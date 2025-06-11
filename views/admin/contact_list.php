<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách liên hệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid py-5">
        <div class="menu-item mb-3">
            <a href="index.php?controller=Admin&action=dashboard" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại Dashboard
            </a>
        </div>
        <h1 class="text-center mb-4">Danh sách liên hệ khách hàng</h1>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contacts)): ?>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= htmlspecialchars($contact->id) ?></td>
                    <td><?= htmlspecialchars($contact->name) ?></td>
                    <td><?= htmlspecialchars($contact->email) ?></td>
                    <td><?= htmlspecialchars(mb_strimwidth($contact->message, 0, 50, '...')) ?></td>
                    <td><?= htmlspecialchars($contact->created_at) ?></td>
                    <td>
                        <?php if ($contact->status == 1): ?>
                            <span class="badge bg-success">Đã phản hồi</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Chưa phản hồi</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?controller=ContactAdmin&action=detail&id=<?= $contact->id ?>"
                            class="btn btn-sm btn-info mb-1">Xem chi tiết</a>
                        <?php if ($contact->status == 0): ?>
                        <a href="index.php?controller=ContactAdmin&action=comfirmed&id=<?= $contact->id ?>"
                            class="btn btn-sm btn-success mb-1">Đã phản hồi</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Không có liên hệ nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p>Tổng số liên hệ: <?= isset($contacts) ? count($contacts) : 0 ?></p>
    </div>
</body>
</html>