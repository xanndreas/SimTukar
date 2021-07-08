<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactDetailRequest;
use App\Http\Requests\StoreContactDetailRequest;
use App\Http\Requests\UpdateContactDetailRequest;
use App\Models\ContactDetail;
use App\Models\ContactIcon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactDetailController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactDetail::with(['contact_icon'])->select(sprintf('%s.*', (new ContactDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_detail_show';
                $editGate = 'contact_detail_edit';
                $deleteGate = 'contact_detail_delete';
                $crudRoutePart = 'contact-details';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('contact_icon_name', function ($row) {
                return $row->contact_icon ? $row->contact_icon->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'contact_icon']);

            return $table->make(true);
        }

        $contact_icons = ContactIcon::get();

        return view('admin.contactDetails.index', compact('contact_icons'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_icons = ContactIcon::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contactDetails.create', compact('contact_icons'));
    }

    public function store(StoreContactDetailRequest $request)
    {
        $contactDetail = ContactDetail::create($request->all());

        return redirect()->route('admin.contact-details.index');
    }

    public function edit(ContactDetail $contactDetail)
    {
        abort_if(Gate::denies('contact_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_icons = ContactIcon::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contactDetail->load('contact_icon');

        return view('admin.contactDetails.edit', compact('contact_icons', 'contactDetail'));
    }

    public function update(UpdateContactDetailRequest $request, ContactDetail $contactDetail)
    {
        $contactDetail->update($request->all());

        return redirect()->route('admin.contact-details.index');
    }

    public function show(ContactDetail $contactDetail)
    {
        abort_if(Gate::denies('contact_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactDetail->load('contact_icon');

        return view('admin.contactDetails.show', compact('contactDetail'));
    }

    public function destroy(ContactDetail $contactDetail)
    {
        abort_if(Gate::denies('contact_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactDetailRequest $request)
    {
        ContactDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
