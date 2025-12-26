{{-- file: resources/views/sellers/show.blade.php --}}
{{-- CDR Use Case: ViewSellerProfile --}}
@extends('layouts.app')

@section('title', $seller->name)

@section('content')
    <div class="min-h-screen bg-white pb-10">
        <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow-lg">
            <div class="px-4 py-8 space-y-6">
                <div class="flex items-center justify-between">
                    <a href="{{ url()->previous() }}" class="p-2 border border-white/60 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                        </svg>
                    </a>
                    <span class="font-semibold tracking-widest">Bookuy.</span>
                    <a href="{{ route('cart.index') }}" class="p-2 border border-white/60 rounded-full relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4" />
                            <circle cx="9" cy="19" r="1.25" />
                            <circle cx="17" cy="19" r="1.25" />
                        </svg>
                        @php
                            $cartCount = \App\Models\Cart::getOrCreateCart()->items()->count();
                        @endphp
                        @if($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-orange-400 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="text-center space-y-3">
                    @if ($seller->avatar)
                        <img src="{{ $seller->avatar }}" alt="{{ $seller->name }}"
                            class="w-24 h-24 rounded-full mx-auto border-4 border-white/40 object-cover shadow-lg">
                    @else
                        <div
                            class="w-24 h-24 rounded-full mx-auto border-4 border-white/40 bg-white/20 flex items-center justify-center text-2xl">
                            👤</div>
                    @endif
                    <p class="text-xs uppercase tracking-wide opacity-80">Penjual</p>
                    <p class="text-2xl font-semibold">{{ $seller->name }}</p>
                    <p class="text-sm opacity-80">{{ $seller->role }}</p>
                </div>
            </div>
        </header>

        <main class="px-4 py-6 space-y-6">
            {{-- Seller Info --}}
            <section class="bg-white rounded-3xl shadow p-5 space-y-3">
                <h2 class="text-lg font-semibold">Tentang Penjual</h2>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $seller->about ?? 'Tidak ada informasi penjual.' }}</p>
            </section>

            {{-- Seller Stats (calculated from reviews) --}}
            @php
                // Calculate average rating from all reviews of seller's books
                $allReviews = collect();
                foreach ($sellerBooks as $book) {
                    $allReviews = $allReviews->merge($book->reviews);
                }
                $sellerRatingAverage = $allReviews->count() > 0 ? $allReviews->avg('stars') : 0;
                $totalReviews = $allReviews->count();
            @endphp
            <section class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 rounded-2xl p-4 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $sellerBooks->count() }}</p>
                    <p class="text-sm text-slate-600">Buku Dijual</p>
                </div>
                <div class="bg-orange-50 rounded-2xl p-4 text-center">
                    <p class="text-2xl font-bold text-orange-500">
                        {{ number_format($sellerRatingAverage, 1) }}
                    </p>
                    <p class="text-sm text-slate-600">Rating Rata-rata ({{ $totalReviews }} ulasan)</p>
                </div>
            </section>

            {{-- CDR: Seller's listed books --}}
            <section class="bg-white rounded-3xl shadow p-5 space-y-4">
                <h2 class="text-lg font-semibold">Buku lain yang dijual</h2>
                @if($sellerBooks->count() > 0)
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        @foreach ($sellerBooks as $book)
                            {{-- CDR: Tapping a listed book navigates to ViewBookDetails(bookId) --}}
                            <a href="{{ route('ViewBookDetails', $book->id) }}"
                                class="flex-shrink-0 w-36 bg-slate-50 rounded-2xl shadow p-3 space-y-2 hover:shadow-md transition-shadow">
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
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs">
                                            No cover</div>
                                    @endif
                                </div>
                                <p class="text-sm font-semibold leading-snug line-clamp-2">{{ $book->title }}</p>
                                <p class="text-xs text-slate-500">Rp
                                    {{ number_format($book->price_buy ?? $book->price ?? 0, 0, ',', '.') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500 text-center py-4">Penjual belum memiliki buku lain.</p>
                @endif
            </section>
        </main>
    </div>
@endsection