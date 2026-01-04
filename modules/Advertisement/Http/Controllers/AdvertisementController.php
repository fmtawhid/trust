<?php

namespace Modules\Advertisement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Localize\Entities\Language;
use Illuminate\Contracts\Support\Renderable;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Advertisement\DataTables\AdvertisementDataTable;
use Modules\Theme\Entities\Theme;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_advertise')->only('index');
        $this->middleware('permission:create_advertise')->only(['create','store']);
        $this->middleware('permission:update_advertise')->only(['edit','update', 'updateLgStatus', 'updateSmStatus']);
        $this->middleware('permission:delete_advertise')->only('destroy');
        $this->middleware('demo')->only(['updateLgStatus','updateSmStatus','store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AdvertisementDataTable $dataTable)
    {
        return $dataTable->render('advertisement::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();
        $themes = Theme::select('id', 'name', 'is_active')->get();

        return view('advertisement::create', compact('languages', 'themes'));
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
        'theme' => 'required',
        'page' => 'required',
        'ad_position' => 'required',
        'ad_type' => 'required',
    ]);

    $ad_type = $request->ad_type;
    $embed_code_link = '';

    if ($ad_type == 1) {
        $request->validate([
            'embed_code' => 'required',
        ]);
        $embed_code_link = $request->embed_code;

    } elseif ($ad_type == 2) {
        $request->validate([
            'ad_url'   => 'required',
            'ad_image' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:1024',
        ]);

        if ($request->hasFile('ad_image') && $request->file('ad_image')->isValid()) {
            $request_file = $request->file('ad_image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();

            // Ensure 'ad_image' folder exists in public/storage
            $folderPath = public_path('storage/ad_image');
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            // Move the uploaded file to public/storage/ad_image
            $request_file->move($folderPath, $filename);

            // Save relative path for DB
            $path = 'ad_image/' . $filename;

            // Build embed code
            $ad_img = asset('storage/' . $path);
            $ad_img_url = $this->addhttp(trim($request->ad_url));
            $embed_code_link = '<a target="_blank" href="' . $ad_img_url . '"><img width="100%" src="' . $ad_img . '" alt=""></a>';
        }
    }

    try {
        Advertisement::create([
            'language_id' => $request->language_id,
            'theme' => $request->theme,
            'page' => $request->page,
            'ad_position' => $request->ad_position,
            'ad_type' => $ad_type,
            'embed_code' => $embed_code_link,
        ]);

        return response()->json(['error' => false, 'msg' => localize('data_saved_successfully')]);
    } catch (\Exception $e) {
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
        return view('advertisement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Advertisement $advertise)
    {
        $languages = Language::all();
        $themes = Theme::select('id', 'name', 'is_active')->get();

        // Define the matrix
        $positionsMatrix = [
            1 => [ // Theme 1
                1 => 7,
                2 => 4,
                3 => 4,
            ],
            2 => [ // Theme 2
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            3 => [ // Theme 3
                1 => 4,
                2 => 4,
                3 => 4,
            ],
            4 => [ // Theme 4
                1 => 7,
                2 => 4,
                3 => 4,
            ],
            5 => [ // Theme 5
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            6 => [ // Theme 6
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            // Add more themes if needed
        ];

        $theme_id = $advertise->theme;
        $page = $advertise->page;

        $count = $positionsMatrix[$theme_id][$page] ?? 0;

        $positions = [];
        for ($i = 1; $i <= $count; $i++) {
            $positions[] = [
                'id'   => $i,
                'name' => localize('ads_position') . ' ' . $i,
            ];
        }

        return view('advertisement::edit', compact('advertise', 'languages', 'themes', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $advertise = Advertisement::findOrFail($id);

        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'theme' => 'required',
            'page' => 'required',
            'ad_position' => 'required',
            'ad_type' => 'required',
        ]);

        $path =  '';
        $ad_type = $request->ad_type;
        $embed_code_link = '';
        if ($ad_type == 1) {
            $request->validate([
                'embed_code' => 'required', // Additional validation rule
            ]);

            $embed_code_link = $request->embed_code;

        } elseif ($ad_type == 2) {

            $request->validate([
                'ad_url'   => 'required',
                'ad_image' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:1024', // 1024 KB
            ]);

            if ($request->hasFile('ad_image')) {

                $request_file = $request->file('ad_image');
                $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
                $path = $request_file->storeAs('ad_image', $filename, 'public');

                $ad_img = asset('storage/' . $path);
                $ad_img_url = $this->addhttp(trim(@$request->ad_url));
                $embed_code_link = '<a target="_blank" href="' . $ad_img_url . '"><img width="100%" src="' . $ad_img . '" alt=""></a>';
            }
        }

        try {

            $advertise_up = $advertise->update([
                'language_id'      => $request->language_id,
                'theme'            => $request->theme,
                'page'             => $request->page,
                'ad_position'      => $request->ad_position,
                'ad_type'          => $ad_type,
                'embed_code'       => $embed_code_link,
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
    public function destroy(Advertisement $advertise)
    {

        $advertise->delete();

        return response()->json(['success' => 'success']);
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateLgStatus(Advertisement $advertise)
    {
        $status = ($advertise->large_status==1?'0':'1');

        try {

            $advertise_up = $advertise->update([
                'large_status'    => $status
            ]);

            // If the creation was successful, redirect with success message
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateSmStatus(Advertisement $advertise)
    {
        $status = ($advertise->mobile_status==1?'0':'1');

        try {

            $advertise_up = $advertise->update([
                'mobile_status'    => $status
            ]);

            // If the creation was successful, redirect with success message
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            // If an exception occurs (e.g., validation error, database error), handle it here
            return response()->json(['fail' => 'fail']);
        }
    }

    #----------------------------------
    #      To add http dynamically
    #----------------------------------
    function addhttp($url) {

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }

    public function getPagePositions(Request $request)
    {

        $theme_id = (int) $request->input('theme_id');
        $page     = (int) $request->input('page');

        // Define positions per theme-page combination
        $positionsMatrix = [
            1 => [ // Theme 1, page => adds
                1 => 7,
                2 => 4,
                3 => 4,
            ],
            2 => [ // Theme 2
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            3 => [ // Theme 3
                1 => 4,
                2 => 4,
                3 => 4,
            ],
            4 => [ // Theme 4
                1 => 7,
                2 => 4,
                3 => 4,
            ],
            5 => [ // Theme 5
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            6 => [ // Theme 6
                1 => 6,
                2 => 4,
                3 => 4,
            ],
            // Add more themes here as needed
        ];

        $count = $positionsMatrix[$theme_id][$page] ?? 0;

        $positions = [];
        for ($i = 1; $i <= $count; $i++) {
            $positions[] = [
                'id'   => $i,
                'name' => localize('ads_position').' ' . $i,
            ];
        }

        return response()->json(['positions' => $positions]);
    }

}
