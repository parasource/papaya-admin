@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'looks'])

    <form action="{{ route('admin.looks.update', $look) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">

                <div class="form-group">
                    <label for="name" class="col-form-label">Название</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $look->name) }}" required>
                    @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desc" class="col-form-label">Описание</label>
                    <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" rows="10" required>{{ old('desc', $look->desc) }}</textarea>
                    @error('desc')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="col-form-label">Картинка</label>
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
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