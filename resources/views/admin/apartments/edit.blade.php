@extends('layouts.app')

@section('page-title', 'Aggiungi un appartamento')

@section('main-content')
    <h1>
        Modifica l'appartamento {{$apartment->title}}
    </h1>
   
    <div class="mb-4">
        <a href="{{route('admin.apartments.index')}}" class="btn btn-primary">
            Torna alla lista dei tuoi appartamenti
        </a>
    </div>
    <div class="row">
        {{-- method POST perché la crud update lo richiede --}}
        <form action="{{route('admin.apartments.update' , ['apartment' => $apartment->slug])}}" method="POST" enctype="multipart/form-data">

            @method('PUT')
            @csrf

            <div class="col-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Nome dell'appartamento <span class="text-danger">*</span></label>
                    {{-- old('title funziona solo se il form è stato sottomesso ma sono spuntati errori o altro')
                        Se non c'è alcun valore precedentemente inserito, verrà utilizzato il valore di $apartment->title. --}}
                    <input type="text" value="{{ $apartment->title, old('title') }}" class="form-control" id="title" name="title" placeholder="nome appartamento" required>
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-8">
                <div class="mb-3">
                    <label for="n_rooms" class="form-label">N° stanze <span class="text-danger">*</span></label>
                    <input type="number" value="{{ $apartment->n_rooms, old('n_rooms') }}" class="form-control" id="n_rooms" name="n_rooms" placeholder="inserisci il numero di stanze"  required>
                    @error('n_rooms')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="n_beds" class="form-label">N° letti <span class="text-danger">*</span></label>
                    <input type="number" value="{{ $apartment->n_beds, old('n_beds') }}" class="form-control" id="n_beds" name="n_beds" placeholder="inserisci il numero di letti"  required>
                    @error('n_beds')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="n_baths" class="form-label">N° bagni <span class="text-danger">*</span></label>
                    <input type="number" value="{{ $apartment->n_baths, old('n_baths') }}" class="form-control" id="n_baths" name="n_baths" placeholder="inserisci il numero di bagni"  required>
                    @error('n_baths')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mq" class="form-label">Metri Quadri <span class="text-danger">*</span></label>
                    <input type="number" value="{{ $apartment->mq, old('mq') }}" class="form-control" id="mq" name="mq" placeholder="inserisci i metri quadri dell'immobile"  required>
                    @error('mq')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo a notte <span class="text-danger">*</span></label>
                    <input type="number" value="{{ $apartment->price, old('price') }}" class="form-control" id="price" name="price" placeholder="inserisci il prezzo" min="0" max="999.99" step="0.01" required>
                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo dell'appartamento<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $apartment->address, old('address') }}" class="form-control" id="address" name="address" placeholder="inserisci l'indirizzo"  required>
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <!-- Lista dei suggerimenti -->
                    <ul id="suggestion-list" class="list-group"></ul>
                </div>
                {{-- <div class="mb-3">
                    <label for="city" class="form-label">Città dell'appartamento<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $apartment->city, old('city') }}" class="form-control" id="city" name="city" placeholder="inserisci la città"  required>
                    @error('city')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Codice Postale (CAP)<span class="text-danger">*</span></label>
                    <input type="text" value="{{ $apartment->zip_code, old('zip_code') }}" class="form-control" id="zip_code" name="zip_code" placeholder="inserisci il Cap" min="5" max="5" required>
                    @error('zip_code')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <div class="col-12 d-flex justify-content-between">
                    <div class="mb-3">
                        <h4>
                            Cover attuale:
                        </h4>
                        <img style="width:100px" src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                        {{-- Creo una checkbox per chiedere se voglio eliminare la cover --}}
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" id="delete_cover_img" name="delete_cover_img">
                            <label class="form-check-label" for="delete_cover_img">
                                Rimuovi immagine
                            </label>
                        </div>
                        <label for="cover_img" class="form-label">Inserisci una nuova immagine dell'appartamento</label>
                        <input type="file" value="{{ $apartment->cover_img, old('cover_img') }}" class="form-control" id="cover_img" name="cover_img" placeholder="file immagine" accept="*">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Servizi dell'appartamento:</label>
                    @foreach ($services as $service)
                        <div class="form-check form-check-inline">
                            <input
                            @if ($errors->any())
                                {{-- Faccio le verifiche sull'old --}}
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                            @else
                                {{-- Faccio le verifiche sulla collezione --}}
                                {{ $apartment->services->contains($service->id) ? 'checked' : '' }}
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
                    <select name="visible" id="visible" value="{{old('visible', $apartment->visible)}}">
                        <option value="1">true</option>
                        <option value="0">false</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-warning">
                    Aggiorna
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
    </script>
    
@endsection