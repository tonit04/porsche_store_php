<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Sửa thông tin danh mục</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-md-6">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category->name) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Ảnh danh mục</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <!-- Ảnh xem trước -->
                <img id="preview" src="assets/images/categories/<?= htmlspecialchars($category->image_url) ?>" alt="Ảnh xem trước" class="img-fluid mt-2" style="max-height: 150px;<?= empty($category->image_url) ? 'display:none;' : '' ?>">
            </div>
            <div class="text-start mt-5">
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="index.php?controller=CategoryAdmin&action=index" class="btn btn-secondary">Hủy</a>
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
                    preview.style.display = "block";
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
</body>

</html>