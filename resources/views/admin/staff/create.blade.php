@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.staff.create') }}

    @include('admin._nav', ['route' => 'staff'])

    <form method="POST" action="{{ route('admin.staff.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Имя</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            @error('name')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">Эл. почта</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Пароль</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>
            @error('password')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="role" class="col-form-label">Роль</label>
            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('role') ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('role')
            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
