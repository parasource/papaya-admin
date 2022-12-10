@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.topics.create') }}

    @include('admin._nav', ['route' => 'topics'])

    <form action="{{ route('admin.topics.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">

                <div class="form-group">
                    <label for="name" class="col-form-label">Название</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desc" class="col-form-label">Описание</label>
                    <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" rows="10"
                              required>{{ old('desc') }}</textarea>
                    @error('desc')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="col-form-label">Превью</label>
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                           name="image">
                    @error('image')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success">Сохранить</button>
            </div>
        </div>
    </form>

@endsection
