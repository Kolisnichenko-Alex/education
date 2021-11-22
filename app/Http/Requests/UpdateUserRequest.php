<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

            $user_id = \Request::segments()[1];
            return [
                User::FIELD_EMAIL => 'required|email|unique:users,email,' . $user_id,
                User::FIELD_NAME => 'required|unique:users,name,' . $user_id,
                User::FIELD_ACCOUNT_TYPE => 'required',
                User::FIELD_PASSWORD => 'nullable|min:4'
            ];
        }
    }
}
