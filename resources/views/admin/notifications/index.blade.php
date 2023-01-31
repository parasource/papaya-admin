@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.notifications.index') }}

    @include('admin._nav', ['route' => 'notifications'])

    <div class="my-3">
        <a href="{{ route('admin.notifications.broadcast') }}" class="btn btn-primary">Рассылка</a>
        <a href="{{ route('admin.notifications.send') }}" class="btn btn-primary">Сообщение</a>
    </div>

@endsection
