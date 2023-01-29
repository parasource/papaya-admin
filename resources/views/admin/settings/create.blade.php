@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.settings.create') }}

    @include('admin._nav', ['route' => 'settings'])

    <form action="{{ route('admin.settings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="key" class="col-form-label">Ключ</label>
            <input id="key" class="form-control @error('key') is-invalid @enderror" name="key" value="{{ old('key') }}"
                   required>
            @error('key')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="value" class="col-form-label">Значение</label>
            <textarea id="value" class="form-control @error('value') is-invalid @enderror" name="value" rows="5"
                      required>{{ old('value') }}</textarea>
            @error('value')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>

@endsection
