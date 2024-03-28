@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <h1>{{ $service->title }}</h1>
<p>{{ $service->description }}</p>

<h2>Appartamenti che offrono questo servizio:</h2>
<ul>
    @foreach($apartments as $apartment)
        <li>{{ $apartment->name }}</li>
    @endforeach
</ul>

@endsection