@extends('layouts.app')

@section('page-title', 'Tutti i servizi')

@section('main-content')
    <h1>
        ciao sono l'index
    </h1>
    @foreach ($services as $singleService)
        <tr>
            <th scope="row">{{$singleService->id}}</th>
            <br>
            <td>{{$singleService->title}}</td>
            <span>
                <i class="{{ $singleService->icon }}"></i>
            </span>

            {{-- <td>
                <a href="{{ route('admin.apartments.show' , ['apartment' => $item->slug]) }}" class="btn btn-primary">
                    Show
                </a>
            <br>

                <a href="{{route('admin.apartments.edit' , ['apartment' => $item->slug  ])}}" class="btn btn-warning">
                    Edit
                </a>
            <br>

                <a href="" class="btn btn-danger">
                    Delete
                </a>
            <br> --}}

            </td>
        </tr>
    @endforeach
@endsection
