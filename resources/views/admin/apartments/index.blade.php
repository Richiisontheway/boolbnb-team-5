@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')

    <section id="apartments">

        

        <div class="container">

            <h1 class="mt-4">
                Appartamenti di {{ $user->name }} {{ $user->lastname }}
            </h1> 
            
            <div class="row mt-3 justify-content-end">
                
                <div class="col-6 col-lg-3">
                    <div class="">
                        <input type="text" name="filter" id="filter" class="form-control" placeholder="cerca tra i tuoi appartamenti...">
                    </div>
                </div>

                <div class="col-6 col-lg-3 mt-lg-0  mt-2 ">
                    <div class="d-grid gap-2 col mx-auto">
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-outline-secondary border-0 w-100 add_button">Aggiungi un nuovo appartamento</a>
                    </div>
                </div>
                
            </div>

            <hr>
            <div class="row">
                @foreach ($apartments as $singleApartment)
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
                                    <div class="d-flex justify-content-center col-12 g-2 ">
                                        <div class="d-flex me-1 button_container">
                                            <a href="{{ route('admin.apartments.show' , ['apartment' => $singleApartment->slug]) }}">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex me-1 button_container">
                                            <a href="{{route('admin.apartments.edit' , ['apartment' => $singleApartment->slug  ])}}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                        {{-- Bottone di eliminazione che apre una modale --}}
                                        <div class="d-flex button_container" >
                                            <button class="erase-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $singleApartment->slug }}">
                                                <i class="fa-solid fa-eraser"></i>
                                            </button>
                                        </div>
                                        {{-- Modale per l'eliminazione dell'appartamento --}}
                                        <div class="modal fade" id="staticBackdrop-{{ $singleApartment->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                            Eliminazione Appartamento
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sei sicuto di voler eliminare: <b> {{ $singleApartment->title }} </b> ?
                                                    </div>
                                                    <div class="modal-footer">
            
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        
                                                        <form 
                                                        action="{{ route('admin.apartments.destroy', ['apartment' => $singleApartment]) }}" 
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        //assegno una variabile all elemento con id filter
        let input_filter = document.getElementById('filter');
        //evento che si scatena ad ogni input nel tag
        input_filter.addEventListener('input',function(){
            //faccio diventare tutta la value dell'input in minuscolo
            const filter = input_filter.value.toLowerCase();
            //prendo tutti gli elementi della classe my-cards
            let cards = document.querySelectorAll('.my-card');
            //ciclo nella variabile cards che ha restituito una NodeList
            cards.forEach(function(card){
                //il contenuto degli h3 li prendo in minuscolo
                let title = card.querySelector('h3').textContent.toLowerCase();
                //se la codizione viene rispettata aggiungo una classe se no ne aggiungo un altra
                if (title.includes(filter)) {
                    card.style.display = 'block';
                }
                else{
                    card.style.display = 'none';
                }
            });
        })

    </script>

@endsection
