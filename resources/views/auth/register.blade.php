@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 480px">
    <h1 class="h3 mb-3">Реєстрація</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Ім’я</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name') }}">
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Телефон (необов’язково)</label>
            <input name="phone" type="text" class="form-control" value="{{ old('phone') }}">
            @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" required>
            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Підтвердження пароля</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Зареєструватися</button>
    </form>
</div>
@endsection
