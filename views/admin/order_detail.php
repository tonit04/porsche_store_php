<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container-fluid py-5">
        <h1 class="text-center mb-4">Danh sách chi tiết đơn hàng</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Mã xe</th>
                    <th>Tên xe</th>
                    <th>Giá xe</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $od): ?>
                    <tr>
                        <td><?= htmlspecialchars($od->id) ?></td>
                        <td><?= htmlspecialchars($od->order_id) ?></td>
                        <td><?= htmlspecialchars($od->order->user_id) ?></td>
                        <td><?= htmlspecialchars($od->order->user->full_name) ?></td>
                        <td><?= htmlspecialchars($od->car_id) ?></td>
                        <td><?= htmlspecialchars($od->car->name) ?></td>
                        <td><?= number_format($od->price, 0, ',', '.') ?> VND</td>
                        <td><?= htmlspecialchars($od->quantity) ?></td>
                        <td><?= number_format($od->subtotal, 0, ',', '.') ?> VND</td>
                        <td><?= htmlspecialchars($od->order->status) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="container">
            <?php if (!empty($orderDetails)): ?>
                <div class="alert alert-success text-center fw-bold fs-5">
                    Tổng tiền: <?= number_format($od->order->total_amount, 0, ',', '.') ?> VND
                </div>
            <?php endif; ?>
        </div>
        <div class="text-end">
            <a href="index.php?controller=OrderAdmin&action=index" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>

</html>