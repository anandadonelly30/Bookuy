<x-guest-layout>
    <div class="min-h-screen bg-page-bg pb-24">
        <!-- Header -->
        <div class="bg-primary text-white px-4 py-4 sticky top-0 z-10 shadow-md">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-xl font-bold">Keranjang</h1>
            </div>
        </div>

        <div class="px-4 py-6">
            <!-- Tabs: Beli / Sewa -->
            <div class="flex gap-3 mb-6">
                <button class="tab-btn flex-1 py-3 rounded-xl font-semibold transition-all bg-primary text-white shadow-md" onclick="switchTab('beli')">
                    Beli
                </button>
                <button class="tab-btn flex-1 py-3 rounded-xl font-semibold transition-all bg-white text-text-primary border border-border-gray" onclick="switchTab('sewa')">
                    Sewa
                </button>
            </div>

            @if($cartItems->isEmpty())
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="w-52 h-52 mb-6 relative">
                        <!-- Empty Cart Illustration -->
                        <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <circle cx="100" cy="100" r="90" fill="#F1F5F9" opacity="0.5"/>
                            <path d="M60 80 L140 80 L130 140 L70 140 Z" fill="#CBD5E1"/>
                            <circle cx="80" cy="155" r="10" fill="#64748B"/>
                            <circle cx="120" cy="155" r="10" fill="#64748B"/>
                            <path d="M50 65 L65 65 L75 95 L150 95" stroke="#94A3B8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="85" y1="110" x2="125" y2="110" stroke="#94A3B8" stroke-width="3" stroke-linecap="round"/>
                            <line x1="85" y1="120" x2="115" y2="120" stroke="#94A3B8" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-text-primary mb-2">Your Cart Is Empty!</h2>
                    <p class="text-text-secondary text-center mb-8 px-8">When you add products, they'll appear here.</p>
                    <a href="{{ route('dashboard') }}" class="px-10 py-3 bg-gradient-to-r from-orange to-orange/90 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all">
                        Go Shop
                    </a>
                </div>
            @else
                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                    <div class="bg-white rounded-2xl p-4 shadow-card">
                        <div class="flex gap-4">
                            <!-- Product Image -->
                            <div class="w-24 h-32 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl overflow-hidden flex-shrink-0">
                                @if($item->product->image_url)
                                <img src="{{ $item->product->image_url }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-primary">
                                    {{ substr($item->product->name, 0, 1) }}
                                </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1 mr-2">
                                        <h3 class="font-bold text-text-primary mb-1 line-clamp-2">{{ $item->product->name }}</h3>
                                        @if($item->product->author)
                                        <p class="text-xs text-text-secondary">by {{ $item->product->author }}</p>
                                        @endif
                                        @if($item->type === 'rent')
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-orange/10 text-orange text-xs rounded-full font-semibold">Sewa</span>
                                        @endif
                                    </div>
                                    <button onclick="removeFromCart({{ $item->id }})" class="text-danger hover:bg-danger/10 p-2 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Price & Quantity -->
                                <div class="flex justify-between items-end mt-3">
                                    <div>
                                        <p class="text-lg font-bold text-primary">
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                        </p>
                                        @if($item->quantity > 1)
                                        <p class="text-xs text-text-secondary mt-0.5">
                                            Total: Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </p>
                                        @endif
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-3 bg-page-bg rounded-xl px-3 py-2">
                                        <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                                class="text-primary hover:text-primary-dark transition-colors {{ $item->quantity <= 1 ? 'opacity-30 cursor-not-allowed' : '' }}"
                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <span class="text-text-primary font-bold w-6 text-center">{{ $item->quantity }}</span>
                                        <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                                class="text-primary hover:text-primary-dark transition-colors {{ $item->quantity >= $item->product->stock ? 'opacity-30 cursor-not-allowed' : '' }}"
                                                {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary Card -->
                <div class="bg-white rounded-2xl p-5 shadow-card mb-6">
                    <h3 class="font-bold text-text-primary mb-4 text-lg">Order Summary</h3>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-text-secondary">
                            <span>Sub-total</span>
                            <span class="font-semibold text-text-primary">Rp {{ number_format($subTotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-text-secondary">
                            <span>Biaya Admin ({{ $adminFee > 0 ? '2%' : '0%' }})</span>
                            <span class="font-semibold text-text-primary">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-text-secondary">
                            <span>Shipping fee</span>
                            <span class="font-semibold text-text-primary">Rp {{ number_format($shippingFee, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-t-2 border-border-light pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-text-primary font-bold text-lg">Total</span>
                            <span class="text-2xl font-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout.index') }}" 
                       class="block w-full py-4 bg-gradient-to-r from-primary to-primary-dark text-white text-center rounded-2xl font-bold text-lg hover:shadow-lg transition-all">
                        Go To Checkout
                    </a>
                </div>
            @endif
        </div>

        <!-- Bottom Navigation -->
        @include('components.bottom-navigation', ['active' => 'cart'])
    </div>

    @push('scripts')
    <script>
        function switchTab(tab) {
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white', 'shadow-md');
                btn.classList.add('bg-white', 'text-text-primary', 'border', 'border-border-gray');
            });
            event.target.classList.remove('bg-white', 'text-text-primary', 'border', 'border-border-gray');
            event.target.classList.add('bg-primary', 'text-white', 'shadow-md');
            
            window.location.href = `{{ route('cart.index') }}?type=${tab}`;
        }

        function updateQuantity(cartItemId, newQuantity) {
            if (newQuantity < 1) return;

            fetch(`/cart/update/${cartItemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('⚠ ' + (data.message || 'Failed to update quantity'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('⚠ Failed to update quantity');
            });
        }

        function removeFromCart(cartItemId) {
            if (!confirm('Remove this item from cart?')) return;

            fetch(`/cart/remove/${cartItemId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('⚠ ' + (data.message || 'Failed to remove item'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('⚠ Failed to remove item');
            });
        }
    </script>
    @endpush
</x-guest-layout>
