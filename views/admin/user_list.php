<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách người dùng</title>
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
        <div class="menu-item">
            <a href="index.php?controller=Admin&action=dashboard" class="menu-link">
                <span class="menu-text">Admin Dashboard</span>
            </a>
        </div>
        <h1 class="text-center mb-4">Danh sách người dùng</h1>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Điện thoại</th>
                    <th>Vai trò</th>
                    <th>Xác thực</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user->id) ?></td>
                            <td><?= htmlspecialchars($user->full_name) ?></td>
                            <td><?= htmlspecialchars($user->phone) ?></td>
                            <td><?= htmlspecialchars($user->role) ?></td>
                            <td>
                                <?= $user->is_verified ? '<span class="text-success fw-bold">Đã xác thực</span>' : '<span class="text-danger fw-bold">Chưa xác thực</span>' ?>
                            </td>
                            <td>
                                <a href="index.php?controller=UserAdmin&action=detail&id=<?= $user->id ?>"
                                    class="btn btn-sm btn-warning mb-1">Xem chi tiết</a>
                                <a href="index.php?controller=UserAdmin&action=update&id=<?= $user->id ?>"
                                    class="btn btn-sm btn-info mb-1">Sửa</a>
                                <a href="index.php?controller=UserAdmin&action=delete&id=<?= $user->id ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center text-muted">Không có người dùng nào trong cơ sở dữ liệu.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?controller=UserAdmin&action=index&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <p>Tổng số người dùng: <?= $totalUsers ?></p>

    </div>
</body>

</html>