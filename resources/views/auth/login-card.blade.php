@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 480px">
    <h1 class="h3 mb-3">Вхід за карткою</h1>

    <form method="POST" action="{{ route('auth.card.login') }}">
        @csrf

        <div class="mb-3">
            <label for="card_number" class="form-label">Номер картки</label>
            <input type="text" name="card_number" id="card_number" class="form-control" required value="{{ old('card_number') }}">
            @error('card_number')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Увійти</button>
        </div>
    </form>

    <hr>

    <div class="text-center">
        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
            Увійти за email
        </a>
    </div>
</div>
@endsection
