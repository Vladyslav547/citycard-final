@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="mb-3">👑 Панель адміністратора</h1>
            <p>Вітаю, <strong>{{ Auth::user()->name }}</strong>!</p>
            <p class="text-muted">Ви увійшли як <span class="fw-bold text-success">адміністратор</span>.</p>

            <hr>

            <h5>🔗 Доступні дії:</h5>
            <ul>
                <li><a href="{{ route('admin.cities.index') }}">Керувати містами</a></li>
                <li><a href="{{ route('admin.users.index') }}">Керувати користувачами</a></li>
                <li><a href="{{ route('admin.ticket-types.index') }}">Керувати типами квитків</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
