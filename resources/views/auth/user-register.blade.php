@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Реєстрація користувача</h2>

        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.register') }}">
            @csrf

            <div>
                <label for="name">Імʼя:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="phone">Телефон:</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
            </div>

            <div>
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="password_confirmation">Підтвердження паролю:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <div>
                <label for="card_number">Номер картки:</label>
                <input type="text" name="card_number" id="card_number" value="{{ old('card_number') }}" required>
            </div>

            <button type="submit">Зареєструватись</button>
        </form>
    </div>
@endsection
