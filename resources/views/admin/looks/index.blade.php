@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'looks'])

    <div class="my-3">
        <a href="{{ route('admin.looks.categories.index') }}" class="btn btn-primary">Категории</a>
        <a href="{{ route('admin.looks.create') }}" class="btn btn-success">Добавить лук</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Описание</th>
            <th>Картинка</th>
            <th>Создан</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($looks as $look)
            <tr>
                <td>{{ $look->id }}</td>
                <td><a href="{{ route('admin.looks.show', $look) }}">{{ $look->name }}</a></td>
                <td>{{ $look->slug }}</td>
                <td>{{ $look->desc }}</td>
                <td>{{ $look->image }}</td>
                <td>{{ $look->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
