<?php

namespace Modules\RssFeeds\Http\Controllers;

use App\Models\NewsMst;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\RssFeeds\Entities\RssFeed;
use Modules\Localize\Entities\Language;
use Modules\Setting\Entities\Language as EntitiesLanguage;
use Illuminate\Contracts\Support\Renderable;
use Modules\RssFeeds\DataTables\RssFeedsDataTable;

class RssFeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_rss_sitemap_link')->only('index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $languages = Language::all();
        $defaultLang = EntitiesLanguage::getDefault();
        
        return view('rssfeeds::index', compact('languages', 'defaultLang'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();

        return view('rssfeeds::create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'feed_name'             => 'required|string|max:255',
            'feed_url'              => 'required|url|max:2000',
            'number_of_posts'       => 'required|integer|min:0',
            'paper_language'        => 'required|exists:languages,id',
            'show_read_more_button' => 'nullable|boolean',
            'read_more_button_text' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            // Manage slug
            $rawTitle = 'rss-'.$request->paper_language.'-'.$request->feed_name;
            $slug = generateSlug($rawTitle);

            RssFeed::create([
                'feed_name'     => $request->feed_name,
                'slug'          => $slug,
                'feed_url'      => $request->feed_url,
                'posts'         => $request->number_of_posts,
                'paper_language'=> $request->paper_language,
                'show_button'   => $request->has('show_read_more_button') ? 1 : 0,
                'button_text'   => $request->read_more_button_text,
                'status'        => 1,
            ]);

            DB::commit();

            return redirect()->route('rss_feeds.show')->with('success', localize('data_saved_successfully'));

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'error' => true,
                'msg'   => 'Failed to save data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Summary of show
     * @param \Modules\RssFeeds\DataTables\RssFeedsDataTable $dataTable
     */
    public function show(RssFeedsDataTable $dataTable)
    {
        return $dataTable->render('rssfeeds::list');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(RssFeed $rss)
    {
        $languages = Language::all();
        return view('rssfeeds::edit', compact('rss', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, RssFeed $rss)
    {
        $request->validate([
            'feed_name'             => 'required|string|max:255',
            'feed_url'              => 'required|url|max:2000',
            'number_of_posts'       => 'required|integer|min:0',
            'paper_language'        => 'required|exists:languages,id',
            'show_read_more_button' => 'nullable|boolean',
            'read_more_button_text' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Manage slug
            $rawTitle = 'rss-'.$request->paper_language.'-'.$request->feed_name;
            $slug = generateSlug($rawTitle);

            $rss->update([
                'feed_name'     => $request->feed_name,
                'slug'          => $slug,
                'feed_url'      => $request->feed_url,
                'posts'         => $request->number_of_posts,
                'paper_language'=> $request->paper_language,
                'show_button'   => $request->has('show_read_more_button') ? 1 : 0,
                'button_text'   => $request->read_more_button_text,
            ]);

            DB::commit();

            return redirect()->route('rss_feeds.show')->with('success', localize('data_updated_successfully'));

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => true,
                'msg'   => 'Failed to update data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Summary of destroy
     * @param \Modules\RssFeeds\Entities\RssFeed $rss
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(RssFeed $rss)
    {
        DB::beginTransaction();

        try {
            $rss->delete();

            DB::commit();

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Summary of updateStatus
     * @param \Modules\RssFeeds\Entities\RssFeed $rss
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateStatus(RssFeed $rss)
    {
        $status = $rss->status === 1 ? 0 : 1;

        try {
            $rss->update([
                'status' => $status
            ]);

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }

    public function googleNewsRss()
    {
        $languageId = EntitiesLanguage::getDefault()->id;
        $newsItems = NewsMst::select(['encode_title', 'title', 'last_update', 'news', 'language_id', 'image', 'post_by'])
        ->with(['language', 'photoLibrary', 'postByUser'])
        ->where('status', 1)->where('language_id', $languageId)
        ->latest()
        ->take(1000)
        ->get();

        $website_title = app_setting()->title;
        $defaultLang = EntitiesLanguage::getDefault()->value;

        return response()->view('rssfeeds::google_news_rss', compact('newsItems', 'website_title', 'defaultLang'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}
