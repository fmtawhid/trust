<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\SocialLoginApiKey;

class SocialLoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $socialApiKey = SocialLoginApiKey::all()->keyBy('provider');
        return view('setting::social_api.index', compact('socialApiKey'));
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
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'facebook_client_id' => 'nullable|string',
            'facebook_client_secret' => 'nullable|string',
            'google_client_id' => 'nullable|string',
            'google_client_secret' => 'nullable|string',
        ]);

        // Update or Create Facebook entry
        SocialLoginApiKey::updateOrCreate(
            ['provider' => 'facebook'],
            [
                'client_id' => $request->facebook_client_id,
                'client_secret' => $request->facebook_client_secret,
                'status' => 1,
            ]
        );

        // Update or Create Google entry
        SocialLoginApiKey::updateOrCreate(
            ['provider' => 'google'],
            [
                'client_id' => $request->google_client_id,
                'client_secret' => $request->google_client_secret,
                'status' => 1,
            ]
        );

        return redirect()->back()->with('success', 'Social login keys updated successfully.');
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
}
