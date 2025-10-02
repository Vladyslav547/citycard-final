@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-3">Картка #{{ $card->number }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-2">Місто: <strong>{{ $card->city?->name ?? '—' }}</strong></div>
                    <div class="mb-3">Баланс: <span class="fw-bold">{{ number_format($card->balance,2) }} грн</span></div>

                    <form method="POST" action="{{ route('user.cards.recharges.store', $card) }}">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Поповнити (грн)</label>
                            <input type="number" step="0.01" min="1" name="amount" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Опис (необов’язково)</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <button class="btn btn-success w-100">Поповнити</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h5 class="card-title">Нова поїздка</h5>
                    <form method="POST" action="{{ route('user.cards.rides.store', $card) }}">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Тип квитка</label>
                            <select name="ticket_type_id" class="form-select" required>
                                <option value="">— Оберіть —</option>
                                @foreach($ticketTypes as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Тип транспорту</label>
                            <select name="transport_type_id" class="form-select" required>
                                <option value="">— Оберіть —</option>
                                @foreach($transportTypes as $tt)
                                    <option value="{{ $tt->id }}">{{ $tt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary w-100">Списати</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Історія поповнень</h5>
                    @if($card->recharges->count())
                        <table class="table table-sm">
                            <thead>
                                <tr><th>Дата</th><th>Сума</th><th>Опис</th></tr>
                            </thead>
                            <tbody>
                            @foreach($card->recharges as $r)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($r->created_at)->format('Y-m-d H:i') }}</td>
                                    <td>{{ number_format($r->amount,2) }}</td>
                                    <td>{{ $r->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-muted">Поповнень ще немає.</div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body">
                    <h5 class="card-title">Історія поїздок</h5>
                    @if($card->rides->count())
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Транспорт</th>
                                    <th>Квиток</th>
                                    <th>Ціна</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($card->rides as $ride)
                                <tr>
                                    <td>
                                        @if($ride->boarded_at)
                                            {{ \Carbon\Carbon::parse($ride->boarded_at)->format('Y-m-d H:i') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($ride->created_at)->format('Y-m-d H:i') }}
                                        @endif
                                    </td>
                                    <td>{{ $ride->transportType?->name ?? '—' }}</td>
                                    <td>{{ $ride->ticketType?->name ?? '—' }}</td>
                                    <td>{{ number_format($ride->price,2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-muted">Поїздок ще немає.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
