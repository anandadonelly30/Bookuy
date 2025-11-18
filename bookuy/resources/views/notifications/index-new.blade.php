<x-guest-layout>
    <!-- Header -->
    <div class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-text-primary">Notifications</h1>
            
            <!-- Mark All as Read Button -->
            <button class="text-sm font-medium text-primary hover:text-blue-600">
                Mark all as read
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-4 space-y-6 pb-24">
        
        @forelse($notifications as $dateGroup => $items)
            <div class="space-y-3">
                <!-- Date Header -->
                <h2 class="text-sm font-semibold text-text-secondary uppercase tracking-wide">{{ $dateGroup }}</h2>
                
                <!-- Notification Cards -->
                <div class="space-y-2">
                    @foreach($items as $notification)
                        <div class="bg-white rounded-xl p-4 border border-gray-200 {{ $notification->read_at ? '' : 'border-l-4 border-l-primary bg-primary/5' }} hover:shadow-md transition-shadow">
                            <div class="flex items-start space-x-3">
                                <!-- Icon -->
                                <div class="flex-shrink-0">
                                    @php
                                        $iconClass = 'bg-primary/10 text-primary';
                                        $icon = '';
                                        
                                        switch($notification->icon ?? 'default') {
                                            case 'discount':
                                            case 'promo':
                                                $iconClass = 'bg-orange/10 text-orange';
                                                $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>';
                                                break;
                                            case 'wallet':
                                            case 'payment':
                                                $iconClass = 'bg-success/10 text-success';
                                                $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>';
                                                break;
                                            case 'service':
                                            case 'info':
                                                $iconClass = 'bg-purple-100 text-purple-500';
                                                $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                                                break;
                                            case 'order':
                                                $iconClass = 'bg-primary/10 text-primary';
                                                $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>';
                                                break;
                                            default:
                                                $iconClass = 'bg-gray-100 text-gray-500';
                                                $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>';
                                        }
                                    @endphp
                                    
                                    <div class="w-12 h-12 {{ $iconClass }} rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            {!! $icon !!}
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between mb-1">
                                        <h3 class="text-sm font-semibold text-text-primary">{{ $notification->title }}</h3>
                                        @if(!$notification->read_at)
                                            <div class="flex-shrink-0 w-2 h-2 bg-primary rounded-full ml-2 mt-1"></div>
                                        @endif
                                    </div>
                                    <p class="text-sm text-text-secondary leading-relaxed">{{ $notification->message }}</p>
                                    
                                    <!-- Time -->
                                    <p class="text-xs text-text-secondary mt-2">
                                        {{ $notification->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons (Optional) -->
                            @if($notification->action_url)
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <a href="{{ $notification->action_url }}" class="text-sm font-medium text-primary hover:text-blue-600 flex items-center">
                                        View Details
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
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
