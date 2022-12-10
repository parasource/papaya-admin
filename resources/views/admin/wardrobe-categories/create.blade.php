@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.wardrobe-categories.create') }}

    @include('admin._nav', ['route' => 'wardrobe'])

    <form action="{{ route('admin.wardrobe-categories.store') }}" enctype="multipart/form-data" method="POST">
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
                    <label for="name" class="col-form-label">Род. Категория</label>
                    <input id="name" class="form-control @error('parent_category') is-invalid @enderror" name="parent_category" value="{{ old('parent_category') }}" required>
                    @error('parent_category')
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
