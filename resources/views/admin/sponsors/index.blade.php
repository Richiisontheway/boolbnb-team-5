@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')

    <div class="container">
        <div class="row sponsorship-container mt-3">

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 description">
                            <div class="row">
                                <div class="col-12">
                                    <h1>
                                        Servizio di sponsorizzazione per gli host
                                    </h1>
                                </div>
                                <div class="col-12">
                                    <p>
                                        Benvenuto nel nostro servizio di sponsorizzazione per gli appartamenti!
                                        Immagina di avere i tuoi appartamenti in primo piano sulla nostra homepage e nella pagina di ricerca, catturando immediatamente l'attenzione degli utenti che visitano il nostro sito alla ricerca di un alloggio.
                                        <br>
                                        Non perdere l'opportunità di sfruttare al massimo la tua attività di affitto con il nostro servizio di sponsorizzazione.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mx-auto mt-3">
                        <div class="row">
                            <div class="col-4 d-lg-flex align-items-lg-stretch">
                                <div class="my-card silver p-2">
                                    <div class="row flex-column justify-content-between">
                                        <div class="col-12 text-center">
                                            <h4 class="mt-1">
                                                SILVER
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="my-ul">
                                                <h6 class="text-center">
                                                    2,99 € / 24h
                                                </h6>
                                                <ul class="d-none d-lg-block fa-ul d-flex flex-column flex-grow-1 justify-content-around">
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Prima pagina per 24 ore  
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Massima visibilità              
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Ideale per promuovere rapidamente
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-lg-flex align-items-lg-stretch">
                                <div class="my-card gold p-2">
                                    <div class="row flex-column justify-content-around">
                                        <div class="col-12 text-center">
                                            <h4 class="mt-1">
                                                GOLD
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="my-ul">

                                                <h6 class="text-center">
                                                    5,99 € / 72h
                                                </h6>
                                                <ul class="d-none d-lg-block fa-ul d-flex flex-column flex-grow-1 justify-content-around">
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Homepage e ricerca per 3 giorni
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Più prenotazioni garantite   
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Ottimo rapporto qualità-prezzo
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 d-lg-flex align-items-lg-stretch ">
                                <div class="my-card platinum p-2">
                                    <div class="row flex-column justify-content-around">
                                        <div class="col-12 text-center">
                                            <h4 class="mt-1">
                                                PLATINUM
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="my-ul">

                                                <h6 class="text-center">
                                                    9,99 € / 144h
                                                </h6>
                                                <ul class="d-none d-lg-block fa-ul d-flex flex-column flex-grow-1 justify-content-around">
                                                    <li> 
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Visibilità massima per 6 giorni         
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Vantaggio competitivo prolungato
                                                    </li>
                                                    <li>
                                                        <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                        Massimizza le prenotazioni a lungo termine
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>

        {{-- Sponsor disponibili --}}
        {{-- <div class="row">
            @foreach ($sponsors as $sponsor)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
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
        </div> --}}
        <hr>
        <h2>
            Approfittane ora
        </h2>
        <p>
            Hai ancora degli appartamenti non sponsorizzati
        </p>
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
                                <div class="d-flex justify-content-center col-12 g-2">
                                    <div class="d-flex me-1 button_container">
                                        <a href="{{ route('admin.sponsor.show', $singleApartment->id) }}" class="text-decoration-none">
                                            Sponsorizza
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
