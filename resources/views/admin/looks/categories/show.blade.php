@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'looks'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.looks.categories.edit', $category) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.looks.categories.destroy', $category) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Название</th>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $category->slug }}</td>
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

                @foreach ($category->looks as $look)
                    <tr>
                        <td>{{ $look->id }}</td>
                        <td><a href="{{ route('admin.looks.show', $look) }}">{{ $look->name }}</a></td>
                        <td>{{ $look->slug }}</td>
                        <td>{{ $look->desc }}</td>
                        <td>{{ $look->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
