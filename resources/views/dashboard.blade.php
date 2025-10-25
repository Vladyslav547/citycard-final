{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    Ви увійшли у свій акаунт ✅
                </p>

                @if(Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 transition">
                        Перейти в адмін-панель
                    </a>
                @else
                    <a href="{{ route('user.cards.index') }}"
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded-md shadow hover:bg-green-700 transition">
                        Мої картки
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
