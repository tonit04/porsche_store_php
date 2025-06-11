<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>





    <div class="container mt-5 py-5">
        <h2 class="text-center mb-4">Chi tiết đơn hàng</h2>

        <?php if ($order_info): ?>
            <h3>Mã đơn hàng: <?php echo htmlspecialchars($order_info['id']); ?></h3>
            <p><b>Ngày đặt hàng:</b> <?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($order_info['order_date']))); ?></p>
            <p><b>Trạng thái:</b> <span class="<?php
                                                if ($order_info['status'] == 'Đã hoàn thành') {
                                                    echo 'text-success';
                                                } elseif ($order_info['status'] == 'Đang xử lý') {
                                                    echo 'text-warning';
                                                } elseif ($order_info['status'] == 'Đã hủy') {
                                                    echo 'text-danger';
                                                } else {
                                                    echo 'text-info';
                                                }
                                                ?>"><?php echo htmlspecialchars($order_info['status']); ?></span></p>
            <p><b>Tổng hóa đơn:</b> <?php echo number_format($order_info['total_amount'], 0, ',', '.'); ?> VND</p>
            <p><b>Phương thức thanh toán:</b> <?php echo htmlspecialchars($order_info['payment_method']); ?></p>

            <?php if (!empty($order_info['notes'])): ?>
                <p><b>Ghi chú:</b> <?php echo htmlspecialchars($order_info['notes']); ?></p>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($order_details)): ?>
                                    <?php
                                    $subtotal_products = 0;
                                    foreach ($order_details as $item):
                                        $item_total = $item['current_car_price'] * $item['quantity'];
                                        $subtotal_products += $item_total;
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo htmlspecialchars(BASE_URL . 'assets/images/cars/' . $item['car_image']); ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="<?php echo htmlspecialchars($item['car_name']); ?>">
                                                </div>
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4"><?php echo htmlspecialchars($item['car_name']); ?></p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4"><?php echo number_format($item['current_car_price'], 0, ',', '.'); ?> VND</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4"><?php echo htmlspecialchars($item['quantity']); ?></p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4"><?php echo number_format($item_total, 0, ',', '.'); ?> VND</p>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>


                                    <tr>
                                        <td colspan="4" class="text-end"><b>TỔNG CỘNG:</b></td>
                                        <td>
                                            <p><b><?php echo number_format($subtotal_products, 0, ',', '.'); ?> VND</b></p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Không có sản phẩm nào trong đơn hàng này.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Không tìm thấy thông tin đơn hàng hoặc bạn không có quyền truy cập.</p>
        <?php endif; ?>
    </div>

</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
