@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <section id="apartments-show">
        {{-- @if ($apartment->cover_img != null)
            <div class="my-3">
                <img src="{{ asset('storage/'.$apartment->cover_img) }}" style="max-width: 400px;">
            </div>
        @endif --}}
        <div class="row g-0">
            <div class="col">
                <div class="my-card-show">
                    <img src="https://vmts.ch/wp-content/uploads/2020/08/modern-apartment-exterior-design-1-scaled.jpg" alt="{{$apartment->title}}">
                    <div class="my-card-show-body">

                        <div class="mt-3">
                            <h4>
                                {{ $apartment->city }}, {{ $apartment->address }}. {{$apartment->title}}
                            </h4>
                            <p>
                                {{ $apartment->n_rooms }} Stanze · {{ $apartment->n_beds }} Letti · {{ $apartment->n_baths }} Bagni · {{ $apartment->mq }} m2
                            </p>
                        </div>
                        <div id="services" class="d-flex flex-wrap">
                            @forelse ($apartment->services as $service)
                                <a href="{{ route('admin.services.show' , ['service' => $service->id]) }}" class="d-flex align-items-center">
                                    <i class="{{$service->icon}} pe-2"></i> {{$service->title}}
                                </a>
                            @empty
                                <h5>
                                    Nessun servizio incluso
                                </h5>
                            @endforelse
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection