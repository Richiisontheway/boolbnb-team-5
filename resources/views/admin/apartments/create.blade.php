@extends('layouts.app')

@section('page-title', 'Aggiungi un appartamento')

@section('main-content')
    <h1>
        Aggiungi un appartamento
    </h1>
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
            <div class="col-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Nome dell'appartamento <span class="text-danger">*</span></label>
                    <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title" maxlength="255" placeholder="nome appartamento" required>
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="n_rooms" class="form-label">N° stanze <span class="text-danger">*</span></label>
                <input type="number" value="{{old('n_rooms', 1)}}" class="form-control" id="n_rooms" name="n_rooms" min="1" max="10" placeholder="inserisci il numero di camere"  required>
                @error('n_rooms')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="n_beds" class="form-label">N° letti <span class="text-danger">*</span></label>
                <input type="number" value="{{old('n_beds', 1)}}" class="form-control" id="n_beds" name="n_beds" min="1" max="10" placeholder="inserisci il numero di letti"  required>
                @error('n_beds')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="n_baths" class="form-label">N° bagni <span class="text-danger">*</span></label>
                <input type="number" value="{{old('n_baths', 1)}}" class="form-control" id="n_baths" name="n_baths" min="1" max="10" placeholder="inserisci il numero di bagni"  required>
                @error('n_baths')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mq" class="form-label">Metri Quadri <span class="text-danger">*</span></label>
                <input type="number" value="{{old('mq')}}" class="form-control" id="mq" name="mq" min="1" max="1000" step="1" placeholder="inserisci i metri quadri dell'immobile"  required>
                @error('mq')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo a notte <span class="text-danger">*</span></label>
                <input type="text" value="{{old('price')}}" class="form-control" id="price" name="price" placeholder="inserisci il prezzo" min="1" max="999.99" step="0.01" required autocomplete="off">
                @error('price')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo dell'immobile<span class="text-danger">*</span></label>
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
            
            {{-- <div class="mb-3">
                <label for="city" class="form-label">Città dell'immobile<span class="text-danger">*</span></label>
                <input type="text" value="{{old('city')}}" class="form-control" id="city" name="city" placeholder="inserisci la città"  required>
                @error('city')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Codice Postale(CAP)<span class="text-danger">*</span></label>
                <input type="number" value="{{old('zip_code')}}" class="form-control" id="zip_code" name="zip_code" placeholder="inserisci l'indirizzo"  required>
                @error('zip_code')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="cover_img" class="form-label">cover_img<span class="text-danger">*</span></label>
                <input type="file" value="{{old('cover_img')}}" class="form-control" id="cover_img" name="cover_img" placeholder="file immagine" accept="*" required>
                @error('cover_img')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Servizi dell'appartamento:</label>
                @foreach ($services as $service)
                    <div class="form-check form-check-inline">
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
            <div class="mb-3">
                <label for="visible" class="form-label">Visibilità<span class="text-danger">*</span></label>
                <select name="visible" id="visible" value="{{old('visible')}}">
                    <option value="1">true</option>
                    <option value="0">false</option>
                </select>
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

    // Funzione per la validazione del modulo prima della sottomissione
    document.getElementById('apt-form').addEventListener('submit', function(event) {
        // Ottieni il valore dell'input dell'indirizzo
        let addressInput = document.getElementById('address');
        let addressValue = addressInput.value;

        // Ottieni la lista dei suggerimenti
        let suggestionList = document.getElementById('suggestion-list');
        let suggestions = suggestionList.getElementsByTagName('li');

        let addressSelected = false;

        // Verifica se l'indirizzo è stato selezionato dalla lista dei suggerimenti
        for (let i = 0; i < suggestions.length; i++) {
            if (suggestions[i].innerText === addressValue) {
                addressSelected = true;
                break;
            }
        }

        // Se l'indirizzo non è stato selezionato, impedisce la sottomissione del modulo e mostra un messaggio di errore
        if (!addressSelected) {
            event.preventDefault(); 
            alert('Seleziona un indirizzo dalla lista dei suggerimenti.');
        }
    });

</script>

@endsection