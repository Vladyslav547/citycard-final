<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CityCard — Міський портал</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">CityCard</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Перемкнути навігацію">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.cards.index') }}">Мої картки</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link p-0">Вийти</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Увійти</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-lg-2" href="{{ route('register') }}">Розпочати</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-5">
    <div class="row align-items-center gy-4">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold">Ласкаво просимо до CityCard</h1>
            <p class="text-muted mb-4">
                Єдина картка для міського транспорту. Поповнення балансу, історія поїздок та зручний доступ — в одному місці.
            </p>
            @guest
                <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Створити обліковий запис</a>
                <a class="btn btn-outline-secondary btn-lg ms-2" href="{{ route('login') }}">Увійти</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{ route('user.cards.index') }}">Перейти до карток</a>
            @endguest
        </div>
        <div class="col-lg-6">
            <div class="p-4 bg-white border rounded-4 shadow-sm">
                <ul class="mb-0">
                    <li>Картки, баланс, поповнення</li>
                    <li>Історія поїздок</li>
                    <li>Підтримка різних типів квитків</li>
                    <li>Адмін-панель для міст, транспорту, тарифів</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<footer class="text-center text-muted py-4">
    &copy; {{ now()->year }} CityCard. Всі права захищені.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
