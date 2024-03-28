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
    <body>
        <header>
            <div class="container">
                {{-- <a class="navbar-brand" href="/">Template</a> --}}
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <nav>
                    <ul>
                        <li>
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit">
                            Log Out
                        </button>
                    </form>
                </nav>
            </div>
        </header>
        <main class="py-4">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
    </body>
</html>
