@extends('layouts.app')

@section('page-title', 'Aggiungi un appartamento')

@section('main-content')
    <h1>
        Nuovo Appartamento
    </h1>
    <a href="{{route('admin.apartments.index')}}" class="text-decoration-none text-dark">
        <i class="fa-solid fa-arrow-rotate-left"></i> 
        <span>
            Torna Indietro
        </span> 
    </a>
    {{-- gestione degli errori in base alla validazione delle formrequest --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        {{-- method POST perché la crud create lo richiede --}}
        <form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data" id="apt-form">
        
            @csrf
            <div class="row my-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="title" class="form-label">Nome dell'appartamento <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title" maxlength="255" placeholder="nome appartamento" required>
                            @error('title')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="address" class="form-label">Indirizzo completo<span class="text-danger">*</span></label>
                            <input type="text" value="{{old('address')}}" class="form-control" id="address" name="address" maxlength="255" placeholder="inserisci l'indirizzo"  required autocomplete="off">
                            @error('address')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!-- Lista dei suggerimenti -->
                            <ul id="suggestion-list" class="list-group">
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="n_rooms" class="form-label">Numero stanze da letto<span class="text-danger">*</span></label>
                            <input type="number" value="{{old('n_rooms', 1)}}" class="form-control" id="n_rooms" name="n_rooms" min="1" max="10" placeholder="inserisci il numero di camere"  required>
                            @error('n_rooms')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="n_beds" class="form-label">Numero letti <span class="text-danger">*</span></label>
                            <input type="number" value="{{old('n_beds', 1)}}" class="form-control" id="n_beds" name="n_beds" min="1" max="10" placeholder="inserisci il numero di letti"  required>
                            @error('n_beds')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="n_baths" class="form-label">Numero bagni <span class="text-danger">*</span></label>
                            <input type="number" value="{{old('n_baths', 1)}}" class="form-control" id="n_baths" name="n_baths" min="1" max="10" placeholder="inserisci il numero di bagni"  required>
                            @error('n_baths')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="mq" class="form-label">Numero mq <span class="text-danger">*</span></label>
                            <input type="number" value="{{old('mq')}}" class="form-control" id="mq" name="mq" min="1" max="1000" step="1" placeholder="inserisci i metri quadri dell'immobile"  required>
                            @error('mq')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="price" class="form-label">Prezzo a notte <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('price')}}" class="form-control" id="price" name="price" placeholder="inserisci il prezzo" min="1" max="999.99" step="0.01" required autocomplete="off">
                            @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <label for="cover_img" class="form-label">Immagine in evidenza<span class="text-danger">*</span></label>
                    <input type="file" value="{{old('cover_img')}}" class="form-control" id="cover_img" name="cover_img" placeholder="file immagine" accept="*" required>
                    @error('cover_img')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mt-2 d-flex justify-content-center">
                        <img class="d-none" id="previewImage" src="#" alt="preview" style="max-width:300px;">
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <div>
                        <label class="form-label">Seleziona i servizi per il tuo appartamento:</label>
                    </div>
                    @foreach ($services as $service)
                        <div class="col-3 form-check form-check-inline">
                            <input 
                            @if ($errors->any())
                                {{ old('services') !== null && in_array($service->id, old('services')) ? 'checked' : ''}}
                            @endif
                            type="checkbox" class="form-check-input"
                            id="service-{{$service->id}}"
                            name="services[]"
                            value="{{$service->id}}"
                            >
                            <label class="form-check-label" for="service-{{$service->id}}">
                                {{ $service->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-auto mb-3">
                    <div>
                        <label for="visible" class="form-label">L'appartmento è disponibile?<span class="text-danger">*</span></label>
                    </div>
                    <select name="visible" id="visible" value="{{old('visible')}}">
                        <option value="1">Visibile</option>
                        <option value="0">Non visibile</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success w-100">
                    Aggiungi
                </button>
            </div>
        </form>
    </div>


{{-- script --}}
<script>
    // Aggiungi gestione evento input per l'autocompletamento
    document.getElementById('address').addEventListener('input', function() {
        const input = this.value;
        const suggestionList = document.getElementById('suggestion-list');

        // Effettua una richiesta all'API di TomTom per ottenere i suggerimenti di completamento
        fetch(`https://api.tomtom.com/search/2/search/${input}.json?key=x5vTIPGVXKGawffLrAoysmnVC9V0S8cq`)
            .then(response => response.json())
            .then(data => {
                // Pulisci la lista dei suggerimenti
                suggestionList.innerHTML = '';

                // Aggiungi i suggerimenti alla lista
                data.results.forEach(result => {
                    const suggestion = document.createElement('li');
                    suggestion.textContent = result.address.freeformAddress;
                    // Aggiungi la classe list-group-item
                    suggestion.classList.add('list-group-item');
                    suggestionList.appendChild(suggestion);
                });
            })
            .catch(error => console.error('Si è verificato un errore:', error));
    });

    // Aggiungi gestione evento click per selezionare un suggerimento
    document.addEventListener('DOMContentLoaded', function() {
        const suggestionList = document.getElementById('suggestion-list');
        
        // Aggiungi gestione evento click per ogni suggerimento
        suggestionList.addEventListener('click', function(event) {
            // Verifica se l'elemento cliccato è un suggerimento
            if (event.target.tagName === 'LI') {
                // Ottieni il testo del suggerimento cliccato
                const selectedSuggestion = event.target.textContent;
                
                // Compila l'input dell'indirizzo con il suggerimento selezionato
                document.getElementById('address').value = selectedSuggestion;

                // Pulisci la lista dei suggerimenti
                suggestionList.innerHTML = '';
            }
        });
    });

    // Creo una flag per l'input dell'indirizzo
    let suggestionSelected = false;

    document.addEventListener('DOMContentLoaded', function() {
        const suggestionList = document.getElementById('suggestion-list');
        
        // Quando l'utente clicca su uno qualsiasi dei suggerimenti
        suggestionList.addEventListener('click', function(event) {
            // Verifica che l'indirizzo cliccato sia un suggerimento
            if (event.target.tagName === 'LI') {
                // Assegno ad una variabile il testo dell'elemento selezionato
                const selectedSuggestion = event.target.textContent;
                
                // Compilo l'input dell'indirizzo con il suggerimento selezionato
                document.getElementById('address').value = selectedSuggestion;

                // Imposta la flag a true
                suggestionSelected = true;

                // Pulisco la lista dei suggerimenti
                suggestionList.innerHTML = '';
            }
        });
    });

    // Quando l'utente sottomette il form
    document.getElementById('apt-form').addEventListener('submit', function(event) {
        // Se la flag è ancora false
        if (!suggestionSelected) {
            // Un alert lo avvisa che è costretto a scegliere dalla lista degli indirizzi suggeriti
            event.preventDefault();
            alert('Devi selezionare un indirizzo dalla lista di suggerimenti.');
        }
    });

    // Se l'utente avesse scelto un indirizzo dalla lista dei suggerimenti e poi dovesse
    // cliccare nuovamente sull'input per inserire nuovamente l'indirizzo 
    document.getElementById('address').addEventListener('focus', function() {
        // Allora la flag viene reimpostata a false ed è costretto nuovamente a scegliere
        // un indirizzo dalla lista dei suggerimenti
        suggestionSelected = false;
    });

    // Anteprima immagine
    document.getElementById('cover_img').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('previewImage');
        const reader = new FileReader();

        reader.onload = function(event) {
            previewImage.src = event.target.result;
            previewImage.classList.remove('d-none');
        };

        reader.readAsDataURL(file);
    });

</script>

@endsection