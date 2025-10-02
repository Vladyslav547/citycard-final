<!DOCTYPE html>
<html>
<head>
    <title>Вхід для користувача</title>
</head>
<body>
    <h2>Вхід для користувача</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.login.submit') }}">
        @csrf

        <label for="card_number">Номер картки:</label><br>
        <input type="text" name="card_number" required><br><br>

        <label for="phone">Телефон:</label><br>
        <input type="text" name="phone" required><br><br>

        <button type="submit">Увійти</button>
    </form>
</body>
</html>
