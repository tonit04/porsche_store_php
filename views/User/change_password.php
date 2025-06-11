<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>
    <div class="container-fluid py-5"></div>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Đổi Mật Khẩu</h2>

                        <?php if (!empty($message)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo BASE_URL; ?>index.php?controller=User&action=changePassword" method="POST">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mật khẩu hiện tại:</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required minlength="12">
                                <small class="form-text text-muted">Mật khẩu mới phải có ít nhất 12 ký tự.</small>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_new_password" class="form-label">Xác nhận mật khẩu mới:</label>
                                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đổi Mật Khẩu</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="<?php echo BASE_URL; ?>index.php?controller=User&action=profile">Quay lại trang cá nhân</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-danger border-3 border-danger rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="assets/template/lib/easing/easing.min.js"></script>
    <script src="assets/template/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/template/lib/lightbox/js/lightbox.min.js"></script>
    <script src="assets/template/lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="assets/template/js/main.js"></script>

</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
