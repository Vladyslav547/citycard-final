@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-3">Додати тип квитка</h1>

    <form action="{{ route('admin.ticket-types.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Назва</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ціна (грн)</label>
            <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') ?? 0 }}" required>
            @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Місто</label>
            <select name="city_id" class="form-select" required>
                <option value="">— Оберіть місто —</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Зберегти</button>
    </form>
</div>
@endsection
