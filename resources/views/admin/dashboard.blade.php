@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col">
            <div>
                ciao
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Ciao {{ $user->name }}, sei loggato!
                    </h1>
                    <h3 class="mt-4 fw-bold ">
                        Le tue credenziali:
                    </h3>
                    <div class="card-body">
                        <div>
                            <h5 class="pb-0 fw-bold">Nome:</h5>
                            <span>{{$user->name}}</span>
                        </div>
                        <div>
                            <h5 class="pb-0 fw-bold">Cognome:</h5>
                            <span>{{$user->lastname}}</span>
                        </div>
                        <div>
                            <h5 class="pb-0 fw-bold">Email:</h5>
                            <span>{{$user->email}}</span>
                        </div>
                        <div>
                            <h5 class="pb-0 fw-bold">Data di nascita:</h5>
                            <span>{{$user->birthday}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
