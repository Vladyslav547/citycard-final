@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Вхід за карткою</h2>

    <form method="POST" action="{{ route('card.login.submit') }}">
        @csrf

        <!-- Номер картки -->
        <div class="mb-3">
            <label for="card_number">Номер картки</label>
            <input type="text" name="card_number" id="card_number" class="form-control" required>
            @error('card_number') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Пароль -->
        <div class="mb-3">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Увійти</button>
    </form>
</div>
@endsection
