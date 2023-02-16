@extends('layouts.app')

@section('content')
    @include('admin._nav', ['route' => 'moderation-step-1'])

    <div class="card">
        <div class="card-header">Соответствует ли фото названию вещи?</div>
        <div class="card-body">
            <b>Категория: {{ $item->category }}</b>
            <img src="https://static.papaya.parasource.tech{{ $item->image }}" alt="">

            <form action="{{ route('admin.moderation-step-1.approve', $item) }}" method="POST">
                @csrf
                <button class="btn btn-success w-100 my-3">Заебись</button>
            </form>
            <form action="{{ route('admin.moderation-step-1.approve', $item) }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100 mt-1">Не заебись</button>
            </form>
        </div>
    </div>
@endsection
