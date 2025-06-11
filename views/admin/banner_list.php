<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách banner</title>
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
        <h1 class="text-center mb-4">Danh sách banner</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Tên banner</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($banners)): ?>
                    <?php foreach ($banners as $banner): ?>
                        <tr>
                            <td><?= htmlspecialchars($banner->id) ?></td>
                            <td><?= htmlspecialchars($banner->name) ?></td>
                            <td><?= htmlspecialchars($banner->description) ?></td>
                            <td>
                                <?php if (!empty($banner->image_url)): ?>
                                    <img src="assets/images/banners/<?= htmlspecialchars($banner->image_url) ?>" alt="Ảnh banner"
                                        style="max-width: 80px; max-height: 80px;">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?controller=BannerAdmin&action=update&id=<?= $banner->id ?>"
                                    class="btn btn-sm btn-info mb-1">Sửa</a>
                                <a href="index.php?controller=BannerAdmin&action=delete&id=<?= $banner->id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa banner này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Không có banner nào trong cơ sở dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p>Tổng số banner: <?= isset($banners) ? count($banners) : 0 ?></p>

    </div>
    <div class="menu-item mb-3">
        <a href="index.php?controller=BannerAdmin&action=create" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm banner
        </a>
    </div>
</body>

</html>