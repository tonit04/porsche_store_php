<?php
require_once __DIR__ . '/../../includes/header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION['review_success'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['review_success']; unset($_SESSION['review_success']); ?>
    </div>
<?php endif; ?>
?>

<body>
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
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>"
                                            onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>"
                                            onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>"
                                            onclick="showImg(this.src)">
                                    </div>
                                    <div class="small-img">
                                        <img src="assets/images/cars/<?= htmlspecialchars($car->image_url) ?>"
                                            onclick="showImg(this.src)">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <form action="index.php?controller=Cart&action=AddToCart" method="post">
                                <input type="hidden" name="id" value="123">
                                <input type="hidden" name="car_id" value="<?= htmlspecialchars($car->id) ?>">
                                <input type="hidden" name="price" value="<?= htmlspecialchars($car->price) ?>">
                                <h4 class="fw-bold mb-3 text-wrap"><?= htmlspecialchars($car->name) ?></h4>
                                <h5 class="fw-bold mb-3">
                                    <?= number_format(htmlspecialchars($car->price), 0, ',', '.') ?> VNĐ</h5>
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
                                        <button type="button"
                                            class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0"
                                        value="1" name="quantity">
                                    <div class="input-group-btn">
                                        <button type="button"
                                            class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button class="btn border border-danger rounded-pill px-4 py-2 mb-4 text-danger"><i
                                        class="fa fa-shopping-bag me-2 text-danger"></i> Thêm vào giỏ</button>
                            </form>
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
                                    <?php
                                    // Lấy danh sách review cho xe hiện tại
                                    require_once __DIR__ . '/../../models/Review.php';
                                    $reviewModel = new Review();
                                    $reviews = $reviewModel->getByCar($car->id);
                                    // Kiểm tra quyền đánh giá
                                    if (session_status() === PHP_SESSION_NONE) {
                                        session_start();
                                    }
                                    $showReviewBtn = false;
                                    if (isset($_SESSION['user_id'])) {
                                        $user_id = $_SESSION['user_id'];
                                        // Đã mua xe và chưa từng đánh giá
                                        if ($reviewModel->hasPurchased($user_id, $car->id) && !$reviewModel->getByUserAndCar($user_id, $car->id)) {
                                            $showReviewBtn = true;
                                        }
                                    }
                                    if ($showReviewBtn): ?>
                                        <div class="mb-4">
                                            <a href="index.php?controller=Review&action=create&car_id=<?= $car->id ?>"
                                                class="btn btn-primary">
                                                <i class="fa fa-star"></i> Viết đánh giá cho xe này
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php include __DIR__ . '/review_list.php'; ?>
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
                    </div>
                </div>
            </div>
            <!-- <h1 class="fw-bold mb-0">Xe bán chạy</h1>
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
                                        class="fa fa-shopping-bag me-2 text-danger"></i> Thêm vào giỏ</a>

                            </div>
                        </div>
                    </div>



                </div>
            </div> -->
        </div>
    </div>
    <!-- Single Product End -->

    <!-- Fruits Shop End-->


    <!-- Footer Start -->

    <!-- Footer End -->




    <!-- Back to Top -->
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


