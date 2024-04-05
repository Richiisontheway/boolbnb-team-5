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
                            <th scope="col"></th>
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
            </div>        
        </div>
        <div class="col-12 col-lg-4 mt-lg-0 mt-3 ">
            <div class="views_container">
                <p>Totale visitatori: 
                    <strong>{{ $views->count() }}</strong>
                </p>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">ip</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($views as $view)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $view->created_at }}</td>
                                <td>{{ $view->user_ip }}</td>
                            </tr> 
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    

</div>


   
    
@endsection