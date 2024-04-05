@extends('layouts.guest')

@section('main-content')
    <div id="login" class="row">
        <div class="form_container col-md-7 col-lg-7">
            <h1 class="text-center mt-4">
                Login
            </h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf 
                <!-- Email Address -->
                <div class="col-12 mx-auto">
                    <div class="text-center">
                        <label for="email">
                            Email
                        </label>
                    </div>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <!-- Password -->
                <div class="col-12 mx-auto">
                    <div class="text-center">
                        <label for="password">
                            Password
                        </label>
                    </div>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <!-- Remember Me -->
                <div class="mt-4 ms-3">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label">
                        <span>Remember me</span>
                    </label>
                </div>

                <div class="mt-4 text-center ">
                    <div class="mb-4">
                        <button type="submit" class="btn login_button">
                            Log in
                        </button>
                    </div>
                    <div class="text-center">
                        <a href="{{route('register')}}" class="text-decoration-none m-3">
                            Non sei registrato? 
                        </a>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none m-3">
                            {{ __('Password dimenticata?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
