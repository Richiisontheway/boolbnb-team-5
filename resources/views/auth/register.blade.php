@extends('layouts.guest')

@section('main-content')
    <div id="register" class="row">
        <div class="form_container col-sm-7 col-md-7 col-lg-7">
            <h1 class="text-center mt-4">
                Form di registrazione
            </h1>
            <form method="POST" action="{{ route('register') }}" onsubmit="return checkPassword()">
                @csrf
                <div class="d-lg-flex justify-content-between">
                    <!-- Name -->
                    <div class="col-10 col-lg-5 ms-3 mt-3">
                        <label for="name">
                            Name
                        </label>
                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="nome">
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- lastaname -->
                    <div class="col-10 col-lg-5 me-lg-3 ms-3 ms-lg-0 mt-3">
                        <label for="lastname">
                            Lastname
                        </label>
                        <input type="text" id="lastname" name="lastname" value="{{old('lastname')}}" class="form-control" placeholder="cognome" >
                        @error('lastname')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 
                </div>

                <div class="d-lg-flex justify-content-between ">
                    <div class="col-10 col-lg-5 ms-3 mt-3">
                        <label for="birthday">
                            Data di Nascita:
                        </label>
                        <input  type="date" id="birthday" name="birthday" value="{{ old('birthday')}}" class="form-control">
                        @error('birthday')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="col-10 col-lg-5 me-lg-3 ms-3 ms-lg-0 mt-3">
                        <label for="email">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="example@gmail.com">
                        @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="d-lg-flex justify-content-between ">
                    <!-- Password -->
                    <div class="col-10 col-lg-5 ms-3 mt-3">
                        <label for="password">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control" >
                        <div id="confirm_password_error" style="color: red;"></div>
                        @error('password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-10 col-lg-5 me-lg-3 ms-3 ms-lg-0 mt-3">
                        <label for="password_confirmation">
                            Conferma Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        <div id="confirm_password_error" style="color: red;"></div>
                            @error('password_confirmation')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mx-3  mt-4 text-center">
                        <div class="pb-3 ">
                            <button type="submit" class="btn register_button">
                                Register
                            </button>
                        </div>
                        <a href="{{ route('login') }}" class=" text-decoration-none ">
                            {{ __('Già registrato?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <script>
            function checkPassword() {
                console.log('ciao')
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('password_confirmation').value;
        
                if (password !== confirmPassword) {
                    document.getElementById('confirm_password_error').innerHTML = 'Le password non corrispondono';
                    return false; // Blocca l'invio del modulo se le password non corrispondono
                } else {
                    document.getElementById('confirm_password_error').innerHTML = '';
                    return true; // Consente l'invio del modulo se le password corrispondono
                }
            }
        </script>
    </div>
@endsection
