<?php

namespace App\Http\Requests;

use App\Models\Umkm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUmkmRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('umkm_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:umkms',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'contact_detail_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
