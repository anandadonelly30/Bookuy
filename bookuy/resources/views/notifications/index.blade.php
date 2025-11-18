<x-guest-layout>
    <!-- Header Biru dengan Logo Bookuy -->
    <div class="bg-primary px-4 py-4">
        <div class="flex items-center justify-between mb-4">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="p-1">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            
            <!-- Logo Bookuy -->
            <img src="{{ asset('logo/Logo%20White.jpeg') }}" alt="Bookuy" class="h-8 rounded-lg object-contain">
        </div>
        
        <!-- Title -->
        <h1 class="text-2xl font-bold font-header text-white text-center">Notifications</h1>
    </div>

    <!-- Main Content dengan Background Putih Rounded Top -->
    <div class="bg-white rounded-t-3xl -mt-4 px-4 py-6 space-y-4 pb-24">
        
        @forelse($notifications as $dateGroup => $items)
            <div class="space-y-3">
                <!-- Date Header -->
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ $dateGroup }}</h2>
                
                <!-- Notification Cards -->
                <div class="space-y-2">
                    @foreach($items as $notification)
                        <div class="flex items-start space-x-3 py-3 border-b border-gray-100 last:border-b-0">
                            <!-- Icon -->
                            <div class="flex-shrink-0 mt-0.5">
                                @php
                                    $iconClass = 'text-gray-600';
                                    $icon = '';
                                    
                                    switch($notification->type ?? 'default') {
                                        case 'discount':
                                        case 'promo':
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>';
                                            break;
                                        case 'wallet':
                                        case 'payment':
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>';
                                            break;
                                        case 'service':
                                        case 'info':
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>';
                                            break;
                                        case 'card':
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>';
                                            break;
                                        case 'success':
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                            break;
                                        default:
                                            $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>';
                                    }
                                @endphp
                                
                                <svg class="w-5 h-5 {{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icon !!}
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-text-primary mb-0.5">{{ $notification->title }}</h3>
                                <p class="text-xs text-text-secondary leading-relaxed">{{ $notification->message }}</p>
                            </div>
                            
                            <!-- Blue Dot for Unread -->
                            @if(!$notification->read_at)
                                <div class="flex-shrink-0">
                                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                    <svg class="w-12 h-12 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-text-primary mb-2">No notifications yet</h3>
                <p class="text-sm text-text-secondary">You'll see updates about your orders and promotions here</p>
            </div>
        @endforelse

    </div>

    <!-- Bottom Navigation -->
    <x-bottom-navigation />

</x-guest-layout>
