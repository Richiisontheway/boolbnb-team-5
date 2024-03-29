@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <h1>{{ $service->title }}</h1>
    {{-- <p>{{ $service->description }}</p> --}}

    <h2>I tuoi appartamenti che offrono questo servizio:</h2>
    <ul>
        @foreach($apartments as $apartment)
            <li>   
                <a href="{{ route('admin.apartments.show' , ['apartment' => $apartment->slug]) }}" class="text-decoration-none">
                    {{ $apartment->title }}
                </a>
            </li>
        @endforeach
    </ul>

@endsection