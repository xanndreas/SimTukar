<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Resources\Admin\OrganizationResource;
use App\Models\Organization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('organization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganizationResource(Organization::all());
    }

    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create($request->all());

        if ($request->input('photos', false)) {
            $organization->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new OrganizationResource($organization))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Organization $organization)
    {
        abort_if(Gate::denies('organization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganizationResource($organization);
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->all());

        if ($request->input('photos', false)) {
            if (!$organization->photos || $request->input('photos') !== $organization->photos->file_name) {
                if ($organization->photos) {
                    $organization->photos->delete();
                }
                $organization->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($organization->photos) {
            $organization->photos->delete();
        }

        return (new OrganizationResource($organization))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Organization $organization)
    {
        abort_if(Gate::denies('organization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
