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

    <main class="flex items-center justify-center min-h-[75vh] text-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Ласкаво просимо до CityCard</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Ваш міський портал для жителів і гостей міста.</p>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Розпочати</a>
        </div>
    </main>

    <footer class="text-center text-sm text-gray-400 dark:text-gray-500 py-4">
        &copy; {{ now()->year }} CityCard. Всі права захищені.
    </footer>
</body>
</html>
