<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactIconRequest;
use App\Http\Requests\StoreContactIconRequest;
use App\Http\Requests\UpdateContactIconRequest;
use App\Models\ContactIcon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactIconController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_icon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactIcon::query()->select(sprintf('%s.*', (new ContactIcon())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_icon_show';
                $editGate = 'contact_icon_edit';
                $deleteGate = 'contact_icon_delete';
                $crudRoutePart = 'contact-icons';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('icon', function ($row) {
                return $row->icon ? $row->icon : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.contactIcons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contact_icon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactIcons.create');
    }

    public function store(StoreContactIconRequest $request)
    {
        $contactIcon = ContactIcon::create($request->all());

        return redirect()->route('admin.contact-icons.index');
    }

    public function edit(ContactIcon $contactIcon)
    {
        abort_if(Gate::denies('contact_icon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactIcons.edit', compact('contactIcon'));
    }

    public function update(UpdateContactIconRequest $request, ContactIcon $contactIcon)
    {
        $contactIcon->update($request->all());

        return redirect()->route('admin.contact-icons.index');
    }

    public function show(ContactIcon $contactIcon)
    {
        abort_if(Gate::denies('contact_icon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactIcons.show', compact('contactIcon'));
    }

    public function destroy(ContactIcon $contactIcon)
    {
        abort_if(Gate::denies('contact_icon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactIcon->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactIconRequest $request)
    {
        ContactIcon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
