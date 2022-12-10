@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.staff.show', $user) }}

    @include('admin._nav', ['route' => 'staff'])

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.staff.edit', $user) }}" class="btn btn-primary mr-1">Изменить</a>
        <form method="POST" action="{{ route('admin.staff.destroy', $user) }}" class="mr-1">
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
            <th>Роль</th>
            <td>{{ $user->getRole() }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

@endsection
