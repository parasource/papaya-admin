@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.looks.items-add', $look) }}

    @include('admin._nav', ['route' => 'looks'])

    <img height="250" src="https://static.papaya.parasource.tech{{ $look->image }}" alt="">

    <div class="card mb-3">
        <div class="card-header">Фильтр</div>
        <div class="card-body">
            <form action="?" method="GET">
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
                            <label for="category_id" class="col-form-label">Категории</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br/>
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
            <th>Картинка</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.wardrobe-items.show', $item) }}">{{ $item->name }}</a></td>
                <td><img height="150" src="https://static.papaya.parasource.tech{{ $item->image }}" alt=""></td>
                <td>
                    <form action="{{ route('admin.looks.items.add', compact('look', 'item')) }}" method="post">
                        @csrf
                        <button class="btn btn-success">+</button>
                    </form>
                </td>
            </tr>
        @endforeach

        {{ $items->links() }}

        </tbody>
    </table>

@endsection
