<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactIconRequest;
use App\Http\Requests\UpdateContactIconRequest;
use App\Http\Resources\Admin\ContactIconResource;
use App\Models\ContactIcon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactIconApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_icon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactIconResource(ContactIcon::all());
    }

    public function store(StoreContactIconRequest $request)
    {
        $contactIcon = ContactIcon::create($request->all());

        return (new ContactIconResource($contactIcon))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactIcon $contactIcon)
    {
        abort_if(Gate::denies('contact_icon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactIconResource($contactIcon);
    }

    public function update(UpdateContactIconRequest $request, ContactIcon $contactIcon)
    {
        $contactIcon->update($request->all());

        return (new ContactIconResource($contactIcon))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactIcon $contactIcon)
    {
        abort_if(Gate::denies('contact_icon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactIcon->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
