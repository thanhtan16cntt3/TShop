<?php

namespace App\Http\Requests\backend\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'old_password:'.Auth::user()->password],
            'new_password' => 'required',
            'new_confirm_password' => 'required|same:new_password'
        ];
    }
}
