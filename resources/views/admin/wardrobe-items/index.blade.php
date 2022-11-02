@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="my-3">
        <a href="{{ route('admin.wardrobe-categories.index') }}" class="btn btn-secondary mr-2">Категории</a>
        <a href="{{ route('admin.wardrobe-items.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Картинка</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.wardrobe-items.show', $item) }}">{{ $item->name }}</a></td>
                <td><a href="{{ route('admin.wardrobe-categories.show', $item->category) }}">{{ $item->category->name }}</a></td>
                <td>
                    <img height="150" src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $items->links() }}

@endsection
