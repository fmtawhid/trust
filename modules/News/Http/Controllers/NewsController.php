<?php

namespace Modules\News\Http\Controllers;

use Carbon\Carbon;
use App\Models\NewsMst;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\News\Services\NewsService;
use App\Services\AutoSocialPostService;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use App\Http\Requests\UpdateStatusRequest;
use Modules\News\DataTables\NewsDataTable;
use Modules\News\Services\ReporterService;
use Modules\News\Http\Requests\NewsRequest;
use Illuminate\Contracts\Support\Renderable;
use Modules\AutoPost\Entities\AutoPostSetting;
use Modules\News\Http\Requests\ReporterRequest;

class NewsController extends Controller
{

    public function __construct(
        private NewsService $newsService,
        private ReporterService $reporterService,
    ) {
        $this->middleware('permission:read_news')->only(['index', 'show']);
        $this->middleware('permission:create_news')->only(['create', 'store']);
        $this->middleware('permission:update_news')->only(['edit', 'update', 'updateStatus']);
        $this->middleware(['permission:delete_news'])->only(['destroy']);
        $this->middleware('permission:create_news|update_news')->only(['storeReport']);

        $this->middleware(['demo'])->only(['store', 'updateStatus', 'update', 'destroy', 'storeReport', 'socialPost']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(NewsDataTable $dataTable)
    {
        $data = $this->newsService->filterData();

        return $dataTable->render('news::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = $this->newsService->formData();
        
        return view('news::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(NewsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $news = $this->newsService->create($data);

        return response()->json([
            'success' => true,
            'message' => localize("post_create_successfully"),
            'title'   => localize("post"),
            'data'    => $news,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        $data            = $this->newsService->formData();
        $data['newsMst'] = $this->newsService->newsMstData($id);
        $data['categories'] = Category::onlyParents()->where('language_id', $data['newsMst']->language_id)->get();
        $data['subCategories'] = $this->newsService->getSubCategory($data['newsMst']->category_id);

        return view('news::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function update(NewsRequest $request, int $id): JsonResponse
    {
        $data                = $request->validated();
        $data['news_mst_id'] = $id;
        $news                = $this->newsService->update($data);

        return response()->json([
            'success' => true,
            'message' => localize("post_update_successfully"),
            'title'   => localize("post"),
            'data'    => $news,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, int $id)
    {
        $this->newsService->destroy(['id' => $id]);

        return response()->json([
            'success' => true,
            'message' => localize("post_data_delete_successfully"),
            'title'   => localize("post"),
        ]);
    }

    /**
     * Store Report
     *
     * @param ReporterRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function storeReport(ReporterRequest $request)
    {
        $data     = $request->validated();
        $reporter = $this->reporterService->create($data);

        return response()->json([
            'success' => true,
            'message' => localize_uc("reporter_created_successfully"),
            'title'   => localize_uc("reporter"),
            'data'    => $reporter,
        ]);
    }

    /**
     * Update status
     *
     * @param UpdateStatusRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function updateStatus(UpdateStatusRequest $request, int $id): JsonResponse
    {
        $data                = $request->validated();
        $data['news_mst_id'] = $id;
        $status_span         = $this->newsService->updateStatus($data);

        $socialPostError = null;

        $news = NewsMst::select(['id', 'status', 'stitle', 'title', 'news', 'encode_title', 'publish_date', 'is_auto_post', 'is_posted_to_social'])
            ->where('id', $id)
            ->where('is_auto_post', 1)
            ->whereDate('publish_date', '<=', Carbon::today())
            ->first();

        if ($news) {
            $fb = AutoPostSetting::where('platform', 'facebook')->where('is_active', true)->first();
            $tw = AutoPostSetting::where('platform', 'twitter')->where('is_active', true)->first();

            // Trigger Auto Post if status is "published"
            if (($fb || $tw) && $news->status === 1 && !$news->is_posted_to_social) {

                $result = AutoSocialPostService::autoPost($news);

                if ($result['success']) {
                    $news->update(['is_posted_to_social' => true]);
                } else {
                    $socialPostError = "<span class='text-danger'>{$result['platform']} auto-post failed: {$result['message']}</span>";
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => localize("post_update_status_successfully"). ($socialPostError ? " {$socialPostError}" : ''),
            'title'   => localize("post"),
            'data'    => $status_span,
        ]);
    }

    /**
     * Get sub-categories by category ID
     * @param mixed $categoryId
     * @return JsonResponse|mixed
     */
    public function getSubCategories($categoryId)
    {
        try {
            $categories = Category::where('id', $categoryId)->first();
            if (!$categories) {
                return response()->json(['error' => 'Category not found'], 404);
            }
            $subCategories = Category::where('parents_id', $categories->id)
                ->get(['id', 'category_name']);
            return response()->json($subCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch sub-categories'], 500);
        }
    }

    /**
     * Summary of getCategoriesByLanguage
     * @param mixed $languageId
     * @return JsonResponse|mixed
     */
    public function getCategoriesByLanguage($languageId)
    {
        try {
            $language = Language::where('id', $languageId)->first();
            if (!$language) {
                return response()->json(['error' => 'Language not found'], 404);
            }

            $categories = Category::onlyParents()->where('language_id', $language->id)->get(['id', 'category_name']);
            return response()->json($categories);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch categories'], 500);
        }
    }

    /**
     * Summary of socialPost
     * @param int $id
     * @return JsonResponse
     */
    public function socialPost(int $id): JsonResponse
    {
        $news = NewsMst::select(['id', 'status', 'stitle', 'title', 'news', 'encode_title', 'publish_date', 'is_posted_to_social'])
            ->where('id', $id)
            ->whereDate('publish_date', '<=', Carbon::today())
            ->first();

        if (!$news) {
            return response()->json([
                'success' => false,
                'message' => localize("publish_date_is_not_reached_yet_or_post_not_found"),
                'title'   => localize("social_post"),
            ]);

        } else {
            $fb = AutoPostSetting::where('platform', 'facebook')->where('is_active', true)->first();
            $tw = AutoPostSetting::where('platform', 'twitter')->where('is_active', true)->first();

            if (($fb || $tw) && $news->status === 1 && !$news->is_posted_to_social) {

                $result = AutoSocialPostService::autoPost($news);

                if ($result['success']) {
                    $news->update(['is_auto_post' => true, 'is_posted_to_social' => true]);

                    return response()->json([
                        'success' => true,
                        'message' => localize("post_in_social_successfully"),
                        'title'   => localize("social_post"),
                    ]);

                } else {
                    $socialPostError = "{$result['platform']} auto-post failed: {$result['message']}";
                    return response()->json([
                        'success' => false,
                        'message' => localize("post_in_social_failed") . " {$socialPostError}",
                        'title'   => localize("social_post"),
                    ]);
                }

            } else {
                return response()->json([
                    'success' => false,
                    'message' => localize("post_not_published_yet_or_auto_posting_media_not_configured"),
                    'title'   => localize("social_post"),
                ]);
            }
        }
    }

}
