@extends('layouts.app')

@section('page-title', 'Invia Richiesta POST')

@section('main-content')
    <h1>Invia Richiesta POST</h1>
    <form action="{{ route('admin.process-payment') }}" method="post">
        @csrf <!-- Token CSRF per Laravel -->
        <label for="amount">Importo:</label>
        <input type="text" id="amount" name="amount" required><br><br>
        <!-- Aggiungi altri campi necessari per il pagamento -->
        <button type="submit">Invia Richiesta</button>
    </form>


@endsection


