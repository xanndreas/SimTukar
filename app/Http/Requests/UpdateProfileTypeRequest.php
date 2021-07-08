<?php

namespace App\Http\Requests;

use App\Models\ProfileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('profile_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:profile_types,name,' . request()->route('profile_type')->id,
            ],
        ];
    }
}
