<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật trạng thái đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center">Cập nhật trạng thái đơn hàng #<?= $order->id ?></h3>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái đơn hàng</label>
                            <select name="status" class="form-select" required>
                                <?php
                                $statuses = ['Pending' => 'Chờ xác nhận', 'Confirmed' => 'Đã xác nhận', 'Cancelled' => 'Đã hủy'];
                                foreach ($statuses as $key => $label):
                                ?>
                                    <option value="<?= $key ?>" <?= $order->status == $key ? 'selected' : '' ?>>
                                        <?= $label ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5">Lưu thay đổi</button>
                            <a href="index.php?controller=OrderAdmin&page=<?= htmlspecialchars($_GET['page'] ?? 1) ?>" class="btn btn-secondary ms-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>