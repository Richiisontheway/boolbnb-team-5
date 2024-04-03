@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <section id="apartments-show">
      
        <div class="row g-0">
            <div class="col">
                <div class="my-card-show">
                    <img src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                    <div class="my-card-show-body">

                        <div class="mt-3">
                            <h4>
                                {{$apartment->title}}, {{ $apartment->address }}. 
                            </h4>
                            <p>
                                {{ $apartment->n_rooms }} Stanze · {{ $apartment->n_beds }} Letti · {{ $apartment->n_baths }} Bagni · {{ $apartment->mq }} m2
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div id="services" class="d-flex flex-wrap">
                                    @forelse ($apartment->services as $service)
                                        <a href="{{ route('admin.services.show' , ['service' => $service->id]) }}" class="d-flex align-items-center">
                                            <i class="{{$service->icon}} pe-2"></i> {{$service->title}}
                                        </a>
                                    @empty
                                        <h5>
                                            Nessun servizio incluso
                                        </h5>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-6">
                                {{-- tasto modifica --}}
                                <div>
                                    <a class="btn btn-light " href="{{route('admin.apartments.edit' , ['apartment' => $apartment->slug  ])}}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                {{-- Sezione sponsorizzazione  --}}
                                <div>
                                    @if($sponsorship)
                                        <div class="alert alert-info">
                                            Questo appartamento è già sponsorizzato. Tipo di sponsorizzazione: {{ $sponsorship->title }}
                                        </div>
                                    @else
                                        <a href="{{ route('admin.apartments.showSponsorizeForm', ['slug' => $apartment->slug]) }}" class="btn btn-primary">Sponsorizza</a>
                                    @endif
                                </div>
                                {{-- tasto delete --}}
                                <div>
                                    <button class="erase-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $apartment->slug }}">
                                        <i class="fa-solid fa-eraser"></i>
                                    </button>
        
                                    <div class="modal fade" id="staticBackdrop-{{ $apartment->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        Eliminazione Appartamento
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuto di voler eliminare: <b> {{ $apartment->title }} </b> ?
                                                </div>
                                                <div class="modal-footer">
         
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
                                                    <form 
                                                    action="{{ route('admin.apartments.destroy', ['apartment' => $apartment]) }}" 
                                                    method="POST">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                        <button 
                                                        type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Elimina
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                                {{-- link view statistiche --}}
                                <div>
                                    <a href="{{ route('admin.apartments.statistics', $apartment->slug) }}">Visualizza statistiche appartamento</a>
                                </div>
                                <div>
                                    Tasto prova
                                    <a href="{{ route('admin.sponsor.show', $apartment->id) }}">Sponsorize this apartment</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection