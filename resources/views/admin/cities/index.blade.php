@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Міста</h1>
        <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Додати місто</a>
    </div>

    @if($cities->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Створено</th>
                    <th style="width:180px">Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->created_at ? $city->created_at->format('Y-m-d') : '-' }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-primary btn-sm">
                                Редагувати
                            </a>
                            <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити місто?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $cities->links() }}
    @else
        <div class="alert alert-info">Список міст порожній.</div>
    @endif
</div>
@endsection
