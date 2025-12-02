@extends('layouts.app')

@section('content')
<!-- Loading Screen for Homepage -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-logo">
        <img src="{{ asset('Logo.png') }}" alt="Logo">
    </div>
    <div class="loading-spinner"></div>
</div>

<div id="homePage">
    <div class="home-page">
        <div class="home-header">
            <div class="welcome-section">
                <div class="logo-text">
                    <div class="logo-icon">
                        <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 10px;">
                    </div>
                    <div class="welcome-text">
                        <h3>Welcome</h3>
                        <p id="welcomeUserName">Farrell!</p>
                    </div>
                </div>
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>

            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search for Books...">
                <div class="filter-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <i class="fas fa-microphone mic-icon"></i>
            </div>
        </div>

        <div class="category-section">
            <div class="section-header">
                <h4>Kategori</h4>
                <a href="#" class="see-all">Lihat Semua</a>
            </div>
            <p style="color: #64748b; margin-bottom: 15px;">Pilih Kategori Bidang yang Kamu Inginkan</p>

            <div class="category-grid">
                <div class="category-card">
                    <div class="category-icon-box">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h6>Manajemen<br>Proses<br>Bisnis</h6>
                </div>
                <div class="category-card">
                    <div class="category-icon-box">
                        <i class="fas fa-code"></i>
                    </div>
                    <h6>Pemrograman</h6>
                </div>
            </div>
        </div>

        <div class="category-section">
            <div class="section-header">
                <h4>Recommended for you</h4>
            </div>

            <div class="recommended-grid" id="recommendedBooksGrid">
                <!-- Books will be loaded here dynamically -->
            </div>
        </div>

        <div class="category-section">
            <div class="section-header">
                <h4>Popular books</h4>
            </div>

            <div class="popular-list" id="popularBooksList">
                <!-- Popular books will be loaded here dynamically -->
            </div>
        </div>

        <div class="bottom-nav">
            <div class="nav-container">
                <a href="{{ url('/') }}" class="nav-item active">
                    <i class="fas fa-home"></i>
                </a>
                <div class="fab-button" onclick="window.location.href='{{ url('/items/create') }}'">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="{{ url('/profile') }}" class="nav-item">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Loading screen handler - only show once when first opening the website
    (function() {
        const loadingScreen = document.getElementById('loadingScreen');
        if (loadingScreen) {
            // Check if user has already seen the loading screen in this session
            if (sessionStorage.getItem('loadingScreenShown')) {
                // Already shown before, hide immediately
                loadingScreen.style.display = 'none';
            } else {
                // First time opening website, show loading screen for 2 seconds
                sessionStorage.setItem('loadingScreenShown', 'true');
                setTimeout(function() {
                    loadingScreen.classList.add('hidden');
                    // Remove from DOM after animation
                    setTimeout(function() {
                        loadingScreen.style.display = 'none';
                    }, 500);
                }, 2000);
            }
        }
    })();

    document.addEventListener('DOMContentLoaded', async function() {
        const userName = localStorage.getItem('user_name');
        if (userName) {
            document.getElementById('welcomeUserName').textContent = userName + '!';
        }

        try {
            const response = await fetch('{{ url('/api/seller-items') }}', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });

            const sellerItems = await response.json();

            const recommendedGrid = document.getElementById('recommendedBooksGrid');
            const popularList = document.getElementById('popularBooksList');

            sellerItems.forEach(item => {
                const book = item.book;
                if (book) {
                    // Recommended Books
                    const recommendedCard = `
                        <div class="book-card">
                            <div class="book-image" style="background-image: url(/storage/${book.image_url}); background-size: cover; background-position: center;"></div>
                            <div class="book-info">
                                <div class="book-title">${book.title}</div>
                                <div class="book-rating">
                                    <i class="fas fa-star"></i>
                                    <span>4.5 (2k)</span> <!-- Placeholder rating -->
                                </div>
                                <div class="book-price">Rp ${book.sell_price.toLocaleString('id-ID')}</div>
                            </div>
                        </div>
                    `;
                    recommendedGrid.insertAdjacentHTML('beforeend', recommendedCard);

                    // Popular Books (can be the same or different logic)
                    const popularItem = `
                        <div class="popular-item">
                            <div class="popular-image" style="background-image: url(/storage/${book.image_url}); background-size: cover; background-position: center;"></div>
                            <div class="popular-content">
                                <div>
                                    <div class="popular-title">${book.title}</div>
                                    <div class="popular-author">${book.author}</div>
                                    <div class="popular-reviews">
                                        <i class="fas fa-star"></i>
                                        <span>5.0 | Based on 23k Reviews</span> <!-- Placeholder reviews -->
                                    </div>
                                    <div class="popular-price">Rp ${book.sell_price.toLocaleString('id-ID')}</div>
                                </div>
                                <div style="display: flex; align-items: flex-end;">
                                    <button class="grab-btn">Grab Now</button>
                                </div>
                            </div>
                        </div>
                    `;
                    popularList.insertAdjacentHTML('beforeend', popularItem);
                }
            });

        } catch (error) {
            console.error('Error fetching seller items:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load books. Please try again later.',
            });
        }
    });
</script>
@endpush
