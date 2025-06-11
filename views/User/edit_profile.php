<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>
    <div class="container-fluid py-5"></div>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Cập Nhật Thông Tin Cá Nhân</h2>

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

                        <form action="<?php echo BASE_URL; ?>index.php?controller=User&action=editProfile" method="POST">

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Họ và Tên:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user_data->full_name ?? ''); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user_data->email ?? ''); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data->phone ?? ''); ?>" required pattern="^0[0-9]{9,10}$" title="Số điện thoại phải có 10 hoặc 11 chữ số và bắt đầu bằng 0.">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ:</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($user_data->address ?? ''); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cập Nhật</button>
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
</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
