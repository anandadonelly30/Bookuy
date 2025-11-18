
<x-guest-layout>
    <!-- Header Biru dengan Back Button -->
    <div class="bg-primary px-4 py-4">
        <div class="flex items-center">
            <a href="{{ route('checkout.index') }}" class="mr-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-semibold font-header text-white">Address</h1>
        </div>
    </div>

    <!-- Main Content - Saved Addresses -->
    <div class="bg-white px-4 py-4 space-y-3 pb-24">
        
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Saved Address</h2>
        
        <!-- Address List -->
        <div class="space-y-3">
            @forelse($addresses as $address)
                <div class="border border-gray-200 rounded-lg p-3 hover:border-primary transition-colors {{ $address->is_default ? 'border-primary bg-blue-50/30' : '' }}">
                    <div class="flex items-start space-x-3">
                        <!-- Radio Button -->
                        <form action="{{ route('address.setDefault', $address) }}" method="POST" class="mt-0.5">
                            @csrf
                            @method('PATCH')
                            <input 
                                type="radio" 
                                name="is_default" 
                                class="w-4 h-4 text-primary border-gray-300 focus:ring-primary" 
                                {{ $address->is_default ? 'checked' : '' }}
                                onchange="this.form.submit()">
                        </form>
                        
                        <!-- Address Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-1">
                                <p class="text-sm font-semibold text-gray-900">{{ $address->nickname }}</p>
                                @if($address->is_default)
                                    <span class="ml-2 px-2 py-0.5 bg-primary text-white text-[10px] font-medium rounded">Default</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $address->full_address }}</p>
                            @if($address->department)
                                <p class="text-xs text-gray-500 mt-1">{{ $address->department }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600 text-sm mb-1">No saved addresses yet</p>
                    <p class="text-xs text-gray-500">Add your first delivery address</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Fixed Bottom Buttons - Inside Mobile Frame -->
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[430px] bg-white border-t border-gray-200 px-4 py-3 space-y-2 rounded-b-[32px]">
        <!-- Add New Address Button -->
        <a href="{{ route('address.create') }}" class="block w-full py-3 bg-white border border-gray-300 text-gray-700 text-center text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Add New Address</span>
        </a>
        
        <!-- Apply Button -->
        <a href="{{ route('checkout.index') }}" class="block w-full py-3 bg-primary text-white text-center text-sm font-semibold rounded-lg hover:bg-blue-600 transition-colors">
            Apply
        </a>
    </div>

</x-guest-layout>