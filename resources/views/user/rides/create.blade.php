@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Нова поїздка для картки №{{ $card->id }}</h2>

    <form action="{{ route('user.rides.store', $card->id) }}" method="POST">
        @csrf

        <input type="hidden" name="city_id" value="{{ $city->id }}">

        {{-- Тип транспорту --}}
        <div class="mb-3">
            <label for="transport_id" class="form-label">Тип транспорту</label>
            <select name="transport_id" id="transport_id" class="form-control" required>
                <option value="">-- Оберіть транспорт --</option>
                @foreach($transports as $transport)
                    <option value="{{ $transport->id }}">{{ $transport->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Тип квитка --}}
        <div class="mb-3">
            <label for="ticket_type_id" class="form-label">Тип квитка</label>
            <select name="ticket_type_id" id="ticket_type_id" class="form-control" required>
                <option value="">-- Оберіть тип квитка --</option>
                @foreach($ticketTypes as $ticket)
                    <option value="{{ $ticket->id }}">
                        {{ $ticket->name }} ({{ $ticket->price }} грн)
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
@endsection
