@extends('layouts.app')

@section('page-title', 'Tutti i messaggi')

@section('main-content')
    <h1>
        Tutti i messaggi
    </h1>
    
    <div class="row">
        @foreach ($contacts as $contact)
            <div class="d-flex justify-content-center col-12 col-xs-6 col-sm-4 col-md-3 mb-3">
                <div class="card m-1">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <h3 class="text-center">
                            {{ $contact->name }}
                        </h3>

                        <h5>
                            {{ $contact->email }}
                        </h5>

                        <p>
                            {{ $contact->message }}
                        </p>

                        <a href="{{ route('admin.contacts.show', ['contact' => $contact->id]) }}" class="show-button align-self-baseline">
                            Mostra
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
