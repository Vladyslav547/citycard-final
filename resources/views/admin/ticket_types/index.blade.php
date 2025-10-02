@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Типи квитків</h1>
        <a href="{{ route('admin.ticket-types.create') }}" class="btn btn-primary">Додати тип квитка</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($ticketTypes->count())
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Ціна</th>
                        <th>Місто</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticketTypes as $t)
                        <tr>
                            <td>{{ $t->name }}</td>
                            <td>{{ number_format($t->price,2) }} грн</td>
                            <td>{{ $t->city?->name ?? '—' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.ticket-types.edit', $t) }}" class="btn btn-primary btn-sm">
                                    Редагувати
                                </a>
                                <form action="{{ route('admin.ticket-types.destroy', $t) }}" method="POST" onsubmit="return confirm('Видалити тип квитка?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $ticketTypes->links() }}
        </div>
    @else
        <div class="alert alert-info">Типів квитків ще немає.</div>
    @endif
</div>
@endsection
