@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <h1>
        ciao sono lo show
    </h1>
    {{-- @if ($apartment->cover_img != null)
        <div class="my-3">
            <img src="{{ asset('storage/'.$apartment->cover_img) }}" style="max-width: 400px;">
        </div>
    @endif --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{$apartment->title}}
                    </h1>
                    <br>
                </div>
                <div>
                    <h2>
                        Services: 
                    </h2>
                    @forelse ($apartment->services as $service)
                        <a href="{{ route('admin.services.show' , ['service' => $service->id]) }}" class="btn btn-primary">
                            {{$service->title}}
                        </a>
                    @empty
                        <h5>
                            None
                        </h5>
                    @endforelse
                </div>
                <ul>
                    <li>
                        N° stanze {{$apartment->n_rooms}}
                    </li>
                    <li>
                        N° letti {{$apartment->n_beds}}
                    </li>
                    <li>
                        N° bagni {{$apartment->n_baths}}
                    </li>
                    <li>
                        Mq {{$apartment->mq}}
                    </li>
                    <li>
                        prezzo {{$apartment->price}}
                    </li>
                    <li>
                        Indirizzo {{$apartment->address}}, {{$apartment->zip_code}}, {{$apartment->city}}
                    </li>
                    <li>
                        @if ($apartment->visible)
                            visibile   
                        @else
                            non visibile
                        @endif

                    </li>
                </ul>
                <div>
                    <img src="{{$apartment->image}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection