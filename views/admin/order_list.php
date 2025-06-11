<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    .menu-link {
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: #666;
        border-radius: 20px;
        background-color: aqua;
    }
</style>

<body class="bg-light">

    <div class="container-fluid py-5">
        <div class="menu-item mb-3">
            <a href="index.php?controller=Admin&action=dashboard" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại Dashboard
            </a>
        </div>
        <h1 class="text-center mb-4">Danh sách đơn hàng</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Chú thích</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order->id) ?></td>
                            <td><?= htmlspecialchars($order->user_id) ?></td>
                            <td><?= htmlspecialchars($order->user->full_name) ?></td>
                            <td><?= htmlspecialchars($order->order_date) ?></td>
                            <td><?= htmlspecialchars($order->status) ?></td>
                            <td><?= number_format($order->total_amount, 0, ',', '.') ?> VND</td>
                            <td><?= htmlspecialchars($order->payment_method) ?></td>
                            <td><?= htmlspecialchars($order->note) ?></td>
                            <td>
                                <a href="index.php?controller=OrderAdmin&action=detail&id=<?= $order->id ?>"
                                    class="btn btn-sm btn-warning mb-1">Xem chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center text-muted">Không có đơn hàng nào trong cơ sở dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?controller=OrderAdmin&action=index&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <p>Tổng số đơn hàng: <?= $totalOrders ?></p>

    </div>
</body>

</html>