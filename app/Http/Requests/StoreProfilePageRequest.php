<?php

namespace App\Http\Requests;

use App\Models\ProfilePage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProfilePageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('profile_page_create');
    }

    public function rules()
    {
        return [
            'profile_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
