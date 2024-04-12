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
                </div>
            </div>                        
        </div>

        {{-- Sponsor disponibili --}}
        <hr>
        <h2>
            Approfittane ora
        </h2>
        <p>
            Hai ancora degli appartamenti non sponsorizzati
        </p>
        <div class="row sponsored_apartments_container">
                @foreach ($unsponsoredApartments as $singleApartment)
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
