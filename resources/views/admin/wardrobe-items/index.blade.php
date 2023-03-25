@php use Diglactic\Breadcrumbs\Breadcrumbs; @endphp
@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.wardrobe-items.index') }}

    @include('admin._nav', ['route' => 'wardrobe'])

    <div class="my-3">
        <a href="{{ route('admin.wardrobe-categories.index') }}" class="btn btn-secondary mr-2">Категории</a>
        <a href="{{ route('admin.wardrobe-items.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <div class="card mb-3">
        <div class="card-header">Фильтр</div>
        <div class="card-body">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Название</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="sex" class="col-form-label">Пол</label>
                            <select class="form-select" name="sex" id="sex">
                                <option value=""></option>
                                @foreach($sexList as $key => $value)
                                    <option
                                        value="{{ $key }}" {{ request('sex') == $key? 'selected':'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="category_id" class="col-form-label">Категория</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ request('category_id') == $category->id? 'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Найти</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Картинка</th>
            <th>Теги</th>
            <th>Пол</th>
            <th>Кол-во ссылок</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.wardrobe-items.show', $item) }}">{{ $item->name }}</a></td>
                <td>
                    <a href="{{ route('admin.wardrobe-categories.show', $item->category) }}">{{ $item->category->name }}</a>
                </td>
                <td>
                    <img height="150" src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">
                </td>
                <td>
                    {{ Str::limit($item->tags) }}
                </td>
                <td>
                    {{ $item->getSex() }}
                </td>
                <td>
                    {{ $item->urls_count }}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $items->append(request()->query())->links() }}

@endsection
