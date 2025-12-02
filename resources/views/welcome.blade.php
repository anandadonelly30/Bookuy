<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farrell - Jual Beli & Sewa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            min-height: 100vh;
        }

        /* Loading Screen Styles */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 60px;
        }

        .loading-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 4px 20px rgba(0, 0, 0, 0.2));
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.2);
            border-top: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Logo pulse animation */
        .loading-logo img {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Auth Pages */
        .auth-page {
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .back-btn {
            position: absolute;
            top: 50px;
            left: 20px;
            color: white;
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .auth-logo i {
            font-size: 60px;
            color: white;
        }

        .auth-title {
            color: white;
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .auth-form {
            max-width: 500px;
            margin: 0 auto;
        }

        .auth-form label {
            color: white;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .auth-input-group {
            position: relative;
            margin-bottom: 30px;
        }

        .auth-input {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 30px;
            background: transparent;
            color: white;
            font-size: 16px;
            outline: none;
        }

        .auth-input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .auth-input:focus {
            border-color: white;
        }

        .eye-icon {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .auth-terms {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .auth-terms a {
            color: white;
            text-decoration: underline;
        }

        .auth-btn {
            width: 100%;
            padding: 18px;
            background: rgba(255,255,255,0.3);
            border: none;
            border-radius: 30px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .auth-btn:hover {
            background: rgba(255,255,255,0.4);
        }

        .auth-footer {
            text-align: center;
            color: white;
            font-size: 16px;
        }

        .auth-footer a {
            color: white;
            text-decoration: underline;
            font-weight: 600;
        }

        /* Homepage */
        .home-page {
            background: #f5f5f5;
            min-height: 100vh;
            padding-bottom: 80px;
        }

        .home-header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            padding: 15px 20px;
            border-radius: 0 0 25px 25px;
        }

        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-text {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon i {
            font-size: 24px;
            color: #2563eb;
        }

        .welcome-text {
            color: white;
        }

        .welcome-text h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .welcome-text p {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
        }

        .cart-icon {
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .search-container {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 50px 15px 50px;
            border-radius: 25px;
            border: none;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 16px;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,0.8);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.8);
        }

        .mic-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.8);
        }

        .filter-icon {
            position: absolute;
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
            width: 35px;
            height: 35px;
            background: #1e40af;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Category Section */
        .category-section {
            padding: 25px 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h4 {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }

        .see-all {
            background: #ff9800;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .category-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            text-align: left;
        }

        .category-icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .category-icon-box i {
            font-size: 28px;
            color: white;
        }

        .category-card h6 {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* Recommended Section */
        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .book-image {
            width: 100%;
            height: 140px;
            background: linear-gradient(135deg, #e5e7eb 0%, #cbd5e1 100%);
        }

        .book-info {
            padding: 12px;
        }

        .book-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .book-author {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .book-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .book-rating i {
            color: #fbbf24;
            font-size: 12px;
        }

        .book-rating span {
            font-size: 12px;
            color: #64748b;
        }

        .book-price {
            font-size: 16px;
            font-weight: 700;
            color: #2563eb;
        }

        /* Popular Books */
        .popular-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .popular-item {
            background: white;
            border-radius: 15px;
            padding: 15px;
            display: flex;
            gap: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .popular-image {
            width: 80px;
            height: 120px;
            background: linear-gradient(135deg, #e5e7eb 0%, #cbd5e1 100%);
            border-radius: 10px;
            flex-shrink: 0;
        }

        .popular-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .popular-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .popular-author {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .popular-reviews {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 10px;
        }

        .popular-reviews i {
            color: #fbbf24;
        }

        .popular-reviews span {
            font-size: 12px;
            color: #64748b;
        }

        .popular-price {
            font-size: 18px;
            font-weight: 700;
            color: #2563eb;
        }

        .grab-btn {
            background: #ff9800;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px 0 10px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #94a3b8;
            flex: 1;
        }

        .nav-item.active {
            color: #2563eb;
        }

        .nav-item i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .nav-item span {
            font-size: 12px;
        }

        .fab-button {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            cursor: pointer;
        }

        .fab-button i {
            font-size: 28px;
            color: white;
        }

        /* Create Page */
        .create-page {
            background: #f5f5f5;
            min-height: 100vh;
            padding-bottom: 30px;
        }

        .create-header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .create-header button {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .create-header h2 {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            flex: 1;
            text-align: center;
        }

        .create-form {
            padding: 20px;
        }

        .upload-area {
            background: white;
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 50px 20px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .upload-area i {
            font-size: 60px;
            color: #2563eb;
            margin-bottom: 15px;
        }

        .upload-area p {
            color: #64748b;
            margin: 0;
        }

        .photo-count {
            font-size: 14px;
            color: #94a3b8;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            font-size: 15px;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
        }

        textarea.form-control {
            border-radius: 20px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border: none;
            border-radius: 30px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 30px;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }
    </style>
</head>
<body>

<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-logo">
        <img src="{{ asset('Logo.png') }}" alt="Logo">
    </div>
    <div class="loading-spinner"></div>
</div>

<!-- Sign Up Page -->
<div id="signupPage" class="page active">
    <div class="auth-page">
        <button class="back-btn" onclick="showPage('loginPage')">
            <i class="fas fa-arrow-left"></i>
        </button>

        <div class="auth-logo">
            <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 80px; height: 80px;">
        </div>

        <div class="auth-form">
            <form id="signupForm">
                <div class="auth-input-group">
                    <label>Full Name</label>
                    <input type="text" class="auth-input" placeholder="Enter your full name" required>
                </div>

                <div class="auth-input-group">
                    <label>Email</label>
                    <input type="email" class="auth-input" placeholder="Enter your email address" required>
                </div>

                <div class="auth-input-group">
                    <label>Password</label>
                    <input type="password" class="auth-input password-field" placeholder="Enter your password" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePassword(this)"></i>
                </div>

                <div class="auth-terms">
                    By signing up you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookie Use</a>
                </div>

                <button type="submit" class="auth-btn">SignUp</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="#" onclick="showPage('loginPage')">Log In</a>
            </div>
        </div>
    </div>
</div>

<!-- Login Page -->
<div id="loginPage" class="page">
    <div class="auth-page">
        <button class="back-btn" onclick="showPage('signupPage')">
            <i class="fas fa-arrow-left"></i>
        </button>

        <h1 class="auth-title">Login</h1>

        <div class="auth-form">
            <form id="loginForm">
                <div class="auth-input-group">
                    <label>Email</label>
                    <input type="email" class="auth-input" placeholder="Enter your email address" required>
                </div>

                <div class="auth-input-group">
                    <label>Password</label>
                    <input type="password" class="auth-input password-field" placeholder="Enter your password" required>
                    <i class="fas fa-eye-slash eye-icon" onclick="togglePassword(this)"></i>
                </div>

                <button type="submit" class="auth-btn">Login</button>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="#" onclick="showPage('signupPage')">SignUp</a>
            </div>
        </div>
    </div>
</div>

<!-- Homepage -->
<div id="homePage" class="page">
    <div class="home-page">
        <div class="home-header">
            <div class="welcome-section">
                <div class="logo-text">
                    <div class="logo-icon">
                        <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 60px; height: 60px; border-radius: 10px;">
                    </div>
                    <div class="welcome-text">
                        <h3>Welcome</h3>
                        <p>Farrell!</p>
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

            <div class="recommended-grid">
                <div class="book-card">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Matematika Dasar</div>
                        <div class="book-rating">
                            <i class="fas fa-star"></i>
                            <span>4.5 (2k)</span>
                        </div>
                        <div class="book-price">Rp 45.000</div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image"></div>
                    <div class="book-info">
                        <div class="book-title">Manajemen Proses Bisnis</div>
                        <div class="book-rating">
                            <i class="fas fa-star"></i>
                            <span>5.0 (1.5k)</span>
                        </div>
                        <div class="book-price">Rp 50.000</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="category-section">
            <div class="section-header">
                <h4>Popular books</h4>
            </div>

            <div class="popular-list">
                <div class="popular-item">
                    <div class="popular-image"></div>
                    <div class="popular-content">
                        <div>
                            <div class="popular-title">Fundamental MPB</div>
                            <div class="popular-author">Marlon Dumas</div>
                            <div class="popular-reviews">
                                <i class="fas fa-star"></i>
                                <span>5.0 | Based on 23k Reviews</span>
                            </div>
                            <div class="popular-price">Rp 50.000</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-end;">
                        <button class="grab-btn">Grab Now</button>
                    </div>
                </div>

                <div class="popular-item">
                    <div class="popular-image"></div>
                    <div class="popular-content">
                        <div>
                            <div class="popular-title">Sistem Enterprise</div>
                            <div class="popular-author">Mahendrawati ER,Ph.D.</div>
                            <div class="popular-reviews">
                                <i class="fas fa-star"></i>
                                <span>4.8 | Based on 7k Reviews</span>
                            </div>
                            <div class="popular-price">Rp 60.000</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-end;">
                        <button class="grab-btn">Grab Now</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-nav">
            <div class="nav-container">
                <a href="#" class="nav-item active">
                    <i class="fas fa-home"></i>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-comment"></i>
                </a>
                <div class="fab-button" onclick="showPage('createPage')">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="#" class="nav-item">
                    <i class="fas fa-bell"></i>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Create Item Page -->
<div id="createPage" class="page">
    <div class="create-page">
        <div class="create-header">
            <button onclick="showPage('homePage')">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h2 class="text-center">Jual Buku</h2>
            <div style="width: 30px;"></div>
        </div>

        <div class="create-form">
            <form id="createItemForm">
                <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p style="font-size: 18px; color: #1e293b; font-weight: 600; margin-bottom: 5px;">Upload Gambar</p>
                    <p class="photo-count">Foto 0/8</p>
                    <p style="font-size: 13px;">Max 100mb</p>
                    <input type="file" id="fileInput" style="display: none;" multiple accept="image/*">
                </div>

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" class="form-control" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Kategori Mata Kuliah</label>
                    <select class="form-control" required>
                        <option value=""></option>
                        <option>Manajemen Proses Bisnis</option>
                        <option>Pemrograman</option>
                        <option>Matematika</option>
                        <option>Fisika</option>
                        <option>Kimia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kondisi</label>
                    <select class="form-control" required>
                        <option value=""></option>
                        <option>Baru</option>
                        <option>Seperti Baru</option>
                        <option>Baik</option>
                        <option>Cukup</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" class="form-control" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Harga Sewa</label>
                    <input type="number" class="form-control" placeholder="">
                </div>

                <button type="submit" class="submit-btn">Jual/Sewa</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Loading screen handler - only show once per session
    document.addEventListener('DOMContentLoaded', function() {
        const loadingScreen = document.getElementById('loadingScreen');

        // Check if loading screen has been shown in this session
        if (sessionStorage.getItem('loadingScreenShown')) {
            // Already shown, hide immediately
            loadingScreen.style.display = 'none';
        } else {
            // First visit, show loading screen for 2 seconds
            sessionStorage.setItem('loadingScreenShown', 'true');
            setTimeout(function() {
                loadingScreen.classList.add('hidden');

                // Remove from DOM after animation
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 2000);
        }
    });

    function showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById(pageId).classList.add('active');
    }

    function togglePassword(icon) {
        const input = icon.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Pendaftaran berhasil!');
        showPage('loginPage');
    });

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Login berhasil!');
        showPage('homePage');
    });

    document.getElementById('createItemForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Pro
