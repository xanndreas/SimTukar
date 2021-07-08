@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.agenda.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.agendas.update", [$agenda->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.agenda.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $agenda->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenda.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.agenda.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $agenda->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenda.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_2">{{ trans('cruds.agenda.fields.description_2') }}</label>
                <input class="form-control {{ $errors->has('description_2') ? 'is-invalid' : '' }}" type="text" name="description_2" id="description_2" value="{{ old('description_2', $agenda->description_2) }}">
                @if($errors->has('description_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenda.fields.description_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.agenda.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $agenda->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenda.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="organization_id">{{ trans('cruds.agenda.fields.organization') }}</label>
                <select class="form-control select2 {{ $errors->has('organization') ? 'is-invalid' : '' }}" name="organization_id" id="organization_id">
                    @foreach($organizations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('organization_id') ? old('organization_id') : $agenda->organization->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('organization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agenda.fields.organization_helper') }}</span>
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