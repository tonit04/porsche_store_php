<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Viết đánh giá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center">Viết đánh giá cho xe</h3>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php elseif (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                        <div class="text-center mt-3">
                            <a href="javascript:history.back()" class="btn btn-primary">Quay lại</a>
                        </div>
                    <?php else: ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Chọn số sao <span class="text-danger">*</span></label>
                                <select name="rating" class="form-select" required>
                                    <option value="">-- Chọn số sao --</option>
                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                        <option value="<?= $i ?>"><?= $i ?> sao</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nhận xét <span class="text-danger">*</span></label>
                                <textarea name="comment" class="form-control" rows="4" required placeholder="Nhập nhận xét của bạn"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5">Gửi đánh giá</button>
                                <a href="javascript:history.back()" class="btn btn-secondary ms-2">Hủy</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>