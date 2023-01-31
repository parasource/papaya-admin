@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.settings.edit', $setting) }}

    @include('admin._nav', ['route' => 'settings'])

    <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="value" class="col-form-label">Значение</label>
            <textarea id="value" class="form-control @error('value') is-invalid @enderror" name="value" rows="5"
                      required>{{ old('value', $setting->value) }}</textarea>
            @error('value')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>

@endsection
