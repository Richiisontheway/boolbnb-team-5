@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni disponibili')

@section('main-content')

<form id="payment-form" method="post" action="{{ route('admin.process-payment') }}">
    <div id="dropin-container"></div>
    <button type="submit">Paga adesso</button>
  </form>
  
  <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
  <script>
    var form = document.querySelector('#payment-form');
    var clientToken = "{{ $clientToken }}";
  
    braintree.dropin.create({
      authorization: clientToken,
      container: '#dropin-container'
    }, function (createErr, instance) {
      if (createErr) {
        console.error(createErr);
        return;
      }
  
      form.addEventListener('submit', function (event) {
        event.preventDefault();
  
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.error(err);
            return;
          }
  
          // Aggiungi il payload al modulo di pagamento e invialo al server
          document.querySelector('#payment-nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
  </script>
  
@endsection
