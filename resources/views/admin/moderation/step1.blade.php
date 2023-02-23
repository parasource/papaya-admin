@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'moderation-step-1'])

    <div class="card">
        <div class="card-header">Носят ли сейчас эту вещь и соответствует ли она своему названию?</div>
        <div class="card-body">
            <p>
                Пол: {{ $item->sex == 'male'? 'Муж.' : 'Жен.' }}
            </p>
            <p>
                <b>Название: {{ $item->name }}</b>
            </p>
            <br>
            <img src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">

            <form action="{{ route('admin.moderation-step-1.approve', $item) }}" method="POST">
                @csrf
                <button class="btn btn-success w-100 my-3">Оставляем</button>
            </form>
            <form action="{{ route('admin.moderation-step-1.decline', $item) }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100 mt-1">Убираем</button>
            </form>
        </div>
    </div>
@endsection
