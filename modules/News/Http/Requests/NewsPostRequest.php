<?php

namespace Modules\News\Http\Requests;

use Illuminate\Validation\Rule;
use App\Traits\FormRequestTrait;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use Illuminate\Foundation\Http\FormRequest;

class NewsPostRequest extends FormRequest
{
    use FormRequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_id'         => ['required', 'integer', Rule::exists(Language::class, 'id')],
            'other_page'          => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'short_head'          => ['nullable', 'string'],
            'head_line'           => ['required', 'string'],
            'meta_keyword'        => ['nullable', 'string'],
            'meta_description'    => ['nullable', 'string'],
            'lib_file_selected'   => ['nullable', 'array'],
            'lib_file_selected.*' => ['nullable', 'string'],
            'image_alt'           => ['nullable', 'array'],
            'image_alt.*'         => ['nullable', 'string'],
            'image_title'         => ['nullable', 'array'],
            'image_title.*'       => ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
