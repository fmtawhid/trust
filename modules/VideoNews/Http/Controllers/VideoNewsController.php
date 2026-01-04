<?php

namespace Modules\VideoNews\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\ActivationStatusEnum;
use Illuminate\Support\Facades\Storage;
use Modules\Localize\Entities\Language;
use Modules\Reporter\Entities\Reporter;
use Modules\VideoNews\Entities\VideoNews;
use Illuminate\Contracts\Support\Renderable;
use Modules\VideoNews\DataTables\VideoNewsDataTable;

class VideoNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_video_news')->only('index');
        $this->middleware('permission:create_video_news')->only(['create', 'store']);
        $this->middleware('permission:update_video_news')->only(['edit', 'update', 'updateStatus', 'deleteVideo', 'deleteImage']);
        $this->middleware('permission:delete_video_news')->only('destroy', 'deleteVideo', 'deleteImage');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(VideoNewsDataTable $dataTable)
    {
        return $dataTable->render('videonews::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();
        $reporters = Reporter::all();

        return view('videonews::create', compact('languages', 'reporters'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'reporter_id' => 'required|exists:reporters,id',
            'publish_date' => 'required|date',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:5120',
            'video' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime,video/x-matroska,video/webm,video/ogg,video/mpeg',
            'video_url' => 'nullable|url',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
            'custom_url' => 'nullable|string|max:200',
            'reference' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
        ]);

        // Manage custom url
        $rawTitle = $request->custom_url ?? $request->title ?? null;
        $encode_title = generateSlug($rawTitle);

        // Check the encode_title is unique
        if (VideoNews::where('encode_title', $encode_title)->exists()) {
            return redirect()->back()->with('fail', localize('url_already_exists_alert'));
        }

        // Handle image upload
        $imagePath = '';
        if ($request->hasFile('image')) {
            $request_file = $request->file('image');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $imagePath = $request_file->storeAs('videonews/thumb', $filename, 'public');
        }

        // Handle video upload
        $videoPath = '';
        if ($request->hasFile('video')) {
            $request_file = $request->file('video');
            $filename = time() . rand(10, 1000) . '.' . $request_file->extension();
            $videoPath = $request_file->storeAs('videonews/video', $filename, 'public');
        }

        DB::beginTransaction();
        try {
            VideoNews::create([
                'language_id' => $request->language_id,
                'reporter_id' => $request->reporter_id,
                'publish_date' => $request->publish_date,
                'title' => $request->title,
                'details' => $request->details,
                'thumbnail_image' => $imagePath,
                'image_alt' => $request->image_alt,
                'image_title' => $request->image_title,
                'video' => $videoPath,
                'video_url' => $request->video_url,
                'encode_title' => $encode_title,
                'reference' => $request->reference,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description
            ]);
            
            DB::commit();

            return redirect()->route('videonews.index')->with('success', localize('data_saved_successfully'));


        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', 'Failed to save data: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('videonews::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(VideoNews $videonews)
    {
        $languages = Language::all();
        $reporters = Reporter::all();

        if ($videonews->video) {
            $video_path = asset('storage/' . $videonews->video);
            $is_iframe = false;
        } elseif ($videonews->video_url) {
            if (Str::contains($videonews->video_url, 'youtube.com/watch')) {
                parse_str(parse_url($videonews->video_url, PHP_URL_QUERY), $query);
                $video_id = $query['v'] ?? '';
                $video_path = 'https://www.youtube.com/embed/' . $video_id;
                $is_iframe = true;
            } elseif (Str::contains($videonews->video_url, 'youtu.be')) {
                $video_id = trim(parse_url($videonews->video_url, PHP_URL_PATH), '/');
                $video_path = 'https://www.youtube.com/embed/' . $video_id;
                $is_iframe = true;
            } else {
                $video_path = $videonews->video_url;
                $is_iframe = true;
            }
        } else {
            $video_path = '';
            $is_iframe = false;
        }

        return view('videonews::edit', compact('videonews', 'languages', 'reporters', 'video_path', 'is_iframe'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'reporter_id' => 'required|exists:reporters,id',
            'publish_date' => 'required|date',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,bmp,svg,webp,avif|max:5120',
            'video' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime,video/x-matroska,video/webm,video/ogg,video/mpeg',
            'video_url' => 'nullable|url',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
            'custom_url' => 'nullable|string|max:200',
            'reference' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $videonews = VideoNews::findOrFail($id);

        // Manage custom url
        $rawTitle = $request->custom_url ?? $request->title ?? null;
        $encode_title = generateSlug($rawTitle);

        // Check the encode_title is unique, except for the current record
        if ($videonews->encode_title !== $encode_title && VideoNews::where('encode_title', $encode_title)->exists()) {
            DB::rollback();
            return redirect()->back()->with('fail', localize('url_already_exists_alert'));
        }

        DB::beginTransaction();
        try {
            // Handle image update
            if ($request->hasFile('image')) {
                if ($videonews->thumbnail_image && Storage::disk('public')->exists($videonews->thumbnail_image)) {
                    Storage::disk('public')->delete($videonews->thumbnail_image);
                }

                $imageFile = $request->file('image');
                $imageName = time() . rand(10, 1000) . '.' . $imageFile->extension();
                $imagePath = $imageFile->storeAs('videonews/thumb', $imageName, 'public');
                $videonews->thumbnail_image = $imagePath;
            }

            // Handle video update
            if ($request->hasFile('video')) {
                if ($videonews->video && Storage::disk('public')->exists($videonews->video)) {
                    Storage::disk('public')->delete($videonews->video);
                }

                $videoFile = $request->file('video');
                $videoName = time() . rand(10, 1000) . '.' . $videoFile->extension();
                $videoPath = $videoFile->storeAs('videonews/video', $videoName, 'public');
                $videonews->video = $videoPath;
            }

            $videonews->language_id = $request->language_id;
            $videonews->reporter_id = $request->reporter_id;
            $videonews->publish_date = $request->publish_date;
            $videonews->title = $request->title;
            $videonews->details = $request->details;
            $videonews->video_url = $request->video_url;
            $videonews->image_alt = $request->image_alt;
            $videonews->image_title = $request->image_title;
            $videonews->encode_title = $encode_title;
            $videonews->reference = $request->reference;
            $videonews->meta_keyword = $request->meta_keyword;
            $videonews->meta_description = $request->meta_description;

            $videonews->save();

            DB::commit();

            return redirect()->route('videonews.index')->with('success', localize('data_updated_successfully'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('fail', 'Failed to update data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(VideoNews $videonews)
    {
        try {
            $videonews->delete();

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateStatus(VideoNews $videonews)
    {
        
        $status = $videonews->status->value === ActivationStatusEnum::ACTIVE->value
            ? ActivationStatusEnum::INACTIVE->value
            : ActivationStatusEnum::ACTIVE->value;
        
        try {
            $videonews->update([
                'status' => $status
            ]);

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }

    public function deleteVideo(VideoNews $videonews)
    {
        try {
            if ($videonews->video && Storage::disk('public')->exists($videonews->video)) {
                Storage::disk('public')->delete($videonews->video);
                $videonews->update(['video' => null]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteImage(VideoNews $videonews)
    {
        try {
            if ($videonews->thumbnail_image && Storage::disk('public')->exists($videonews->thumbnail_image)) {
                Storage::disk('public')->delete($videonews->thumbnail_image);
                $videonews->update(['thumbnail_image' => null]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

}
