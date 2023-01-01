@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.looks.show', $look) }}

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
            <th>Slug</th>
            <td>{{ $look->slug }}</td>
        </tr>
        <tr>
            <th>Описание</th>
            <td>{{ $look->desc }}</td>
        </tr>
        <tr>
            <th>Картинка</th>
            <td>
                <img height="450" src="https://static.papaya.parasource.tech{{ $look->image_resized }}" alt="">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">Айтемы</div>
        <div class="card-body">
            <div class="my-3">
                <a href="{{ route('admin.looks.items-add', $look) }}" class="btn btn-success">Прикрепить айтем</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($look->items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route('admin.looks.show', $item) }}">{{ $item->name }}</a></td>
                        <td>
                            <img height="150" src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">
                        </td>
                        <td>
                            <form action="{{ route('admin.looks.items.remove', compact('look', 'item')) }}"
                                  method="post">
                                @csrf
                                <button class="btn btn-danger">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
