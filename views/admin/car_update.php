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
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($car->name) ?>"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Model</label>
                    <select name="model_id" class="form-control" required>
                        <option value="<?= $car->model->id ?>"><?= $car->model->name ?></option>
                        <?php foreach ($models as $model): ?>
                            <option value="<?= $model->id ?>"><?= $model->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($car->slug) ?>"
                        required>
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
                    <input type="number" name="horsepower" class="form-control"
                        value="<?= htmlspecialchars($car->horsepower) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tốc độ tối đa</label>
                    <input type="number" name="max_speed" class="form-control"
                        value="<?= htmlspecialchars($car->max_speed) ?>">
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
                    <input type="number" step="0.01" name="price" class="form-control"
                        value="<?= htmlspecialchars($car->price) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="stock" class="form-control" value="<?= htmlspecialchars($car->stock) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= htmlspecialchars($car->description) ?></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Ảnh xe</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                <!-- Thêm ảnh preview -->
                <img id="preview" src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" alt="Ảnh xem trước" class="img-fluid mt-2" style="max-height: 200px;">
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="active" <?= $car->status === 'active' ? 'selected' : '' ?>>Đang bán</option>
                    <option value="discontinued" <?= $car->status === 'discontinued' ? 'selected' : '' ?>>Ngừng bán
                    </option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="index.php?controller=CarAdmin&page=<?= htmlspecialchars($_GET['page'] ?? 1) ?>" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById("image").addEventListener("change", function (event) {
            const input = event.target;
            const preview = document.getElementById("preview");

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                }

                reader.readAsDataURL(input.files[0]); // Đọc file ảnh
            }
        });
    </script>
</body>

</html>