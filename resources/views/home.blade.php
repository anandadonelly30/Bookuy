{{-- file: resources/views/home.blade.php --}}
{{-- CDR Use Case: ViewRecommended --}}
@extends('layouts.app')

@section('title', 'Bookuy - Home')

@section('content')
    <div class="min-h-screen bg-slate-50 pb-20">
        <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow-lg">
            <div class="px-4 py-6 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-80">Welcome</p>
                        <p class="text-3xl font-bold">Bookuy!</p>
                    </div>
                    <a href="{{ route('cart.index') }}" class="border border-white/70 rounded-full p-3 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
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
                <div class="bg-white rounded-full flex items-center px-4 py-2 shadow text-slate-600">
                    <div class="flex items-center flex-1 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                        </svg>
                        <input type="text" placeholder="Search for Books..."
                            class="flex-1 bg-transparent focus:outline-none text-sm placeholder:text-slate-400">
                    </div>
                    <button class="bg-blue-500 text-white rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <main class="px-4 -mt-6 space-y-8">
            <section class="bg-white rounded-3xl shadow p-5">
                <div class="flex flex-wrap items-center gap-3 justify-between">
                    <div>
                        <h2 class="text-lg font-semibold">Kategori</h2>
                        <p class="text-sm text-slate-500">Pilih Kategori Bidang yang Kamu Inginkan</p>
                    </div>
                    <button class="bg-orange-400 text-white text-sm px-4 py-2 rounded-full">Lihat Semua</button>
                </div>
                <div class="mt-5 overflow-x-auto">
                    <div class="flex gap-4 min-w-max">
                        @foreach ($categories as $category)
                            <div class="bg-slate-50 rounded-2xl shadow px-4 py-3 min-w-[140px]">
                                <div class="text-2xl mb-2">{{ $category->icon ?? '📚' }}</div>
                                <p class="text-sm font-semibold text-slate-800 leading-snug">{{ $category->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ViewRecommended: Display Recommended Books --}}
            <section>
                <h2 class="text-lg font-semibold mb-3">Recommended for you</h2>
                <div class="flex gap-4 overflow-x-auto pb-2">
                    @forelse ($recommendedBooks as $book)
                        {{-- CDR: Tap a book navigates to ViewBookDetails(bookId) --}}
                        <a href="{{ route('ViewBookDetails', $book->id) }}"
                            class="flex-shrink-0 w-32 h-44 rounded-2xl overflow-hidden shadow bg-white relative">
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
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm bg-slate-100">No
                                    cover</div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent px-2 py-1">
                                <p class="text-[11px] text-white truncate">
                                    {{ $book->categories->first()->name ?? $book->category ?? 'Kategori' }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">No recommended books yet.</p>
                    @endforelse
                </div>
            </section>

            {{-- ViewRecommended: Display Popular Books --}}
            <section class="space-y-4">
                <h2 class="text-lg font-semibold">Popular books</h2>
                @forelse ($popularBooks as $book)
                    {{-- CDR: Tap a book navigates to ViewBookDetails(bookId) --}}
                    <a href="{{ route('ViewBookDetails', $book->id) }}" class="bg-white rounded-2xl shadow p-4 flex gap-4">
                        <div class="w-20 h-28 rounded-2xl overflow-hidden bg-slate-100">
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
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">No cover</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-800 leading-tight">{{ $book->title }}</h3>
                            <p class="text-sm text-slate-500 truncate">{{ $book->author }}</p>
                            <p class="text-lg font-bold mt-2 text-blue-700">Rp
                                {{ number_format($book->price ?? $book->price_buy ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <span class="bg-orange-400 text-white text-xs font-semibold px-4 py-2 rounded-full self-start">Grab
                            Now</span>
                    </a>
                @empty
                    <p class="text-sm text-slate-500">No popular books yet.</p>
                @endforelse
            </section>
        </main>
    </div>
@endsection