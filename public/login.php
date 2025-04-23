<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    // Nếu người dùng đã đăng nhập, chuyển hướng tới trang home.php
    header("Location: home.php");
    exit();
}

// Nếu người dùng gửi form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thông tin đăng nhập giả sử
    $username = 'admin'; 
    $password = 'password123'; 

    // Lấy thông tin từ form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Kiểm tra đăng nhập
    if ($input_username === $username && $input_password === $password) {
        // Lưu session đăng nhập
        $_SESSION['user_logged_in'] = true;
        header("Location: home.php");  // Chuyển hướng đến trang home
        exit();
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Website bán xe</title>
    <!-- Kết nối với Bootstrap qua CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center" style="height: 100vh; align-items: center;">
            <div class="col-4">
                <h2 class="text-center mb-4">Đăng nhập</h2>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger">
                        <?= $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
                <div class="text-center mt-3">
                    <a href="#" class="text-muted">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
