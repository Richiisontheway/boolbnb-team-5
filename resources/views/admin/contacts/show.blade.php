@extends('layouts.app')

@section('page-title', $contact->name)

@section('main-content')
    <div class="row g-0">
        <div class="col d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-3">
                        {{ $contact->name }}
                    </h1>
                        
                    <h5 class="mb-3">
                        {{ $contact->email }}
                    </h5>

                    <p>
                        {{ $contact->message }}
                    </p>

                    <p>
                        Creato il: 
                        <span class="text-success">
                            {{ $contact->created_at->format('d/m/Y') }}
                        </span>
                        <br>
                        Alle: 
                        <span class="text-success">
                            {{ $contact->created_at->format('H:i')  }}
                        </span>
                    </p>


                    <div class="edit-buttons-container d-flex flex-column align-items-end">

                        {{-- Bottone di eliminazione che apre una modale --}}
                        <button class="erase-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $contact->id }}">
                            {{-- <i class="fa-solid fa-eraser"></i> --}}
                            ELIMINA
                        </button>

                        {{-- Modale per l'eliminazione del messaggio --}}
                        <div class="modal fade" id="staticBackdrop-{{ $contact->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                            Eliminazione Messaggio
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Sei sicuto di voler eliminare: <b> {{ $contact->name }} </b> ?
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        {{-- Creiamo il form per l'eliminazione che con l'action reindirizza alla rotta destroy del controller, 
                                        come argomento passo lo slug del singolo messaggio--}}
                                        <form 
                                        action="{{ route('admin.contacts.destroy', ['contact' => $contact->id]) }}" 
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
            </div>
        </div>
    </div>
@endsection