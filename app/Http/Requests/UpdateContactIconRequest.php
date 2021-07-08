<?php

namespace App\Http\Requests;

use App\Models\ContactIcon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactIconRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_icon_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:contact_icons,name,' . request()->route('contact_icon')->id,
            ],
            'icon' => [
                'string',
                'required',
            ],
        ];
    }
}
