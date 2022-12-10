@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.topics.show', $topic) }}

    @include('admin._nav', ['route' => 'topics'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.topics.edit', $topic) }}" class="btn btn-primary mx-2">Изменить</a>
        <form method="POST" action="{{ route('admin.topics.destroy', $topic) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2">Удалить</button>
        </form>
        <a href="{{ route('admin.topics.add-look', $topic) }}" class="btn btn-success mx-2">Добавить лук</a>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $topic->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $topic->name }}</td>
        </tr>
        <tr>
            <th>Slug</th><td>{{ $topic->slug }}</td>
        </tr>
        <tr>
            <th>Описание</th><td>{{ $topic->desc }}</td>
        </tr>
        <tr>
            <th>Картинка</th><td>
                <img height="450" src="https://static.papaya.parasource.tech{{$topic->image}}" alt="">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">Луки</div>
        <div class="card-body">
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

                @foreach ($topic->looks as $look)
                    <tr>
                        <td>{{ $look->id }}</td>
                        <td><a href="{{ route('admin.looks.show', $look) }}">{{ $look->name }}</a></td>
                        <td>{{ $look->slug }}</td>
                        <td>{{ $look->desc }}</td>
                        <td>{{ $topic->created_at->format('d-m-Y') }}</td>
                        <td>
                            <form action="{{ route('admin.topics.remove-look', compact('topic', 'look')) }}" method="post">
                                @csrf
                                <button class="btn btn-danger">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection
