@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <h1>
       Sponsorizzazioni disponibili
    </h1>

      <div class="container">
        {{-- Sponsor disponibili --}}
        <div class="row">
            @foreach ($sponsors as $sponsor)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h3>    
                                {{ $sponsor->title }}
                            </h3>
                            <div class="card-text">
                                <ul>
                                    <li>
                                        Durata: {{ $sponsor->time }} h
                                    </li>
                                    <li>
                                        Prezzo: {{ $sponsor->price }} €
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <h2>
            Appartamenti sponsorizzati
        </h2>
        <div class="row flex-wrap  sponsored_apartments_container">
            @foreach ($sponsoredApartments as $apartment)
            <div class="col-2 d-flex m-2">
                <div class="my-card">
                    @if ($apartment->cover_img != null)
                        <img src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                    @endif
                    <h3>
                        {{$apartment->title}}
                    </h3>
                    <p>
                        {{ $apartment->city }}
                        <br>
                        {{ $apartment->address }}
                    </p>
                    <div>
                        @php
                            $firstSponsor = $apartment->sponsors->first();
                        @endphp
                        <p>Sponsorizzato: <span class="rounded-pill bg-primary text-light p-1">{{ $firstSponsor->title }}</span></p>                      
                    </div>
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('admin.apartments.show' , ['apartment' => $apartment->slug]) }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                    </div>      
                </div>
            </div>
            @endforeach
        </div>

      </div>

@endsection
