<?php

namespace App\Http\Requests;

use App\MenuItem;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
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
            MenuItem::FIELD_TITLE => 'required|min:3',
            MenuItem::FIELD_URL => 'required'
        ];
    }
}
