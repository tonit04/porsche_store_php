<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết liên hệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="menu-item mb-3">
        <a href="index.php?controller=ContactAdmin" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách liên hệ
        </a>
    </div>
    <h2 class="mb-4 text-center">Chi tiết liên hệ khách hàng</h2>
    <?php if ($contact): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p><strong>ID:</strong> <?= htmlspecialchars($contact->id) ?></p>
                <?php if ($userInfo): ?>
                    <p><strong>Tài khoản gửi:</strong> <?= htmlspecialchars($userInfo->username) ?></p>
                    <p><strong>Họ tên user:</strong> <?= htmlspecialchars($userInfo->full_name) ?></p>
                    <p><strong>Email user:</strong> <?= htmlspecialchars($userInfo->email) ?></p>
                    <?php if (!empty($userInfo->phone)): ?>
                        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($userInfo->phone) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($userInfo->address)): ?>
                        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($userInfo->address) ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <p><strong>Người gửi:</strong> Khách (chưa đăng nhập)</p>
                <?php endif; ?>
                <hr>
                <p><strong>Họ tên (khách nhập):</strong> <?= htmlspecialchars($contact->name) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($contact->email) ?></p>
                <p><strong>Nội dung:</strong><br><?= nl2br(htmlspecialchars($contact->message)) ?></p>
                <p><strong>Ngày gửi:</strong> <?= htmlspecialchars($contact->created_at) ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Không tìm thấy liên hệ này.</div>
    <?php endif; ?>
</div>
</body>
</html>