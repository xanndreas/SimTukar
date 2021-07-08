<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProfileTypeRequest;
use App\Http\Requests\StoreProfileTypeRequest;
use App\Http\Requests\UpdateProfileTypeRequest;
use App\Models\ProfileType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProfileTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('profile_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProfileType::query()->select(sprintf('%s.*', (new ProfileType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'profile_type_show';
                $editGate = 'profile_type_edit';
                $deleteGate = 'profile_type_delete';
                $crudRoutePart = 'profile-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.profileTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('profile_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profileTypes.create');
    }

    public function store(StoreProfileTypeRequest $request)
    {
        $profileType = ProfileType::create($request->all());

        return redirect()->route('admin.profile-types.index');
    }

    public function edit(ProfileType $profileType)
    {
        abort_if(Gate::denies('profile_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profileTypes.edit', compact('profileType'));
    }

    public function update(UpdateProfileTypeRequest $request, ProfileType $profileType)
    {
        $profileType->update($request->all());

        return redirect()->route('admin.profile-types.index');
    }

    public function show(ProfileType $profileType)
    {
        abort_if(Gate::denies('profile_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profileTypes.show', compact('profileType'));
    }

    public function destroy(ProfileType $profileType)
    {
        abort_if(Gate::denies('profile_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profileType->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfileTypeRequest $request)
    {
        ProfileType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
