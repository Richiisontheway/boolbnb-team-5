@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <section id="apartments-show">
      
        <div class="row g-0">
            
                <div class="my_card_show col-12 ">
                    <div class="img_container col-lg-6 col-md-12">
                         <h4>
                                {{$apartment->title}} 
                        </h4>
                        <img src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                    </div>
                    
                    <div class="my_card_show_body col-6 col-md-12">

                        <div class="mt-3">
                            <h4>
                                 {{ $apartment->address }}
                            </h4>
                            <p>
                                {{ $apartment->n_rooms }} Stanze · {{ $apartment->n_beds }} Letti · {{ $apartment->n_baths }} Bagni · {{ $apartment->mq }} m²
                            </p>
                        </div>
                        <hr>
                        {{-- link view statistiche --}}
                        <div>
                            <div>
                                <h5>Cosa Troverai</h5>
                                <div id="services" class="d-flex flex-wrap  ">
                                    
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
                            <hr>
                            <div>
                                {{-- Sezione sponsorizzazione  --}}
                                <div>
                                    @if($sponsorship)
                                    <div class="alert alert-info">
                                        Questo appartamento è già sponsorizzato. Tipo di sponsorizzazione: {{ $sponsorship->title }}
                                    </div>
                                    @else
                                    <a href="{{ route('admin.sponsor.show', $apartment->id) }}">Sponsorize this apartment</a>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    {{-- tasto modifica --}}
                                <div>
                                    <a class="btn  button" href="{{route('admin.apartments.edit' , ['apartment' => $apartment->slug  ])}}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                {{-- tasto delete --}}
                                <div class="ms-3 me-3 ">
                                    <button class="btn button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $apartment->slug }}">
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
                                    <div>
                                        <a href="{{ route('admin.apartments.statistics', $apartment->slug) }}" class="btn button">
                                            <i class="fa-solid fa-chart-column"></i>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            
        </div>
    </section>

@endsection