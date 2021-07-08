<?php

namespace App\Http\Requests;

use App\Models\ProfilePage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProfilePageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('profile_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:profile_pages,id',
        ];
    }
}
