<?php

namespace Modules\AutoPost\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\AutoPost\Entities\AutoPostSetting;

class AutoPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_auto_posting_media')->only('index');
        $this->middleware('permission:update_auto_post_settings')->only(['update']);

        $this->middleware(['demo'])->only(['update']);
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $facebook = AutoPostSetting::where('platform', 'facebook')->first();
        $twitter = AutoPostSetting::where('platform', 'twitter')->first();

        return view('autopost::index', compact('facebook', 'twitter'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('autopost::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('autopost::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('autopost::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'facebook.is_active' => 'nullable|boolean',
            'twitter.is_active' => 'nullable|boolean',
        ]);

        $rules = [];

        if ($request->input('facebook.is_active')) {
            $rules['facebook.page_id'] = 'required|string';
            $rules['facebook.access_token'] = 'required|string';
        } else {
            $rules['facebook.page_id'] = 'nullable|string';
            $rules['facebook.access_token'] = 'nullable|string';
        }

        if ($request->input('twitter.is_active')) {
            $rules['twitter.is_test_mode'] = 'required|boolean';
            $rules['twitter.api_key'] = 'required|string';
            $rules['twitter.api_secret'] = 'required|string';
            $rules['twitter.access_token'] = 'required|string';
            $rules['twitter.access_token_secret'] = 'required|string';
        } else {
            $rules['twitter.is_test_mode'] = 'required|boolean';
            $rules['twitter.api_key'] = 'nullable|string';
            $rules['twitter.api_secret'] = 'nullable|string';
            $rules['twitter.access_token'] = 'nullable|string';
            $rules['twitter.access_token_secret'] = 'nullable|string';
        }

        $data = $request->validate($rules);

        try {
            DB::beginTransaction();

            // Facebook
            $facebook = AutoPostSetting::firstOrCreate(['platform' => 'facebook']);
            $facebook->update([
                'page_id' => $data['facebook']['page_id'] ?? null,
                'access_token' => $data['facebook']['access_token'] ?? null,
                'is_active' => $request->input('facebook.is_active') ? true : false,
            ]);

            // Twitter
            $twitter = AutoPostSetting::firstOrCreate(['platform' => 'twitter']);
            $twitter->update([
                'is_test_mode' => $request->input('twitter.is_test_mode') ? true : false,
                'api_key' => $data['twitter']['api_key'] ?? null,
                'api_secret' => $data['twitter']['api_secret'] ?? null,
                'access_token' => $data['twitter']['access_token'] ?? null,
                'access_token_secret' => $data['twitter']['access_token_secret'] ?? null,
                'is_active' => $request->input('twitter.is_active') ? true : false,
            ]);

            DB::commit();
            return redirect()->back()->with('success', localize('social_media_settings_updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', localize('failed_to_update_social_media_settings'));
        }
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
}
