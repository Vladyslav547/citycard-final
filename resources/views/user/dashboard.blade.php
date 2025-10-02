<!DOCTYPE html>
<html>
<head>
    <title>Панель користувача</title>
</head>
<body>
    <h2>Вітаємо, {{ auth()->user()->name }}</h2>

    <h3>Ваші картки:</h3>
    @if($cards->isEmpty())
        <p>Карток не знайдено</p>
    @else
        <ul>
            @foreach ($cards as $card)
                <li>Номер: {{ $card->number }} | Баланс: {{ $card->balance }} грн</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button type="submit">Вийти</button>
    </form>
</body>
</html>
