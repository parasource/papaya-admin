@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.looks.categories.index') }}

    @include('admin._nav', ['route' => 'looks'])

    <h3>Категории луков</h3>

    <div class="my-3">
        <a href="{{ route('admin.looks.categories.create') }}" class="btn btn-success mr-2">Добавить</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Создан</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.looks.categories.show', $category) }}">{{ $category->name }}</a></td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $categories->links() }}
@endsection
