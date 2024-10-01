<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>

    <meta name="application-name" content="{{ config('app.name') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @filamentStyles
    @livewireStyles
    @fluxStyles
    @vite('resources/css/app.css')
    @vite('resources/sass/app.scss')
</head>

<body class="min-h-screen bg-gray-50 dark:bg-zinc-800 antialiased">
@include('layouts.top-nav')
@include('layouts.side-nav')

<flux:main container>
    {{ $slot ?? ''}}
    @yield('content')
</flux:main>

@livewire('notifications')
@filamentScripts
@vite('resources/js/app.js')
@livewireScripts
@fluxScripts
</body>
</html>
