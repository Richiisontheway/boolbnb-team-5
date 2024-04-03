
{{-- questa view funziona ma non reindirizza dopo il pagamento --}}
@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')
    <h1>Sponsor Apartment</h1>
    <form method="POST" action="{{ route('admin.sponsor.pay', $apartment_id) }}">
        @csrf
        <label for="sponsor">Select Sponsorship:</label>
        <select name="sponsor" id="sponsor">
            @foreach($sponsors as $sponsor)
                <option value="{{ $sponsor->id }}">{{ $sponsor->title }} - {{ $sponsor->price }}</option>
            @endforeach
        </select>
        <div id="dropin-container"></div>
        <input type="hidden" name="payment_method_nonce" id="payment-method-nonce">
        <button type="submit">Pay</button>
    </form>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('form');
        var dropinInstance;
    
        braintree.dropin.create({
            authorization: "{{ $token }}",
            container: '#dropin-container'
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            dropinInstance = instance;
        });
    
        form.addEventListener('submit', function (event) {
            event.preventDefault();
    
            dropinInstance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }
    
                // Imposta il valore di payment_method_nonce con il nonce della carta di credito
                document.querySelector('#payment-method-nonce').value = payload.nonce;
    
                // Invia il form
                form.submit();
            });
        });
    </script>
    
@endsection
