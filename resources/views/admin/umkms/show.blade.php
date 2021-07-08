@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.umkm.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.umkms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.id') }}
                        </th>
                        <td>
                            {{ $umkm->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.name') }}
                        </th>
                        <td>
                            {{ $umkm->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.description') }}
                        </th>
                        <td>
                            {!! $umkm->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.longitude') }}
                        </th>
                        <td>
                            {{ $umkm->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.latitude') }}
                        </th>
                        <td>
                            {{ $umkm->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.contact_detail') }}
                        </th>
                        <td>
                            {{ $umkm->contact_detail->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.umkm.fields.photos') }}
                        </th>
                        <td>
                            @foreach($umkm->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.umkms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection