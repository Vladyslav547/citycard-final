@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Мої картки</h1>
        <a href="{{ route('user.cards.create') }}" class="btn btn-primary">Додати картку</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cards->count())
        <div class="list-group">
            @foreach($cards as $card)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('user.cards.show', $card) }}" class="text-decoration-none">
                                <strong>#{{ $card->number }}</strong>
                                @if($card->city)
                                    <span class="text-muted"> • {{ $card->city->name }}</span>
                                @endif
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span>Баланс: <strong>{{ number_format($card->balance, 2) }} грн</strong></span>
                            <form action="{{ route('user.cards.destroy', $card) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити картку?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $cards->links() }}
        </div>
    @else
        <div class="alert alert-info">У вас ще немає карток.</div>
    @endif
</div>
@endsection
