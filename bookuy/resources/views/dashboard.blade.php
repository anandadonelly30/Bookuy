<x-guest-layout>
    <div class="min-h-screen bg-gray-50 pb-20">
        <!-- Header Biru dengan Welcome & Logo -->
        <div class="bg-primary text-white px-4 pt-3 pb-4">
            <!-- Top Bar: Logo & Cart -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('logo/Logo%20White.jpeg') }}" alt="Bookuy" class="h-10 w-10 rounded-lg object-contain">
                    <div class="leading-tight">
                        <p class="text-xs opacity-90">Welcome</p>
                        <p class="text-lg font-bold font-header">{{ explode(' ', Auth::user()->name)[0] }}</p>
                    </div>
                </div>
                <a href="{{ route('cart.index') }}" class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </a>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('dashboard') }}" id="searchForm" class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search our Books..." 
                       class="w-full pl-10 pr-12 py-2.5 rounded-full text-sm text-gray-700 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/30">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <button type="button" onclick="document.getElementById('filterModal').classList.remove('hidden')" class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-primary p-1.5 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </form>
        </div>

        <div class="px-4 py-4">
            <!-- Kategori Section -->
            <div class="mb-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Kategori</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Pilih Kategori Bidang yang Kamu Inginkan</p>
                    </div>
                    <span class="px-3 py-1 bg-orange text-white text-xs font-semibold rounded-full">Best Seller</span>
                </div>
                
                <!-- Kategori Cards - 2 Kolom -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Manajemen Proses Bisnis -->
                    <a href="{{ route('dashboard', ['mata_kuliah' => 'Manajemen Proses Bisnis']) }}" 
                       class="bg-primary rounded-2xl p-4 text-white relative overflow-hidden h-24 flex flex-col justify-between">
                        <div>
                            <p class="text-sm font-semibold leading-tight">Manajemen<br>Proses<br>Bisnis</p>
                        </div>
                        <div class="absolute bottom-2 right-2">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Pemrograman -->
                    <a href="{{ route('dashboard', ['mata_kuliah' => 'Pemrograman']) }}" 
                       class="bg-primary rounded-2xl p-4 text-white relative overflow-hidden h-24 flex flex-col justify-between">
                        <div>
                            <p class="text-sm font-semibold leading-tight">Pemrograman</p>
                        </div>
                        <div class="absolute bottom-2 right-2">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recommended for you -->
            <div class="mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-3">Recommended for you</h2>
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                    @forelse($recommendedBooks->take(6) as $book)
                    <div class="flex-shrink-0 w-32">
                        <div class="aspect-[3/4] bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl overflow-hidden relative shadow-sm mb-2">
                            @if($book->image_url)
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-primary mb-1">📖</div>
                                    <p class="text-xs text-gray-600 px-2 leading-tight">{{ $book->name }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <button onclick="addToCart({{ $book->id }})" 
                                class="w-full bg-primary text-white text-xs font-semibold py-1.5 rounded-lg hover:bg-blue-600 transition-colors">
                            Add to Cart
                        </button>
                    </div>
                    @empty
                    <div class="w-full text-center py-8">
                        <div class="text-6xl mb-3">📚</div>
                        <p class="text-gray-500">No books found</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Popular books -->
            <div class="mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-3">Popular books</h2>
                <div class="space-y-3">
                    @forelse($popularBooks->take(2) as $book)
                    <div class="bg-white rounded-2xl p-3 flex items-center space-x-3 shadow-sm">
                        <!-- Book Cover -->
                        <div class="w-16 h-20 flex-shrink-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg overflow-hidden">
                            @if($book->image_url)
                            <img src="{{ $book->image_url }}" 
                                 alt="{{ $book->name }}" 
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-primary">
                                📖
                            </div>
                            @endif
                        </div>
                        
                        <!-- Book Info -->
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-sm text-gray-900 mb-0.5 line-clamp-1">{{ $book->name }}</h3>
                            <p class="text-xs text-gray-500 mb-1 line-clamp-1">{{ $book->author ?? 'Unknown Author' }}</p>
                            <p class="text-primary font-bold text-sm">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <!-- Button -->
                        <button onclick="addToCart({{ $book->id }})" class="flex-shrink-0 px-4 py-2 bg-orange text-white text-xs font-semibold rounded-lg hover:bg-orange/90 transition-colors">
                            Add to Cart
                        </button>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="text-6xl mb-3">🔥</div>
                        <p class="text-gray-500">No popular books yet</p>
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
        function showToast(message, success = true) {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 left-1/2 -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg z-50 transition-all ${success ? 'bg-green-500' : 'bg-red-500'} text-white font-medium`;
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        }

        function addToCart(productId) {
            console.log('Adding product to cart:', productId);
            
            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showToast('✓ Book added to cart!');
                    // Update cart count in header if exists
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('⚠ ' + (data.message || 'Failed to add to cart'), false);
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                showToast('⚠ Failed to add to cart. Please try again.', false);
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
