<?php

namespace App\Http\Requests;

use App\Models\ProfileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('profile_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:profile_types',
            ],
        ];
    }
}
