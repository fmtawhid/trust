<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Menu\Entities\MenuContent;
use Illuminate\Support\Facades\Storage;
use Modules\Localize\Entities\Language;
use Modules\Page\DataTables\PageDataTable;
use Illuminate\Contracts\Support\Renderable;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_page')->only('index');
        $this->middleware('permission:create_page')->only(['create','store']);
        $this->middleware('permission:update_page')->only(['edit','update','updatePageStatus']);
        $this->middleware(['permission:delete_page'])->only('destroy');

        $this->middleware(['demo'])->only(['store', 'updatePageStatus','update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('page::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();

        return view('page::create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $path = '';
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'title' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png|max:1024', // 1024 KB
        ]);

        // Manage slug
        $rawTitle = $request->slug ?? $request->title ?? null;
        $slug = generateSlug($rawTitle);

        if ($request->hasFile('image')) {
            $request_file = $request->file('image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $path = $request_file->storeAs('page', $filename, 'public');
        }

        try {

            $data = array(
                'language_id'   => $request->language_id,
                'title'         => $request->title,
                'page_slug'     => $slug,
                'description'   => $request->details_news,
                'image_id'      => $path,
                'video_url'     => $this->get_youtube_id_from_url($request->videos),
                'publishar_id'  => Auth::id(),
                'seo_keyword'   => trim($request->meta_keyword),
                'seo_description' => trim($request->meta_description),
                'publish_date'  => date("Y-m-d h:m:s")
            );

            $page = Page::create($data);

            // If the creation was successful, redirect with success message
            return response()->json(['error' => false, 'msg' => localize('data_saved_successfully')]);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            // You can customize the error message based on the type of exception
            return response()->json(['error' => true, 'msg' => 'Failed to save data: ' . $e->getMessage()]);
        }
    }

    #----------------------------
    #  Get youtube id for url
    #----------------------------
    public function get_youtube_id_from_url($url) {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $url, $match)) {
        return $match['1'];
        }else{
            return $url;
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Page $page)
    {
        $languages = Language::all();

        return view('page::edit', compact('page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $pageData = Page::findOrFail($id);

        $path = $pageData->image_id;
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'title' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png|max:1024', // 1024 KB
        ]);

        // Manage slug
        $rawTitle = $request->slug ?? $request->title ?? null;
        $slug = generateSlug($rawTitle);

        if ($request->hasFile('image')) {
            if ($pageData->image_id) {
                Storage::disk('public')->delete($pageData->image_id);
            }
            $request_file = $request->file('image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $path = $request_file->storeAs('page', $filename, 'public');
        }

        try {

            $data = array(
                'language_id'   => $request->language_id,
                'title'         => $request->title,
                'page_slug'     => $slug,
                'description'   => $request->details_news,
                'image_id'      => $path,
                'video_url'     => $request->videos ? $request->videos : $pageData->video_url,
                'publishar_id'  => Auth::id(),
                'seo_keyword'   => trim($request->meta_keyword),
                'seo_description' => trim($request->meta_description),
                'publish_date'  => date("Y-m-d h:m:s")
            );

            $pageData->update($data);

            // Update slug in menu_contents where content_type='pages' and content_id = $id
            MenuContent::where('content_type', 'pages')
                ->where('content_id', $id)
                ->update([
                    'slug'  => $slug,
                ]);

            // If the creation was successful, redirect with success message
            return response()->json(['error' => false, 'msg' => localize('data_updated_successfully')]);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            // You can customize the error message based on the type of exception
            return response()->json(['error' => true, 'msg' => 'Failed to update data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json(['success' => 'success']);
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updatePageStatus(Page $page)
    {
        $status = ($page->status==1?'0':'1');

        try {

            $page_up = $page->update([
                'status'    => $status
            ]);

            // If the creation was successful, redirect with success message
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Upload file from CKEDITOR.
     * @param int $id
     * @return Renderable
     */
    public function upload_ckeditor_data(Request $request)
    {
        $path = '';
        if ($request->hasFile('upload')) {

            $request_file = $request->file('upload');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $path = $request_file->storeAs('ckeditor_media', $filename, 'public');

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/' . $path);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
