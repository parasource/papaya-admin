@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'looks'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.looks.edit', $look) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.looks.destroy', $look) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $look->id }}</td>
        </tr>
        <tr>
            <th>Название</th><td>{{ $look->name }}</td>
        </tr>
        <tr>
            <th>Slug</th><td>{{ $look->slug }}</td>
        </tr>
        <tr>
            <th>Картинка</th><td>{{ \Storage::disk('public')->url($look->image) }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection
