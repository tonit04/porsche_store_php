<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm xe mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Thêm xe Porsche mới</h1>

        <form action="index.php?controller=CarAdmin&action=create" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên xe</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Năm sản xuất</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Màu xe</label>
                <input type="text" class="form-control" id="color" name="color" required>
            </div>

            <div class="mb-3">
                <label for="engine" class="form-label">Động cơ</label>
                <input type="text" class="form-control" id="engine" name="engine" required>
            </div>

            <div class="mb-3">
                <label for="horsepower" class="form-label">Mã lực</label>
                <input type="number" class="form-control" id="horsepower" name="horsepower" required>
            </div>

            <div class="mb-3">
                <label for="max_speed" class="form-label">Tốc độ tối đa</label>
                <input type="number" class="form-control" id="max_speed" name="max_speed" required>
            </div>

            <div class="mb-3">
                <label for="transmission" class="form-label">Truyền động</label>
                <select class="form-control" id="transmission" name="transmission" required>
                    <option value="Automatic">Tự động</option>
                    <option value="Manual">Số tay</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fuel_type" class="form-label">Loại nhiên liệu</label>
                <select class="form-control" id="fuel_type" name="fuel_type" required>
                    <option value="Gasoline">Xăng</option>
                    <option value="Electric">Điện</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá (VNĐ)</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh xe</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Đang bán</option>
                    <option value="discontinued">Ngừng bán</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Lưu xe</button>
            <a href="index.php?controller=CarAdmin" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
