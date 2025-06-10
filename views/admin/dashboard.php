<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #fff;
            border-right: 1px solid #ddd;
        }

        .sidebar-header {
            padding: 20px;
            background-color: #4a90e2;
            color: white;
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 12px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            margin-bottom: 5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            text-decoration: none;
            color: #666;
        }

        .menu-link:hover {
            background-color: #f0f0f0;
        }

        .menu-link.active {
            background-color: #4a90e2;
            color: white;
        }

        .menu-icon {
            margin-right: 10px;
        }

        .menu-text {
            font-size: 14px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .welcome-card {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .welcome-subtitle {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
                <p>Hệ thống quản trị</p>
            </div>

            <div class="sidebar-menu">
                <div class="menu-item">
                    <a href="index.php?controller=CarAdmin&action=index" class="menu-link">
                        <div class="menu-icon">🚗</div>
                        <span class="menu-text">Quản lý Xe</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="index.php?controller=OrderAdmin&action=index" class="menu-link">
                        <div class="menu-icon">📋</div>
                        <span class="menu-text">Quản lý Đơn hàng</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="index.php?controller=UserAdmin&action=index" class="menu-link">
                        <div class="menu-icon">👥</div>
                        <span class="menu-text">Quản lý Người dùng</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="index.php?controller=CategoryAdmin&action=index" class="menu-link">
                        <div class="menu-icon">🚗</div>
                        <span class="menu-text">Quản lý dòng xe</span>
                    </a>
                </div>
                 <div class="menu-item">
                    <a href="index.php?controller=BannerAdmin&action=index" class="menu-link">
                        <div class="menu-icon">🚞</div>
                        <span class="menu-text">Quản lý banner</span>
                    </a>
                </div>

            </div>
        </nav>

        <div class="main-content">

            <div class="content-area">
                <div class="welcome-card">
                    <div class="welcome-content">
                        <h2 class="welcome-title">Chào mừng đến với Admin Dashboard</h2>
                        <p class="welcome-subtitle">
                            Quản lý hệ thống một cách hiệu quả với giao diện hiện đại và dễ sử dụng.
                            Chọn một mục trong thanh điều hướng hoặc xem tổng quan dưới đây.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>