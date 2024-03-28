@extends('layouts.app')

@section('page-title', 'Aggiungi un appartamento')

@section('main-content')
    <h1>
        Modifica l'appartamento {{$apartment->title}}
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
                    <input type="text" value="{{old('title', $apartment->title)}}" class="form-control" id="title" name="title" placeholder="nome appartamento" required>
                </div>
            </div>
            <div class="col-8">
                <div class="mb-3">
                    <label for="n_rooms" class="form-label">N° stanze <span class="text-danger">*</span></label>
                    <input type="number" value="{{old('n_rooms', $apartment->n_rooms)}}" class="form-control" id="n_rooms" name="n_rooms" placeholder="inserisci il numero di stanze"  required>
                </div>
                <div class="mb-3">
                    <label for="n_beds" class="form-label">N° letti <span class="text-danger">*</span></label>
                    <input type="number" value="{{old('n_beds', $apartment->n_beds)}}" class="form-control" id="n_beds" name="n_beds" placeholder="inserisci il numero di letti"  required>
                </div>
                <div class="mb-3">
                    <label for="n_baths" class="form-label">N° bagni <span class="text-danger">*</span></label>
                    <input type="number" value="{{old('n_baths', $apartment->n_baths)}}" class="form-control" id="n_baths" name="n_baths" placeholder="inserisci il numero di bagni"  required>
                </div>
                <div class="mb-3">
                    <label for="mq" class="form-label">Metri Quadri <span class="text-danger">*</span></label>
                    <input type="number" value="{{old('mq', $apartment->mq)}}" class="form-control" id="mq" name="mq" placeholder="inserisci i metri quadri dell'immobile"  required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo a notte <span class="text-danger">*</span></label>
                    <input type="number" value="{{old('price', $apartment->price)}}" class="form-control" id="price" name="price" placeholder="inserisci il prezzo" min="0" max="999.99" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo dell'immobile<span class="text-danger">*</span></label>
                    <input type="text" value="{{old('address', $apartment->address)}}" class="form-control" id="address" name="address" placeholder="inserisci l'indirizzo"  required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Città dell'immobile<span class="text-danger">*</span></label>
                    <input type="text" value="{{old('city', $apartment->city)}}" class="form-control" id="city" name="city" placeholder="inserisci la città"  required>
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Codice Postale (CAP)<span class="text-danger">*</span></label>
                    <input type="text" value="{{old('zip_code',$apartment->zip_code)}}" class="form-control" id="zip_code" name="zip_code" placeholder="inserisci il Cap" min="5" max="5" required>
                </div>
                {{-- <div class="mb-3">
                    <label for="lat" class="form-label">Latitudine<span class="text-danger">*</span></label>
                    <input type="number" value="{{old('lat')}}" class="form-control" id="lat" name="lat" placeholder="inserisci latitudine" step="0.0001" required>
                </div>
                <div class="mb-3">
                    <label for="lon" class="form-label">Longitudine<span class="text-danger">*</span></label>
                    <input type="number" value="{{old('lon')}}" class="form-control" id="lon" name="lon" placeholder="inserisci longitudine" step="0.0001" required>
                </div> --}}
                <div class="col-12 d-flex justify-content-between">
                    <div class="mb-3">
                        <img src="{{ $apartment->full_cover_img }}" alt="{{$apartment->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="cover_img" class="form-label">cover_img<span class="text-danger">*</span></label>
                        <input type="file" value="{{old('cover_img', $apartment->cover_img)}}" class="form-control" id="cover_img" name="cover_img" placeholder="file immagine" accept="*">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Servizi dell'appartamento:</label>
                    @foreach ($services as $service)
                        <div class="form-check form-check-inline">
                            <input
                            @if ($errors->any())
                                {{-- verifiche sull'old --}}
                                {{in_array($service->id, old('services', [])) ? 'checked' : ''}}
                            @else
                                {{$apartment->services->contains($service->id) ? 'checked' : ''}}
                            @endif 
                            {{-- {{ old('services') !== null && in_array($service->id, old('services')) ? 'checked' : ''}} --}}
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
                <button type="submit" class="btn btn-success w-100">
                    + Aggiungi
                </button>
            </div>
        </form>
    </div>
@endsection