<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="overflow-hidden ">
        <div class="d-flex overflow-hidden">
            <header >
                <nav class="d-flex flex-column">
                    <ul class="flex-grow-1 ">
                        <li>
                            <a class="nav-link" href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" >Dashboard</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('admin.apartments.index')}}">Appartamenti</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.services.index') }}">Servizi</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.contacts.index') }}">Messaggi</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('admin.sponsors.index') }}">Sponsor</a>
                        </li>
                    </ul>
                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf

                        <button type="submit">
                            Log Out
                        </button>
                    </form>
                </nav>
                
            </header>
            <main class="py-4">
                <div class="container">
                    @yield('main-content')
                </div>
            </main>
        </div>
    </body>
</html>
