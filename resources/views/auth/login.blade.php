@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 480px">
    <h1 class="h3 mb-3">Вхід</h1>

    {{-- Стандартний вхід --}}
    <form method="POST" action="{{ route('login') }}" class="mb-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Запам’ятати мене</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Увійти</button>
    </form>

    <hr>

    {{-- Вхід по картці --}}
    <div class="text-center">
        <a href="{{ route('auth.card.form') }}" class="btn btn-outline-secondary w-100">
            Увійти по картці
        </a>
    </div>
</div>
@endsection
