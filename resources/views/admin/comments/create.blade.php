@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">{{ trans('cruds.comment.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.comment.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.comment.fields.content') }}</label>
                <input class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" type="text" name="content" id="content" value="{{ old('content', '') }}">
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.comment.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="report_count">{{ trans('cruds.comment.fields.report_count') }}</label>
                <input class="form-control {{ $errors->has('report_count') ? 'is-invalid' : '' }}" type="text" name="report_count" id="report_count" value="{{ old('report_count', '0') }}">
                @if($errors->has('report_count'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_count') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.report_count_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="berita_id">{{ trans('cruds.comment.fields.berita') }}</label>
                <select class="form-control select2 {{ $errors->has('berita') ? 'is-invalid' : '' }}" name="berita_id" id="berita_id">
                    @foreach($beritas as $id => $entry)
                        <option value="{{ $id }}" {{ old('berita_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('berita'))
                    <div class="invalid-feedback">
                        {{ $errors->first('berita') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.berita_helper') }}</span>
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