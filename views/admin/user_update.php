<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Sửa thông tin người dùng</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="col-md-6">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select">
                    <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                    <option value="customer" <?= $user->role === 'customer' ? 'selected' : '' ?>>Khách hàng</option>
                </select>
                <label class="form-label">Xác thực</label>
                <select name="is_verified" class="form-select">
                    <option value="0" <?= $user->is_verified === 0 ? 'selected' : '' ?>>Chưa xác thực</option>
                    <option value="1" <?= $user->is_verified === 1 ? 'selected' : '' ?>>Đã xác thực</option>
                </select>
            </div>
            <div class="text-start mt-5">
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                <a href="index.php?controller=UserAdmin&action=index" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</body>

</html>