@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <h1>
       Le nostre sponsorizzazioni
    </h1>

      <div class="container">
        <div class="row">
            @foreach ($sponsors as $sponsor)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h3>    
                                {{ $sponsor->title }}
                            </h3>
                            <div class="card-text">
                                <ul>
                                    <li>
                                        Durata: {{ $sponsor->time }} h
                                    </li>
                                    <li>
                                        Prezzo: {{ $sponsor->price }} €
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      </div>

@endsection
