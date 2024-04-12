@php
    $user = auth()->user();
    $initials = strtoupper(substr($user->name, 0, 1) . substr($user->lastname, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        {{-- Google Font --}}
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>@yield('page-title') | {{ config('app.name', 'Boolbnb') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body>
        <main class="d-flex">
            <aside class="d-flex align-items-end flex-column">    
                <ul class="h-100 flex-grow-1 px-3">
                    <li>
                        <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <span class="d-lg-block d-none">
                                Dashboard
                            </span>
                            <i class="d-lg-none d-md-block fa-solid fa-table-columns"></i>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ Request::routeIs('admin.apartments.index') ? 'active' : '' }}" href="{{route('admin.apartments.index')}}">
                            <span class="d-lg-block d-none">
                                Appartamenti
                            </span>
                            <i class="d-lg-none d-md-block fa-solid fa-house-user"></i>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ Request::routeIs('admin.services.index') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                            <span class="d-lg-block d-none">
                                Servizi
                            </span>
                            <i class="d-lg-none d-md-block fa-solid fa-bell-concierge"></i>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a class="nav-link {{ Request::routeIs('admin.contacts.index') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                            <span class="d-lg-block d-none">
                                Messaggi
                            </span>
                            <i class="d-lg-none d-md-block fa-solid fa-square-envelope"></i>
                        </a>
                    </li> --}}
                    <li>
                        <a class="nav-link {{ Request::routeIs('admin.sponsors.index') ? 'active' : '' }}" href="{{ route('admin.sponsors.index') }}">
                            <span class="d-lg-block d-none">
                                Sponsor
                            </span>
                            <i class="d-lg-none d-md-block fa-solid fa-certificate"></i>
                        </a>
                    </li>
                    <li class="mt-auto p-2">
                        <img src="../../storage/img/logo_VV_ridimensionato.svg" alt="">
                    </li>

                </ul>
            </aside>
            <div class="main-menu-container overflow-y-scroll">
            {{-- TUTTO IL MENU --}}
                <!-- Inizio Colonna Bottoni -->
                <div class="row g-0 justify-content-end user">
                    <div class="col-auto me-5">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <!-- Inizio Bottone Dropdown -->
                            <div class="btn-group my-button" role="group">
                                <button type="button" class="btn d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars"></i>
                                    {{$initials }}   
                                    {{-- <i class="fa-regular fa-circle-user"></i>                  --}}
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="d-lg-block text-center">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span>
                                            {{ $user->email }}
                                        </span>
                                    </li>
                                    <li class="d-lg-block text-center">
                                        <i class="fa-solid fa-cake-candles"></i>
                                        <span>
                                            {{$user->birthday}}                                
                                        </span>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="text-center">
                                            @csrf
                                            <button type="submit">
                                                Log Out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>                            
                            <!-- Inizio Bottone Dropdown -->
                        </div>
                    </div>
                </div>
                <!-- Fine Colonna Bottoni -->
                <div class="main-container">
                    {{-- MAIN MENU --}}
                    <div class="container h-100">
                        @yield('main-content')
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
