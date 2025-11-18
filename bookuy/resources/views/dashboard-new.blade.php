<x-guest-layout>
    <div class="min-h-screen bg-page-bg pb-20">
        <!-- Header dengan Search -->
        <div class="bg-primary text-white px-4 py-4 sticky top-0 z-10 shadow-md">
            <div class="max-w-7xl mx-auto">
                <!-- Header Title & Profile -->
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold">Bookuy</h1>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('notifications.index') }}" class="relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 block h-2 w-2 rounded-full bg-danger"></span>
                        </a>
                        <a href="{{ route('profile.edit') }}">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff" 
                                 alt="Profile" class="w-9 h-9 rounded-full border-2 border-white">
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <form method="GET" action="{{ route('dashboard') }}" class="relative" id="searchForm">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search books, authors..." 
                           class="w-full px-4 py-3 pl-12 pr-14 rounded-2xl text-text-primary border-0 focus:ring-2 focus:ring-primary-light shadow-sm">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <button type="button" 
                            onclick="document.getElementById('filterModal').classList.remove('hidden')" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-primary hover:bg-primary-dark text-white p-2 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-6">
            <!-- Kategori Pills -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-bold text-text-primary">Kategori</h2>
                    <a href="{{ route('dashboard') }}" class="text-primary text-sm font-semibold">See all</a>
                </div>
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                    <a href="{{ route('dashboard') }}" 
                       class="px-5 py-2 rounded-full whitespace-nowrap text-sm font-medium transition-all {{ !request('mata_kuliah') ? 'bg-primary text-white shadow-md' : 'bg-white text-text-primary border border-border-gray hover:border-primary' }}">
                        All
                    </a>
                    @foreach($categories as $category)
                    <a href="{{ route('dashboard', ['mata_kuliah' => $category] + request()->except('mata_kuliah')) }}" 
                       class="px-5 py-2 rounded-full whitespace-nowrap text-sm font-medium transition-all {{ request('mata_kuliah') == $category ? 'bg-primary text-white shadow-md' : 'bg-white text-text-primary border border-border-gray hover:border-primary' }}">
                        {{ $category }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Recommended Books -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-text-primary">Recommended for you</h2>
                    <button class="text-primary text-sm font-semibold">Clear all</button>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @forelse($recommendedBooks as $book)
                    <div class="bg-white rounded-2xl p-3 shadow-card hover:shadow-lg transition-all cursor-pointer" onclick="addToCart({{ $book->id }})">
                        <div class="aspect-[3/4] bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl mb-3 overflow-hidden relative">
                            @if($book->image_url)
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-primary">
                                {{ substr($book->name, 0, 1) }}
                            </div>
                            @endif
                            @if($book->type === 'rent')
                            <span class="absolute top-2 right-2 px-2 py-1 bg-orange text-white text-xs font-semibold rounded-full">Rent</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-sm text-text-primary mb-1 line-clamp-2 min-h-[2.5rem]">{{ $book->name }}</h3>
                        <p class="text-primary font-bold text-sm">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        @if($book->stock > 0)
                        <p class="text-success text-xs mt-1">{{ $book->stock }} available</p>
                        @else
                        <p class="text-danger text-xs mt-1">Out of stock</p>
                        @endif
                    </div>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <div class="text-6xl mb-3">📚</div>
                        <p class="text-text-secondary">No books found</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Popular Books -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-text-primary">Popular books</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @forelse($popularBooks as $book)
                    <div class="bg-white rounded-2xl p-3 shadow-card hover:shadow-lg transition-all">
                        <div class="aspect-[3/4] bg-gradient-to-br from-purple-100 to-pink-50 rounded-xl mb-3 overflow-hidden relative">
                            @if($book->image_url)
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-primary">
                                {{ substr($book->name, 0, 1) }}
                            </div>
                            @endif
                            @if($book->stock > 0)
                            <span class="absolute top-2 left-2 px-2 py-1 bg-success/90 text-white text-xs font-semibold rounded-full backdrop-blur-sm">
                                ✓ Available
                            </span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-sm text-text-primary mb-1 line-clamp-2 min-h-[2.5rem]">{{ $book->name }}</h3>
                        <p class="text-primary font-bold text-sm mb-2">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        <button onclick="addToCart({{ $book->id }})" 
                                class="w-full bg-primary hover:bg-primary-dark text-white py-2 rounded-xl text-xs font-semibold transition-colors">
                            Add to Cart
                        </button>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <div class="text-6xl mb-3">🔥</div>
                        <p class="text-text-secondary">No popular books yet</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Search Results (if searching) -->
            @if(request('search') || request('mata_kuliah') || request('location') || request('sort_by'))
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-text-primary">
                            @if(request('search'))
                                Search Results for "{{ request('search') }}"
                            @else
                                Filtered Results
                            @endif
                        </h2>
                        <p class="text-text-secondary text-sm">{{ $products->count() }} books found</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="text-danger text-sm font-semibold">Clear filters</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @forelse($products as $book)
                    <div class="bg-white rounded-2xl p-3 shadow-card hover:shadow-lg transition-all">
                        <div class="aspect-[3/4] bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl mb-3 overflow-hidden">
                            @if($book->image_url)
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-primary">
                                {{ substr($book->name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <h3 class="font-semibold text-sm text-text-primary mb-1 line-clamp-2 min-h-[2.5rem]">{{ $book->name }}</h3>
                        <p class="text-text-secondary text-xs mb-1">{{ $book->mata_kuliah }}</p>
                        <p class="text-primary font-bold text-sm mb-2">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        <button onclick="addToCart({{ $book->id }})" 
                                class="w-full bg-primary hover:bg-primary-dark text-white py-2 rounded-xl text-xs font-semibold transition-colors">
                            Add to Cart
                        </button>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl">
                        <div class="text-6xl mb-3">🔍</div>
                        <h3 class="text-lg font-semibold text-text-primary mb-2">No books found</h3>
                        <p class="text-text-secondary mb-4">Try adjusting your search or filters</p>
                        <a href="{{ route('dashboard') }}" class="inline-block px-6 py-2 bg-primary text-white rounded-xl font-medium hover:bg-primary-dark transition-colors">
                            Reset Filters
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
            @endif
        </div>

        <!-- Bottom Navigation -->
        @include('components.bottom-navigation', ['active' => 'home'])
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-end sm:items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-t-3xl sm:rounded-3xl w-full max-w-md max-h-[85vh] overflow-y-auto shadow-2xl">
            <form method="GET" action="{{ route('dashboard') }}" class="p-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-border-light">
                    <h3 class="text-xl font-bold text-text-primary">Filters</h3>
                    <button type="button" onclick="document.getElementById('filterModal').classList.add('hidden')" class="text-text-secondary hover:text-text-primary transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Preserve search query -->
                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <!-- Sort By -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-text-primary mb-3">Sort By</label>
                    <div class="grid grid-cols-1 gap-2">
                        <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all {{ request('sort_by', 'recommended') == 'recommended' ? 'border-primary bg-primary/5' : 'border-border-gray hover:border-primary/50' }}">
                            <input type="radio" name="sort_by" value="recommended" {{ request('sort_by', 'recommended') == 'recommended' ? 'checked' : '' }} class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm font-medium">Recommended</span>
                        </label>
                        <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all {{ request('sort_by') == 'price_low' ? 'border-primary bg-primary/5' : 'border-border-gray hover:border-primary/50' }}">
                            <input type="radio" name="sort_by" value="price_low" {{ request('sort_by') == 'price_low' ? 'checked' : '' }} class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm font-medium">Price: Low to High</span>
                        </label>
                        <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all {{ request('sort_by') == 'price_high' ? 'border-primary bg-primary/5' : 'border-border-gray hover:border-primary/50' }}">
                            <input type="radio" name="sort_by" value="price_high" {{ request('sort_by') == 'price_high' ? 'checked' : '' }} class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm font-medium">Price: High to Low</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-text-primary mb-3">Price Range</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs text-text-secondary mb-1 block">Min Price</label>
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="0" 
                                   class="w-full px-4 py-2 border-2 border-border-gray rounded-xl focus:border-primary focus:ring-0 transition-colors">
                        </div>
                        <div>
                            <label class="text-xs text-text-secondary mb-1 block">Max Price</label>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="999999" 
                                   class="w-full px-4 py-2 border-2 border-border-gray rounded-xl focus:border-primary focus:ring-0 transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Mata Kuliah -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-text-primary mb-3">Subject (Mata Kuliah)</label>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($categories as $category)
                        <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all {{ request('mata_kuliah') == $category ? 'border-primary bg-primary/5' : 'border-border-gray hover:border-primary/50' }}">
                            <input type="radio" name="mata_kuliah" value="{{ $category }}" 
                                   {{ request('mata_kuliah') == $category ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm">{{ $category }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Location -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-text-primary mb-3">Location</label>
                    <div class="space-y-2">
                        @foreach($locations as $location)
                        <label class="flex items-center p-3 border-2 rounded-xl cursor-pointer transition-all {{ request('location') == $location ? 'border-primary bg-primary/5' : 'border-border-gray hover:border-primary/50' }}">
                            <input type="checkbox" name="location" value="{{ $location }}" 
                                   {{ request('location') == $location ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary rounded">
                            <span class="ml-3 text-sm">{{ $location }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-border-light">
                    <a href="{{ route('dashboard') }}" 
                       class="flex-1 px-6 py-3 border-2 border-border-gray text-text-primary rounded-xl font-semibold text-center hover:bg-gray-50 transition-colors">
                        Reset
                    </a>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-orange hover:bg-orange/90 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function addToCart(productId) {
            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert('✓ Book added to cart!');
                    // Optionally reload to update cart count
                    location.reload();
                } else {
                    alert('⚠ ' + (data.message || 'Failed to add to cart'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('⚠ Failed to add to cart. Please try again.');
            });
        }

        // Close modal when clicking outside
        document.getElementById('filterModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        // Prevent form submit on Enter in search
        document.getElementById('searchForm')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.name !== 'search') {
                e.preventDefault();
            }
        });
    </script>
    @endpush
</x-guest-layout>
