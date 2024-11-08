@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.articles.create') }}

    @include('admin._nav', ['route' => 'articles'])

    <form action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="form-group">
            <label for="sex" class="col-form-label">Пол</label>
            <select class="form-control" name="sex" id="sex">
                @foreach($sex as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('sex')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="author" class="col-form-label">Автор</label>
            <input id="author" class="form-control @error('author') is-invalid @enderror" name="author"
                   value="{{ old('author') }}" required>
            @error('author')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="title" class="col-form-label">Заголовок</label>
            <input id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{ old('title') }}" required>
            @error('title')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label class="col-form-label" for="text">Текст</label>
            <textarea name="text" id="text" rows="10">{{ old('text') }}</textarea>
        </div>

        <div class="form-group">
            <label for="cover" class="col-form-label">Обложка</label>
            <input id="cover" type="file" class="form-control-file @error('cover') is-invalid @enderror"
                   name="cover">
            @error('cover')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
