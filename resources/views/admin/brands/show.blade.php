@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'brands'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-primary mx-2">Изменить</a>
        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mx-2">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $brand->id }}</td>
        </tr>
        <tr>
            <th>Название</th>
            <td>{{ $brand->name }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $brand->slug }}</td>
        </tr>
        <tr>
            <th>Картинка</th>
            <td>
                <img height="450" src="https://static.papaya.pw/{{ $brand->image }}">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
