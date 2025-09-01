<?php

namespace App\Http\Requests;

use App\Traits\FormRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PhotoLibraryRequest extends FormRequest
{
    use FormRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'thumb_height' => ['required', 'integer'],
            'thumb_width'  => ['required', 'integer'],
            'large_height' => ['required', 'integer'],
            'large_width'  => ['required', 'integer'],
            'image'        => ['required', 'file', 'image', 'max:5120'],
            'caption'      => ['nullable', 'string'],
            'reference'    => ['nullable', 'string'],
        ];
    }

    public function prepareForValidation()
    {
        if (!$this->hasFile('image') || !$this->file('image')) {
            throw ValidationException::withMessages([
                'image' => 'The uploaded file is too large. Server max upload size exceeded. Please contact the administrator or increase the server\'s upload/post size limit.',
            ]);
        }
    }

    public function messages()
    {
        return [
            'image.required' => 'Please upload an image.',
            'image.file' => 'The uploaded file must be a valid file.',
            'image.image' => 'The image must be a valid type: JPG, JPEG, PNG, WebP, GIF, or BMP.',
            'image.max' => 'The image size must not exceed 5MB.',
        ];
    }
}