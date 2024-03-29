@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')

    <section id="apartments">

        <div id="add">
            <a href="{{ route('admin.apartments.create') }}" class="add-button mb-5">
                <span>Aggiungi</span>
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div class="container">

            <h1>
                Gli appartamenti di {{ $user->name }}
            </h1>    

            <div class="row g-0">

                @foreach ($apartments as $singleApartment)
                    <div class="my-card">
                        @if ($singleApartment->cover_img != null)
                            <img src="{{ $singleApartment->full_cover_img }}" alt="{{$singleApartment->title}}">
                        @endif
                        <h3>
                            {{$singleApartment->title}}
                        </h3>
                        <p>
                            {{ $singleApartment->city }}
                            <br>
                            {{ $singleApartment->address }}
                        </p>
                        {{-- <div>
                            @forelse ($singleApartment->services as $singleservice)
                                <i class="{{$singleservice->icon}}"></i>
                                <a href="{{route('admin.services.show', ['service' => $singleservice->id])}}">
                                    {{$singleservice->title}} -      
                                </a>   
                            @empty    
                                -
                            @endforelse
                        </div> --}}

                        <div class="d-flex">
                            <a href="{{ route('admin.apartments.show' , ['apartment' => $singleApartment->slug]) }}">
                                Info
                            </a>
                            <a href="{{route('admin.apartments.edit' , ['apartment' => $singleApartment->slug  ])}}" class="btn btn-warning">
                                Edit
                            </a>
                            <form 
                            onsubmit="return confirm('Sei sicuro di voler eliminare questo appartamento?')"
                            action="{{route('admin.apartments.destroy', ['apartment' => $singleApartment])}}" 
                            method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    Elimina
                                </button>
                            </form>
                        </div>      
                    </div>
                @endforeach

            </div>

        </div>
        
    </section>

@endsection
