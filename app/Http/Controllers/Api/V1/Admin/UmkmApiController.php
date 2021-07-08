<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Http\Resources\Admin\UmkmResource;
use App\Models\Umkm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UmkmApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UmkmResource(Umkm::with(['contact_detail'])->get());
    }

    public function store(StoreUmkmRequest $request)
    {
        $umkm = Umkm::create($request->all());

        if ($request->input('photos', false)) {
            $umkm->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new UmkmResource($umkm))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UmkmResource($umkm->load(['contact_detail']));
    }

    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $umkm->update($request->all());

        if ($request->input('photos', false)) {
            if (!$umkm->photos || $request->input('photos') !== $umkm->photos->file_name) {
                if ($umkm->photos) {
                    $umkm->photos->delete();
                }
                $umkm->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($umkm->photos) {
            $umkm->photos->delete();
        }

        return (new UmkmResource($umkm))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $umkm->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
