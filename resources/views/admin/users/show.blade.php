@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.users.show', $user) }}

    @include('admin._nav', ['route' => 'users'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Имя</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Эл.почта</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Пол</th>
            <td>{{ $user->getSex() }}</td>
        </tr>
        <tr>
            <th>Зарегистрировался</th>
            <td>{{ $user->created_at->format('H:i d.m.Y') }}</td>
        </tr>
        <tr>
            <th>Включены уведомления</th>
            <td>{{ $user->push_notifications? 'Да': 'Нет' }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <div class="card">
        <div class="card-header">Сводка</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Количество вещей в гардеробе</th>
                    <td>{{ $user->wardrobe()->count() }}</td>
                </tr>
                <tr>
                    <th>Количество лайкнутых образов</th>
                    <td>{{ $user->liked_looks()->count() }}</td>
                </tr>
                <tr>
                    <th>Количество дизлайкнутых образов</th>
                    <td>{{ $user->disliked_looks()->count() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
