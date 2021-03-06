<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Script -->
        <script src="{{ mix('js/app.js') }}"></script>
        @livewireScripts
   
    </head>

    <body class="flex flex-wrap justify-center">
    
        <div class="flex w-full justify-between px-4 bg-teal-700 text-white">
        @auth
            <a class="mx-3 py-4 hover:text-gray-400" href="/">Home</a>
            @livewire('logout')
        @endauth
        @guest
        <div class="py-4">
            <a  class="mx-3 hover:text-gray-400"  href="/login">Login</a>
            <a  class="mx-3 hover:text-gray-400"  href="/register">Register</a>
        </div>
        @endguest
        
        </div>
        <div class="container mx-auto px-4 justify-center">
            @yield('content')
        </div>

    </body>  
</html>




