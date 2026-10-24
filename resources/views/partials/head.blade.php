<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#0d3151">

{{-- Favicon --}}
<link rel="icon" type="image/png" href="{{ asset('logo.jpg') }}">
<link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">

{{-- Vite: CSS + JS bundle --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

@stack('styles')
