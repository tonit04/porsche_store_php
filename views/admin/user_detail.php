<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            width: 30%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Thông tin chi tiết người dùng</h2>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?= htmlspecialchars($user->id) ?></td>
                    </tr>
                    <tr>
                        <th>Tên đăng nhập</th>
                        <td><?= htmlspecialchars($user->username) ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($user->email) ?></td>
                    </tr>
                    <tr>
                        <th>Họ và tên</th>
                        <td><?= htmlspecialchars($user->full_name) ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?= htmlspecialchars($user->phone) ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td><?= htmlspecialchars($user->address) ?></td>
                    </tr>
                    <tr>
                        <th>Quyền</th>
                        <td><?= htmlspecialchars($user->role) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td><?= htmlspecialchars($user->created_at) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td><?= htmlspecialchars($user->updated_at) ?></td>
                    </tr>
                    <tr>
                        <th>Xác minh</th>
                        <td>
                            <span class="badge bg-<?= $user->is_verified ? 'success' : 'secondary' ?>">
                                <?= $user->is_verified ? 'Đã xác minh' : 'Chưa xác minh' ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="index.php?controller=UserAdmin&action=index" class="btn btn-secondary">Quay lại</a>
            <a href="index.php?controller=UserAdmin&action=update&id=<?= $user->id ?>"
                class="btn btn-sm btn-info mb-1">Sửa</a>
            <a href="index.php?controller=UserAdmin&action=delete&id=<?= $user->id ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">Xóa</a>
        </div>
    </div>
</body>

</html>