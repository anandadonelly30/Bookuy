<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-900">
        <!-- Mobile-only frame -->
        <div class="min-h-screen bg-slate-900 flex justify-center items-stretch px-4 py-6">
            <div class="w-full max-w-[430px] min-h-[calc(100vh-3rem)] bg-page-bg rounded-[32px] shadow-[0px_25px_60px_rgba(15,23,42,0.35)] overflow-hidden relative">
                {{ $slot }}
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>
