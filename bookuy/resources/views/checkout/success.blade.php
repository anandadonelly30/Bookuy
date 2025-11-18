<x-guest-layout>
    <div class="flex flex-col min-h-full bg-gradient-to-br from-primary via-blue-500 to-blue-600">
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center px-6 py-12">
            
            <!-- Success Illustration -->
            <div class="relative w-72 h-72 mb-8">
                <!-- Celebration character illustration -->
                <svg viewBox="0 0 280 280" class="w-full h-full">
                    <!-- Moon background -->
                    <circle cx="200" cy="80" r="60" fill="#FDB022" opacity="0.9"/>
                    
                    <!-- Character with cape -->
                    <g transform="translate(100, 120)">
                        <!-- Cape -->
                        <path d="M0,40 Q-30,20 -25,60 L-20,90 Q-10,85 0,80 Z" fill="#1E3A8A" opacity="0.8"/>
                        <path d="M0,40 Q30,20 25,60 L20,90 Q10,85 0,80 Z" fill="#1E40AF" opacity="0.9"/>
                        
                        <!-- Body -->
                        <ellipse cx="0" cy="60" rx="25" ry="35" fill="#3B82F6"/>
                        
                        <!-- Head -->
                        <circle cx="0" cy="20" r="20" fill="#FCD34D"/>
                        
                        <!-- Graduation cap -->
                        <rect x="-18" y="5" width="36" height="8" rx="2" fill="#1F2937"/>
                        <polygon points="0,-8 -25,5 25,5" fill="#1F2937"/>
                        <circle cx="22" cy="5" r="3" fill="#DC2626"/>
                        
                        <!-- Face details -->
                        <circle cx="-6" cy="18" r="2" fill="#1F2937"/>
                        <circle cx="6" cy="18" r="2" fill="#1F2937"/>
                        <path d="M-4,24 Q0,27 4,24" stroke="#1F2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                        
                        <!-- Arms raised -->
                        <rect x="-35" y="45" width="12" height="30" rx="6" fill="#FCD34D" transform="rotate(-45 -29 60)"/>
                        <rect x="23" y="45" width="12" height="30" rx="6" fill="#FCD34D" transform="rotate(45 29 60)"/>
                        
                        <!-- Legs -->
                        <rect x="-15" y="90" width="12" height="35" rx="6" fill="#1E40AF"/>
                        <rect x="3" y="90" width="12" height="35" rx="6" fill="#1E40AF"/>
                        <ellipse cx="-9" cy="128" rx="10" ry="6" fill="#1F2937"/>
                        <ellipse cx="9" cy="128" rx="10" ry="6" fill="#1F2937"/>
                    </g>
                    
                    <!-- Package/Book -->
                    <g transform="translate(220, 180)">
                        <rect x="-20" y="-15" width="40" height="30" rx="4" fill="#F59E0B"/>
                        <rect x="-20" y="-15" width="40" height="12" rx="2" fill="#D97706"/>
                        <rect x="-18" y="-2" width="8" height="2" fill="#FBBF24"/>
                        <rect x="-18" y="3" width="12" height="2" fill="#FBBF24"/>
                    </g>
                    
                    <!-- Confetti -->
                    <circle cx="40" cy="60" r="4" fill="#EF4444"/>
                    <circle cx="240" cy="120" r="3" fill="#10B981"/>
                    <circle cx="60" cy="200" r="4" fill="#FBBF24"/>
                    <rect x="220" y="40" width="6" height="6" fill="#8B5CF6" rx="1"/>
                    <rect x="30" y="140" width="5" height="5" fill="#EC4899" rx="1"/>
                    <circle cx="250" cy="180" r="3" fill="#3B82F6"/>
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-white mb-3 font-header">Congratulations!</h2>
            <p class="text-white/90 text-center mb-8">Your order has been placed</p>
            
            <!-- Success checkmark -->
            <div class="flex items-center justify-center w-20 h-20 bg-white rounded-full mb-8 shadow-xl">
                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <!-- Action Button -->
            <a href="{{ route('dashboard') }}" 
               class="w-full max-w-xs px-8 py-4 bg-white text-primary text-center text-base font-semibold rounded-xl hover:bg-gray-50 transition-colors shadow-xl flex items-center justify-center space-x-2">
                <span>Track Your Order</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Hidden extra content (can be removed for clean success page) -->
    <div class="hidden">
        <!-- Order Status Timeline -->
        <div class="bg-white rounded-xl p-4 border border-gray-200">
            <h3 class="text-base font-semibold text-text-primary mb-4">Order Status</h3>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <!-- Status Items -->
                <div class="space-y-6">
                    <!-- Packing - Active -->
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary border-4 border-white z-10">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-text-primary">Order Placed</p>
                            <p class="text-xs text-text-secondary">{{ now()->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <!-- Picked - Pending -->
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 border-4 border-white z-10">
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary">Processing</p>
                            <p class="text-xs text-text-secondary">Preparing your order</p>
                        </div>
                    </div>

                    <!-- In Transit - Pending -->
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 border-4 border-white z-10">
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary">Out for Delivery</p>
                            <p class="text-xs text-text-secondary">On the way to you</p>
                        </div>
                    </div>

                    <!-- Delivered - Pending -->
                    <div class="relative flex items-start">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 border-4 border-white z-10">
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary">Delivered</p>
                            <p class="text-xs text-text-secondary">Package arrived</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delivery Map (Placeholder) -->
        <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
            <div class="relative h-48 bg-gradient-to-br from-blue-100 to-blue-200">
                <!-- Map Placeholder -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-16 h-16 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                
                <!-- Delivery Pin -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-full">
                    <svg class="w-10 h-10 text-danger drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Courier Information -->
        <div class="bg-white rounded-xl p-4 border border-gray-200">
            <h3 class="text-base font-semibold text-text-primary mb-4">Courier Information</h3>
            
            <div class="flex items-center space-x-4">
                <!-- Courier Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-blue-500 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Courier Details -->
                <div class="flex-1">
                    <p class="text-sm font-semibold text-text-primary">{{ $order->courier_name ?? 'John Doe' }}</p>
                    <p class="text-xs text-text-secondary mb-1">Courier</p>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-orange fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-xs font-medium text-text-primary">4.8</span>
                        <span class="text-xs text-text-secondary">(120 reviews)</span>
                    </div>
                </div>
                
                <!-- Call Button -->
                <a href="tel:+628123456789" class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-success rounded-full hover:bg-green-600 transition-colors">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-xl p-4 border border-gray-200">
            <h3 class="text-base font-semibold text-text-primary mb-4">Order Summary</h3>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-text-secondary">Total Amount</span>
                    <span class="text-base font-bold text-primary">Rp {{ number_format($order->total ?? 185000, 0, ',', '.') }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm text-text-secondary">Payment Method</span>
                    <span class="text-sm font-medium text-text-primary">{{ $order->payment_method ?? 'E-Wallet' }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm text-text-secondary">Order Date</span>
                    <span class="text-sm font-medium text-text-primary">{{ ($order->created_at ?? now())->format('d M Y') }}</span>
                </div>
            </div>
        </div>

    </div>

</x-guest-layout>