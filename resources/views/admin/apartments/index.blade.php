@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')

    <section id="apartments">

        <div class="container">

            <h1>
                Gli appartamenti di {{ $user->name }}
            </h1>    

            <div class="row g-0">

                @foreach ($apartments as $singleApartment)
                    <div class="my-card">
                        <img src="https://vmts.ch/wp-content/uploads/2020/08/modern-apartment-exterior-design-1-scaled.jpg" alt="{{$singleApartment->title}}">
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

                        <div>
                            <a href="{{ route('admin.apartments.show' , ['apartment' => $singleApartment->slug]) }}">
                                Info
                            </a>
                            {{-- <a href="{{route('admin.apartments.edit' , ['apartment' => $singleApartment->slug  ])}}" class="btn btn-warning">
                                Edit
                            </a>
                            <a href="" class="btn btn-danger">
                                Delete
                            </a>        --}}
                        </div>      
                    </div>
                @endforeach

            </div>

        </div>
        
    </section>

@endsection
