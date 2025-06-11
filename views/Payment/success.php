<!-- views/payment/checkout.php -->
<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Đặt hàng thành công</h5>
                    </div>
                    <div class="card-body text-center py-5">
                        <div class="success-icon mb-4">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                        </div>
                        <h3 class="mb-3">Cảm ơn bạn đã đặt hàng!</h3>
                        <p class="mb-4">Đơn hàng #<?= $orderInfo->id ?> của bạn đã được xác nhận thành công.</p>
                        <div class="order-details mb-4 text-start">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Chi tiết đơn hàng</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><strong>Mã đơn hàng:</strong> #<?= $orderInfo->id ?></p>
                                            <p><strong>Ngày đặt hàng:</strong> <?= date('d/m/Y H:i', strtotime($orderInfo->order_date)) ?></p>
                                            <p><strong>Phương thức thanh toán:</strong>
                                                <?php
                                                if ($orderInfo->payment_method == 'COD') {
                                                    echo 'Thanh toán khi nhận hàng (COD)';
                                                } elseif ($orderInfo->payment_method == 'VNPAY') {
                                                    echo 'Thanh toán qua VNPAY';
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Tình trạng:</strong> <span class="badge bg-success">Đã xác nhận</span></p>
                                            <p><strong>Tổng thanh toán:</strong> <?= number_format($orderInfo->total_amount) ?> VNĐ</p>
                                        </div>
                                    </div>

                                    <h6 class="mb-3">Sản phẩm đã đặt:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orderItems as $item): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($item->car->name) ?></td>
                                                        <td><?= number_format($item->price) ?> VNĐ</td>
                                                        <td><?= $item->quantity ?></td>
                                                        <td><?= number_format($item->price * $item->quantity) ?> VNĐ</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Giảm giá:</strong></td>
                                                    <td><strong><?= number_format($orderInfo->discount_applied) ?> VNĐ</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                                    <td><strong><?= number_format($orderInfo->total_amount) ?> VNĐ</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="/porsche_store_php/index.php?controller=User&action=Orderdetails&id=<?= $orderInfo->id ?>" class="btn btn-outline-primary me-2">Xem đơn hàng của tôi</a>
                            <a href="/porsche_store_php/" class="btn btn-primary">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
