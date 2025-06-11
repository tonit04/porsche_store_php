<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="menu-item mb-3">
        <a href="index.php?controller=FaqAdmin" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách FAQ
        </a>
    </div>
    <h2 class="mb-4 text-center">Cập nhật câu hỏi thường gặp (FAQ)</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Câu hỏi <span class="text-danger">*</span></label>
            <input type="text" name="question" class="form-control" required value="<?= htmlspecialchars($faq->question) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Trả lời <span class="text-danger">*</span></label>
            <textarea name="answer" class="form-control" rows="5" required><?= htmlspecialchars($faq->answer) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="index.php?controller=FaqAdmin" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>