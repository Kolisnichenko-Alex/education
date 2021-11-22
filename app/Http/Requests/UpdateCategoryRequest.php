<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (count(\Request::segments()) > 1) {

            $category_id = \Request::segments()[1];
            return [
                Category::FIELD_TITLE => 'required|min:3|unique:categories,title,' . $category_id,
                Category::FIELD_PARENT_ID => 'nullable|integer'
            ];
        }
    }
}
