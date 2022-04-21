@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'looks'])

    <form action="{{ route('admin.looks.categories.update', $category) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">

                <div class="form-group">
                    <label for="name" class="col-form-label">Название</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
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