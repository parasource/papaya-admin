@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.topics.add-look', $topic) }}

    @include('admin._nav', ['route' => 'topics'])

    <h3>{{ $topic->name }}</h3>

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
                            <label for="last_name" class="col-form-label">Описание</label>
                            <input id="last_name" class="form-control" name="desc" value="{{ request('desc') }}">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
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
            <th>Slug</th>
            <th>Описание</th>
            <th>Картинка</th>
            <th>Создан</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($looks as $look)
            <tr>
                <td>{{ $look->id }}</td>
                <td><a href="{{ route('admin.looks.show', $look) }}">{{ $look->name }}</a></td>
                <td>{{ $look->slug }}</td>
                <td>{{ $look->desc }}</td>
                <td>
                    <img height="250" src="https://static.papaya.pw{{ $look->image }}" alt="">
                </td>
                <td>{{ $look->created_at->format('d-m-Y') }}</td>
                <td>
                    <form action="{{ route('admin.topics.put-look', compact('topic', 'look')) }}" method="post">
                        @csrf
                        <button class="btn btn-success">+</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
