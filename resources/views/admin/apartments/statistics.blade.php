@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    
    <h1 class=" bg-light">
        {{ $apartment->title }}
    </h1>

    
    <p>Numero totale di visualizzazioni: {{ $views->count() }}</p>

    <!-- Elenco delle visualizzazioni -->
    @foreach($views as $view)
        <ul>
                <li>
                    IP: {{ $view->user_ip }}
                </li>
                <li>
                    Data visualizzazione: {{ $view->created_at }}
                </li>
        </ul>
        <hr>
    @endforeach
    <hr>
     <!-- Elenco dei messaggi -->
    <h2>Messaggi</h2>
    <ul>
        @foreach($messages as $message)
            <li>
                <strong>Nome:</strong> {{ $message->name }} <br>
                <strong>Email:</strong> {{ $message->email }} <br>
                <strong>Messaggio:</strong> {{ $message->message }}
            </li>
            <hr>
        @endforeach
    </ul>

@endsection