@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')

    <section id="apartments">

        <div id="add" class="container-fluid">
            <a href="{{ route('admin.apartments.create') }}" class="add-button mb-5">
                <span>Aggiungi</span>
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div class="container">

            <h1>
                Gli appartamenti di {{ $user->name }}
            </h1>    

            <div class="row g-0">

                @foreach ($apartments as $singleApartment)
                
                    <div class="my-card">
                        @if ($singleApartment->cover_img != null)
                            <img src="{{ $singleApartment->full_cover_img }}" alt="{{$singleApartment->title}}">
                        @endif
                        <h3>
                            {{$singleApartment->title}}
                        </h3>
                        <p>
                            {{ $singleApartment->city }}
                            <br>
                            {{ $singleApartment->address }}
                        </p>

                        <div class="d-flex justify-content-around">
                            <a href="{{ route('admin.apartments.show' , ['apartment' => $singleApartment->slug]) }}">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            <a href="{{route('admin.apartments.edit' , ['apartment' => $singleApartment->slug  ])}}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>

                            {{-- Bottone di eliminazione che apre una modale --}}
                            <button class="erase-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $singleApartment->slug }}">
                                <i class="fa-solid fa-eraser"></i>
                            </button>

                            {{-- Modale per l'eliminazione dell'appartamento --}}
                            <div class="modal fade" id="staticBackdrop-{{ $singleApartment->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                Eliminazione Appartamento
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuto di voler eliminare: <b> {{ $singleApartment->title }} </b> ?
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            {{-- Creiamo il form per l'eliminazione che con l'action reindirizza alla rotta destroy del controller, 
                                            come argomento passo lo slug del singolo appartamento--}}
                                            <form 
                                            action="{{ route('admin.apartments.destroy', ['apartment' => $singleApartment->slug]) }}" 
                                            method="POST">
                                            {{-- 
                                                Cross
                                                Site
                                                Request
                                                Forgery
                                                Genera un input nascosto con un token all'interno per verificare che tutte le richieste
                                                del front-end provengano dal sito stesso e si usa per le richieste in POST
                                            --}}
                                            @csrf
                                            {{-- Richiamo il metodo DELETE che non può essere inserito nel FORM --}}
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
                    </div>
                @endforeach

            </div>

        </div>
        
    </section>

@endsection
