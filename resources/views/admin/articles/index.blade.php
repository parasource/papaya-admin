@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.articles.index') }}

    @include('admin._nav', ['route' => 'articles'])

    <div class="my-3">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success">Создать</a>
    </div>

    <div class="my-3">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Slug</th>
            <th>Пол</th>
            <th>Опубликована</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($articles as $article)
            <tr>
                <td>
                    <a href="{{ route('admin.articles.show', $article) }}">
                        {{ $article->title }}
                    </a>
                </td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->slug }}</td>
                <td>{{ $article->getSex() }}</td>
                <td>
                    {{ $article->updated_at->format('d.m.Y H:i') }}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $articles->links() }}

@endsection
