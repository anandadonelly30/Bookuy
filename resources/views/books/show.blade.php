{{-- file: resources/views/books/show.blade.php --}}
@extends('layouts.app')

@section('title', $book->title)

@php
    $coverPath = $book->cover ?? $book->cover_image_url ?? null;
    $isAbsolute = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://']);
    $hasImagesPrefix = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['images/', 'images\\']);
    $coverSrc = $coverPath
        ? ($isAbsolute ? $coverPath : asset($hasImagesPrefix ? $coverPath : 'images/books/' . ltrim($coverPath, '/')))
        : null;

    $ratingAverage = $book->rating_average ?? 0;
    $ratingCount = $book->rating_count ?? 0;
    $reviews = $book->reviews ?? collect();
    $seller = $book->seller;
@endphp

@section('content')
<div class="pb-24">
    <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow-lg">
        <div class="px-4 pt-8 pb-16 space-y-6">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="p-2 border border-white/50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                    </svg>
                </a>
                <span class="font-semibold tracking-widest">Bookuy.</span>
                <a href="{{ route('cart.index') }}" class="p-2 border border-white/50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4" />
                        <circle cx="9" cy="19" r="1.25" />
                        <circle cx="17" cy="19" r="1.25" />
                    </svg>
                </a>
            </div>
            <div class="relative bg-gradient-to-r from-blue-500/40 to-blue-600/60 rounded-3xl p-6 shadow-2xl">
                <div class="flex justify-center">
                    <div class="bg-white rounded-[28px] p-3 shadow-xl">
                        @if ($coverSrc)
                            <img src="{{ $coverSrc }}" alt="{{ $book->title }}" class="w-40 h-56 object-cover rounded-2xl">
                        @else
                            <div class="w-40 h-56 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">No cover</div>
                        @endif
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <h1 class="text-2xl font-semibold">{{ $book->title }}</h1>
                    <p class="text-sm opacity-80">{{ $book->author }}</p>
                </div>
            </div>
        </div>
    </header>

    <main class="-mt-10 px-4">
        <div class="bg-white rounded-t-3xl p-6 space-y-8 shadow">
            <section class="space-y-3">
                <h2 class="text-lg font-semibold">Deskripsi Produk</h2>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $book->full_description ?? $book->short_description }}</p>
            </section>

            <section class="space-y-3">
                <h2 class="text-lg font-semibold">Detail Buku</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ([
                        'Alamat' => $book->address,
                        'Kondisi' => $book->condition,
                        'Kategori' => $book->categories->first()->name ?? $book->category,
                        'Halaman' => $book->pages,
                    ] as $label => $value)
                        <div class="bg-gray-100 rounded-2xl px-4 py-3 flex justify-between text-sm">
                            <span class="text-slate-500">{{ $label }}</span>
                            <span class="font-semibold text-right">{{ $value ?? '-' }}</span>
                        </div>
                    @endforeach
                </div>
                @if ($seller)
                    <a href="{{ route('sellers.show', $seller->id) }}" class="block mt-4 bg-white rounded-2xl shadow p-4 flex items-center gap-4 hover:bg-slate-50">
                        @if ($seller->avatar)
                            <img src="{{ $seller->avatar }}" alt="{{ $seller->name }}" class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">👤</div>
                        @endif
                        <div>
                            <p class="font-semibold">{{ $seller->name }}</p>
                            <p class="text-sm text-slate-500">{{ $seller->role }}</p>
                        </div>
                    </a>
                @endif
            </section>

            <section class="space-y-4">
                <div>
                    <p class="text-4xl font-bold">{{ number_format($ratingAverage, 1) }}</p>
                    <p class="text-sm text-slate-500 mt-1">{{ $ratingCount }} Ratings</p>
                </div>
                @if ($reviews->count())
                    <div class="space-y-6">
                        @foreach ($reviews as $review)
                            <article class="space-y-2 border-b border-slate-100 pb-4 last:border-0">
                                <div class="flex gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 {{ $i <= ($review->stars ?? 0) ? 'text-yellow-400' : 'text-slate-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049.927a1 1 0 011.902 0l1.2 3.695a1 1 0 00.95.69h3.884c.969 0 1.371 1.24.588 1.81l-3.143 2.284a1 1 0 00-.364 1.118l1.2 3.695c.3.924-.755 1.688-1.54 1.118l-3.143-2.284a1 1 0 00-1.176 0l-3.143 2.284c-.785.57-1.84-.194-1.54-1.118l1.2-3.695a1 1 0 00-.364-1.118L2.427 7.122c-.783-.57-.38-1.81.588-1.81h3.884a1 1 0 00.95-.69L9.049.927z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-slate-600">{{ $review->comment }}</p>
                                <p class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                                    {{ $review->reviewer_name ?? 'Anonim' }}
                                    @if ($review->created_at)
                                        <span class="font-normal text-slate-500">{{ $review->created_at->diffForHumans() }}</span>
                                    @endif
                                </p>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">Belum ada ulasan.</p>
                @endif
            </section>
        </div>
    </main>

    <div class="fixed bottom-0 inset-x-0 px-4 pb-4">
        <div class="bg-blue-600 text-white rounded-t-3xl shadow-2xl px-5 py-4 flex items-center gap-3">
            <button class="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4-.8L3 20l1.33-3.11A7.42 7.42 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </button>
            <form method="POST" action="{{ route('cart.add') }}" class="flex-1 flex gap-3">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="mode" value="rent">
                <input type="hidden" name="title" value="{{ $book->title }}">
                <input type="hidden" name="cover" value="{{ $book->cover_image_url ?? $book->cover }}">
                <input type="hidden" name="price" value="{{ $book->price_rent }}">
                <button type="submit" class="flex-1 bg-blue-500 rounded-full px-4 py-2 text-center">
                    <p class="text-xs uppercase tracking-wide">Sewa</p>
                    <p class="text-sm font-semibold">Rp {{ number_format($book->price_rent, 0, ',', '.') }}</p>
                </button>
            </form>
            <form method="POST" action="{{ route('cart.add') }}" class="flex-1 flex">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="mode" value="buy">
                <input type="hidden" name="title" value="{{ $book->title }}">
                <input type="hidden" name="cover" value="{{ $book->cover_image_url ?? $book->cover }}">
                <input type="hidden" name="price" value="{{ $book->price_buy }}">
                <button type="submit" class="flex-1 bg-orange-400 rounded-full px-4 py-2 text-center">
                    <p class="text-xs uppercase tracking-wide">Beli</p>
                    <p class="text-sm font-semibold">Rp {{ number_format($book->price_buy, 0, ',', '.') }}</p>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
