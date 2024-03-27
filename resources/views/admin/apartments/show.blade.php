@extends('layouts.app')

@section('page-title', 'Singolo appartamento - Show')

@section('main-content')
    <h1>
        ciao sono lo show
    </h1>
    @if ($apartment->cover_img != null)
        <div class="my-3">
            <img src="{{ asset('storage/'.$apartment->cover_img) }}" style="max-width: 400px;">
        </div>
    @endif
@endsection