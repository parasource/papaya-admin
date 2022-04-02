@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.wardrobe-categories.edit', $wardrobeCategory) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.wardrobe-categories.destroy', $wardrobeCategory) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $wardrobeCategory->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $wardrobeCategory->name }}</td>
        </tr>
        <tr>
            <th>Slug</th><td>{{ $wardrobeCategory->slug }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection