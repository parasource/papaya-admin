@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.wardrobe-items.show', $item) }}

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.wardrobe-items.edit', $item) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.wardrobe-items.destroy', $item) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
        <a href="{{ route('admin.wardrobe-items.urls.add', $item) }}" class="btn btn-success mx-2">Добавить ссылку</a>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $item->id }}</td>
        </tr>
        <tr>
            <th>Пол</th>
            <td>{{ $item->getSex() }}</td>
        </tr>
        <tr>
            <th>Название</th>
            <td>{{ $item->name }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $item->slug }}</td>
        </tr>
        <tr>
            <th>Картинка</th>
            <td>
                <img height="450" src="https://static.papaya.pw{{$item->image}}">
            </td>
        </tr>
        <tr>
            <th>Теги</th>
            <td>{{ $item->tags }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">Ссылки</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Бренд</th>
                    <th>Ссылка</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($item->urls as $url)
                    <tr>
                        <td>{{ $url->id }}</td>
                        <td><a href="{{ route('admin.brands.show', $url->brand) }}">{{ $url->brand->name }}</a></td>
                        <td><a href="{{ $url->url }}">{{ $url->url }}</a></td>
                        <td>
                            <form action="{{ route('admin.wardrobe-items.urls.remove', compact('item', 'url')) }}"
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
