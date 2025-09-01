<?php

namespace Modules\Category\Http\Controllers;

use App\Models\NewsMst;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\NewsPositionMap;
use App\Models\HomePagePosition;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Menu\Entities\MenuContent;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Entities\CategoryTopic;
use Modules\Category\DataTables\CategoryDataTable;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_category')->only('index');
        $this->middleware('permission:create_category')->only(['create', 'store']);
        $this->middleware('permission:update_category')->only(['edit', 'update']);
        $this->middleware('permission:delete_category')->only('destroy');

        $this->middleware('demo')->only(['saveCategoryImgStatus','update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::where('category_type', 2)->get();

        $parent_categories = Category::where('category_type', 1)
        ->where(function($query) {
            $query->whereNull('parents_id')
                ->orWhere('parents_id', '');
        })->get();
        $languages = Language::all();
        
        return view('category::create', compact('categories', 'parent_categories', 'languages'));
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
            'category_name' => 'required',
            'category_type' => 'required',
            'slug' => 'required',
            'category_image' => 'file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:1024', // 1024 KB
        ]);

        // Manage slug
        $rawTitle = $request->slug ?? $request->category_name ?? null;
        $slug = generateSlug($rawTitle);

        // making query to check category is exist or not
        if ($slug != '') {
            $check_data_exist = $this->check_category_existence($slug);
            // if it is exist already
            if ($check_data_exist) {
                // You can customize the error message based on the type of exception
                return response()->json(['error' => true, 'msg' => 'Category already exists !']);
            }
        }

        if ($request->hasFile('category_image')) {
            $request_file = $request->file('category_image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $path = $request_file->storeAs('category', $filename, 'public');
        }

        try {

            if ($request->category_type == 2) {
                $parentsId = null;
            } else {;
                $parentsId = $request->parents_id ?? null;
            }

            $category = Category::create([
                'language_id'      => $request->language_id,
                'category_name'    => $request->category_name,
                'category_type'    => $request->category_type,
                'slug'             => $slug,
                'parents_id'       => $parentsId,
                'description'      => $request->description,
                'meta_keyword'     => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'color_code'       => $request->color_code,
                'category_imgae'   => $path
            ]);

            if($category && $request->category_type == 2){
                $topics = $request->category_topic;
                
                // Delete existing records by cat_slug
                CategoryTopic::where('cat_slug', $slug)->delete();

                // Insert new records
                if(!empty($topics)){
                    foreach ($topics as $topic) {
                        CategoryTopic::create([
                            'cat_slug' => $slug,
                            'topic' => $topic
                        ]);
                    }
                }
            }

            // If the creation was successful, redirect with success message
            return response()->json(['error' => false, 'msg' => localize('data_saved_successfully')]);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            // You can customize the error message based on the type of exception
            return response()->json(['error' => true, 'msg' => 'Failed to save data: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Category $category)
    {
        $categories = Category::where('category_type', 2)->get();
        $category = Category::findOrFail($category->id);

        // Use query builder to join the tables and get the results
        $topics = DB::table('category_topics')
                ->join('categories', 'categories.slug', '=', 'category_topics.topic')
                ->select('category_topics.topic')
                ->where('category_topics.cat_slug', $category->slug)
                ->where('category_topics.deleted_at', Null)
                ->pluck('category_topics.topic')
                ->toArray();

        $parent_categories = Category::where('category_type', 1)
            ->where(function($query) {
                $query->whereNull('parents_id')
                    ->orWhere('parents_id', '');
            })->get();

        $parent_category = Category::where('id', $category->parents_id)->first();
        $languages = Language::all();

        return view('category::edit', compact('categories','category', 'topics', 'parent_categories', 'parent_category', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $category = Category::findOrFail($id);

        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'category_name' => 'required',
            'category_type' => 'required',
            'slug' => 'required',
            'category_image' => 'file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:1024', // 1024 KB
        ]);

        // Manage slug
        $rawTitle = $request->slug ?? $request->category_name ?? null;
        $slug = generateSlug($rawTitle);

        // making query to check category is exist or not
        if ($slug != '' && $slug != $category->slug) {
            $check_data_exist = $this->check_category_existence($slug);
            // if it is exist already
            if ($check_data_exist) {
                // You can customize the error message based on the type of exception
                return response()->json(['error' => true, 'msg' => 'Category already exists !']);
            }
        }

        $path =  $category->category_imgae;

        if ($request->hasFile('category_image')) {
             // Delete previous signature if it exists
             Storage::delete('public/' . $category->category_imgae);

            $request_file = $request->file('category_image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $path = $request_file->storeAs('category', $filename, 'public');
        }

        try {

            if ($request->category_type == 2) {
                $parentsId = null;
            } else {;
                $parentsId = $request->parents_id ?? null;
            }

            $category_up = $category->update([
                'language_id'      => $request->language_id,
                'category_name'    => $request->category_name,
                'category_type'    => $request->category_type,
                'slug'             => $slug,
                'parents_id'       => $parentsId,
                'description'      => $request->description,
                'meta_keyword'     => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'color_code'       => $request->color_code,
                'category_imgae'   => $path
            ]);

            if($category_up && $request->category_type == 2) {
                $topics = $request->category_topic;

                CategoryTopic::where('cat_slug', $slug)->delete();

                // Insert new records
                if(!empty($topics)){
                    foreach ($topics as $topic) {
                        CategoryTopic::create([
                            'cat_slug' => $slug,
                            'topic' => $topic
                        ]);
                    }
                }
            }

            // Update slug in menu_contents where content_type='categories' and content_id = $id
            MenuContent::where('content_type', 'categories')
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

    public function check_category_existence($slug){
        return Category::where('slug', $slug)->exists();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        if ($category->category_imgae) {
            Storage::delete('public/' . $category->category_imgae);
        }

        HomePagePosition::where('category_id', $category->id)->delete();
        CategoryTopic::where('cat_slug', $category->slug)->delete();
        Category::where('id', $category->id)->delete();

        return response()->json(['success' => 'success']);
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function saveCategoryImgStatus(Category $category)
    {
        $status = ($category->img_status==1?'0':'1');
        $contentStatus = $category->img_status == 1 ? '1' : '0';

        try {

            $category->update([
                'img_status'    => $status
            ]);

            MenuContent::where('content_id', $category->id)
                ->where('content_type', 'categories')
                ->update([
                    'status' => $contentStatus
                ]);

            NewsPositionMap::where('category_id', $category->id)
                ->update([
                    'status' => $contentStatus
                ]);

            NewsMst::where('category_id', $category->id)
                ->update([
                    'status' => $contentStatus
                ]);

            // If the creation was successful, redirect with success message
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            return response()->json(['fail' => 'fail']);
        }
    }

}
