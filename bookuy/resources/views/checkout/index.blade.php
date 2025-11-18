<x-guest-layout>
    <div class="flex flex-col min-h-full bg-page-bg">
        <!-- Header dengan Back Button -->
        <div class="bg-primary text-white px-4 py-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-xl font-bold font-header">Checkout</h1>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex-1 flex flex-col">
            @csrf
            
            <!-- Main Content -->
            <div class="flex-1 px-4 py-4 space-y-4 pb-32">
            
            <!-- Delivery Address Section -->
            <div class="bg-white rounded-xl p-4 border border-gray-200">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-base font-semibold text-text-primary">Delivery Address</h2>
                    <a href="{{ route('address.index') }}" class="text-sm font-medium text-primary">Change</a>
                </div>
                
                @if($defaultAddress)
                    <div class="flex items-start space-x-3">
                        <!-- Icon Lokasi -->
                        <div class="flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-text-primary mb-1">{{ $defaultAddress->nickname }}</p>
                            <p class="text-sm text-text-secondary leading-relaxed">{{ $defaultAddress->full_address }}</p>
                            @if($defaultAddress->department)
                                <p class="text-xs text-text-secondary mt-1">Department: {{ $defaultAddress->department }}</p>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="address_id" value="{{ $defaultAddress->id }}">
                @else
                    <div class="text-center py-4">
                        <p class="text-sm text-danger mb-3">You don't have a delivery address yet!</p>
                        <a href="{{ route('address.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Address
                        </a>
                    </div>
                @endif
            </div>

            <!-- Payment Method Section -->
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <h2 class="text-base font-semibold text-text-primary mb-4 font-header">Payment Method</h2>
                
                <div class="flex gap-3 mb-4">
                    <!-- Card Option -->
                    <label class="flex-1 cursor-pointer payment-option">
                        <input type="radio" name="payment_method" value="card" class="hidden peer" checked>
                        <div class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-text-primary">Card</p>
                        </div>
                    </label>

                    <!-- Cash Option -->
                    <label class="flex-1 cursor-pointer payment-option">
                        <input type="radio" name="payment_method" value="cash" class="hidden peer">
                        <div class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                            <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-text-primary">Cash</p>
                        </div>
                    </label>

                    <!-- Apple Pay Option -->
                    <label class="flex-1 cursor-pointer payment-option">
                        <input type="radio" name="payment_method" value="apple_pay" class="hidden peer">
                        <div class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                            <div class="w-12 h-12 bg-black rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-text-primary">Pay</p>
                        </div>
                    </label>
                </div>

                <!-- Card Details (shown when Card is selected) -->
                <div class="bg-gradient-to-r from-primary to-blue-600 rounded-xl p-4 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-xs opacity-90">Card Number</div>
                        <svg class="w-8 h-6" viewBox="0 0 32 24" fill="none">
                            <rect width="32" height="24" rx="4" fill="white" opacity="0.2"/>
                            <circle cx="12" cy="12" r="6" fill="white" opacity="0.8"/>
                            <circle cx="20" cy="12" r="6" fill="white" opacity="0.6"/>
                        </svg>
                    </div>
                    <div class="text-lg font-semibold tracking-wider mb-4">VISA **** **** **** 2512</div>
                    <div class="flex justify-between items-end">
                        <div>
                            <div class="text-xs opacity-90 mb-1">Card Holder</div>
                            <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                        </div>
                        <button type="button" class="text-white/90 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="bg-white rounded-xl p-4 border border-gray-200">
                <h2 class="text-base font-semibold text-text-primary mb-4">Order Summary</h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-secondary">Sub-total</span>
                        <span class="text-sm font-medium text-text-primary">Rp {{ number_format($subTotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-secondary">Admin fee</span>
                        <span class="text-sm font-medium text-text-primary">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-secondary">Shipping fee</span>
                        <span class="text-sm font-medium text-text-primary">Rp {{ number_format($shippingFee, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="border-t border-gray-200 my-3"></div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-base font-semibold text-text-primary">Total</span>
                        <span class="text-lg font-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Promo Code Section -->
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <div class="flex items-center space-x-2">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <input 
                            type="text" 
                            name="promo_code"
                            placeholder="Enter promo code" 
                            class="w-full pl-10 pr-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-text-primary placeholder-gray-400">
                    </div>
                    <button 
                        type="button" 
                        onclick="applyPromo()"
                        class="px-6 py-3 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition-colors">
                        Add
                    </button>
                </div>
            </div>

            </div>

            <!-- Fixed Bottom Button -->
            <div class="px-4 py-4 bg-white border-t border-gray-100">
                <button 
                    type="submit" 
                    @if(!$defaultAddress) disabled @endif
                    class="w-full py-4 bg-primary text-white text-base font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg disabled:bg-gray-300 disabled:cursor-not-allowed flex items-center justify-center space-x-2">
                    <span>Place Order</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </div>

        </form>
    </div>

    <script>
        // Payment method selection highlight
        document.querySelectorAll('.payment-option input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.payment-option').forEach(option => {
                    option.classList.remove('border-primary', 'bg-primary/5');
                });
                if(this.checked) {
                    this.closest('.payment-option').classList.add('border-primary', 'bg-primary/5');
                }
            });
        });

        // Initialize first payment method as selected
        document.addEventListener('DOMContentLoaded', function() {
            const firstRadio = document.querySelector('.payment-option input[type="radio"]:checked');
            if(firstRadio) {
                firstRadio.closest('.payment-option').classList.add('border-primary', 'bg-primary/5');
            }
        });

        // Promo code apply function
        function applyPromo() {
            const promoInput = document.querySelector('input[name="promo_code"]');
            const promoCode = promoInput.value.trim();
            
            if(promoCode === '') {
                alert('Please enter a promo code');
                return;
            }

            // Here you would typically make an AJAX call to validate the promo code
            // For now, we'll just show success message
            document.getElementById('promo-success').classList.remove('hidden');
            
            setTimeout(() => {
                document.getElementById('promo-success').classList.add('hidden');
            }, 3000);
        }
    </script>

</x-guest-layout>