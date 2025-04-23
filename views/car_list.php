<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách xe Porsche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        img {
            width: 120px;
            height: auto;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-discontinued {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-center mb-4">Danh sách xe Porsche</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên xe</th>
                    <th>Slug</th>
                    <th>Năm</th>
                    <th>Màu</th>
                    <th>Động cơ</th>
                    <th>Mã lực</th>
                    <th>Tốc độ tối đa</th>
                    <th>Truyền động</th>
                    <th>Nhiên liệu</th>
                    <th>Giá (VNĐ)</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td>
                                <?php if (!empty($car['image_url'])): ?>
                                    <img src="assets/images/cars/<?= htmlspecialchars($car['image_url']) ?>"
                                        alt="<?= htmlspecialchars($car['name']) ?>">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($car['name']) ?></td>
                            <td><?= htmlspecialchars($car['slug']) ?></td>
                            <td><?= htmlspecialchars($car['year']) ?></td>
                            <td><?= htmlspecialchars($car['color']) ?></td>
                            <td><?= htmlspecialchars($car['engine']) ?></td>
                            <td><?= htmlspecialchars($car['horsepower']) ?> HP</td>
                            <td><?= htmlspecialchars($car['max_speed']) ?> km/h</td>
                            <td><?= htmlspecialchars($car['transmission']) ?></td>
                            <td><?= htmlspecialchars($car['fuel_type']) ?></td>
                            <td><?= number_format($car['price'], 0, ',', '.') ?>₫</td>
                            <td><?= htmlspecialchars($car['stock']) ?></td>
                            <td class="status-<?= strtolower($car['status']) ?>">
                                <?= $car['status'] === 'active' ? 'Đang bán' : 'Ngừng bán' ?>
                            </td>
                            <td><?= htmlspecialchars($car['description']) ?></td>
                            <td>
                                <a href="index.php?controller=CarAdmin&action=edit&id=<?= $car['id'] ?>"
                                    class="btn btn-sm btn-warning mb-1">Sửa</a>
                                <a href="index.php?controller=CarAdmin&action=delete&id=<?= $car['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa xe này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="15" class="text-center text-muted">Không có xe nào trong cơ sở dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Nút thêm xe mới -->
    <div class="text-center mt-4">
        <a href="index.php?controller=CarAdmin&action=create" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm xe mới
        </a>
    </div>


</body>

</html>