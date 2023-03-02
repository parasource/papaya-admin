@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'moderation-step-1'])

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Картинка</th>
            <th>Пол</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    {{ $item->category }}
                </td>
                <td>
                    <img height="150" src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">
                </td>
                <td>
                    {{ $item->sex == 'male'? 'Муж.' : 'Жен.' }}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $items->links() }}

@endsection
