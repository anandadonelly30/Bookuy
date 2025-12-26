{{-- file: resources/views/cart/index.blade.php --}}
{{-- Cart View - Displays items from database (carts and cart_items tables) --}}
@extends('layouts.app')

@section('title', 'Bookuy - Keranjang')

@section('content')
    <div x-data="{ tab: 'buy' }" class="min-h-screen bg-gray-50 pb-20">
        <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow">
            <div class="px-4 py-8 flex items-center justify-between">
                <a href="{{ route('ViewRecommended') }}" class="p-2 border border-white/60 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                    </svg>
                </a>
                <div class="text-center">
                    <span class="font-semibold tracking-widest block">Bookuy.</span>
                    <h1 class="text-2xl font-bold">Keranjang</h1>
                </div>
                <span class="h-10 w-10"></span>
            </div>
        </header>

        {{-- Flash message --}}
        @if(session('cart_message'))
            <div class="px-4 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl">
                    {{ session('cart_message') }}
                </div>
            </div>
        @endif

        {{-- Tab switcher: Beli / Sewa --}}
        <div class="px-4 mt-6 flex gap-3 justify-center">
            <button @click="tab = 'buy'" :class="tab === 'buy' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600'"
                class="px-8 py-3 rounded-full shadow font-semibold transition-colors">
                Beli
            </button>
            <button @click="tab = 'rent'" :class="tab === 'rent' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600'"
                class="px-8 py-3 rounded-full shadow font-semibold transition-colors">
                Sewa
            </button>
        </div>

        <div class="px-4 mt-6 space-y-6">
            {{-- Buy Cart (Database) --}}
            <div x-cloak x-show="tab === 'buy'" class="space-y-4">
                @forelse ($cart['buy'] as $item)
                    <div class="bg-white rounded-2xl shadow p-4 flex gap-4 items-center">
                        @php
                            $book = $item->book;
                            $coverPath = $book->cover ?? $book->cover_image_url ?? null;
                            $isAbsolute = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://']);
                            $hasImagesPrefix = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['images/', 'images\\']);
                            $coverSrc = $coverPath
                                ? ($isAbsolute ? $coverPath : asset($hasImagesPrefix ? $coverPath : 'images/books/' . ltrim($coverPath, '/')))
                                : null;
                        @endphp
                        @if($coverSrc)
                            <img src="{{ $coverSrc }}" alt="{{ $book->title ?? 'Book' }}" class="w-16 h-20 rounded-xl object-cover">
                        @else
                            <div class="w-16 h-20 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-xs">
                                No cover</div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold line-clamp-2">{{ $book->title ?? 'Unknown Book' }}</p>
                            <p class="text-sm text-slate-500">{{ $book->condition ?? '' }}</p>
                            <p class="text-sm text-slate-500">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-lg font-bold text-blue-600">Rp
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            {{-- Quantity controls --}}
                            <div class="flex items-center gap-2 bg-slate-100 rounded-full px-2 py-1">
                                <form method="POST" action="{{ route('cart.updateQuantity') }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="action" value="decrement">
                                    <button type="submit"
                                        class="w-6 h-6 rounded-full bg-white shadow flex items-center justify-center text-slate-600 hover:bg-slate-200">-</button>
                                </form>
                                <span class="w-6 text-center font-semibold">{{ $item->quantity }}</span>
                                <form method="POST" action="{{ route('cart.updateQuantity') }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="action" value="increment">
                                    <button type="submit"
                                        class="w-6 h-6 rounded-full bg-white shadow flex items-center justify-center text-slate-600 hover:bg-slate-200">+</button>
                                </form>
                            </div>
                            {{-- Remove button --}}
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-32 h-32 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-700">Your Cart Is Empty!</h3>
                        <p class="text-sm text-slate-500 mt-1">When you add products, they'll appear here.</p>
                        <a href="{{ route('ViewRecommended') }}"
                            class="inline-block mt-4 bg-orange-400 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-500 transition-colors">
                            Go Shop
                        </a>
                    </div>
                @endforelse
                @if(count($cart['buy']) > 0)
                    <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
                        <span>Subtotal Beli</span>
                        <span class="text-blue-600">Rp {{ number_format($buySubtotal, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>

            {{-- Rent Cart (Database) --}}
            <div x-cloak x-show="tab === 'rent'" class="space-y-4">
                @forelse ($cart['rent'] as $item)
                    <div class="bg-white rounded-2xl shadow p-4 flex gap-4 items-center">
                        @php
                            $book = $item->book;
                            $coverPath = $book->cover ?? $book->cover_image_url ?? null;
                            $isAbsolute = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['http://', 'https://']);
                            $hasImagesPrefix = $coverPath && \Illuminate\Support\Str::startsWith($coverPath, ['images/', 'images\\']);
                            $coverSrc = $coverPath
                                ? ($isAbsolute ? $coverPath : asset($hasImagesPrefix ? $coverPath : 'images/books/' . ltrim($coverPath, '/')))
                                : null;
                        @endphp
                        @if($coverSrc)
                            <img src="{{ $coverSrc }}" alt="{{ $book->title ?? 'Book' }}" class="w-16 h-20 rounded-xl object-cover">
                        @else
                            <div class="w-16 h-20 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-xs">
                                No cover</div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold line-clamp-2">{{ $book->title ?? 'Unknown Book' }}</p>
                            <p class="text-sm text-slate-500">{{ $item->quantity }} Semester</p>
                            <p class="text-sm text-slate-500">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}/semester
                            </p>
                            <p class="text-lg font-bold text-blue-600">Rp
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            {{-- Duration controls --}}
                            <div class="flex items-center gap-2 bg-slate-100 rounded-full px-2 py-1">
                                <form method="POST" action="{{ route('cart.updateQuantity') }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="action" value="decrement">
                                    <button type="submit"
                                        class="w-6 h-6 rounded-full bg-white shadow flex items-center justify-center text-slate-600 hover:bg-slate-200">-</button>
                                </form>
                                <span class="w-6 text-center font-semibold">{{ $item->quantity }}</span>
                                <form method="POST" action="{{ route('cart.updateQuantity') }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="action" value="increment">
                                    <button type="submit"
                                        class="w-6 h-6 rounded-full bg-white shadow flex items-center justify-center text-slate-600 hover:bg-slate-200">+</button>
                                </form>
                            </div>
                            {{-- Remove button --}}
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-32 h-32 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-700">Your Cart Is Empty!</h3>
                        <p class="text-sm text-slate-500 mt-1">When you add products, they'll appear here.</p>
                        <a href="{{ route('ViewRecommended') }}"
                            class="inline-block mt-4 bg-orange-400 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-500 transition-colors">
                            Go Shop
                        </a>
                    </div>
                @endforelse
                @if(count($cart['rent']) > 0)
                    <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
                        <span>Subtotal Sewa</span>
                        <span class="text-blue-600">Rp {{ number_format($rentSubtotal, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>

            {{-- Total Summary --}}
            @if(count($cart['buy']) > 0 || count($cart['rent']) > 0)
                <div class="bg-white rounded-2xl shadow p-4 space-y-3">
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Sub-total</span>
                        <span>Rp {{ number_format($buySubtotal + $rentSubtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Biaya Admin</span>
                        <span>Rp 1.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>Shipping fee</span>
                        <span>Rp 5.000</span>
                    </div>
                    <hr class="border-slate-100">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($total + 6000, 0, ',', '.') }}</span>
                    </div>
                    <button
                        class="w-full bg-orange-400 text-white rounded-full py-4 font-semibold mt-3 hover:bg-orange-500 transition-colors flex items-center justify-center gap-2">
                        Go To Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection