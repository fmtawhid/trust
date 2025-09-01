<?php

namespace Modules\Setting\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HomePagePosition;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use Modules\Setting\Entities\TopBreaking;
use Illuminate\Contracts\Support\Renderable;

class ViewSetupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['demo'])->only(['store', 'homePageSettingsStore', 'contactPageSetupStore', 'homePageSettingsSave']);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('setting::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function setupTopBreaking()
    {
        $top_breaking = TopBreaking::first();
        $categories   = Category::where('category_type', 2)->get();
        return view('setting::web_setup.setup_top_breaking', compact('categories', 'top_breaking'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $record = TopBreaking::first();
        $data = [
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'background_color' => $request->background_color,
            'status'           => $request->status,
        ];

        if($record == null){

            try {

                $record_create = TopBreaking::create($data);

                // If the creation was successful, redirect with success message
                return response()->json(['error' => false, 'msg' => localize('data_saved_successfully')]);
            } catch (\Exception $e) {
                // If an exception occurs (e.g., validation error, database error), handle it here
                // You can customize the error message based on the type of exception
                return response()->json(['error' => true, 'msg' => 'Failed to save data: ' . $e->getMessage()]);
            }
        }else{

            try {

                $record_up = $record->update($data);

                // If the creation was successful, redirect with success message
                return response()->json(['error' => false, 'msg' => localize('data_updated_successfully')]);
            } catch (\Exception $e) {
                // If an exception occurs (e.g., validation error, database error), handle it here
                // You can customize the error message based on the type of exception
                return response()->json(['error' => true, 'msg' => 'Failed to update data: ' . $e->getMessage()]);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function contactPageSetup()
    {
        $contact_setting = Setting::where('id',113)->first();
        $contact_setting_page = json_decode($contact_setting->details);

        return view('setting::web_setup.contact_page_setup', compact('contact_setting_page'));
    }

   /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function contactPageSetupStore(Request $request)
    {
        $contact_page = Setting::where('id',113)->first();

        $S_data ['id'] = 113;
        $S_data ['event'] = 'contact_page_setup';

        $post['editor'] = $request->input('editor');
        $post['content'] = $request->input('content');
        $post['address'] = $request->input('address');
        $post['phone'] = $request->input('phone');
        $post['phone_two'] = $request->input('phone_two');
        $post['email'] = $request->input('email');
        $post['website'] = $request->input('website');
        $post['latitude'] = $request->input('latitude');
        $post['longitude'] = $request->input('longitude');
        $post['map'] = $request->input('map');

        $S_data ['details'] = json_encode($post);

        try {

            $contact_page_up = $contact_page->update($S_data);

            // If the creation was successful, redirect with success message
            return response()->json(['error' => false, 'msg' => localize('data_updated_successfully')]);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            // You can customize the error message based on the type of exception
            return response()->json(['error' => true, 'msg' => 'Failed to update data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function homePageSettings()
    {
        $home_page_settings = HomePagePosition::orderBy('language_id', 'ASC')->get();
        $categories         = Category::onlyParents()->get();
        $languages          = Language::all();
        return view('setting::web_setup.home_page_setup', compact('home_page_settings', 'categories', 'languages'));
    }

    /**
     * Summary of homePageSettingsSave
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function homePageSettingsSave(Request $request)
    {
        $request->validate([
            'language_id'   => 'required',
            'position_no'   => 'required|integer|min:1',
            'category_name' => 'required',
        ]);

        $position_no = (int) $request->input('position_no'); // keep as 1-based
        $language_id = $request->input('language_id');
        $category_id = $request->input('category_name');

        $cat_info = Category::where('category_id', $category_id)->first();

        if (!$cat_info) {
            return response()->json(['error' => true, 'msg' => 'Invalid category']);
        }

        // Get entries for this language ordered by position
        $homePagePositions = HomePagePosition::where('language_id', $language_id)
                                ->orderBy('position_no')
                                ->get();

        $insertData = [
            'language_id'   => $language_id,
            'position_no'   => $position_no,
            'slug'          => $cat_info->slug,
            'cat_name'      => $cat_info->category_name,
            'category_id'   => $category_id,
            'status'        => 0,
        ];

        

        try {
            // Shift existing items if inserting within range
            foreach ($homePagePositions as $position) {
                if ($position->position_no >= $position_no) {
                    $position->position_no += 1;
                    $position->save();
                }
            }

            // Insert the new record
            HomePagePosition::create($insertData);

            return response()->json(['error' => false, 'msg' => localize('data_updated_successfully')]);

        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => 'Failed to update data: ' . $e->getMessage()]);
        }
    }

    /**
     * Summary of homePageSettingsStore
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function homePageSettingsStore(Request $request)
    {
        $language_ids  = $request->input('language_id');     // array
        $position_nos  = $request->input('position_no');     // array
        $category_ids  = $request->input('category_id');     // array
        $statuses      = $request->input('status');          // array
        $now           = Carbon::now();

        $new_data = [];

        // Group positions by language
        $grouped = [];

        foreach ($position_nos as $key => $position) {
            $lang_id = $language_ids[$key];
            $grouped[$lang_id][$position] = [
                'language_id'   => $lang_id,
                'position_key'  => $position,
                'category_id'   => $category_ids[$position] ?? null,
                'status'        => isset($statuses[$position]) ? $statuses[$position] : 0,
            ];
        }

        // Rebuild data assigning fresh position_no per language
        foreach ($grouped as $lang_id => $items) {
            $i = 1;
            foreach ($items as $original_position => $item) {
                $cat_info = Category::where('category_id', $item['category_id'])->first();

                if ($cat_info) {
                    $new_data[] = [
                        'language_id' => $lang_id,
                        'position_no' => $i,
                        'cat_name'    => $cat_info->category_name,
                        'slug'        => $cat_info->slug,
                        'category_id' => $item['category_id'],
                        'status'      => $item['status'],
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ];
                    $i++;
                }
            }
        }

        try {
            HomePagePosition::truncate(); // Clear previous entries
            HomePagePosition::insert($new_data); // Insert new grouped data

            return response()->json(['error' => false, 'msg' => localize('data_updated_successfully')]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => 'Failed to update data: ' . $e->getMessage()]);
        }
    }

}
