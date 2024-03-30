@extends('layouts.email-template');

@section('content')
    <h1>
        Ciao,
    </h1>

    <p>
        Hai ricevuto un nuovo messaggio.
    </p>

    <ul>
        <li>
            Nome: 
            <br>
            {{ $contact->name }}
        </li>

        <li>
            Email: 
            <br>
            {{ $contact->email }}
        </li>

        <li>
            {{-- New Line 2 br --}}
            Messaggio: 
            <br>
            {!! nl2br($contact->message) !!}
        </li>
    </ul>
@endsection