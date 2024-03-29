@extends('layouts.app')

@section('page-title', 'Tutti i servizi')

@section('main-content')
    <section id="services-index" >

        <div class="mb-3">
            <h1>
                I servizi disponibili
            </h1>
        </div>

        <div class="d-flex flex-wrap justify-content-center">

            @foreach ($services as $singleService)
                <div class="single-service-card d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.services.show' , ['service' => $singleService->id]) }}" class="text-decoration-none">
                        <i class="{{$singleService->icon}} pe-2"></i> {{$singleService->title}}
                    </a>
                </div>
            @endforeach

        </div>

    </section>
@endsection
