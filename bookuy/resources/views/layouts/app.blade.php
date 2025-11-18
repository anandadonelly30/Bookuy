<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bookuy') }}</title>

    <!-- Fonts --><link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- Kalau pakai Google Fonts, bisa dihapus atau diganti dengan yang di app.css --}}

    <!-- Scripts -->@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-white-text bg-dark-bg min-h-screen">
    <div class="min-h-screen bg-dark-bg flex justify-center items-stretch px-4 py-6">
        <div class="w-full max-w-[430px] min-h-[calc(100vh-3rem)] bg-dark-bg rounded-[32px] shadow-[0px_25px_60px_rgba(0,0,0,0.45)] overflow-hidden flex flex-col relative">
            {{-- Header hanya akan muncul jika didefinisikan di view --}}
            @isset($header)
                {{ $header }}
            @endisset

            {{-- Konten Utama Halaman --}}
            <main class="flex-1 pb-24">
                {{ $slot }}
            </main>

            {{-- Bottom Navigation Bar --}}
            <x-bottom-navigation />
        </div>
    </div>

    {{-- Script tambahan atau modal bisa diletakkan di sini --}}
    @stack('scripts')
</body>
</html>