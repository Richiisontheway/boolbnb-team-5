@extends('layouts.app')

@section('page-title', 'Tutti gli appartamenti')

@section('main-content')
    <h1>
        ciao sono l'index
    </h1>
    @foreach ($apartment as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <br>
            <td>{{$item->title}}</td>
            <br>
            <td>{{$item->date}}</td>
            <br>

            <td>
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
            <br>

            </td>
        </tr>
    @endforeach
@endsection
