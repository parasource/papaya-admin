@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.wardrobe-items.edit', $wardrobeItem) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.wardrobe-items.destroy', $wardrobeItem) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $wardrobeItem->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $wardrobeItem->name }}</td>
        </tr>
        <tr>
            <th>Slug</th><td>{{ $wardrobeItem->slug }}</td>
        </tr>
        <tr>
            <th>Картинка</th>
            <td>
                <img src="{{ \Storage::disk('public')->url($wardrobeItem->image) }}" alt="">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection
