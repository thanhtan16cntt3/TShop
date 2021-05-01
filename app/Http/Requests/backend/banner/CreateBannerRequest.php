<?php

namespace App\Http\Requests\backend\banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'title' => 'required | string',
            'description' => 'string | nullable',
            'photo' => 'required',
            'status' => 'required | in:active,inactive'
        ];
    }
}
