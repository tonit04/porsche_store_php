<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .sidebar {
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 bg-white sidebar">
                <div class="d-flex flex-column">
                    <div class="p-3 bg-primary text-white">
                        <h4 class="mb-0">PORSCHE ADMIN</h4>
                    </div>
                    <div class="nav flex-column py-3">
                        <a href="index.php?controller=CarAdmin" class="nav-link"><i class="bi bi-car-front"></i> Quản lý Xe
                        </a>
                        <a href="index.php?controller=OrderAdmin" class="nav-link"><i class="bi bi-cart"></i> Quản lý Đơn
                            hàng</a>
                        <a href="index.php?controller=UserAdmin" class="nav-link"><i class="bi bi-people"></i> Quản lý
                            Users</a>
                        <a href="index.php?controller=CategoryAdmin" class="nav-link"><i class="bi bi-tags"></i> Quản lý
                            Dòng xe</a>
                        <a href="index.php?controller=BannerAdmin" class="nav-link"><i class="bi bi-image"></i> Quản lý
                            Banner</a>
                        <a href="index.php?controller=ContactAdmin" class="nav-link"><i class="bi bi-envelope"></i>
                            Quản lý Liên hệ</a>
                        <a href="index.php?controller=FaqAdmin" class="nav-link"><i class="bi bi-question-circle"></i>
                            Quản lý FAQ</a>
                    </div>
                    <div class="mt-auto border-top pt-3">
                        <a href="index.php?controller=Home&action=index" class="nav-link text-danger">
                            <i class="bi bi-box-arrow-right"></i> Trang chủ
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-4 py-4 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Dashboard Overview</h4>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center me-3">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            <div>
                                <small class="text-muted d-block">Xin chào,</small>
                                <span class="fw-medium"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                            </div>
                        </div>
                        <div class="vr mx-3"></div>
                        <div>
                            <i class="bi bi-calendar3 me-2"></i>
                            <span><?= date('d/m/Y') ?></span>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">Tổng đơn hàng</h6>
                                        <h4 class="card-title mb-0"><?= $totalOrders ?></h4>
                                    </div>
                                    <div class="stat-icon bg-primary text-white">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">Tổng users</h6>
                                        <h4 class="card-title mb-0"><?= $totalUsers ?></h4>
                                    </div>
                                    <div class="stat-icon bg-success text-white">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">Tổng xe</h6>
                                        <h4 class="card-title mb-0"><?= $totalCars ?></h4>
                                    </div>
                                    <div class="stat-icon bg-info text-white">
                                        <i class="bi bi-car-front"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">Doanh thu</h6>
                                        <h4 class="card-title mb-0"><?= number_format($totalRevenue, 0, ',', '.') ?> VNĐ</h4>
                                    </div>
                                    <div class="stat-icon bg-warning text-white">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="card dashboard-card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Đơn hàng gần đây</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td>#<?= $order->id ?></td>
                                        <td><?= htmlspecialchars($order->user->full_name) ?></td>
                                        <td><?= number_format($order->total_amount, 0, ',', '.') ?> VNĐ</td>
                                        <td>
                                            <span class="badge bg-<?= $order->status == 'Completed' ? 'success' : 'warning' ?>">
                                                <?= htmlspecialchars($order->status) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($order->order_date)) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Revenue Chart
    const revenueChart = new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($revenueData['labels']) ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?= json_encode($revenueData['values']) ?>,
                borderColor: '#0d6efd',
                tension: 0.1
            }]
        }
    });

    // Top Cars Chart
    const topCarsChart = new Chart(document.getElementById('topCarsChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($topCarsData['labels']) ?>,
            datasets: [{
                data: <?= json_encode($topCarsData['values']) ?>,
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d']
            }]
        }
    });
    </script>

</body>

</html>