@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.newsPage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.news-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.id') }}
                        </th>
                        <td>
                            {{ $newsPage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.title') }}
                        </th>
                        <td>
                            {{ $newsPage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.content') }}
                        </th>
                        <td>
                            {!! $newsPage->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.photos') }}
                        </th>
                        <td>
                            @foreach($newsPage->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.views') }}
                        </th>
                        <td>
                            {{ $newsPage->views }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.user') }}
                        </th>
                        <td>
                            {{ $newsPage->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.organization') }}
                        </th>
                        <td>
                            {{ $newsPage->organization->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsPage.fields.tag') }}
                        </th>
                        <td>
                            @foreach($newsPage->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.news-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection