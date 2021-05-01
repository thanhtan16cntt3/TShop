<?php

namespace App\Http\Requests\backend\admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangeSettingRequest extends FormRequest
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
            'description' => 'required',
            'short_des' => 'required',
            'logo' => 'required',
            'photo' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ];
    }
}
