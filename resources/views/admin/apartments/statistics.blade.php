@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    
<div class="statistics">
    <h1 class=" bg-light mb-3 mt-3 ">
        {{ $apartment->title }}
    </h1>
        
    {{-- Tabella Message --}}
    <!-- Elenco delle messaggi -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="messages_container">
                @if ($messages->count() > 0)
                    <p>Messaggi ricevuti: 
                        <strong>{{ $messages->count() }}</strong>
                    </p>

                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Testo Messaggio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.contacts.show', ['contact' => $message->id]) }}" class="show-button align-self-baseline link_message">
                                            {{ $message->message }}</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.contacts.show', ['contact' => $message->id]) }}" class="show-button align-self-baseline">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>

                                </tr> 
                            @endforeach 
                        </tbody>
                    </table>
                @else 
                    <p>
                        Non hai ricevuto messaggi per questo appartamento.
                    </p>
                @endif
            </div>        
        </div>
        <div class="col-12 col-lg-4 mt-lg-0 mt-3 ">
            <div class="views_container">
                <p>Totale visitatori: 
                    <strong>{{ $views->count() }}</strong>
                </p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            {{-- <th scope="col">ip</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($views as $view)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $view->date }}</td>
                                {{-- <td>{{ $view->user_ip }}</td> --}}
                            </tr> 
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-8  ">
            <canvas id="myChart" class="w-100"></canvas>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const ctx = document.getElementById('myChart');

        // Estrai i dati dei contatti per il grafico
        const contacts = @json($messages);
        const dataContacts = new Array(12).fill(0); // Crea un array di lunghezza 12 inizializzato a 0 per memorizzare i conteggi per ogni mese

        // Estrai i dati delle visualizzazioni per il grafico
        const views = @json($views);
        const dataViews = new Array(12).fill(0); // Crea un array di lunghezza 12 inizializzato a 0 per memorizzare i conteggi per ogni mese

        // Cicla sui contatti e incrementa il conteggio per il mese corrispondente
        contacts.forEach(contact => {
            let date = contact.date;
            // Se la data di contatto è null, utilizza la data di creazione
            if (!date && contact.created_at) {
                date = contact.created_at;
            }
            if (date) {
                const month = new Date(date).getMonth(); // Ottieni il mese (da 0 a 11)
                dataContacts[month]++;
            }
        });

        // Cicla sulle visualizzazioni e incrementa il conteggio per il mese corrispondente
        views.forEach(view => {
            const month = new Date(view.date).getMonth(); // Ottieni il mese (da 0 a 11)
            dataViews[month]++;
        });
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                datasets: [ 
                {
                    label: 'Messages',
                    data: dataContacts,
                    borderWidth: 2.5,
                    tension: 0.5
                },
                {
                    label: 'Views',
                    data: dataViews,
                    borderWidth: 2.5,
                    tension: 0.5
                }]
            },
            options: {               
                scales: {
                    y: {
                        min: 0,
                        max: 12,
                    }
                }
            }
        });
    </script>
</div>


   
    
@endsection