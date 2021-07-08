<?php

namespace App\Http\Requests;

use App\Models\NewsPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewsPageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_page_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'views' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
        ];
    }
}
