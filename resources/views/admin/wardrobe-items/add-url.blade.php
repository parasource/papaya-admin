@extends('layouts.app')

@section('content')

    @include('admin._nav', ['route' => 'wardrobe'])

    <form action="{{ route('admin.wardrobe-items.urls.add', $item) }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                Общие сведения
            </div>
            <div class="card-body pb-2">
                <div class="form-group mb-3">
                    <label for="brand_id" class="col-form-label">Бренд</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="url" class="col-form-label">Ссылка</label>
                    <input id="url" class="form-control @error('url') is-invalid @enderror" name="url"
                           value="{{ old('url') }}" required>
                    @error('url')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success">Добавить</button>
            </div>
        </div>
    </form>
@endsection
