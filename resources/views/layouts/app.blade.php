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

    @filamentStyles
    @vite('resources/css/app.css')
    @vite('resources/sass/app.scss')
</head>

<body class="antialiased bg-gray-100">
@include('layouts.top-nav')


<div style="min-height: 100px;">
    {{ $slot ?? ''}}
    @yield('content')
</div>

@livewire('notifications')

@filamentScripts
@include('layouts.footer')
@vite('resources/js/app.js')
</body>
</html>
