<?php

namespace App\Http\Requests;

use App\Models\NewsPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNewsPageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('news_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:news_pages,id',
        ];
    }
}
