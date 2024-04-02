@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <form action="{{ route('apartments.sponsorize', ['slug' => $apartment->slug]) }}" method="post">
        @csrf
        <label for="sponsorship">Tipo di sponsorizzazione:</label>
        <select name="sponsorship" id="sponsorship">
            <option value="Tipo 1">Tipo 1</option>
            <option value="Tipo 2">Tipo 2</option>
            <option value="Tipo 3">Tipo 3</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Sponsorizza</button>
    </form>
@endsection
