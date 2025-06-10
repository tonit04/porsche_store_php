<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>
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
            <a href="index.php?controller=Admin&action=dashboard" class="menu-link ms-2">
                <span class="menu-text">Admin Dashboard</span>
            </a>
        </div>
        <h1 class="text-center mb-4">Danh sách danh mục</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category->id) ?></td>
                            <td><?= htmlspecialchars($category->name) ?></td>
                            <td>
                                <?php if (!empty($category->image_url)): ?>
                                    <img src="assets/images/categories/<?= htmlspecialchars($category->image_url) ?>"
                                        alt="Ảnh danh mục" style="max-width: 80px; max-height: 80px;">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?controller=CategoryAdmin&action=update&id=<?= $category->id ?>"
                                    class="btn btn-sm btn-info mb-1">Sửa</a>
                                <a href="index.php?controller=CategoryAdmin&action=delete&id=<?= $category->id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Không có danh mục nào trong cơ sở dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p>Tổng số danh mục: <?= isset($categories) ? count($categories) : 0 ?></p>

    </div>
     <div class="menu-item mb-3">
            <a href="index.php?controller=CategoryAdmin&action=create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm danh mục
            </a>
           
        </div>
</body>

</html>