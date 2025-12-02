<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farrell - Jual Beli & Sewa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            width: 100%;
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
            top: 70%;
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
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 15px; /* Add some padding for the scrollbar */
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .recommended-grid::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .book-card {
            flex: 0 0 150px; /* Give a fixed width to each card */
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

    <div id="app">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showPage(pageId) {
            // This function will be handled by Laravel routing now
            window.location.href = `/${pageId}`;
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
    </script>
    @stack('scripts')
</body>
</html>
