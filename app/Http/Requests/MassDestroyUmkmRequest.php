<?php

namespace App\Http\Requests;

use App\Models\Umkm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUmkmRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('umkm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:umkms,id',
        ];
    }
}
