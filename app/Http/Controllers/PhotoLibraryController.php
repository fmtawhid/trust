<?php

namespace App\Http\Controllers;

use App\DataTables\PhotoLibraryDataTable;
use App\Http\Requests\PhotoLibraryRequest;
use App\Services\PhotoLibraryService;
use Illuminate\Http\Request;

class PhotoLibraryController extends Controller
{
    public function __construct(private PhotoLibraryService $photoLibraryService)
    {
        $this->middleware('permission:read_media_library')->only(['index']);
        $this->middleware('permission:create_media_library')->only(['create', 'store']);
        $this->middleware('permission:create_news|update_news|create_post|update_post')->only(['show', 'store']);
        $this->middleware('permission:delete_media_library')->only(['destroy']);

        $this->middleware('demo')->only(['store', 'destroy']);
    }

    public function index(PhotoLibraryDataTable $dataTable)
    {
        return $dataTable->render('backend.photo-library.index');
    }

    public function create(Request $request)
    {
        $data = $this->photoLibraryService->formData($request->all());
        return view('backend.photo-library.create', $data);
    }

    public function store(PhotoLibraryRequest $request)
    {
        $data = $request->validated();

        // Handle original image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = time() . '-photo.' . $file->getClientOriginalExtension();
            $folderPath = public_path('uploads/photo-library');
            if (!is_dir($folderPath)) mkdir($folderPath, 0755, true);

            $file->move($folderPath, $name);

            $data['image'] = 'uploads/photo-library/' . $name;
        }

        // Handle cropped thumb image (blob)
        if (!empty($data['cropped_thumb'])) {
            $data['cropped_thumb_path'] = $this->saveBlobImage($data['cropped_thumb'], 'thumb');
        }

        // Handle cropped large image (blob)
        if (!empty($data['cropped_large'])) {
            $data['cropped_large_path'] = $this->saveBlobImage($data['cropped_large'], 'large');
        }

        $photoLibrary = $this->photoLibraryService->create($data);

        return response()->json([
    'success' => true,
    'message' => localize("photo_library_data_saved_successfully"),
    'title'   => localize("photo_library"),
    'data' => [
        'uuid' => $photoLibrary->uuid ?? '',
        'title' => $photoLibrary->title ?? '',
        'actual_image_name' => $photoLibrary->actual_image_name ?? '',
        'thumb_image' => $photoLibrary->thumb_image ?? '',
        'large_image' => $photoLibrary->large_image ?? '',
        'thumb_image_path' => asset($photoLibrary->thumb_image ?? ''),
        'large_image_path' => asset($photoLibrary->large_image ?? ''),
    ],
]);


    }

    private function saveBlobImage($blobUrl, $type)
    {
        try {
            if (str_starts_with($blobUrl, 'data:image')) {
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $blobUrl));
            } else {
                $imageData = file_get_contents($blobUrl);
            }

            if ($imageData === false) {
                throw new \Exception('Failed to get image data');
            }

            $filename = $type . '_' . time() . '.jpg';
            $folderPath = public_path('uploads/photo-library');
            if (!is_dir($folderPath)) mkdir($folderPath, 0755, true);

            $filePath = $folderPath . '/' . $filename;
            file_put_contents($filePath, $imageData);

            return 'uploads/photo-library/' . $filename;
        } catch (\Exception $e) {
            \Log::error('Error saving blob image: ' . $e->getMessage());
            return null;
        }
    }

    public function show(Request $request)
    {
        $data = $this->photoLibraryService->formData($request->all());
        return view('backend.photo-library.view', $data);
    }

    public function destroy(Request $request, int $id)
    {
        $this->photoLibraryService->destroy(['id' => $id]);

        return response()->json([
            'success' => true,
            'message' => localize("photo_library_data_delete_successfully"),
            'title'   => localize("photo_library"),
        ]);
    }
}
