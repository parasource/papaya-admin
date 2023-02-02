@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.wardrobe-items.create') }}

    @include('admin._nav', ['route' => 'wardrobe'])

    <form action="{{ route('admin.wardrobe-items.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Название</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group my-3">
                    <label for="image" class="col-form-label">Картинка</label>
                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror"
                           name="image">
                    @error('image')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags" class="col-form-label">Теги (через запятую)</label>
                    <textarea name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" id="tags"
                              rows="5">{{ old('tags') }}</textarea>
                    @error('tags')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group my-3">
                    <label for="sex" class="col-form-label">Пол</label>
                    <select class="form-select" name="sex" id="sex">
                        @foreach($sex as $key => $value)
                            <option value="{{ $key }}" {{ old('sex') == $key? 'selected' : '' }} >{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('sex')
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
