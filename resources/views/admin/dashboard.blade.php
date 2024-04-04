@php
    $totalAppartments = App\Models\Apartment::count();
    // $userApartments = Auth::user()->apartments;
    $userApartments = App\Models\Apartment::where('user_id', auth()->id())->get();
@endphp

@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <!-- Inizio Header -->
    <header>
        <div class="text-white h-100">
            
            <div class="row align-items-center h-100 m-0">
                <!-- Inizio Colonna Search Bar -->
                {{-- <div class="col">
                    <form action="#">
                        <div class="input-group">
                            <span class="my-navbar border-end-0 input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0 my-navbar" placeholder="Prova a cercare: Lezioni di Laravel" aria-label="Prova a cercare: Lezioni di Laravel" aria-describedby="basic-addon1">
                        </div>    
                    </form>
            
                </div> --}}
                <!-- Fine Colonna Search Bar -->

                <!-- Inizio Colonna Bottoni -->
                <div class="col-auto ms-auto">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <!-- Inizio Bottone Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->name }} {{ $user->lastname }}                    
                            </button>
                            <ul class="dropdown-menu">
                                <li class="d-none d-lg-block">
                                    <h6>
                                        Email:
                                    </h6>
                                    {{ $user->email }}
                                </li>
                                <li class="d-none d-lg-block">
                                    <h6>
                                        Data di nascita:
                                    </h6>
                                    {{$user->birthday}}                                
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                                        @csrf
                                            <button type="submit">
                                                Log Out
                                            </button>
                                    </form>
                                </li>
                            </ul>
                        </div>                            
                        <!-- Inizio Bottone Dropdown -->

                    </div>
                </div>
                <!-- Fine Colonna Bottoni -->

            </div>
        </div>
    </header>
    <!-- Fine Header -->

    {{-- Inizio Main --}}
    <main>
        <!-- Inizio Container Tabelle -->
        <div class="container-fluid p-0 my-table-container">

            <!-- Inizio 2^ Row  -->
            <div class="row">

                <!-- Inizio Colonna Sx Container Tabelle-->
                <div class="col-12 col-lg-8 pt-3">

                    {{-- Creo una condizione per cui se l'utente ha appartamenti allora vengono mostrati --}}
                    @if($userApartments->isNotEmpty())
                    
                        <!-- Inizio Tabella Appartamenti -->
                        <div class="table-responsive">
                            <table class="table caption-top border text-center">

                                <!-- Titolo Tabella -->
                                <caption class="border rounded-top-2">
                                    <h5 class="ps-2 fs-4">
                                        Numero Totale Appartamenti: {{ $totalAppartments }}
                                    </h5>
                                </caption>
                                {{-- Inizio Testata Tabella --}}
                                <thead>
                                    <tr>
                                    <th class="col-6 text-start">
                                        Nome Appartamento
                                    </th>
                                    <th>Città</th>
                                    <th>Sponsor</th>
                                    </tr>
                                </thead>
                                {{-- Fine Testata Tabella --}}
                                <!-- Inizio Corpo Tabella -->
                                <tbody>
                                    @foreach ($userApartments as $singleApartment)
                                        <tr>
                                            <td class="text-start">
                                                <img src="img/class-avatar.jpg" alt="">
                                                <span>
                                                    {{ $singleApartment->title }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $apartmentAddress = $singleApartment->address;
                                                    $addressParts = explode(',', $apartmentAddress);
                                                    $city = end($addressParts);
                                                    $cityParts = explode(' ', trim($city));
                                                    $newApartmentAddress = end($cityParts);
                                                @endphp
                                                {{ $newApartmentAddress }}
                                            </td>
                                            <td>
                                                @if ($singleApartment->sponsors)
                                                    @foreach ($singleApartment->sponsors as $sponsor)
                                                        @if ($sponsor->id == 1)
                                                            <span class="badgetext-bg-silver px-1">
                                                                {{ $sponsor->title }}
                                                            </span>
                                                        @elseif ($sponsor->id == 2)
                                                            <span class="badgetext-bg-gold px-1">
                                                                {{ $sponsor->title }}
                                                            </span>
                                                        @elseif ($sponsor->id == 3)
                                                            <span class="badgetext-bg-platinum px-1">
                                                                {{ $sponsor->title }}
                                                            </span>
                                                        @endif       
                                                    @endforeach
                                                @endif   
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                
                        </div>
                        <!-- Fine Tabella Appartamenti-->

                    {{-- Altrimenti viene avvisato che ancora non ne ha --}}
                    @else
                        <p>Non hai ancora aggiunto nessun appartamento.</p>
                    @endif


                    <!-- Inizio Accordion -->
                    <div class="card accordion accordion-flush" id="accordionFlushExample">
                        <div class="card-header">
                            <h5 class="fs-4">
                                F.A.Q.
                            </h5>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Come aggiungere un nuovo studente?
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Clicca sul "+" in alto nella sezione blu.
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Come posso accedere alle informazioni del mio account?
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Clicca sull'icona della "campanella".
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Posso usare questa dashboard su mobile?
                            </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                Chiedi a @Nik.
                            </div>
                            </div>
                        </div>
                    </div>  
                    <!-- Fine Accordion -->

                </div>
                <!-- Fine Colonna Sx -->

                <!-- Inizio Colonna Dx -->
                <div class="col-12 col-lg-4 pt-3">

                    <!-- Inizio To Do List -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="fs-4">
                            Todo
                            </h5>
                        </div>
                        <ul class="list-group p-3">
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                                <label class="form-check-label" for="firstCheckbox">
                                Kickoff nuove classi
                                </label>
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" id="secondCheckbox">
                                <label class="form-check-label" for="secondCheckbox">
                                Lezione su Bootstrap 5 in classe #75
                                </label>
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" id="thirdCheckbox">
                                <label class="form-check-label" for="thirdCheckbox">
                                Controllare username github studenti
                                </label>
                            </li>
                        </ul> 
                    </div>
                    <!-- Fine To Do List -->

                    <!-- Inizio Card Stats -->
                    <div class="card p-2">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                <img src="img/stats.jpeg" alt="stats" class="w-100">
                                <h5>
                                    Utenti Attivi
                                </h5>
                                Lista degli utenti attivi in piattaforma nell'ultimo mese
                                </li>
                                <li class="list-group-item">
                                Gennaio: 1200
                                </li>
                                <li class="list-group-item">
                                Febbraio: 800
                                </li>
                                <li class="list-group-item">
                                Marzo: 1500
                                </li>
                                <li class="list-group-item">
                                <a href="#">
                                    Visualizza report approfondito
                                </a>
                                </li>
                            </ul>
                        </div>                              
                    </div> 
                    <!-- Fine Card Stats -->
            
                </div>
                <!-- Inizio Colonna Dx -->

            </div>
            <!-- Fine 2^ Row -->

        </div>
        <!-- Fine Container Tabelle -->
    </main>
    {{-- Fine Main --}}
@endsection
