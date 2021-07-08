<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUmkmRequest;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\ContactDetail;
use App\Models\Umkm;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UmkmController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('umkm_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Umkm::with(['contact_detail'])->select(sprintf('%s.*', (new Umkm())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'umkm_show';
                $editGate = 'umkm_edit';
                $deleteGate = 'umkm_delete';
                $crudRoutePart = 'umkms';

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
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->addColumn('contact_detail_description', function ($row) {
                return $row->contact_detail ? $row->contact_detail->description : '';
            });

            $table->editColumn('photos', function ($row) {
                if (!$row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'contact_detail', 'photos']);

            return $table->make(true);
        }

        $contact_details = ContactDetail::get();

        return view('admin.umkms.index', compact('contact_details'));
    }

    public function create()
    {
        abort_if(Gate::denies('umkm_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_details = ContactDetail::all()->pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.umkms.create', compact('contact_details'));
    }

    public function store(StoreUmkmRequest $request)
    {
        $umkm = Umkm::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $umkm->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $umkm->id]);
        }

        return redirect()->route('admin.umkms.index');
    }

    public function edit(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_details = ContactDetail::all()->pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $umkm->load('contact_detail');

        return view('admin.umkms.edit', compact('contact_details', 'umkm'));
    }

    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $umkm->update($request->all());

        if (count($umkm->photos) > 0) {
            foreach ($umkm->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $umkm->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $umkm->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.umkms.index');
    }

    public function show(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $umkm->load('contact_detail');

        return view('admin.umkms.show', compact('umkm'));
    }

    public function destroy(Umkm $umkm)
    {
        abort_if(Gate::denies('umkm_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $umkm->delete();

        return back();
    }

    public function massDestroy(MassDestroyUmkmRequest $request)
    {
        Umkm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('umkm_create') && Gate::denies('umkm_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Umkm();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
