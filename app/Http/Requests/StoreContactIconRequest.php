<?php

namespace App\Http\Requests;

use App\Models\ContactIcon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactIconRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_icon_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:contact_icons',
            ],
            'icon' => [
                'string',
                'required',
            ],
        ];
    }
}
