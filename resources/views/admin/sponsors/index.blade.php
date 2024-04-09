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
        <div class="row sponsored_apartments_container">
                @foreach ($sponsoredApartments as $singleApartment)
                    <div class="col-12 col-md-6 col-lg-3 p-2">
                        <div class="card h-100" style = "border:none">
                            @if ($singleApartment->cover_img != null)
                                <div class="img_container">
                                    <img src="{{ $singleApartment->full_cover_img }}" class="card-img-top img-fluid" alt="{{$singleApartment->title}}" style="height: 200px; object-fit: cover;">
                                </div>
                            @endif
                        <div class="card-body text-start">
                            <div class="card-text row">
                                <div class="col-12">
                                    <strong>
                                        {{$singleApartment->title}}
                                    </strong>
                                </div>
                                <div class="col-12 address_container">
                                    {{ $singleApartment->address }}
                                </div>
                                <div>
                                    @php
                                        $firstSponsor = $singleApartment->sponsors->first();
                                    @endphp
                                    <p> 
                                        Sponsorizzato: 
                                        <span class="rounded-pill sponsor-pill">
                                            {{ $firstSponsor->title }}
                                        </span>
                                    </p>                      
                                </div>
                                <div class="d-flex justify-content-center col-12 g-2">
                                    <div class="d-flex me-1 button_container">
                                        <a href="{{ route('admin.apartments.show' , ['apartment' => $singleApartment->slug]) }}">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

      </div>

@endsection
