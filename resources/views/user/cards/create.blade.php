@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Створити картку</h1>

    {{-- Вивід помилок --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.cards.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="number">Номер картки</label>
            <input type="text" class="form-control" id="number" name="number"
                   placeholder="Введіть номер картки" value="{{ old('number') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="city_id">Місто</label>
            <select name="city_id" id="city_id" class="form-control" required>
                <option value="">— Оберіть місто —</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Створити</button>
        <a href="{{ route('user.cards.index') }}" class="btn btn-secondary mt-3">Назад</a>
    </form>
</div>
@endsection
