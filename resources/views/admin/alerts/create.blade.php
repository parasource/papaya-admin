@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'alerts'])

    <form action="{{ route('admin.alerts.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="type" class="col-form-label">Тип</label>
            <select class="form-control" name="type" id="type">
                @foreach($types as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('type')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="title" class="col-form-label">Тайтл</label>
            <input id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="text" class="col-form-label">Текст</label>
            <textarea class="form-control" name="text" id="text" rows="5">{{ old('text') }}</textarea>
            @error('text')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>

@endsection
