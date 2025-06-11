<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/template/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="assets/template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/template/css/style.css" rel="stylesheet">
</head>
<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>

    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
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
                <a href="index.php?controller=User&action=register">Đăng ký</a>
                <hr>
                <div class="d-flex justify-content-center pb-4">
                    <button class="btn btn-white border-dark me-3">
                        <img class="mx-2" src="~/Assets/img/iconGG.png"
                            width="20px">Google
                    </button>
                    <button class="btn btn-white border-dark">
                        <img class="mx-2" src="~/Assets/img/iconFF.png"
                            width="20px">Facebook
                    </button>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-danger border-3 border-danger rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/template/lib/easing/easing.min.js"></script>
    <script src="assets/template/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/template/lib/lightbox/js/lightbox.min.js"></script>
    <script src="assets/template/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/template/js/main.js"></script>

</body>

</html>

<?php
require_once __DIR__ . '/../../includes/footer.php';
