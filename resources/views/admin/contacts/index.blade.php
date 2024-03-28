@extends('layouts.app')

@section('page-title', 'Messaggi ricevuti')

@section('main-content')
    <h1>
        Messaggi ricevuti
    </h1>

    <div class="row g-0">

        <form action="{{ route('admin.contacts.index') }}" method="GET">
            <div class="input-group my-3">
                <span class="input-group-text">Cerca per Nome</span>
                <input type="text" aria-label="First name" class="form-control" id="name" name="name" value="{{ request()->input('name') }}">
                <span class="input-group-text">Cerca per Mail</span>
                <input type="text" aria-label="Last name" class="form-control" id="email" name="email" value="{{ request()->input('email') }}">
                <button type="submit" class="btn btn-primary">
                    Cerca
                </button>    
            </div>
        </form>

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
