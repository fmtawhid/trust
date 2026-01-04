<?php

namespace Modules\Opinion\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\ActivationStatusEnum;
use Modules\Opinion\Entities\Opinion;
use Illuminate\Support\Facades\Storage;
use Modules\Localize\Entities\Language;
use Illuminate\Contracts\Support\Renderable;
use Modules\Opinion\DataTables\OpinionDataTable;



class OpinionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_opinion')->only('index');
        $this->middleware('permission:create_opinion')->only(['create', 'store']);
        $this->middleware('permission:update_opinion')->only(['edit', 'update', 'updateStatus']);
        $this->middleware('permission:delete_opinion')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(OpinionDataTable $dataTable)
    {
        return $dataTable->render('opinion::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();

        return view('opinion::create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $person_image_path = '';
        $news_image_path = '';

        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'name' => 'required',
            'title' => 'required',
            'details' => 'required',
        ]);

        if ($request->hasFile('person_image')) {
            $request_file = $request->file('person_image');
            $filename = time() . rand(10, 1000) . '_person.' . $request_file->extension();
            $person_image_path = $request_file->storeAs('opinion', $filename, 'public');
        }

        if ($request->hasFile('news_image')) {
            $request_file = $request->file('news_image');
            $filename = time() . rand(10, 1000) . '_news.' . $request_file->extension();
            $news_image_path = $request_file->storeAs('opinion', $filename, 'public');
        }


        $rawTitle = $request->custom_url ?? $request->title ?? null;
        $encode_title = generateSlug($rawTitle);

        DB::beginTransaction();

        try {
            Opinion::create([
                'language_id'       => $request->language_id,
                'name'              => $request->name,
                'designation'       => $request->designation,
                'encode_title'      => $encode_title,
                'title'             => $request->title,
                'content'           => $request->details,
                'person_image'      => $person_image_path ?? null,
                'news_image'        => $news_image_path ?? null,
                'image_alt'         => $request->image_alt,
                'image_title'       => $request->image_title,
                'meta_keyword'      => $request->meta_keyword,
                'meta_description'  => $request->meta_description
            ]);
            
            DB::commit();

            return redirect()->route('opinion.index')
                            ->with('success', localize('opinion_create_successfully'));

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to save data: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('opinion::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Opinion $opinion)
    {
        $languages = Language::all();

        return view('opinion::edit', compact('opinion', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $opinion = Opinion::findOrFail($id);

        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'name'        => 'required',
            'title'       => 'required',
            'details'     => 'required',
        ]);

        $person_image_path = $opinion->person_image;
        $news_image_path = $opinion->news_image;

        if ($request->hasFile('person_image')) {
            // Optionally delete old image
            if ($person_image_path && Storage::disk('public')->exists($person_image_path)) {
                Storage::disk('public')->delete($person_image_path);
            }

            $file = $request->file('person_image');
            $filename = time() . rand(10, 1000) . '_person.' . $file->extension();
            $person_image_path = $file->storeAs('opinion', $filename, 'public');
        }

        if ($request->hasFile('news_image')) {
            // Optionally delete old image
            if ($news_image_path && Storage::disk('public')->exists($news_image_path)) {
                Storage::disk('public')->delete($news_image_path);
            }

            $file = $request->file('news_image');
            $filename = time() . rand(10, 1000) . '_news.' . $file->extension();
            $news_image_path = $file->storeAs('opinion', $filename, 'public');
        }

        $rawTitle = $request->custom_url ?? $request->title ?? null;
        $encode_title = generateSlug($rawTitle);

        DB::beginTransaction();

        try {
            $opinion->update([
                'language_id'      => $request->language_id,
                'name'             => $request->name,
                'designation'      => $request->designation,
                'encode_title'     => $encode_title,
                'title'            => $request->title,
                'content'          => $request->details,
                'person_image'     => $person_image_path,
                'news_image'       => $news_image_path,
                'image_alt'        => $request->image_alt,
                'image_title'      => $request->image_title,
                'meta_keyword'     => $request->meta_keyword,
                'meta_description' => $request->meta_description
            ]);

            DB::commit();

            return redirect()->route('opinion.index')
                            ->with('success', localize('opinion_updated_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Failed to update data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Opinion $opinion)
    {
        DB::beginTransaction();

        try {
            $opinion->delete();

            DB::commit();

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateStatus(Opinion $opinion)
    {
        $status = $opinion->status->value === ActivationStatusEnum::ACTIVE->value
            ? ActivationStatusEnum::INACTIVE->value
            : ActivationStatusEnum::ACTIVE->value;

        try {
            $opinion->update([
                'status' => $status
            ]);

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }
}
