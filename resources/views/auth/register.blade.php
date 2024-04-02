@extends('layouts.guest')

@section('main-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">
                Name
            </label>
            <input type="text" id="name" name="name">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Name -->
        <div>
            <label for="lastname">
                Lastname
            </label>
            <input type="text" id="lastname" name="lastname">
              @error('lastname')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

         <div>
            <label for="birthday">
                Data di Nascita:
            </label>
            <input  type="date" id="birthday" name="birthday" >
              @error('birthday')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">
                Email
            </label>
            <input type="email" id="email" name="email">
              @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">
                Password
            </label>
            <input type="password" id="password" name="password">
              @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">
                Conferma Password
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation">
              @error('password_confirmation')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit">
                Register
            </button>
        </div>
    </form>
@endsection
