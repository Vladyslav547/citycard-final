<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityCard — Міський портал</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">

<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">CityCard</h1>

        <nav class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300">Панель</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 dark:text-red-400">Вийти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300">Увійти</a>
                <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-300">Реєстрація</a>
            @endauth
        </nav>
    </div>
</header>

<main class="flex items-center justify-center min-h-[75vh] text-center px-4">
    <div class="max-w-2xl">
        <h2 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-4">Ласкаво просимо до CityCard</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-8">
            Єдина картка для міського транспорту. Поповнення балансу, історія поїздок та зручний доступ — в одному місці.
        </p>

        <div class="flex items-center justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Створити обліковий запис</a>
            <a href="{{ route('login') }}" class="border border-gray-400 dark:border-gray-600 px-6 py-2 rounded text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                Увійти
            </a>
        </div>
    </div>
</main>

<footer class="text-center text-sm text-gray-400 dark:text-gray-500 py-4">
    &copy; {{ now()->year }} CityCard. Всі права захищені.
</footer>

</body>
</html>
