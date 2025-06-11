<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>

    <div class="container-fluid  py-5"></div>
    <div class="container-fluid py-5">
        <div class="container mt-5 d-flex justify-content-center">
            <div class="col-md-5 border border-dark p-4 rounded shadow">
                <h3 class="text-center">ĐĂNG NHẬP</h3>
                <?php
                // Hiển thị thông báo đăng ký thành công
                if (isset($_SESSION['registration_success'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_SESSION['registration_success']);
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    unset($_SESSION['registration_success']); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <form method="POST">
                    <div class="text-danger">
                        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                    </div>

                    <div class="mb-3">
                        <input required name="username" type="text" class="form-control" placeholder="Username">
                    </div>

                    <div class="mb-3">
                        <input required name="password" type="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark w-50">
                            Đăng nhập
                        </button>
                    </div>
                </form>
                <a style="text-decoration: none;" href="index.php?controller=User&action=forgotPassword">Quên mật khẩu</a>

            </div>
        </div>
    </div>
    <a href="#" class="btn btn-danger border-3 border-danger rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>



    <!-- JavaScript Libraries -->

</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
