@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contactDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-details.update", [$contactDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contact_icon_id">{{ trans('cruds.contactDetail.fields.contact_icon') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_icon') ? 'is-invalid' : '' }}" name="contact_icon_id" id="contact_icon_id" required>
                    @foreach($contact_icons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('contact_icon_id') ? old('contact_icon_id') : $contactDetail->contact_icon->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactDetail.fields.contact_icon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.contactDetail.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $contactDetail->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactDetail.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection