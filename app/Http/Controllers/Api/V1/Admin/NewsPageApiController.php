<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNewsPageRequest;
use App\Http\Requests\UpdateNewsPageRequest;
use App\Http\Resources\Admin\NewsPageResource;
use App\Models\NewsPage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsPageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('news_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NewsPageResource(NewsPage::with(['user', 'organization', 'tags', 'created_by'])->get());
    }

    public function store(StoreNewsPageRequest $request)
    {
        $newsPage = NewsPage::create($request->all());
        $newsPage->tags()->sync($request->input('tags', []));
        if ($request->input('photos', false)) {
            $newsPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new NewsPageResource($newsPage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NewsPage $newsPage)
    {
        abort_if(Gate::denies('news_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NewsPageResource($newsPage->load(['user', 'organization', 'tags', 'created_by']));
    }

    public function update(UpdateNewsPageRequest $request, NewsPage $newsPage)
    {
        $newsPage->update($request->all());
        $newsPage->tags()->sync($request->input('tags', []));
        if ($request->input('photos', false)) {
            if (!$newsPage->photos || $request->input('photos') !== $newsPage->photos->file_name) {
                if ($newsPage->photos) {
                    $newsPage->photos->delete();
                }
                $newsPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($newsPage->photos) {
            $newsPage->photos->delete();
        }

        return (new NewsPageResource($newsPage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NewsPage $newsPage)
    {
        abort_if(Gate::denies('news_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsPage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
