<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProfilePageRequest;
use App\Http\Requests\StoreProfilePageRequest;
use App\Http\Requests\UpdateProfilePageRequest;
use App\Models\ProfilePage;
use App\Models\ProfileType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProfilePageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('profile_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProfilePage::with(['profile_type'])->select(sprintf('%s.*', (new ProfilePage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'profile_page_show';
                $editGate = 'profile_page_edit';
                $deleteGate = 'profile_page_delete';
                $crudRoutePart = 'profile-pages';

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
            $table->addColumn('profile_type_name', function ($row) {
                return $row->profile_type ? $row->profile_type->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'profile_type', 'photos']);

            return $table->make(true);
        }

        $profile_types = ProfileType::get();

        return view('admin.profilePages.index', compact('profile_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('profile_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profile_types = ProfileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.profilePages.create', compact('profile_types'));
    }

    public function store(StoreProfilePageRequest $request)
    {
        $profilePage = ProfilePage::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $profilePage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $profilePage->id]);
        }

        return redirect()->route('admin.profile-pages.index');
    }

    public function edit(ProfilePage $profilePage)
    {
        abort_if(Gate::denies('profile_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profile_types = ProfileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profilePage->load('profile_type');

        return view('admin.profilePages.edit', compact('profile_types', 'profilePage'));
    }

    public function update(UpdateProfilePageRequest $request, ProfilePage $profilePage)
    {
        $profilePage->update($request->all());

        if (count($profilePage->photos) > 0) {
            foreach ($profilePage->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $profilePage->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $profilePage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.profile-pages.index');
    }

    public function show(ProfilePage $profilePage)
    {
        abort_if(Gate::denies('profile_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profilePage->load('profile_type');

        return view('admin.profilePages.show', compact('profilePage'));
    }

    public function destroy(ProfilePage $profilePage)
    {
        abort_if(Gate::denies('profile_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profilePage->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfilePageRequest $request)
    {
        ProfilePage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('profile_page_create') && Gate::denies('profile_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProfilePage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
