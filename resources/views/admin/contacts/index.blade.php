@extends('layouts.app')

@section('page-title', 'Messaggi ricevuti')

@section('main-content')
    <h1>
        Messaggi ricevuti
    </h1>

    <div class="row g-0">

        <div class="input-group my-3">
            <span class="input-group-text">Cerca per Nome</span>
            <input type="text" aria-label="First name" class="form-control" id="name" name="name" value="{{ request()->input('name') }}" autocomplete="off">
            
            <span class="input-group-text">Cerca per Mail</span>
            <input type="text" aria-label="Last name" class="form-control" id="email" name="email" value="{{ request()->input('email') }}" autocomplete="off">
                
        </div>
       
        @foreach ($contacts as $contact)
           
                <div class="card m-1 col-3 flex-wrap ">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <h3 class="text-center">
                            {{ $contact->name }}
                        </h3>

                        <h5>
                            {{ $contact->email }}
                        </h5>

                        <p>
                            {{ $contact->message }}
                        </p>

                        <a href="{{ route('admin.contacts.show', ['contact' => $contact->id]) }}" class="show-button align-self-baseline">
                            Mostra
                        </a>
                    </div>
                </div>
           
        @endforeach
    </div>

@endsection
<script>
    //fa l evento sul caricamento del dom
   document.addEventListener('DOMContentLoaded', function() {
    let name_filter = document.getElementById('name');
    let email_filter = document.getElementById('email');

    name_filter.addEventListener('input', function() {
        filterContacts(name_filter.value.toLowerCase(), email_filter.value.toLowerCase());
    });

    email_filter.addEventListener('input', function() {
        filterContacts(name_filter.value.toLowerCase(), email_filter.value.toLowerCase());
    });

    function filterContacts(nameFilter, emailFilter) {
        let cards = document.querySelectorAll('.card');

        cards.forEach(function(card) {
            let name = card.querySelector('h3').textContent.toLowerCase();
            let email = card.querySelector('h5').textContent.toLowerCase();

            let nameMatch = name.includes(nameFilter);
            let emailMatch = email.includes(emailFilter);

            if (nameMatch && emailMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
});


</script>
