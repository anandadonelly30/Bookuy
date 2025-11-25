<x-guest-layout>
    <!-- Header dengan Profile Banner -->
    <div class="bg-primary px-4 pt-6 pb-24">
        <!-- Title dan Logo -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-base font-header text-white/80">Account</h1>
        </div>

        <!-- Profile Info Card -->
        <div class="bg-white rounded-3xl p-4 shadow-xl">
            <div class="flex items-center space-x-3">
                <!-- Profile Picture -->
                <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('logo/Logo Blue.png') }}" alt="Profile" class="w-full h-full object-contain bg-white p-1">
                    @endif
                </div>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <h2 class="text-lg font-bold text-text-primary truncate">{{ Auth::user()->name }}</h2>
                    <a href="{{ route('profile.edit') }}" class="text-xs text-primary hover:text-blue-600 flex items-center mt-0.5">
                        Edit Profile →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-t-[32px] -mt-20 px-5 py-6 space-y-6 pb-24">
        
        <!-- Account Security Section -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-text-primary">Account Security</h3>
            
            <div class="bg-white">
                <a href="#" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Privacy & Security</p>
                            <p class="text-xs text-text-secondary">Password & PIN, Security Stuff</p>
                        </div>
                    </div>
                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                </a>
            </div>
        </div>

        <!-- Purchase History Section -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-text-primary">Purchase History</h3>
            
            <div class="bg-white">
                <!-- Sales History -->
                <a href="#" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Sales History</p>
                            <p class="text-xs text-text-secondary">History Penjualanmu</p>
                        </div>
                    </div>
                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                </a>

                <!-- Purchase History -->
                <a href="#" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Purchase History</p>
                            <p class="text-xs text-text-secondary">History & Review</p>
                        </div>
                    </div>
                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                </a>
            </div>
        </div>

        <!-- Information Section -->
        <div class="space-y-3">
            <h3 class="text-xs font-bold text-text-primary">Information</h3>
            
            <div class="bg-white">
                <!-- Address -->
                <a href="{{ route('address.index') }}" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Address</p>
                            <p class="text-xs text-text-secondary">Set up address to your location!</p>
                        </div>
                    </div>
                </a>

                <!-- Payment -->
                <a href="#" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-text-primary">Payment</p>
                            <p class="text-xs text-text-secondary">Set up your payment method!</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="pt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full flex items-center justify-center space-x-2 py-2 text-danger text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </div>

    <!-- Bottom Navigation -->
    <x-bottom-navigation />

</x-guest-layout>
