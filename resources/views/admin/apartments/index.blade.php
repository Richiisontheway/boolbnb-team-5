@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')
    <h1>
        ciao sono l'index
    </h1>
    @foreach ($apartment as $item)
        
            <div>
                {{$item->id}}
            </div>
            <span>
                {{$item->title}}
            </span>
            <div>
                {{$item->date}}
            </div>  

            <div style="color: white">
                @forelse ($item->services as $singleservice)
                    <i class="{{$singleservice->icon}}"></i>
                    <a href="{{route('admin.services.show', ['service' => $singleservice->id])}}">
                        {{$singleservice->title}} -      
                    </a>   
                @empty    
                    -
                @endforelse
            </div>
            <div>
                <a href="{{ route('admin.apartments.show' , ['apartment' => $item->slug]) }}" class="btn btn-primary">
                    Show
                </a>
                <a href="{{route('admin.apartments.edit' , ['apartment' => $item->slug  ])}}" class="btn btn-warning">
                    Edit
                </a>
                <a href="" class="btn btn-danger">
                    Delete
                </a>       
            </div>      
        
    @endforeach
@endsection
