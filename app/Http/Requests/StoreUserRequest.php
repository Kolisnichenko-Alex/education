<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            User::FIELD_EMAIL => 'required|email|unique:users',
            User::FIELD_NAME => 'required|unique:users',
            User::FIELD_ACCOUNT_TYPE => 'required',
            User::FIELD_PASSWORD => 'required|min:4'
        ];
    }
}
