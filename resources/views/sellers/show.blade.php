{{-- file: resources/views/sellers/show.blade.php --}}
@extends('layouts.app')

@section('title', $seller->name)

@section('content')
<div class="min-h-screen bg-white pb-10">
    <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow-lg">
        <div class="px-4 py-8 space-y-6">
            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}" class="p-2 border border-white/60 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                    </svg>
                </a>
                <span class="font-semibold tracking-widest">Bookuy.</span>
                <a href="{{ route('cart.index') }}" class="p-2 border border-white/60 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4" />
                        <circle cx="9" cy="19" r="1.25" />
                        <circle cx="17" cy="19" r="1.25" />
                    </svg>
                </a>
            </div>
            <div class="text-center space-y-3">
                @if ($seller->avatar)
                    <img src="{{ $seller->avatar }}" alt="{{ $seller->name }}" class="w-24 h-24 rounded-full mx-auto border-4 border-white/40 object-cover shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full mx-auto border-4 border-white/40 bg-white/20 flex items-center justify-center text-2xl">👤</div>
                @endif
                <p class="text-xs uppercase tracking-wide opacity-80">Penjual</p>
                <p class="text-2xl font-semibold">{{ $seller->name }}</p>
                <p class="text-sm opacity-80">{{ $seller->role }}</p>
            </div>
        </div>
    </header>

    <main class="px-4 py-6 space-y-6">
        <section class="bg-white rounded-3xl shadow p-5 space-y-3">
            <h2 class="text-lg font-semibold">Tentang Penjual</h2>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $seller->about }}</p>
        </section>

        <section class="bg-white rounded-3xl shadow p-5 space-y-4">
            <h2 class="text-lg font-semibold">Buku lain yang dijual</h2>
            <div class="flex gap-4 overflow-x-auto">
                @foreach ($sellerBooks as $book)
                    <a href="{{ route('books.show', $book->id) }}" class="flex-shrink-0 w-36 bg-slate-50 rounded-2xl shadow p-3 space-y-2">
                        <div class="h-40 rounded-xl overflow-hidden">
                            @php
                                $coverPath = $book->cover ?? $book->cover_image_url ?? null;
                                $isAbsolute = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://']);
                                $hasImagesPrefix = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['images/', 'images\\']);
                                $src = $coverPath
                                    ? ($isAbsolute ? $coverPath : asset($hasImagesPrefix ? $coverPath : 'images/books/' . ltrim($coverPath, '/')))
                                    : null;
                            @endphp
                            @if ($src)
                                <img src="{{ $src }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs">No cover</div>
                            @endif
                        </div>
                        <p class="text-sm font-semibold leading-snug">{{ $book->title }}</p>
                        <p class="text-xs text-slate-500">Rp {{ number_format($book->price_buy, 0, ',', '.') }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
</div>
@endsection
