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
        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body>
        <div class="d-flex">
            <aside>    
                <nav class="d-flex flex-column">
                    <ul class="flex-grow-1">
                        <li>
                            <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('admin.apartments.index') ? 'active' : '' }}" href="{{route('admin.apartments.index')}}">Appartamenti</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('admin.services.index') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">Servizi</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('admin.contacts.index') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">Messaggi</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('admin.sponsors.index') ? 'active' : '' }}" href="{{ route('admin.sponsors.index') }}">Sponsor</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="py-4 overflow-y-scroll">
                <div class="container">
                    @yield('main-content')
                </div>
            </main>
        </div>
    </body>
</html>
