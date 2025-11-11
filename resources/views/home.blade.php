<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farrel! - Digital Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .phone-container {
            max-width: 375px;
            margin: 20px auto;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .status-bar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 8px 20px;
            color: white;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: white;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .logo i {
            margin-right: 10px;
            font-size: 28px;
        }
        .search-box {
            background: rgba(255,255,255,0.2);
            border-radius: 25px;
            padding: 10px 15px;
            margin-top: 15px;
            display: flex;
            align-items: center;
        }
        .search-box input {
            background: transparent;
            border: none;
            color: white;
            width: 100%;
            outline: none;
        }
        .search-box input::placeholder {
            color: rgba(255,255,255,0.7);
        }
        .category-section {
            padding: 20px;
        }
        .category-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 15px;
        }
        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .category-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 20px;
            color: white;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .category-card i {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .book-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .book-info {
            padding: 15px;
        }
        .book-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .book-price {
            color: #667eea;
            font-size: 13px;
        }
        .borrowed-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 11px;
            display: inline-block;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            max-width: 375px;
            width: 100%;
            background: white;
            padding: 15px;
            display: flex;
            justify-content: space-around;
            border-radius: 25px 25px 0 0;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.1);
        }
        .nav-item {
            text-align: center;
            color: #999;
            cursor: pointer;
            transition: color 0.3s;
        }
        .nav-item.active {
            color: #667eea;
        }
        .nav-item i {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .filter-modal {
            background: white;
            border-radius: 25px 25px 0 0;
            padding: 25px;
        }
        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .filter-section {
            margin-bottom: 25px;
        }
        .filter-section h6 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .filter-btn {
            padding: 8px 20px;
            border-radius: 20px;
            border: 1px solid #667eea;
            color: #667eea;
            background: white;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .filter-btn.active {
            background: #667eea;
            color: white;
        }
        .apply-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 25px;
            width: 100%;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }
        .book-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .recent-search-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .search-text {
            font-size: 14px;
            color: #666;
        }
        .price-range {
            margin: 20px 0;
        }
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .tab-btn {
            flex: 1;
            padding: 8px;
            border-radius: 20px;
            border: 1px solid #667eea;
            background: white;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s;
        }
        .tab-btn.active {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Homepage -->
    <div class="phone-container" id="homepage">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>

        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <i class="fas fa-book-reader"></i>
                    <span>Farrel!</span>
                </div>
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="search-box" onclick="showSearch()">
                <i class="fas fa-search mr-2"></i>
                <input type="text" placeholder="Search for Books...">
                <i class="fas fa-sliders-h ml-2"></i>
            </div>
        </div>

        <div class="category-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="m-0"><strong>Kategori</strong></h6>
                <span class="category-badge">Pilih sesuai Bidang yang kamu-inginkan</span>
            </div>

            <div class="category-grid">
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-briefcase"></i>
                    <div>Manajemen<br>Proses</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-graduation-cap"></i>
                    <div>Pemrograman</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-file-alt"></i>
                    <div>Blanks</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-building"></i>
                    <div>Sistem<br>Enterprise</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-atom"></i>
                    <div>Fisika</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-flask"></i>
                    <div>Kimia</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-calculator"></i>
                    <div>Matematika</div>
                </div>
                <div class="category-card" onclick="showSearch()">
                    <i class="fas fa-database"></i>
                    <div>Database</div>
                </div>
            </div>

            <h6 class="section-title">Recommended for you</h6>
            <div class="book-grid">
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Matematika I</div>
                        <div class="book-price">Rp 32.500</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Fundamental MPI</div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
            </div>

            <h6 class="section-title mt-4">Popular books</h6>
            <div class="book-card" onclick="showProductDetail()">
                <div class="d-flex">
                    <div class="book-image" style="width: 100px; height: 120px;"></div>
                    <div class="book-info flex-grow-1">
                        <div class="book-title">Fundamental MPI</div>
                        <div class="text-muted small">By Author</div>
                        <div class="book-price mt-2">Rp 50.000</div>
                        <span class="borrowed-badge mt-2">Borrowed</span>
                    </div>
                </div>
            </div>
            <div style="height: 80px;"></div>
        </div>

        <div class="bottom-nav">
            <div class="nav-item active" onclick="showHome()">
                <div><i class="fas fa-home"></i></div>
            </div>
            <div class="nav-item">
                <div><i class="fas fa-plus-circle"></i></div>
            </div>
            <a href="/notifikasi" class="nav-item">
                <div><i class="fas fa-bell"></i></div>
            </a>
            <div class="nav-item" onclick="showProfile()">
                <div><i class="fas fa-user"></i></div>
            </div>
        </div>
    </div>

    <!-- Search Page (Hidden by default) -->
    <div class="phone-container" id="searchpage" style="display: none;">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>

        <div class="header">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-arrow-left mr-3" onclick="showHome()"></i>
                <div class="search-box flex-grow-1 m-0">
                    <i class="fas fa-search mr-2"></i>
                    <input type="text" placeholder="Search for Books..." onkeyup="if(event.keyCode === 13) showResults()">
                </div>
                <i class="fas fa-microphone ml-2"></i>
            </div>
            <div class="category-grid" style="grid-template-columns: repeat(4, 1fr); gap: 10px;">
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-briefcase" style="font-size: 20px;"></i>
                    <div>Manajemen<br>Proses</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-graduation-cap" style="font-size: 20px;"></i>
                    <div>Pemrograman</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-building" style="font-size: 20px;"></i>
                    <div>Sistem<br>Enterprise</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-cog" style="font-size: 20px;"></i>
                    <div>Ketenagaan</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-atom" style="font-size: 20px;"></i>
                    <div>Fisika</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-flask" style="font-size: 20px;"></i>
                    <div>Kimia</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-calculator" style="font-size: 20px;"></i>
                    <div>Meksolah</div>
                </div>
                <div class="category-card" style="padding: 15px; font-size: 11px;" onclick="showResults()">
                    <i class="fas fa-database" style="font-size: 20px;"></i>
                    <div>Database</div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="section-title m-0">Recent Searches</h6>
                <span style="color: #667eea; font-size: 14px; cursor: pointer;">Clear all</span>
            </div>

            <div class="recent-search-item">
                <span class="search-text">Matematika</span>
                <i class="fas fa-times" style="color: #ccc;"></i>
            </div>
            <div class="recent-search-item">
                <span class="search-text">Matematika</span>
                <i class="fas fa-times" style="color: #ccc;"></i>
            </div>
            <div class="recent-search-item">
                <span class="search-text">Ibu Machfud</span>
                <i class="fas fa-times" style="color: #ccc;"></i>
            </div>
            <div style="height: 80px;"></div>
        </div>

        <div class="bottom-nav">
            <div class="nav-item" onclick="showHome()">
                <div><i class="fas fa-home"></i></div>
            </div>
            <div class="nav-item">
                <div><i class="fas fa-plus-circle"></i></div>
            </div>
            <a href="/notifikasi" class="nav-item">
                <div><i class="fas fa-bell"></i></div>
            </a>
            <div class="nav-item" onclick="showProfile()">
                <div><i class="fas fa-user"></i></div>
            </div>
        </div>
    </div>

    <!-- Search Results Page (Hidden by default) -->
    <div class="phone-container" id="resultspage" style="display: none;">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>

        <div class="header">
            <div class="d-flex align-items-center">
                <i class="fas fa-arrow-left mr-3" onclick="showSearch()"></i>
                <div class="search-box flex-grow-1 m-0">
                    <i class="fas fa-search mr-2"></i>
                    <input type="text" placeholder="Search for Books..." value="Matematika" onkeyup="if(event.keyCode === 13) showResults()">
                </div>
                <i class="fas fa-sliders-h ml-2" onclick="showFilter()"></i>
            </div>
        </div>

        <div class="category-section">
            <div class="tab-buttons">
                <button class="tab-btn active">1st Semester</button>
                <button class="tab-btn">Dota</button>
                <button class="tab-btn">Codex</button>
            </div>

            <div class="book-grid">
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Matematika I</div>
                        <div class="book-price">Rp 32.500</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Fundamental MPI</div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">MANAJEMEN PROSES BISNIS</div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Matematika I</div>
                        <div class="book-price">Rp 35.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">MPI Fundamental</div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">FISIKA DASAR</div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
            </div>
            <div style="height: 80px;"></div>
        </div>

        <div class="bottom-nav">
            <div class="nav-item" onclick="showHome()">
                <div><i class="fas fa-home"></i></div>
            </div>
            <div class="nav-item">
                <div><i class="fas fa-plus-circle"></i></div>
            </div>
            <a href="/notifikasi" class="nav-item">
                <div><i class="fas fa-bell"></i></div>
            </a>
            <div class="nav-item" onclick="showProfile()">
                <div><i class="fas fa-user"></i></div>
            </div>
        </div>
    </div>

    <!-- Product Detail Page (Hidden by default) -->
    <div class="phone-container" id="productDetail" style="display: none;">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>

        <div class="header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-arrow-left" style="cursor: pointer;" onclick="showHome()"></i>
                <div class="logo">
                    <i class="fas fa-book-reader"></i>
                    <span>Farrel!</span>
                </div>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <div style="position: relative; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px;">
            <div style="text-align: center; position: relative;">
                <img src="https://via.placeholder.com/200x280/667eea/ffffff?text=Manajemen+Proses+Bisnis" alt="Book" style="width: 200px; height: 280px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <div style="position: absolute; top: 10px; right: 80px; background: rgba(255,255,255,0.3); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <i class="fas fa-share-alt" style="color: white;"></i>
                </div>
                <div style="position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 8px 20px; border-radius: 25px; color: white; font-size: 13px;">
                    <i class="fas fa-star"></i> 4.5
                </div>
            </div>
        </div>

        <div style="padding: 20px; padding-top: 30px;">
            <div class="text-center mb-3">
                <h5 style="font-weight: bold; margin-bottom: 5px;">Fundamental Manajemen Proses Bisnis</h5>
                <p style="color: #999; font-size: 14px; margin: 0;">Rachmat Muchson</p>
            </div>

            <div style="background: #f8f9fa; border-radius: 15px; padding: 20px; margin-bottom: 20px;">
                <h6 style="font-weight: bold; margin-bottom: 15px;">Deskripsi Produk</h6>
                <p style="color: #666; font-size: 13px; line-height: 1.6; text-align: justify;">
                    Buku ini berisi materi dan praktik mengenai Manajemen Proses Bisnis yang dirancang untuk mahasiswa dan profesional. Dengan pendekatan sistematis, buku ini membahas konsep dasar, metodologi, dan studi kasus yang relevan dengan kebutuhan industri modern. Sempurna untuk pembelajaran akademis maupun referensi praktis di dunia kerja.
                </p>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                <button class="filter-btn active" style="flex: 1; padding: 12px;">
                    <i class="fas fa-shopping-bag mr-2"></i>Sewa
                </button>
                <button class="filter-btn" style="flex: 1; padding: 12px;" onclick="document.querySelector('.filter-btn.active').classList.remove('active'); this.classList.add('active');">
                    <i class="fas fa-shopping-cart mr-2"></i>Beli
                </button>
            </div>

            <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 100px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                    <span style="color: #666;">Alamat</span>
                    <span style="font-weight: 500;">Sukolilo, Surabaya</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                    <span style="color: #666;">Kondisi</span>
                    <span style="font-weight: 500;">Buku Populer</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                    <span style="color: #666;">Kategori</span>
                    <span style="font-weight: 500;">Manajemen Proses Bisnis</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0;">
                    <span style="color: #666;">Halaman</span>
                    <span style="font-weight: 500;">352</span>
                </div>
            </div>
        </div>

        <div style="position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); max-width: 375px; width: 100%; background: white; padding: 15px 20px; box-shadow: 0 -4px 15px rgba(0,0,0,0.1); border-radius: 25px 25px 0 0;">
            <div style="display: flex; gap: 15px; align-items: center;">
                <div style="flex: 1;">
                    <div style="color: #999; font-size: 12px;">Harga</div>
                    <div style="font-size: 20px; font-weight: bold; color: #667eea;">Rp20.000</div>
                    <div style="color: #999; font-size: 11px;">*4 Semester</div>
                </div>
                <button onclick="showPopup('rent')" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 15px 30px; border-radius: 25px; font-weight: bold; flex: 1;">
                    Keranjang
                </button>
                <button onclick="showPopup('buy')" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; padding: 15px 30px; border-radius: 25px; font-weight: bold; flex: 1;">
                    Beli
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Page (Seller) -->
    <div class="phone-container mt-4" id="profilePage" style="display: none;">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>

        <div class="header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-arrow-left" style="cursor: pointer;" onclick="showHome()"></i>
                <div class="logo">
                    <i class="fas fa-book-reader"></i>
                    <span>Farrel!</span>
                </div>
                <div></div>
            </div>
        </div>

        <div style="padding: 20px;">
            <div style="text-align: center; margin-bottom: 30px;">
                <div style="position: relative; display: inline-block;">
                    <img src="https://via.placeholder.com/100/764ba2/ffffff?text=MT" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                    <div style="position: absolute; bottom: 0; right: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white;">
                        <i class="fas fa-check" style="color: white; font-size: 14px;"></i>
                    </div>
                </div>
                <h5 style="font-weight: bold; margin-top: 15px; margin-bottom: 5px;">Missy Tiffany</h5>
                <p style="color: #999; font-size: 14px;">Penjual</p>
            </div>

            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; padding: 20px; margin-bottom: 20px; color: white;">
                <h6 style="font-weight: bold; margin-bottom: 15px;">Tentang Penjual</h6>
                <p style="font-size: 13px; line-height: 1.6; opacity: 0.95;">
                    Saya adalah penjual buku bekas dan baru yang sudah berpengalaman lebih dari 5 tahun. Semua buku dijamin original dan berkualitas.
                </p>
            </div>

            <h6 class="section-title">Buku lain yang dijual</h6>
            <div class="book-grid">
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Matematika I</div>
                        <div class="book-price">Rp 32.500</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Sistem Enterprise</div>
                        <div class="book-price">Rp 40.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Fisika Dasar I</div>
                        <div class="book-price">Rp 35.000</div>
                    </div>
                </div>
                <div class="book-card" onclick="showProductDetail()">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Kimia Dasar I</div>
                        <div class="book-price">Rp 38.000</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rent Popup Modal -->
    <div class="modal fade" id="rentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 25px; padding: 20px;">
                <div style="text-align: center;">
                    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
                        <i class="fas fa-share-alt" style="color: #667eea; font-size: 20px; margin-right: 15px; cursor: pointer;"></i>
                        <i class="fas fa-heart" style="color: #667eea; font-size: 20px; cursor: pointer;"></i>
                    </div>
                    <img src="https://via.placeholder.com/120x160/667eea/ffffff?text=Book" alt="Book" style="width: 120px; height: 160px; border-radius: 10px; margin-bottom: 15px;">
                    <h6 style="font-weight: bold; margin-bottom: 5px;">Fundamental Manajemen Proses Bisnis</h6>
                    <p style="color: #999; font-size: 13px; margin-bottom: 5px;">Rachmat Muchson</p>
                    <div style="font-size: 18px; font-weight: bold; color: #667eea; margin-bottom: 15px;">Rp20.000</div>
                    <div style="color: #999; font-size: 12px; margin-bottom: 3px;">*4 Semester</div>
                </div>

                <div style="border-top: 1px solid #f0f0f0; padding-top: 15px; margin-top: 15px;">
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Alamat</span>
                        <span style="font-weight: 500; font-size: 14px;">Sukolilo, Surabaya</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Kondisi</span>
                        <span style="font-weight: 500; font-size: 14px;">Buku Populer</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Kategori</span>
                        <span style="font-weight: 500; font-size: 14px;">Manajemen Proses Bisnis</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Halaman</span>
                        <span style="font-weight: 500; font-size: 14px;">352</span>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button onclick="$('#rentModal').modal('hide')" style="background: white; color: #667eea; border: 2px solid #667eea; padding: 12px; border-radius: 25px; flex: 1; font-weight: bold;">
                        Keranjang
                    </button>
                    <button onclick="showCongrats()" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; padding: 12px; border-radius: 25px; flex: 1; font-weight: bold;">
                        Beli
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Buy Popup Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 25px; padding: 20px;">
                <div style="text-align: center;">
                    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
                        <i class="fas fa-sync-alt" style="color: #667eea; font-size: 20px; margin-right: 15px; cursor: pointer;"></i>
                        <i class="fas fa-heart" style="color: #667eea; font-size: 20px; cursor: pointer;"></i>
                    </div>
                    <img src="https://via.placeholder.com/120x160/667eea/ffffff?text=Book" alt="Book" style="width: 120px; height: 160px; border-radius: 10px; margin-bottom: 15px;">
                    <h6 style="font-weight: bold; margin-bottom: 5px;">Fundamental Manajemen Proses Bisnis</h6>
                    <p style="color: #999; font-size: 13px; margin-bottom: 5px;">Rachmat Muchson</p>
                    <div style="font-size: 18px; font-weight: bold; color: #667eea; margin-bottom: 5px;">Rp90.000</div>
                </div>

                <div style="border-top: 1px solid #f0f0f0; padding-top: 15px; margin-top: 15px;">
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Alamat</span>
                        <span style="font-weight: 500; font-size: 14px;">Sukolilo, Surabaya</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Kondisi</span>
                        <span style="font-weight: 500; font-size: 14px;">Buku Populer</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Kategori</span>
                        <span style="font-weight: 500; font-size: 14px;">Manajemen Proses Bisnis</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span style="color: #666;">Halaman</span>
                        <span style="font-weight: 500; font-size: 14px;">352</span>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button onclick="$('#buyModal').modal('hide')" style="background: white; color: #667eea; border: 2px solid #667eea; padding: 12px; border-radius: 25px; flex: 1; font-weight: bold;">
                        Keranjang
                    </button>
                    <button onclick="showCongrats()" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; padding: 12px; border-radius: 25px; flex: 1; font-weight: bold;">
                        Beli
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Congratulations Modal -->
    <div class="modal fade" id="congratsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 25px; padding: 40px; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 15px; right: 15px;">
                    <span>&times;</span>
                </button>
                <h3 style="color: #667eea; font-weight: bold; margin-bottom: 15px;">Congratulations!</h3>
                <p style="color: #999; margin-bottom: 25px;">Your order has been Added to Cart</p>
                <div style="width: 80px; height: 80px; border-radius: 50%; border: 4px solid #4CAF50; margin: 0 auto 25px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-check" style="color: #4CAF50; font-size: 40px;"></i>
                </div>
                <button onclick="$('#congratsModal').modal('hide')" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px 40px; border-radius: 25px; font-weight: bold; width: 100%;">
                    Go To My Cart
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-bottom">
            <div class="modal-content" style="border-radius: 25px 25px 0 0;">
                <div class="filter-modal">
                    <div class="filter-header">
                        <h5 class="m-0"><strong>Filters</strong></h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="filter-section">
                        <h6>Sort By</h6>
                        <button class="filter-btn active">Relevance</button>
                        <button class="filter-btn">Price: Low - High</button>
                        <button class="filter-btn">Price: High - Low</button>
                    </div>

                    <div class="filter-section">
                        <h6>Price</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Rp 0</span>
                            <span>Rp 200k</span>
                        </div>
                        <input type="range" class="custom-range" min="0" max="200000" value="100000">
                        <div class="text-center mt-3">
                            <strong>SPPK</strong>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h6>Location</h6>
                        <button class="filter-btn active">Surabaya</button>
                        <button class="filter-btn">Jakarta</button>
                        <button class="filter-btn">Bandung</button>
                    </div>

                    <button class="apply-btn">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showHome() {
            document.getElementById('homepage').style.display = 'block';
            document.getElementById('searchpage').style.display = 'none';
            document.getElementById('resultspage').style.display = 'none';
            document.getElementById('productDetail').style.display = 'none';
            document.getElementById('profilePage').style.display = 'none';
            // document.getElementById('notificationPage').style.display = 'none'; // Removed as notifications is now a route
        }

        function showSearch() {
            document.getElementById('homepage').style.display = 'none';
            document.getElementById('searchpage').style.display = 'block';
            document.getElementById('resultspage').style.display = 'none';
            document.getElementById('productDetail').style.display = 'none';
            document.getElementById('profilePage').style.display = 'none';
            // document.getElementById('notificationPage').style.display = 'none'; // Removed as notifications is now a route
        }

        function showResults() {
            document.getElementById('homepage').style.display = 'none';
            document.getElementById('searchpage').style.display = 'none';
            document.getElementById('resultspage').style.display = 'block';
            document.getElementById('productDetail').style.display = 'none';
            document.getElementById('profilePage').style.display = 'none';
            // document.getElementById('notificationPage').style.display = 'none'; // Removed as notifications is now a route
        }

        function showProductDetail() {
            document.getElementById('homepage').style.display = 'none';
            document.getElementById('searchpage').style.display = 'none';
            document.getElementById('resultspage').style.display = 'none';
            document.getElementById('productDetail').style.display = 'block';
            document.getElementById('profilePage').style.display = 'none';
            // document.getElementById('notificationPage').style.display = 'none'; // Removed as notifications is now a route
        }

        function showProfile() {
            document.getElementById('homepage').style.display = 'none';
            document.getElementById('searchpage').style.display = 'none';
            document.getElementById('resultspage').style.display = 'none';
            document.getElementById('productDetail').style.display = 'none';
            document.getElementById('profilePage').style.display = 'block';
            // document.getElementById('notificationPage').style.display = 'none'; // Removed as notifications is now a route
        }

        // function showNotifications() { // Removed as notifications is now a route
        //     document.getElementById('homepage').style.display = 'none';
        //     document.getElementById('searchpage').style.display = 'none';
        //     document.getElementById('resultspage').style.display = 'none';
        //     document.getElementById('productDetail').style.display = 'none';
        //     document.getElementById('profilePage').style.display = 'none';
        //     document.getElementById('notificationPage').style.display = 'block';
        // }

        function showFilter() {
            $('#filterModal').modal('show');
        }

        function showPopup(type) {
            if (type === 'rent') {
                $('#rentModal').modal('show');
            } else {
                $('#buyModal').modal('show');
            }
        }

        function showCongrats() {
            $('#rentModal').modal('hide');
            $('#buyModal').modal('hide');
            $('#congratsModal').modal('show');
        }

        // Toggle filter buttons
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-btn') && !e.target.onclick) {
                const parent = e.target.parentElement;
                parent.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                e.target.classList.add('active');
            }
            if (e.target.classList.contains('tab-btn')) {
                const parent = e.target.parentElement;
                parent.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                e.target.classList.add('active');
            }
        });
    </script>
</body>
</html>
