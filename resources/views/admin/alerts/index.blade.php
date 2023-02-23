@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'alerts'])

    <div class="my-3">
        <a href="{{ route('admin.alerts.create') }}" class="btn btn-success">Создать</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Тип</th>
            <th>Тайтл</th>
            <th>Текст</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($alerts as $alert)
            <tr>
                <td>{{ $alert->getType() }}</td>
                <td>{{ $alert->title }}</td>
                <td>{{ $alert->text }}</td>
                <td>
                    <form action="{{ route('admin.alerts.destroy', $alert) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">X</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
