@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Користувачі</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Імʼя</th>
                <th>Email</th>
                <th>Дата реєстрації</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                <td>
                    @if(!$user->is_admin) {{-- приховати кнопку для адміна --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Видалити цього користувача?');" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Видалити</button>
                        </form>
                    @else
                        <span class="text-muted">Адміністратор</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
