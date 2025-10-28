<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CityCard — Міський портал</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">CityCard</a>
    <div class="ms-auto">
      @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-secondary me-2">Панель</a>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-danger">Вийти</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary me-2">Увійти</a>
        <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Реєстрація</a>
      @endauth
    </div>
  </div>
</nav>

<main class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-8">
      <h1 class="display-5 fw-bold mb-3">Ласкаво просимо до <span class="text-primary">CityCard</span></h1>
      <p class="lead text-muted mb-4">
        Єдина картка для міського транспорту. Поповнення балансу, історія поїздок та зручний доступ — в одному місці.
      </p>
      <div class="d-flex gap-3">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Створити обліковий запис</a>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Увійти</a>
      </div>
    </div>
  </div>
</main>

<footer class="text-center text-muted py-4 small">
  © {{ now()->year }} CityCard. Всі права захищені.
</footer>

</body>
</html>
