<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farrel! - Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .phone-container {
            max-width: 375px;
            margin: 0 auto;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            min-height: 600px;
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
            text-align: center;
            position: relative;
        }
        .header .back-btn {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
        }
        .header h4 {
            margin: 0;
            font-weight: bold;
            font-size: 24px;
        }
        .logo-small {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .notification-section {
            padding: 20px;
        }
        .date-header {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-bottom: 15px;
            margin-top: 20px;
        }
        .date-header:first-child {
            margin-top: 0;
        }
        .notification-item {
            display: flex;
            align-items: flex-start;
            padding: 15px;
            background: white;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: relative;
            transition: transform 0.2s;
        }
        .notification-item:hover {
            transform: translateX(5px);
        }
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .notification-icon.discount {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .notification-icon.wallet {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .notification-icon.service {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .notification-icon.credit {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .notification-icon.account {
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        }
        .notification-content {
            flex: 1;
        }
        .notification-title {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }
        .notification-desc {
            font-size: 12px;
            color: #999;
            line-height: 1.4;
        }
        .notification-badge {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background: #667eea;
            border-radius: 50%;
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
            position: relative;
        }
        .nav-item.active {
            color: #667eea;
        }
        .nav-item i {
            font-size: 24px;
        }
        .nav-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f5576c;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Notification Page -->
    <div class="phone-container" id="notificationPage">
        <div class="status-bar">
            <span>9:41</span>
            <span><i class="fas fa-signal"></i> <i class="fas fa-wifi"></i> <i class="fas fa-battery-full"></i></span>
        </div>
        
        <div class="header">
            <i class="fas fa-arrow-left back-btn" onclick="window.location.href = '/'"></i>
            <div class="logo-small">
                <i class="fas fa-book-reader"></i> Farrel!
            </div>
            <h4>Notifications</h4>
        </div>

        <div class="notification-section" style="padding-bottom: 100px;">
            <!-- Today Section -->
            <div class="date-header">Today</div>
            
            <div class="notification-item">
                <div class="notification-icon discount">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">20% Special Discount!</div>
                    <div class="notification-desc">Special promotion only valid today</div>
                </div>
                <div class="notification-badge"></div>
            </div>

            <!-- Yesterday Section -->
            <div class="date-header">Yesterday</div>
            
            <div class="notification-item">
                <div class="notification-icon wallet">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Top Up E-wallet Successfully!</div>
                    <div class="notification-desc">You have top up your e-wallet</div>
                </div>
                <div class="notification-badge"></div>
            </div>

            <div class="notification-item">
                <div class="notification-icon service">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">New Service Available!</div>
                    <div class="notification-desc">Now you can track orders in real time</div>
                </div>
                <div class="notification-badge"></div>
            </div>

            <!-- May 7, 2025 Section -->
            <div class="date-header">May 7, 2025</div>
            
            <div class="notification-item">
                <div class="notification-icon credit">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Credit Card Connected!</div>
                    <div class="notification-desc">Credit card has been linked!</div>
                </div>
            </div>

            <div class="notification-item">
                <div class="notification-icon account">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">Account Setup Successfully!</div>
                    <div class="notification-desc">Your account has been created</div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <a href="/" class="nav-item">
                <i class="fas fa-home"></i>
            </a>
            <div class="nav-item">
                <i class="fas fa-plus-circle"></i>
            </div>
            <a href="/notifikasi" class="nav-item active">
                <i class="fas fa-bell"></i>
                <div class="nav-badge">5</div>
            </a>
            <div class="nav-item" onclick="window.location.href = '/bookuy#profilePage'">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>