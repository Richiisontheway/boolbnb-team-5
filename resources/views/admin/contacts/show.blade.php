@extends('layouts.app')

@section('page-title', $contact->name)

@section('main-content')
    <div class="row g-0 show_message_container mt-5">
        <div class="mb-3">
            Messaggio dell'appartamento:
            <strong>{{ $apartment->title }}</strong>
        </div>
        <div class="col d-flex justify-content-center">
            <div class="card w-100 ">
                <div class="card-body">
                    <h4 class="text-center mb-3">
                        {{ $contact->email }}
                    </h4>
                        
                    <div class="d-flex justify-content-between ">
                        <div class="mb-3">
                            Nome mittente: 
                            <strong>
                                {{ $contact->name }}
                            </strong>
                        </div>
                        <div>
                            <p>
                                Inviato il: 
                                <span class="text-primary">
                                    {{ $contact->created_at->format('d/m/Y') }}
                                </span>
                              
                                Alle: 
                                <span class="text-primary">
                                    {{ $contact->created_at->format('H:i')  }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="my-bg">
                        <p class="text_messages">
                            {{ $contact->message }}
                        </p>
                    </div>

                    
                    <div class="edit-buttons-container d-flex flex-column align-items-end mt-2 ">

                        <div class="w-100 d-flex justify-content-center ">
                            {{-- Bottone di eliminazione che apre una modale --}}
                            <button class="erase-button btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $contact->id }}">
                               
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>

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

                                        <form 
                                        action="{{ route('admin.contacts.destroy', ['contact' => $contact->id]) }}" 
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
        <div class="mt-3">
            <a href="{{ URL::previous() }}" class=" text-decoration-none ">
                <i class="fa-solid fa-arrow-left-long"></i>
                Torna ai messaggi
            </a>
        </div>
    </div>

    <div class="row">
        
    </div>
@endsection