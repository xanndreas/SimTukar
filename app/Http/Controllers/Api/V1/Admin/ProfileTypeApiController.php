<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileTypeRequest;
use App\Http\Requests\UpdateProfileTypeRequest;
use App\Http\Resources\Admin\ProfileTypeResource;
use App\Models\ProfileType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('profile_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfileTypeResource(ProfileType::all());
    }

    public function store(StoreProfileTypeRequest $request)
    {
        $profileType = ProfileType::create($request->all());

        return (new ProfileTypeResource($profileType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProfileType $profileType)
    {
        abort_if(Gate::denies('profile_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfileTypeResource($profileType);
    }

    public function update(UpdateProfileTypeRequest $request, ProfileType $profileType)
    {
        $profileType->update($request->all());

        return (new ProfileTypeResource($profileType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProfileType $profileType)
    {
        abort_if(Gate::denies('profile_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profileType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
