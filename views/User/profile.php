<?php session_start(); ?>
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

        <!-- Fruits Shop Start-->
        <div class="container mt-5">
            <h2 class="text-center mb-4">Thông Tin Cá Nhân</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><strong>Họ và Tên:</strong> Trần thị ;an</h5>
                    <p class="card-text"><strong>Email:</strong> kh01@gmail.com</p>
                    <p class="card-text"><strong>Số Điện Thoại:</strong> 0398926997</p>
                    <p class="card-text"><strong>Địa Chỉ:</strong> 123 đường D, quận 4 TPHCM</p>
                </div>
            </div>

            <h2 class="text-center mb-4">Đơn Hàng Của Bạn</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Ngày Đặt</th>
                                    <th>Trạng Thái</th>
                                    <th>Tổng Tiền</th>
                                    <th>Địa Chỉ Giao</th>
                                    <th>Chi Tiết</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td>3/30/2025 6:32:43 PM</td>
                                    <td class="text-danger">Đang xử lý</td>
                                    <td>745,000 VND</td>
                                    <td> 140 Lê Trọng Tấn-1231-TPHCM</td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                        <a href="" class="btn btn-danger btn-sm">Hủy</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3/30/2025 6:32:43 PM</td>
                                    <td class="text-danger">Đang xử lý</td>
                                    <td>745,000 VND</td>
                                    <td> 140 Lê Trọng Tấn-1231-TPHCM</td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                        <a href="" class="btn btn-danger btn-sm">Hủy</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3/30/2025 6:32:43 PM</td>
                                    <td class="text-danger">Đang xử lý</td>
                                    <td>745,000 VND</td>
                                    <td> 140 Lê Trọng Tấn-1231-TPHCM</td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                        <a href="" class="btn btn-danger btn-sm">Hủy</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3/30/2025 6:32:43 PM</td>
                                    <td class="text-danger">Đang xử lý</td>
                                    <td>745,000 VND</td>
                                    <td> 140 Lê Trọng Tấn-1231-TPHCM</td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                        <a href="" class="btn btn-danger btn-sm">Hủy</a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
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