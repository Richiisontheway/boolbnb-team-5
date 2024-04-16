@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')

    <div class="container">
        <div class="row sponsorship-container mt-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 description">
                        <div class="row">
                            <div class="col-12">
                                <h1>
                                    Servizio di sponsorizzazione per gli Host
                                </h1>
                            </div>
                            <div class="col-12">
                                <p class="fw-medium">
                                    Benvenuto nel nostro servizio di sponsorizzazione per gli appartamenti!
                                    Immagina di avere i tuoi appartamenti in primo piano sulla nostra homepage e nella pagina di ricerca, catturando immediatamente l'attenzione degli utenti che corrispondono al profilo ideale del tuo pubblico di riferimento visitano il nostro sito alla ricerca di un alloggio.
                                    <br>
                                    Non perdere l'opportunità di sfruttare al massimo la tua attività di affitto con il nostro servizio di sponsorizzazione.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 description-info py-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="my-description-card me-2">
                                    <h6>
                                        Evidenza in Homepage
                                    </h6>
                                    <p class="fw-normal">
                                        Il tuo appartamento sarà presentato in cima agli elenchi di ricerca, garantendo che sia il primo ad essere visualizzato dagli utenti che corrispondono al profilo ideale del tuo pubblico di riferimento quando visitano la nostra homepage.
                                    </p>
                                </div>
                                <div class="my-description-card mx-2">
                                    <h6>
                                        Maggiore Visibilità
                                    </h6>
                                    <p class="fw-normal">
                                        Sfruttando il nostro algoritmo avanzato, il tuo appartamento sarà raccomandato agli utenti che corrispondono al profilo ideale del tuo pubblico di riferimento, garantendo una maggiore visibilità.
                                    </p>
                                </div>
                                <div class="my-description-card mx-2">
                                    <h6>
                                        Presentazione Esclusiva
                                    </h6>
                                    <p class="fw-normal">
                                        La sponsorizzazione premium distingue il tuo appartamento con animazioni esclusive, rendendolo diverso dagli altri annunci sulla piattaforma.
                                    </p>
                                </div>
                                <div class="my-description-card mx-2">
                                    <h6>
                                        Aumento delle Prenotazioni
                                    </h6>
                                    <p class="fw-normal">
                                        Gli annunci sponsorizzati tendono ad attirare un maggior numero di prenotazioni rispetto alla media.
                                    </p>
                                </div>
                                <div class="my-description-card mx-2">
                                    <h6>
                                        Feedback e Recensioni Prioritarie
                                    </h6>
                                    <p class="fw-normal">
                                        Gli ospiti che prenotano il tuo alloggio tramite il nostro servizio di sponsorizzazione premium avranno la possibilità di fornire feedback e recensioni con priorità.
                                    </p>
                                </div>
                                <div class="my-description-card">
                                    <h6>
                                        Supporto personalizzato
                                    </h6>
                                    <p class="fw-normal">
                                        Il nostro team dedicato è sempre disponibile per assisterti e consigliarti su come ottimizzare la tua sponsorizzazione per massimizzare i risultati.
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
                            <div class="card-text flex-grow-1 h-100 row flex-column">
                                <div class="col-12">
                                    <strong class="fw-semibold">
                                        {{Str::limit($singleApartment->title,20, '...')}}                                     
                                    </strong>
                                </div>
                                <div class="col-12 address_container fw-medium">
                                    {{ Str::limit($singleApartment->address,30, '...') }}
                                </div>
                                <div class="d-flex justify-content-center col-12 mt-3 g-2">
                                    <div class="d-flex me-1 button_container">
                                        <a href="{{ route('admin.sponsor.show', $singleApartment->id) }}" class="text-decoration-none fw-medium">
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
