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


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="left">
                                <div class="big-img">
                                    <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>">
                                </div>
                                <div class="images">
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" onclick="showImg(this.src)">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3 text-wrap"><?= htmlspecialchars($car->name) ?></h4>
                            <h5 class="fw-bold mb-3"><?= number_format(htmlspecialchars($car->price), 0, ',', '.') ?> VNĐ</h5>
                            <p class="mb-3">Dòng xe: <?= htmlspecialchars($car->model->name) ?> </p>
                            <p class="mb-3">Màu sơn: <?= htmlspecialchars($car->color) ?> </p>
                            <p class="mb-3">Sản xuất: <?= htmlspecialchars($car->year) ?> </p>


                            <div class="my-4">
                                <p class="mb-0">✔ Bảo hành động cơ 2 năm hoặc 50.000 km.</p>
                                <p class="mb-0">✔ Hỗ trợ thủ tục đăng ký, sang tên nhanh chóng.</p>
                                <p class="mb-0">✔ Miễn phí vận chuyển xe tận nhà toàn quốc.</p>
                                <p class="mb-0">✔ Tặng gói bảo dưỡng miễn phí lần đầu.</p>
                            </div>

                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#" class="btn border border-danger rounded-pill px-3 text-danger "><i
                                    class="fa fa-shopping-bag me-2 text-danger"></i> Thêm vào
                                giỏ</a>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p><?= htmlspecialchars($car->engine) ?></p>

                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-8">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0"><b>Động cơ: </b></p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->engine) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0"><b>Mã lực</b></p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->horsepower) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0"><b>Tốc độ tối đa</b></p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->max_speed) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0"><b>Hộp số</b></p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->transmission) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0">Nhiên liệu</p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->fuel_type) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0"><b>Hộp số</b></p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->transmission) ?></p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-3">
                                                        <p class="mb-0">Nhiên liệu</p>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0"><?= htmlspecialchars($car->fuel_type) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Jason Smith</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>The generated Lorem Ipsum is therefore always free from repetition
                                                injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Sam Peters</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">The generated Lorem Ipsum is therefore always free from
                                                repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">

                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><img src="dell.png"></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><img src="asus.png"></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><img src="msi.png"></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><img src="hp.png"></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><img src="macbook.png"></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Xe bán chạy</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <div class="border border-danger rounded position-relative vesitable-item pb-4">
                        <div class="vesitable-img">
                            <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>

                        <div class="p-2 pb-0 rounded-bottom">
                            <h6><?= htmlspecialchars($car->name) ?></h6>
                            <p class="mb-0 " style="font-size: 14px;">Động cơ: <?= htmlspecialchars($car->engine) ?></p>
                            <p class="mb-0 " style="font-size: 14px;">Mã lực: <?= htmlspecialchars($car->horsepower) ?></p>
                            <p class="mb-0 " style="font-size: 14px;">Max speed: <?= htmlspecialchars($car->max_speed) ?></p>
                            <p class="mb-0 " style="font-size: 14px;">Hộp số: <?= htmlspecialchars($car->transmission) ?></p>


                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-danger fs-5 fw-bold mb-0 text-center"><?= number_format(htmlspecialchars($car->price), 0, ',', '.') ?>VND</p>
                                <s class="text-dark"><?= number_format(htmlspecialchars(9000000000), 0, ',', '.') ?>VND</s>
                                <a style="display: block; margin: 0 auto;" href="#"
                                    class="btn border border-danger rounded-pill px-3 text-danger "><i
                                        class="fa fa-shopping-bag me-2 text-danger"></i> Thêm vào
                                    giỏ</a>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

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