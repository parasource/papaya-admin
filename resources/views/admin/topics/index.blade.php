@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.topics.index') }}

    @include('admin._nav', ['route' => 'topics'])

    <div class="my-3">
        <a href="{{ route('admin.topics.create') }}" class="btn btn-success">Добавить тему</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Описание</th>
            <th>Создан</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($topics as $topic)
            <tr>
                <td>{{ $topic->id }}</td>
                <td><a href="{{ route('admin.topics.show', $topic) }}">{{ $topic->name }}</a></td>
                <td>{{ $topic->slug }}</td>
                <td>{{ $topic->desc }}</td>
                <td>{{ $topic->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $topics->links() }}

@endsection
