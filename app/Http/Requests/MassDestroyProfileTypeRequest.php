<?php

namespace App\Http\Requests;

use App\Models\ProfileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('profile_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:profile_types,id',
        ];
    }
}
