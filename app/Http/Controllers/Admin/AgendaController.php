<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgendaRequest;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Models\Agenda;
use App\Models\Organization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Agenda::with(['organization'])->select(sprintf('%s.*', (new Agenda())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'agenda_show';
                $editGate = 'agenda_edit';
                $deleteGate = 'agenda_delete';
                $crudRoutePart = 'agendas';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('description_2', function ($row) {
                return $row->description_2 ? $row->description_2 : '';
            });

            $table->addColumn('organization_name', function ($row) {
                return $row->organization ? $row->organization->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'organization']);

            return $table->make(true);
        }

        $organizations = Organization::get();

        return view('admin.agendas.index', compact('organizations'));
    }

    public function create()
    {
        abort_if(Gate::denies('agenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizations = Organization::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.agendas.create', compact('organizations'));
    }

    public function store(StoreAgendaRequest $request)
    {
        $agenda = Agenda::create($request->all());

        return redirect()->route('admin.agendas.index');
    }

    public function edit(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizations = Organization::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agenda->load('organization');

        return view('admin.agendas.edit', compact('organizations', 'agenda'));
    }

    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        $agenda->update($request->all());

        return redirect()->route('admin.agendas.index');
    }

    public function show(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenda->load('organization');

        return view('admin.agendas.show', compact('agenda'));
    }

    public function destroy(Agenda $agenda)
    {
        abort_if(Gate::denies('agenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenda->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgendaRequest $request)
    {
        Agenda::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
