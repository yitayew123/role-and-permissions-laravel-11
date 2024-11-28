<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Define the character encoding for the document -->
    <meta charset="utf-8">

    <!-- Make the page responsive to different screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token for secure form submissions -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Set the title of the webpage, with a fallback value -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts: Preloading and specifying a font -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts: Include the compiled app styles and scripts using Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome: External CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
    <div id="app">
        <!-- Navigation bar with Laravel branding and user options -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Brand link pointing to the home page -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel 11 User Roles and Permissions
                </a>
                <!-- Navbar toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" 
                        aria-expanded="false" 
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left side of the navbar (empty placeholder for future links) -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right side of the navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication links -->
                        @guest
                            <!-- If the user is not logged in, show login and register options -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- If the user is logged in, show management options -->
                            <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                            <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>

                            <!-- User dropdown for account options -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" 
                                   role="button" data-bs-toggle="dropdown" 
                                   aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Logout link with JavaScript to submit a hidden form -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <!-- Hidden logout form -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content area -->
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!-- Card to display the content -->
                        <div class="card">
                            <div class="card-body">
                                <!-- Placeholder for content from child views -->
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
