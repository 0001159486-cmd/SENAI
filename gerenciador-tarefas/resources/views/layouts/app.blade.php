<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body { font-family: 'Figtree', sans-serif; background-color: #f4f7f6; }
            .navbar { background: #ffffff; border-bottom: 1px solid #e5e7eb; }
            .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
            .btn-primary { background-color: #4f46e5; border: none; }
            .btn-primary:hover { background-color: #4338ca; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white py-4 mb-4 shadow-sm">
                    <div class="container px-4 sm:px-6 lg:px-8">
                        <h2 class="h4 mb-0 text-dark fw-bold">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endif

            <main class="container py-4">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>