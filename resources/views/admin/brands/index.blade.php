@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'brands'])

    <div class="my-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">Добавить бренд</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Slug</th>
            <th>Картинка</th>
            <th>Создан</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td><a href="{{ route('admin.brands.show', $brand) }}">{{ $brand->name }}</a></td>
                <td>{{ $brand->slug }}</td>
                <td>
                    <img height="100" src="{{ Storage::disk('public')->url($brand->image) }}" alt="">
                </td>
                <td>{{ $brand->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
