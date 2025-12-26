{{-- file: resources/views/books/show.blade.php --}}
{{-- CDR Use Case: ViewBookDetails (with integrated reviews) --}}
@extends('layouts.app')

@section('title', $book->title)

@php
    $coverPath = $book->cover ?? $book->cover_image_url ?? null;
    $isAbsolute = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://']);
    $hasImagesPrefix = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['images/', 'images\\']);
    $coverSrc = $coverPath
        ? ($isAbsolute ? $coverPath : asset($hasImagesPrefix ? $coverPath : 'images/books/' . ltrim($coverPath, '/')))
        : null;

    $bookReviews = $reviews ?? $book->reviews ?? collect();
    $bookSeller = $seller ?? $book->seller;
    
    // Calculate rating from actual reviews
    $ratingCount = $bookReviews->count();
    $ratingAverage = $ratingCount > 0 ? $bookReviews->avg('stars') : 0;
@endphp

@section('content')
<div class="pb-24">
    {{-- Success flash message for AddToCart --}}
    @if(session('added_to_cart'))
        <div class="fixed top-4 left-4 right-4 z-50 animate-pulse">
            <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-semibold">{{ session('cart_message', 'Item ditambahkan ke keranjang!') }}</span>
                <a href="{{ route('cart.index') }}" class="ml-auto bg-white/20 px-3 py-1 rounded-full text-sm">Lihat Keranjang</a>
            </div>
        </div>
    @endif

    <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow-lg">
        <div class="px-4 pt-8 pb-16 space-y-6">
            <div class="flex items-center justify-between">
                {{-- CDR: Back to ViewRecommended --}}
                <a href="{{ route('ViewRecommended') }}" class="p-2 border border-white/50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                    </svg>
                </a>
                <span class="font-semibold tracking-widest">Bookuy.</span>
                <a href="{{ route('cart.index') }}" class="p-2 border border-white/50 rounded-full relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4" />
                        <circle cx="9" cy="19" r="1.25" />
                        <circle cx="17" cy="19" r="1.25" />
                    </svg>
                    @php
                        $cartCount = \App\Models\Cart::getOrCreateCart()->items()->count();
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-orange-400 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
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
            {{-- ShowDeskripsiBuku: Book Description --}}
            <section class="space-y-3">
                <h2 class="text-lg font-semibold">Deskripsi Produk</h2>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $book->full_description ?? $book->short_description ?? $book->description ?? 'Tidak ada deskripsi.' }}</p>
            </section>

            {{-- Book Details --}}
            <section class="space-y-3">
                <h2 class="text-lg font-semibold">Detail Buku</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ([
                        'Alamat' => $book->address,
                        'Kondisi' => $book->condition,
                        'Kategori' => $book->categories->first()->name ?? $book->category ?? '-',
                        'Halaman' => $book->pages,
                    ] as $label => $value)
                        <div class="bg-gray-100 rounded-2xl px-4 py-3 flex justify-between text-sm">
                            <span class="text-slate-500">{{ $label }}</span>
                            <span class="font-semibold text-right">{{ $value ?? '-' }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CDR: ViewSellerProfile link --}}
                @if ($bookSeller)
                    <a href="{{ route('ViewSellerProfile', $bookSeller->id) }}" class="block mt-4 bg-white rounded-2xl shadow p-4 flex items-center gap-4 hover:bg-slate-50 border border-slate-100">
                        @if ($bookSeller->avatar)
                            <img src="{{ $bookSeller->avatar }}" alt="{{ $bookSeller->name }}" class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-2xl">👤</div>
                        @endif
                        <div class="flex-1">
                            <p class="text-xs text-slate-500 uppercase tracking-wide">Penjual</p>
                            <p class="font-semibold">{{ $bookSeller->name }}</p>
                            <p class="text-sm text-slate-500">{{ $bookSeller->role ?? 'Seller' }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </section>

            {{-- CDR: Reviews Section (integrated, not separate page) --}}
            {{-- ShowDaftarReviewBuku: Display reviews --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-4xl font-bold">{{ number_format($ratingAverage, 1) }}</p>
                        <p class="text-sm text-slate-500 mt-1">{{ $ratingCount }} Ratings</p>
                    </div>
                    <div class="flex gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $i <= round($ratingAverage) ? 'text-yellow-400' : 'text-slate-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049.927a1 1 0 011.902 0l1.2 3.695a1 1 0 00.95.69h3.884c.969 0 1.371 1.24.588 1.81l-3.143 2.284a1 1 0 00-.364 1.118l1.2 3.695c.3.924-.755 1.688-1.54 1.118l-3.143-2.284a1 1 0 00-1.176 0l-3.143 2.284c-.785.57-1.84-.194-1.54-1.118l1.2-3.695a1 1 0 00-.364-1.118L2.427 7.122c-.783-.57-.38-1.81.588-1.81h3.884a1 1 0 00.95-.69L9.049.927z" />
                            </svg>
                        @endfor
                    </div>
                </div>

                <h3 class="text-lg font-semibold">Ulasan Pembeli</h3>

                @if ($bookReviews->count())
                    <div class="space-y-6">
                        @foreach ($bookReviews as $review)
                            <article class="space-y-2 border-b border-slate-100 pb-4 last:border-0">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-semibold">
                                        {{ substr($review->reviewer_name ?? 'A', 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-slate-800">
                                            {{ $review->reviewer_name ?? 'Anonim' }}
                                        </p>
                                        @if ($review->created_at)
                                            <p class="text-xs text-slate-500">{{ $review->created_at->diffForHumans() }}</p>
                                        @endif
                                    </div>
                                    <div class="flex gap-0.5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 {{ $i <= ($review->stars ?? 0) ? 'text-yellow-400' : 'text-slate-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049.927a1 1 0 011.902 0l1.2 3.695a1 1 0 00.95.69h3.884c.969 0 1.371 1.24.588 1.81l-3.143 2.284a1 1 0 00-.364 1.118l1.2 3.695c.3.924-.755 1.688-1.54 1.118l-3.143-2.284a1 1 0 00-1.176 0l-3.143 2.284c-.785.57-1.84-.194-1.54-1.118l1.2-3.695a1 1 0 00-.364-1.118L2.427 7.122c-.783-.57-.38-1.81.588-1.81h3.884a1 1 0 00.95-.69L9.049.927z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm text-slate-600 pl-10">{{ $review->comment }}</p>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-slate-400 text-sm">Belum ada review.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>

    {{-- CDR: AddToCart actions --}}
    <div class="fixed bottom-0 inset-x-0 px-4 pb-4">
        <div class="bg-blue-600 text-white rounded-t-3xl shadow-2xl px-5 py-4 flex items-center gap-3">
            <button class="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4-.8L3 20l1.33-3.11A7.42 7.42 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </button>

            {{-- AddToCart: Sewa (Rent) --}}
            <form method="POST" action="{{ route('AddToCart') }}" class="flex-1 flex gap-3">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="mode" value="rent">
                <input type="hidden" name="title" value="{{ $book->title }}">
                <input type="hidden" name="cover" value="{{ $coverSrc ?? '' }}">
                <input type="hidden" name="price" value="{{ $book->price_rent ?? 0 }}">
                <button type="submit" class="flex-1 bg-blue-500 rounded-full px-4 py-2 text-center hover:bg-blue-400 transition-colors">
                    <p class="text-xs uppercase tracking-wide">Sewa</p>
                    <p class="text-sm font-semibold">Rp {{ number_format($book->price_rent ?? 0, 0, ',', '.') }}</p>
                </button>
            </form>

            {{-- AddToCart: Beli (Buy) --}}
            <form method="POST" action="{{ route('AddToCart') }}" class="flex-1 flex">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="mode" value="buy">
                <input type="hidden" name="title" value="{{ $book->title }}">
                <input type="hidden" name="cover" value="{{ $coverSrc ?? '' }}">
                <input type="hidden" name="price" value="{{ $book->price_buy ?? 0 }}">
                <button type="submit" class="flex-1 bg-orange-400 rounded-full px-4 py-2 text-center hover:bg-orange-300 transition-colors">
                    <p class="text-xs uppercase tracking-wide">Beli</p>
                    <p class="text-sm font-semibold">Rp {{ number_format($book->price_buy ?? 0, 0, ',', '.') }}</p>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
