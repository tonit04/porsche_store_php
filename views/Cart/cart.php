<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>

    <!-- Single Page Header start -->
    <div class="container-fluid  py-5">

    </div>
    <!-- Single Page Header start -->
    <div class="container-fluid page-header">
        <h3 class="text-center">Giỏ hàng của bạn</h3>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <?php
    // Hiển thị thông báo lỗi hoặc thành công nếu có
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info">
            Giỏ hàng của bạn đang trống. <a href="index.php?page=cars">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>

        <div class="container-fluid py-2">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Hủy</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cars/<?php echo $item['image_url']; ?>" class="img-fluid me-5"
                                                style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo $item['name']; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <a href="index.php?controller=Cart&action=giam&carid=<?php echo $item['car_id']; ?>" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="<?php echo $item['quantity']; ?>">
                                            <div class="input-group-btn">
                                                <a href="index.php?controller=Cart&action=tang&carid=<?php echo $item['car_id']; ?>" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VNĐ</p>
                                    </td>
                                    <td>
                                        <a href="index.php?controller=Cart&action=removeProduct&carid=<?php echo $item['car_id']; ?>" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="mt-5 col-6  col-xs-1 col-lg-8 col-md-8">

                    </div>
                    <div class=" col-6  col-xs-11 col-lg-4 col-md-4">
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                                <td><strong><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                        <a href="index.php?controller=Payment&action=index" class="mt-2 btn border-danger rounded-pill px-4  text-danger text-center " type="button">Thanh toán</a>

                    </div>
                </div>


            </div>
        </div>
    <?php endif; ?>
    <!-- Cart Page End -->


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
