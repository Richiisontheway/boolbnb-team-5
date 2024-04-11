@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')

    <div class="row justify-content-center ">

        <div class="col-12 col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <h1 class="mb-4 col-12 col-lg-8 text-left">{{ $apartmentTitle }}</h1>
        <form id="payment-form" method="POST" action="{{ route('admin.sponsor.pay', $apartment_id) }}" class="col-12 col-lg-8">
            @csrf
            <label class="mb-2" for="sponsor">Scegli il piano di sponsorizzazione:</label>
            <select name="sponsor" id="sponsor" class="form-select w-25" aria-label="Default select example">
                @foreach($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->title }} - {{ $sponsor->price }}</option>
                @endforeach
            </select>
            <div id="dropin-container"></div>
            <input type="hidden" name="payment_method_nonce" id="payment-method-nonce" value="">
            <button class="btn pay_button_sponsor" id="pay-button" type="submit" style="
            background-color: #EA4C89;
            color: white;
            font-size: 1.2em;" >Paga</button>
        </form>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
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
