@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <h1>Statistiche dell'appartamento: {{ $apartment->title }}</h1>

    
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
    @endforeach
@endsection