@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.notifications.index') }}

    @include('admin._nav', ['route' => 'notifications'])

    <h2>Рассылка всем пользователям</h2>

    <form action="{{ route('admin.notifications.broadcast') }}" method="post">
        @csrf

        <div class="form-group mt-3">
            <label for="title">Заголовок</label>
            <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group mt-3">
            <label for="text">Текст</label>
            <textarea name="text" class="form-control" id="text" rows="5">{{ old('text') }}</textarea>
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success">Отправить</button>
        </div>
    </form>

@endsection
