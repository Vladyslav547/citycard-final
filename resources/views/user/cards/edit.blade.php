@extends('layouts.app')

@section('content')
<h1>Редагувати картку</h1>

<form action="{{ route('user.cards.update', $card) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="number">Номер картки:</label>
        <input type="text" id="number" name="number" value="{{ old('number', $card->number) }}">
    </div>

    <div>
        <label for="balance">Баланс:</label>
        <input type="number" id="balance" name="balance" value="{{ old('balance', $card->balance) }}">
    </div>

    <button type="submit">Оновити</button>
</form>
@endsection
