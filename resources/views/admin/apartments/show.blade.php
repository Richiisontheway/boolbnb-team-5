@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    
    <div id="apartments-show" class="container mt-5">
        <div class="row g-0">
            <div class="col-12 my_card_show">
                <div class="row">
                    <div class="img_container col-12 col-lg-8">
                        <img src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                    </div>
                    <div class="my_card_show_body col-12">
                        <div class="row">
                            <div class="col-12 my-3 text-warning">
                                @if ($apartment->visible == 0)
                                    Attualmente hai scelto di impostare il tuo appartamento come non disponibile
                                @endif
                            </div>
                            <div class="col-lg-8 col-12 main-info">
                                <h4>
                                    {{$apartment->title}} 
                                </h4>
                                <div class="color-1 fw-normal">
                                    {{ $apartment->address }}
                                </div>
                                <div class="my-2 fw-bolder">
                                    {{ $apartment->n_rooms }} Stanze · {{ $apartment->n_beds }}<abbr title="letti"><i class="fa-solid fa-bed px-1"></i></abbr> · {{ $apartment->n_baths }} <abbr title="bagno"><i class="fa-solid fa-bath px-1 "></i></abbr> · {{ $apartment->mq }} m²
                                </div>
                                <hr>
                            </div>
                            {{-- link view statistiche --}}
                            <div class="col-12 my-2">
                                <h5 class="mb-2">
                                    Cosa Troverai
                                </h5>
                                <div class="col-lg-8 col-12 my-2 service-info" id="services">
                                    @forelse ($apartment->services as $service)
                                        <i class="{{$service->icon}} ms-2"></i> <span class="fw-normal"> {{$service->title}} </span>
                                    @empty
                                        <h5>
                                            Nessun servizio incluso
                                        </h5>
                                    @endforelse
                                    <hr>
                                </div>
                                {{-- Sezione sponsorizzazione  --}}
                                <div class="col-12 mt-3" id="sponsors">
                                    @if($latestSponsorship)
                                    <div class="col-auto mb-3 sponsors-info fw-normal">
                                        Questo appartamento è già sponsorizzato: <span class="fw-normal"> {{ $sponsorTitle }} </span> . Fine sponsorizzazione: <span class="fw-normal"> {{ $formattedDate }} </span> 
                                    </div>
                                    @else
                                    <div class="col-auto mb-3 fw-normal">
                                        Massimizza le possibilità di affitto e
                                        <a href="{{ route('admin.sponsor.show', $apartment->id) }}" class="text-decoration-none">SPONSORIZZA</a>
                                        questo appartamento
                                    </div>
                                    @endif
                                </div>
                                <div class="col-12 d-flex">
                                    {{-- tasto modifica --}}
                                    <div>
                                        <a class="btn  button text-white" href="{{route('admin.apartments.edit' , ['apartment' => $apartment->slug  ])}}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                    </div>
                                    {{-- tasto delete --}}
                                    <div class="ms-3 me-3 mb-3 ">
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
                                                        Sei sicuro di voler eliminare: <b> {{ $apartment->title }} </b> ?
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
                                        <a href="{{ route('admin.apartments.statistics', $apartment->slug) }}" class="btn button text-white">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection