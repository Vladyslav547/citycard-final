@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати місто</h1>

    <form action="{{ route('admin.cities.update', $city) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Назва</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $city->name) }}" required>
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Типи транспорту в місті</label>
            @foreach($transportTypes as $type)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="transport_types[]" id="t{{ $type->id }}" value="{{ $type->id }}"
                        {{ in_array($type->id, old('transport_types', $selected ?? [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="t{{ $type->id }}">{{ $type->name }}</label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Оновити</button>
    </form>
</div>
@endsection
