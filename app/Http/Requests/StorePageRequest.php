<?php

namespace App\Http\Requests;

use App\SavedPage;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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
        return [
            SavedPage::FIELD_TITLE => 'required|min:3',
            SavedPage::FIELD_HTML => 'required'
        ];
    }
}
