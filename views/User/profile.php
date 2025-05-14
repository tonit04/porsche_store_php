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

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-danger d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-white"></i> <a href="#"
                            class="text-white">140 Lê Trọng Tấn, phường Tây Thạnh, TPHCM</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-white"></i><a href="#"
                            class="text-white">shoptec@gmail.com</a></small>
                </div>

            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-danger display-6">ShopTec</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-danger"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="shop.html" class="nav-item nav-link active">Shop</a>
                        <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="cart.html" class="dropdown-item">Cart</a>
                                <a href="chackout.html" class="dropdown-item">Chackout</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <div class="input-group w-100  d-flex ">
                            <input type="search" class="form-control" placeholder="Tìm kiếm"
                                aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text "><i class="fa fa-search"></i></span>
                        </div>
                        <a href="#" class="position-relative mx-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x text-danger"></i>
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                        </a>
                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x text-danger"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->





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


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-danger mb-0">ShopTec</h1>
                                <p class="text-secondary mb-0">Uy tín - Chất lượng</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number"
                                    placeholder="Your Email">
                                <button type="submit"
                                    class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                                    style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Why People Like us!</h4>
                            <p class="mb-4">typesetting, remaining essentially unchanged. It was
                                popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                            <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="">About Us</a>
                            <a class="btn-link" href="">Contact Us</a>
                            <a class="btn-link" href="">Privacy Policy</a>
                            <a class="btn-link" href="">Terms & Condition</a>
                            <a class="btn-link" href="">Return Policy</a>
                            <a class="btn-link" href="">FAQs & Help</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Account</h4>
                            <a class="btn-link" href="">My Account</a>
                            <a class="btn-link" href="">Shop details</a>
                            <a class="btn-link" href="">Shopping Cart</a>
                            <a class="btn-link" href="">Wishlist</a>
                            <a class="btn-link" href="">Order History</a>
                            <a class="btn-link" href="">International Orders</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: 1429 Netus Rd, NY 48247</p>
                            <p>Email: Example@gmail.com</p>
                            <p>Phone: +0123 4567 8910</p>
                            <p>Payment Accepted</p>
                            <img src="img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->





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