@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
<h1>Sponsorizza l'appartamento "{{ $apartment->title }}"</h1>

<form action="{{ route('admin.apartments.sponsorize', ['slug' => $apartment->slug]) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="sponsorship">Seleziona il tipo di sponsorizzazione:</label>
        <select name="sponsorship" id="sponsorship" class="form-control">
            <option value="">-</option>
            @foreach($sponsorships as $sponsorship)
                <option value="{{ $sponsorship->id }}">{{ $sponsorship->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Sponsorizza</button>
</form>
@endsection
