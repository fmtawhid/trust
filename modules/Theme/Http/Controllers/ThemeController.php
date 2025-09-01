<?php

namespace Modules\Theme\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Theme\Entities\Theme;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_theme')->only('index');
        $this->middleware('permission:update_theme')->only(['updateActiveTheme', 'updateColors']);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $themes = Theme::all();
        $activeTheme = Theme::where('is_active', true)->first();

        return view('theme::index', compact('themes', 'activeTheme'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('theme::create');
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
        return view('theme::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('theme::edit');
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
     * Update the active theme.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateActiveTheme(Request $request)
    {
        $themeId = $request->input('theme_id');
        $updatedBy = auth()->user()->id;

        // Deactivate all themes
        Theme::query()->update(['is_active' => false]);

        // Activate the selected theme
        Theme::where('id', $themeId)->update(['is_active' => true, 'updated_by' => $updatedBy]);

        return redirect()->back()->with('success', 'Theme updated successfully!');
    }

    /**
     * Update the theme colors.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateColors(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'background_color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'font_family' => 'nullable|string|max:255',
            'font_size' => 'nullable|string',
            'hover_color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'footer_color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the theme colors in the database
        $theme = Theme::where('is_active', true)->first();

        if ($theme) {
            $theme->background_color = $request->input('background_color');
            $theme->text_color = $request->input('text_color');
            $theme->font_family = $request->input('font_family');
            $theme->font_size = $request->input('font_size');
            $theme->hover_color = $request->input('hover_color');
            $theme->footer_color = $request->input('footer_color');
            $theme->is_default = 0;
            $theme->updated_by = auth()->user()->id;
            $theme->save();

            return redirect()->back()->with('success', 'Theme colors updated successfully!');
        }

        return redirect()->back()->with('error', 'No active theme found to update colors.');
    }

    public function resetThemeSettings()
    {
        $activeTheme = Theme::where('is_active', true)->first();
        if ($activeTheme && !$activeTheme->is_default) {

            $activeTheme->background_color = null;
            $activeTheme->text_color = null;
            $activeTheme->font_family = null;
            $activeTheme->font_size = null;
            $activeTheme->hover_color = null;
            $activeTheme->footer_color = null;
            $activeTheme->updated_by = auth()->user()->id;
            $activeTheme->is_default = true;
            $activeTheme->save();

            return redirect()->back()->with('success', 'Theme settings reset to default successfully!');
        }

        return redirect()->back()->with('error', 'No default settings found to reset.');
    }
}
