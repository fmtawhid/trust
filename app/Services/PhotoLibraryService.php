<?php

namespace App\Services;

use App\Enums\AssetsFolderEnum;
use App\Helpers\ImageHelper;
use App\Models\PhotoLibrary;
use App\Models\SpaceCredential;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class PhotoLibraryService
{
    /**
     * Form Data
     *
     * @return array
     */
    public function formData(array $attributes = []): array
    {
        $data                   = [];
        $data['imageLibraries'] = PhotoLibrary::where(function ($query) use ($attributes) {

            if (!empty($attributes['name'])) {
                $query = $query->where('title', 'LIKE', "%" . $attributes['name'] . "%");
            }
        })->orderByDesc('id')->get();

        if (!empty($attributes['div_id'])) {
            $data['div_id'] = $attributes['div_id'];
        }

        return $data;
    }

    /**
     * Create Image library
     *
     * @param  array  $attributes
     * @return PhotoLibrary
     * @throws Exception
     */
    public function create(array $attributes): ?PhotoLibrary
    {
        $uploadDisk = 'local'; // আমরা public folder ব্যবহার করব

        try {
            DB::beginTransaction();

            $thumbImgPath  = null;
            $largeImgPath  = null;
            $imageFilename = null;
            $imageBaseUrl  = null;

            if (!empty($attributes['image'])) {
                $imagePath = public_path($attributes['image']); // public path থেকে file access
                $imageFilename = basename($attributes['image']);

                // thumb size
                $thumbSize = [
                    'width' => $attributes['thumb_width'] ?? 438,
                    'height' => $attributes['thumb_height'] ?? 240,
                ];

                // large size
                $largeSize = [
                    'width' => $attributes['large_width'] ?? 1067,
                    'height' => $attributes['large_height'] ?? 585,
                ];

                // thumb image
                $thumbImgPath = 'uploads/photo-library/thumb_' . $imageFilename;
                \Intervention\Image\Facades\Image::make($imagePath)
                    ->resize($thumbSize['width'], $thumbSize['height'])
                    ->save(public_path($thumbImgPath));

                // large image
                $largeImgPath = 'uploads/photo-library/large_' . $imageFilename;
                \Intervention\Image\Facades\Image::make($imagePath)
                    ->resize($largeSize['width'], $largeSize['height'])
                    ->save(public_path($largeImgPath));

                $imageBaseUrl = asset($attributes['image']); // original image url
            }

            $insertData = [
                'disk'              => $uploadDisk,
                'image_base_url'    => $imageBaseUrl,
                'actual_image_name' => $imageFilename,
                'picture_name'      => $imageFilename,
                'thumb_image'       => $thumbImgPath,
                'large_image'       => $largeImgPath,
                'title'             => $attributes['caption'] ?? null,
                'reference'         => $attributes['reference'] ?? null,
                'time_stamp'        => time(),
                'status'            => 1,
            ];

            $photoLibrary = PhotoLibrary::create($insertData);

            DB::commit();

            return $photoLibrary;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("photo_library_create_error"),
                'title'   => localize("photo_library"),
            ], 422));
        }
    }


    /**
     * Delete Image library
     *
     * @param  array  $attributes
     * @return bool
     * @throws Exception
     */
    public function destroy(array $attributes): bool
    {
        $photoLibraryId = $attributes['id'];

        try {
            DB::beginTransaction();

            $photoLibrary = PhotoLibrary::findOrFail($photoLibraryId);

            if ($photoLibrary) {

                if ($photoLibrary->thumb_image) {
                    ImageHelper::delete_file($photoLibrary->thumb_image);
                }

                if ($photoLibrary->large_image) {
                    ImageHelper::delete_file($photoLibrary->large_image);
                }
            }

            $photoLibrary->delete();

            DB::commit();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();

            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => localize("photo_library_delete_error"),
                'title'   => localize("photo_library"),
            ], 422));
        }
    }
}
