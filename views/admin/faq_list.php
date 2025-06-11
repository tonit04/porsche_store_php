<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="menu-item mb-3">
        <a href="index.php?controller=Admin&action=dashboard" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại Dashboard
        </a>
        <a href="index.php?controller=FaqAdmin&action=create" class="btn btn-success ms-2">
            <i class="bi bi-plus-circle"></i> Thêm FAQ
        </a>
    </div>
    <h2 class="mb-4 text-center">Danh sách câu hỏi thường gặp (FAQ)</h2>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-info">
            <tr>
                <th>ID</th>
                <th>Câu hỏi</th>
                <th>Trả lời</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $faq): ?>
                    <tr>
                        <td><?= htmlspecialchars($faq->id) ?></td>
                        <td><?= htmlspecialchars($faq->question) ?></td>
                        <td><?= htmlspecialchars(mb_strimwidth($faq->answer, 0, 80, '...')) ?></td>
                        <td>
                            <a href="index.php?controller=FaqAdmin&action=update&id=<?= $faq->id ?>" class="btn btn-sm btn-info mb-1">Sửa</a>
                            <a href="index.php?controller=FaqAdmin&action=delete&id=<?= $faq->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa FAQ này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Không có câu hỏi nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p>Tổng số FAQ: <?= isset($faqs) ? count($faqs) : 0 ?></p>
</div>
</body>
</html>