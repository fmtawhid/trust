<?php

namespace Modules\Setting\Http\Controllers;

use App\Enums\FontSourceEnum;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\FontSetting;
use Illuminate\Contracts\Support\Renderable;
use Modules\Setting\DataTables\FontFamilyDataTable;

class FontSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(FontFamilyDataTable $fontFamilyDataTable)
    {
        return $fontFamilyDataTable->render('setting::font_setting.index');
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
        $validated = $request->validate([
            'font_name' => 'required|string|max:255',
            'source_url' => 'required|url|max:1000',
            'font_family' => 'required|string|max:255',
        ]);

        // 2. Store the font settings
        FontSetting::create([
            'name' => $validated['font_name'],
            'source_url' => $validated['source_url'],
            'font_family' => $validated['font_family'],
            'source' => FontSourceEnum::GOOGLE->value,
            'created_by' => auth()->user()->id
        ]);

        // 3. Redirect with success message
        return redirect()->back()->with('success', 'Font added successfully!');
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
        $fontSetting = FontSetting::findOrFail($id);
        return view('setting::font_setting.edit', compact('fontSetting'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'font_name' => 'required|string|max:255',
            'source_url' => 'required|url|max:1000',
            'font_family' => 'required|string|max:255',
        ]);

        $fontSetting = FontSetting::findOrFail($id);
        $fontSetting->update([
            'name' => $validated['font_name'],
            'source_url' => $validated['source_url'],
            'font_family' => $validated['font_family'],
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->route('admin.font.settings.index')->with('success', 'Font updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id)
    {
        $fontSetting = FontSetting::findOrFail($id);
        $fontSetting->delete();

        return redirect()->route('admin.font.settings.index')->with('success', 'Font deleted successfully!');
    }
}
