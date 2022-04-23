@extends('layouts.app')

@section('content')

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
            <th>Настроение</th>
            <td>{{ $user->mood }}</td>
        </tr>
        <tr>
            <th>Аватар</th>
            <td>
                <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="">
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection
