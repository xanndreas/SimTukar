<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProfilePageRequest;
use App\Http\Requests\UpdateProfilePageRequest;
use App\Http\Resources\Admin\ProfilePageResource;
use App\Models\ProfilePage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfilePageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('profile_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfilePageResource(ProfilePage::with(['profile_type'])->get());
    }

    public function store(StoreProfilePageRequest $request)
    {
        $profilePage = ProfilePage::create($request->all());

        if ($request->input('photos', false)) {
            $profilePage->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new ProfilePageResource($profilePage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProfilePage $profilePage)
    {
        abort_if(Gate::denies('profile_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfilePageResource($profilePage->load(['profile_type']));
    }

    public function update(UpdateProfilePageRequest $request, ProfilePage $profilePage)
    {
        $profilePage->update($request->all());

        if ($request->input('photos', false)) {
            if (!$profilePage->photos || $request->input('photos') !== $profilePage->photos->file_name) {
                if ($profilePage->photos) {
                    $profilePage->photos->delete();
                }
                $profilePage->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($profilePage->photos) {
            $profilePage->photos->delete();
        }

        return (new ProfilePageResource($profilePage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProfilePage $profilePage)
    {
        abort_if(Gate::denies('profile_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profilePage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
