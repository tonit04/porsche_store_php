<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa xe Porsche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Sửa thông tin xe Porsche</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tên xe</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($car->name) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($car->slug) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Năm</label>
                    <input type="number" name="year" class="form-control" value="<?= htmlspecialchars($car->year) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Màu</label>
                    <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($car->color) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Động cơ</label>
                    <input type="text" name="engine" class="form-control" value="<?= htmlspecialchars($car->engine) ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Mã lực</label>
                    <input type="number" name="horsepower" class="form-control" value="<?= htmlspecialchars($car->horsepower) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tốc độ tối đa</label>
                    <input type="number" name="max_speed" class="form-control" value="<?= htmlspecialchars($car->max_speed) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Truyền động</label>
                    <select name="transmission" class="form-select">
                        <option <?= $car->transmission === 'Automatic' ? 'selected' : '' ?>>Automatic</option>
                        <option <?= $car->transmission === 'Manual' ? 'selected' : '' ?>>Manual</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Nhiên liệu</label>
                    <select name="fuel_type" class="form-select">
                        <option <?= $car->fuel_type === 'Gasoline' ? 'selected' : '' ?>>Gasoline</option>
                        <option <?= $car->fuel_type === 'Electric' ? 'selected' : '' ?>>Electric</option>
                        <option <?= $car->fuel_type === 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Giá</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($car->price) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($car->stock) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($car->description) ?></textarea>
            </div>

            <label>Image:</label><br>
            <input type="file" name="image"><br>
            <?php if (!empty($car->image_url)): ?>
                <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" width="200">
            <?php endif; ?><br>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active" <?= $car->status === 'active' ? 'selected' : '' ?>>Đang bán</option>
                    <option value="discontinued" <?= $car->status === 'discontinued' ? 'selected' : '' ?>>Ngừng bán</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="index.php?controller=CarAdmin&action=index" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</body>

</html>
