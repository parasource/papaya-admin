@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'articles'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary mx-2">Изменить</a>
        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $article->id }}</td>
        </tr>
        <tr>
            <th>Заголовок</th>
            <td>{{ $article->title }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $article->slug }}</td>
        </tr>
        <tr>
            <th>Обложка</th>
            <td>
                <img height="450" src="{{ Storage::disk('public')->url($article->cover) }}">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <div class="card">
        <div class="card-body">
            {!! $article->text !!}
        </div>
    </div>
@endsection
