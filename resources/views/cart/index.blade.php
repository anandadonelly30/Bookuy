{{-- file: resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Bookuy - Cart')

@section('content')
<div x-data="{ tab: 'buy' }" class="min-h-screen bg-gray-50 pb-20">
    <header class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-b-3xl shadow">
        <div class="px-4 py-8 flex items-center justify-between">
            <a href="{{ route('home') }}" class="p-2 border border-white/60 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 6l-6 6 6 6" />
                </svg>
            </a>
            <h1 class="text-xl font-semibold">My Cart</h1>
            <span class="h-10 w-10"></span>
        </div>
    </header>

    <div class="px-4 mt-6 flex gap-3 justify-center">
        <button @click="tab = 'buy'" :class="tab === 'buy' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600'" class="px-6 py-2 rounded-full shadow">
            Beli
        </button>
        <button @click="tab = 'rent'" :class="tab === 'rent' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600'" class="px-6 py-2 rounded-full shadow">
            Sewa
        </button>
    </div>

    <div class="px-4 mt-6 space-y-6">
        <div x-cloak x-show="tab === 'buy'" class="space-y-4">
            @forelse ($cart['buy'] as $index => $item)
                <div class="bg-white rounded-2xl shadow p-4 flex gap-4 items-center">
                    <img src="{{ $item['cover'] }}" alt="{{ $item['title'] }}" class="w-16 h-20 rounded-xl object-cover">
                    <div class="flex-1">
                        <p class="font-semibold">{{ $item['title'] }}</p>
                        <p class="text-sm text-slate-500">Qty: {{ $item['qty'] }}</p>
                        <p class="text-sm text-slate-500">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="text-lg font-bold">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.remove') }}">
                        @csrf
                        <input type="hidden" name="mode" value="buy">
                        <input type="hidden" name="index" value="{{ $index }}">
                        <button type="submit" class="text-xs text-red-500">Remove</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-sm text-slate-500">Belum ada buku yang dibeli.</p>
            @endforelse
            <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
                <span>Subtotal Beli</span>
                <span>Rp {{ number_format($buySubtotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <div x-cloak x-show="tab === 'rent'" class="space-y-4">
            @forelse ($cart['rent'] as $index => $item)
                <div class="bg-white rounded-2xl shadow p-4 flex gap-4 items-center">
                    <img src="{{ $item['cover'] }}" alt="{{ $item['title'] }}" class="w-16 h-20 rounded-xl object-cover">
                    <div class="flex-1">
                        <p class="font-semibold">{{ $item['title'] }}</p>
                        <p class="text-sm text-slate-500">{{ $item['months'] }} Semester</p>
                        <p class="text-sm text-slate-500">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="text-lg font-bold">Rp {{ number_format($item['price'] * $item['months'], 0, ',', '.') }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.remove') }}">
                        @csrf
                        <input type="hidden" name="mode" value="rent">
                        <input type="hidden" name="index" value="{{ $index }}">
                        <button type="submit" class="text-xs text-red-500">Remove</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-sm text-slate-500">Belum ada buku yang disewa.</p>
            @endforelse
            <div class="bg-white rounded-2xl shadow p-4 flex justify-between font-semibold">
                <span>Subtotal Sewa</span>
                <span>Rp {{ number_format($rentSubtotal, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-4 space-y-2">
            <div class="flex justify-between text-sm text-slate-500">
                <span>Total Beli</span>
                <span>Rp {{ number_format($buySubtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-slate-500">
                <span>Total Sewa</span>
                <span>Rp {{ number_format($rentSubtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-lg font-bold">
                <span>Grand Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <button class="w-full bg-blue-600 text-white rounded-full py-3 font-semibold mt-3">Checkout</button>
        </div>
    </div>
</div>
@endsection
