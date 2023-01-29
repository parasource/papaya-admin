@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.settings.index') }}

    @include('admin._nav', ['route' => 'settings'])

    <div class="my-3">
        <a href="{{ route('admin.settings.create') }}" class="btn btn-success">Создать</a>
    </div>

    <div class="my-3">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ключ</th>
            <th>Значение</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($settings as $setting)
            <tr>
                <td>{{ $setting->id }}</td>
                <td>{{ $setting->key }}</td>
                <td>{{ $setting->value }}</td>
                <td>
                    <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">X</button>
                    </form>
                    <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-primary">Редактировать</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{--    {{ $looks->links() }}--}}

@endsection
