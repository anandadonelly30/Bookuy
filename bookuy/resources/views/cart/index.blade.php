<x-guest-layout>
    <div class="flex flex-col min-h-full bg-page-bg">
        <!-- Header -->
        <div class="bg-primary text-white px-4 py-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo/Logo White.png') }}" alt="Bookuy" class="h-8 w-8 rounded-lg object-contain">
                    <h1 class="text-xl font-bold font-header">Keranjang</h1>
                </div>
            </div>
        </div>

        <div class="flex-1 px-4 py-6 pb-28">
            <!-- Tabs: Beli / Sewa -->
            <div class="flex gap-3 mb-6">
                <a href="{{ route('cart.index', ['type' => 'sell']) }}" 
                   class="flex-1 py-3 rounded-full font-semibold text-center transition-all {{ $activeType === 'sell' ? 'bg-primary text-white shadow-lg' : 'bg-white text-gray-600 border border-gray-200' }}">
                    Beli
                </a>
                <a href="{{ route('cart.index', ['type' => 'rent']) }}" 
                   class="flex-1 py-3 rounded-full font-semibold text-center transition-all {{ $activeType === 'rent' ? 'bg-primary text-white shadow-lg' : 'bg-white text-gray-600 border border-gray-200' }}">
                    Sewa
                </a>
            </div>

            @if($cartItems->isEmpty())
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-12">
                    <!-- Illustration: Cart dengan paket -->
                    <div class="relative w-64 h-64 mb-6">
                        <!-- Background gradient circle -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full opacity-60"></div>
                        
                        <!-- Cart illustration -->
                        <svg viewBox="0 0 240 240" class="w-full h-full relative z-10">
                            <!-- Packages floating around -->
                            <g opacity="0.7">
                                <!-- Box 1 - top left -->
                                <rect x="40" y="50" width="35" height="35" fill="#FFA500" rx="4" transform="rotate(-15 57.5 67.5)"/>
                                <rect x="42" y="52" width="31" height="15" fill="#FF8C00" rx="2" transform="rotate(-15 57.5 59.5)"/>
                                
                                <!-- Box 2 - top right -->
                                <rect x="165" y="45" width="30" height="30" fill="#4A90E2" rx="4" transform="rotate(20 180 60)"/>
                                <rect x="167" y="47" width="26" height="12" fill="#357ABD" rx="2" transform="rotate(20 180 53)"/>
                                
                                <!-- Box 3 - bottom left -->
                                <rect x="30" y="160" width="28" height="28" fill="#FFB84D" rx="4" transform="rotate(10 44 174)"/>
                                
                                <!-- Box 4 - bottom right -->
                                <rect x="180" y="165" width="32" height="32" fill="#5DADE2" rx="4" transform="rotate(-12 196 181)"/>
                            </g>
                            
                            <!-- Main cart -->
                            <g transform="translate(70, 80)">
                                <!-- Cart body - perspective box -->
                                <path d="M20,30 L80,30 L75,75 L25,75 Z" fill="#3B82F6" opacity="0.9"/>
                                <path d="M80,30 L95,20 L90,65 L75,75 Z" fill="#2563EB" opacity="0.8"/>
                                <path d="M20,30 L35,20 L95,20 L80,30 Z" fill="#60A5FA" opacity="0.85"/>
                                
                                <!-- Cart handle -->
                                <path d="M10,20 L15,25 L20,30" stroke="#1E40AF" stroke-width="3" fill="none" stroke-linecap="round"/>
                                
                                <!-- Wheels -->
                                <circle cx="35" cy="85" r="8" fill="#1F2937"/>
                                <circle cx="35" cy="85" r="5" fill="#374151"/>
                                <circle cx="65" cy="85" r="8" fill="#1F2937"/>
                                <circle cx="65" cy="85" r="5" fill="#374151"/>
                            </g>
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-text-primary mb-2 font-header">Your Cart Is Empty!</h2>
                    <p class="text-text-secondary text-center mb-8 px-8 text-sm">When you add products, they'll appear here.</p>
                    <a href="{{ route('dashboard') }}" class="px-10 py-3.5 bg-orange text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:bg-orange/90">
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
    </div>

    <!-- Bottom Navigation -->
    <div class="px-4 pb-6">
        <x-bottom-navigation />
    </div>

    @push('scripts')
    <script>

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
