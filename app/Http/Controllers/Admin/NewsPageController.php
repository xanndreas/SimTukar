<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsPageRequest;
use App\Http\Requests\StoreNewsPageRequest;
use App\Http\Requests\UpdateNewsPageRequest;
use App\Models\Category;
use App\Models\NewsPage;
use App\Models\Organization;
use App\Models\Tag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NewsPageController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('news_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NewsPage::with(['user', 'organization', 'tags', 'category', 'created_by'])->select(sprintf('%s.*', (new NewsPage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'news_page_show';
                $editGate = 'news_page_edit';
                $deleteGate = 'news_page_delete';
                $crudRoutePart = 'news-pages';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
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
            $table->editColumn('views', function ($row) {
                return $row->views ? $row->views : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('organization_name', function ($row) {
                return $row->organization ? $row->organization->name : '';
            });

            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'photos', 'user', 'organization', 'category', 'tag']);

            return $table->make(true);
        }

        $users         = User::get();
        $organizations = Organization::get();
        $tags          = Tag::get();
        $categories    = Category::get();

        return view('admin.newsPages.index', compact('users', 'organizations', 'tags', 'categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('news_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizations = Organization::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.newsPages.create', compact('users', 'organizations', 'tags', 'categories'));
    }

    public function store(StoreNewsPageRequest $request)
    {
        $newsPage = NewsPage::create($request->all());
        $newsPage->tags()->sync($request->input('tags', []));
        foreach ($request->input('photos', []) as $file) {
            $newsPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $newsPage->id]);
        }

        return redirect()->route('admin.news-pages.index');
    }

    public function edit(NewsPage $newsPage)
    {
        abort_if(Gate::denies('news_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizations = Organization::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        $categories = Category::all()->pluck('name', 'id');

        $newsPage->load('user', 'organization', 'tags', 'created_by', 'category');

        return view('admin.newsPages.edit', compact('users', 'organizations', 'tags', 'newsPage', 'categories'));
    }

    public function update(UpdateNewsPageRequest $request, NewsPage $newsPage)
    {
        $newsPage->update($request->all());
        $newsPage->tags()->sync($request->input('tags', []));
        if (count($newsPage->photos) > 0) {
            foreach ($newsPage->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $newsPage->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $newsPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.news-pages.index');
    }

    public function show(NewsPage $newsPage)
    {
        abort_if(Gate::denies('news_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsPage->load('user', 'organization', 'tags', 'created_by', 'category');

        return view('admin.newsPages.show', compact('newsPage'));
    }

    public function destroy(NewsPage $newsPage)
    {
        abort_if(Gate::denies('news_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsPage->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsPageRequest $request)
    {
        NewsPage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('news_page_create') && Gate::denies('news_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NewsPage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
