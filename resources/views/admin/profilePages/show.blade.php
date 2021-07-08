@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.profilePage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profile-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.profilePage.fields.id') }}
                        </th>
                        <td>
                            {{ $profilePage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profilePage.fields.profile_type') }}
                        </th>
                        <td>
                            {{ $profilePage->profile_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profilePage.fields.description') }}
                        </th>
                        <td>
                            {!! $profilePage->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profilePage.fields.photos') }}
                        </th>
                        <td>
                            @foreach($profilePage->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profile-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection