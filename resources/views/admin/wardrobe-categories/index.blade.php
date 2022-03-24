@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="my-3">
        <a href="{{ route('admin.wardrobe-categories.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.wardrobe-categories.show', $category) }}">{{ $category->name }}</a></td>
                <td>{{ $category->slug }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
