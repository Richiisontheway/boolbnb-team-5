@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <h1>
       Le nostre sponsorizzazioni
    </h1>
        <h1>Scegli il tipo di sponsorizzazione</h1>
        <form action="{{ route('sponsors.sponsorize', $apartment->id) }}" method="post">
            @csrf
            <select name="sponsor_id" class="form-select">
                <option value="">Seleziona il tipo di sponsorizzazione</option>
                @foreach($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->title }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-3">Sponsorizza</button>
        </form>
@endsection
