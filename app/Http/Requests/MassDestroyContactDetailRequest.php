<?php

namespace App\Http\Requests;

use App\Models\ContactDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContactDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contact_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:contact_details,id',
        ];
    }
}
