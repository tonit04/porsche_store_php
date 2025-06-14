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

        .menu-link {
            align-items: center;
            padding: 12px 20px;
            text-decoration: none;
            color: #666;
            border-radius: 20px;
            background-color: aqua;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid py-5">
        <div class="menu-item mb-3">
            <a href="index.php?controller=Admin&action=dashboard" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại Dashboard
            </a>
            <!-- Thêm nút tải lại -->
             <a href="index.php?controller=CarAdmin&action=index" class="btn btn-info ms-2">
                <i class="bi bi-arrow-clockwise"></i> Tải lại trang
            </a>
        </div>
        <h1 class="text-center mb-4">Danh sách xe Porsche</h1>

        <!-- Add this after the header and before the table -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <input type="hidden" name="controller" value="CarAdmin">
                            <input type="hidden" name="action" value="index">

                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            </div>

                            <div class="col-md-2">
                                <input type="number" name="min_price" class="form-control" placeholder="Giá từ"
                                    value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                            </div>

                            <div class="col-md-2">
                                <input type="number" name="max_price" class="form-control" placeholder="Giá đến"
                                    value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                            </div>

                            <div class="col-md-2">
                                <select name="category_id" class="form-select">
                                    <option value="">Tất cả danh mục</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"
                                        <?= isset($_GET['category_id']) && $_GET['category_id'] == $category->id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category->name) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="sort" class="form-select">
                                    <option value="">Sắp xếp</option>
                                    <option value="price_asc"
                                        <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>
                                        Giá tăng dần
                                    </option>
                                    <option value="price_desc"
                                        <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>
                                        Giá giảm dần
                                    </option>
                                    <option value="name_asc"
                                        <?= isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : '' ?>>
                                        Tên A-Z
                                    </option>
                                    <option value="name_desc"
                                        <?= isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : '' ?>>
                                        Tên Z-A
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">Lọc</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên xe</th>
                    <th>Model</th>
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
                        <?php if (!empty($car->image_url)): ?>
                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>"
                            alt="<?= htmlspecialchars($car->name) ?>">
                        <?php else: ?>
                        <span class="text-muted">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($car->name) ?></td>
                    <td><?= $car->model->name ?? 'Không xác định' ?></td>
                    <td><?= htmlspecialchars($car->slug) ?></td>
                    <td><?= htmlspecialchars($car->year) ?></td>
                    <td><?= htmlspecialchars($car->color) ?></td>
                    <td><?= htmlspecialchars($car->engine) ?></td>
                    <td><?= htmlspecialchars($car->horsepower) ?> HP</td>
                    <td><?= htmlspecialchars($car->max_speed) ?> km/h</td>
                    <td><?= htmlspecialchars($car->transmission) ?></td>
                    <td><?= htmlspecialchars($car->fuel_type) ?></td>
                    <td><?= number_format($car->price, 0, ',', '.') ?>₫</td>
                    <td><?= htmlspecialchars($car->stock) ?></td>
                    <td class="status-<?= strtolower($car->status) ?>">
                        <?= $car->status === 'active' ? 'Đang bán' : 'Ngừng bán' ?>
                    </td>
                    <td><?= htmlspecialchars($car->description) ?></td>
                    <td>
                        <a href="index.php?controller=CarAdmin&action=update&id=<?= $car->id ?>&page=<?= $_GET['page'] ?? 1 ?>"
                            class="btn btn-primary btn-sm">Sửa</a>
                        <a href="index.php?controller=CarAdmin&action=delete&id=<?= $car->id ?>"
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
        <?php if ($totalPages > 1): ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?controller=CarAdmin&action=index&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <p>Tổng số danh mục xe: <?php echo "$totalModels" ?></p>
        <!-- Nút thêm xe mới -->
        <div class="text-center mt-4">
            <a href="index.php?controller=CarAdmin&action=create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm xe mới
            </a>
        </div>
    </div>
</body>

</html>