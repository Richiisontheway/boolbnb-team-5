@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')

    <div class="row mt-3 h-100">

        <div class="h-100 col-8 payment">
            <div class="row g-0">
                <div class="col-12 col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="col-12">
                    <div class="row g-0">
                        <h1 class="mb-4 col-12 col-lg-8 text-left">{{ $apartmentTitle }}</h1>
                    </div>
                    <div class="row g-0">
                        <div class="col-12">
                            <form id="payment-form" method="POST" action="{{ route('admin.sponsor.pay', $apartment_id) }}" class="col-12 col-lg-8">
                                @csrf
                                <label class="mb-2" for="sponsor">Scegli il piano di sponsorizzazione:</label>
                                <select name="sponsor" id="sponsor" class="form-select w-50" aria-label="Default select example">
                                    <option value="/" disabled selected>Scegli un piano</option>
                                    @foreach($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}">{{ $sponsor->title }} - {{ $sponsor->price }} €</option>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4 h-100 sponsorship">
            <div class="row h-100 g-0">
                <div class="col-12 mx-auto">
                    <div class="row g-0 h-100 flex-column justify-content-around">
                        <div class="col-12 d-lg-flex">
                            <div class="my-card p-2 mb-3 w-100 silver">
                                <div class="row g-0 flex-column">
                                    <div class="col-12 text-center">
                                        <h4 class="mt-1">
                                            SILVER
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="my-ul">
                                            <h6 class="text-center">
                                                2,99 € / 24h
                                            </h6>
                                            <ul class="fa-ul d-flex flex-column flex-grow-1 justify-content-around">
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Prima pagina per 24 ore  
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Massima visibilità              
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Promozione rapida efficace
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-lg-flex">
                            <div class="my-card p-2 my-3 gold w-100">
                                <div class="row g-0 flex-column justify-content-around">
                                    <div class="col-12 text-center">
                                        <h4 class="mt-1">
                                            GOLD
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="my-ul">

                                            <h6 class="text-center">
                                                5,99 € / 72h
                                            </h6>
                                            <ul class="fa-ul d-flex flex-column flex-grow g-0-1 justify-content-around">
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Homepage e ricerca per 3 giorni
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Più prenotazioni garantite   
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Ottimo rapporto qualità-prezzo
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-lg-flex ">
                            <div class="my-card p-2 my-3 platinum w-100">
                                <div class="row g-0 flex-column h-100 justify-content-around">
                                    <div class="col-12 text-center">
                                        <h4 class="mt-1">
                                            PLATINUM
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="my-ul">

                                            <h6 class="text-center">
                                                9,99 € / 144h
                                            </h6>
                                            <ul class="fa-ul d-flex flex-column flex-grow-1 justify-content-around">
                                                <li> 
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Visibilità massima per 6 giorni         
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Vantaggio competitivo prolungato
                                                </li>
                                                <li>
                                                    <span class="fa-li"><i class="fa-solid fa-check"></i></span>
                                                    Massimizza le prenotazioni
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

                // Chiama la funzione per visualizzare il messaggio di conferma
                showConfirmationMessage('Sponsorizzazione aggiunta con successo.');

                // Invia il form
                form.submit();
            });
        });

        function showConfirmationMessage(message) {
            Swal.fire({
                icon: 'success',
                title: 'Payment successful',
                text: message,
                showConfirmButton: false,
                timer: 3000 // Mostra il messaggio per 3 secondi
            });
        }
    </script>
    
@endsection
