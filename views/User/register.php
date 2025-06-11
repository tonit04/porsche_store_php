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

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->




    <!-- Single Page Header start -->
    <div class="container-fluid  py-5">

    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <!-- Fruits Shop Start-->
    <div class="container-fluid py-5">

        <div class="container mt-5 d-flex justify-content-center">

            <!-- Đăng ký -->
            <div class="col-md-5 border border-dark p-4 rounded shadow">
                <h3 class="text-center">ĐĂNG KÝ</h3>
                <form method="POST">
                    <div class="text-danger">
                        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                    </div>
                    <div class="mb-3">
                        <label>Username *</label>
                        <input name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label>Password *</label>

                        <input name="password" type="password" class="form-control" placeholder="Password">


                    </div>

                    <div class="mb-3">
                        <label>Email *</label>
                        <input name="email" type="text" class="form-control" placeholder="Email">

                    </div>
                    <div class="mb-3">
                        <label for="">Họ tên</label>
                        <input name="full_name" class="form-control" placeholder="Họ Tên">

                    </div>
                    <div class="mb-3">
                        <label for="">Số điện thoại</label>
                        <input name="phone" class="form-control" placeholder="Số điện thoại">

                    </div>
                    <div class="mb-3">
                        <label for="">Địa chỉ</label>
                        <input name="address" class="form-control" placeholder="Địa chỉ">

                    </div>


                    <button type="submit" class="btn btn-dark w-100">Đăng ký</button>
                </form>
                <a href="index.php?controller=User&action=login">Đăng nhập</a>
                <p class="mt-3 text-center">
                    Thông tin cá nhân của bạn sẽ được dùng để điền vào hóa đơn, giúp bạn
                    thanh
                    toán nhanh chóng và dễ dàng.
                </p>
            </div>
        </div>
    </div>
    </div>
    <!-- Fruits Shop End-->






    <!-- Back to Top -->
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
