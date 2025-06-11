<!-- views/payment/checkout.php -->
<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>

    <div class="container my-5">
        <h2 class="text-center mb-4">Xác nhận đơn hàng và Thanh toán</h2>
        <div class="row">
            <div class="col-lg-8">
                <?php if (isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['payment_error'])): ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $_SESSION['payment_error'];
                        unset($_SESSION['payment_error']);
                        ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Thông tin giỏ hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    if (!empty($cartItems)) :
                                        foreach ($cartItems as $item) :
                                            $itemTotal = $item['price'] * $item['quantity'];
                                            $subtotal += $itemTotal;
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                                <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                                                <td><?= number_format($itemTotal, 0, ',', '.') ?> VND</td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Giỏ hàng của bạn trống.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Tổng cộng:</th>
                                        <th><?= number_format($cartTotal, 0, ',', '.') ?> VND</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <form action="<?php echo BASE_URL; ?>index.php?controller=Payment&action=index" method="POST">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Thông tin người nhận</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Họ tên:</strong> <?= htmlspecialchars($user->full_name ?? '') ?></p>
                            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($user->phone ?? '') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($user->email ?? '') ?></p>

                            <div class="mb-3">
                                <label for="delivery_address" class="form-label">Địa chỉ giao hàng khác (nếu có):</label>
                                <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required><?php echo htmlspecialchars($user->address ?? ''); ?></textarea>
                                <small class="form-text text-muted">Địa chỉ này sẽ được dùng để giao hàng. Mặc định là địa chỉ của bạn.</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Phương thức thanh toán</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="COD" checked>
                                <label class="form-check-label" for="payment_cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay" value="VNPAY">
                                <label class="form-check-label" for="payment_vnpay">
                                    Thanh toán qua VNPAY
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Ghi chú (Tùy chọn)</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Ví dụ: Giao hàng vào giờ hành chính..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Mã giảm giá</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Nhập mã giảm giá">
                                <small class="form-text text-muted">Nhập mã giảm giá nếu có.</small>
                            </div>
                            <button type="button" id="apply_discount" class="btn btn-secondary">Áp dụng mã giảm giá</button>
                            <div id="discount_result" class="mt-3"></div>
                        </div>
                    </div>
                    <input type="hidden" name="total_amount" value="<?= htmlspecialchars($cartTotal) ?>">
                    <button type="submit" class="btn btn-primary w-100 py-3">Hoàn tất đặt hàng</button>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
    document.getElementById('apply_discount').addEventListener('click', function() {
        const discountCode = document.getElementById('discount_code').value;
        const totalAmount = document.querySelector('input[name="total_amount"]').value;

        if (!discountCode) {
            document.getElementById('discount_result').innerHTML = '<span class="text-danger">Vui lòng nhập mã giảm giá.</span>';
            return;
        }

        fetch('<?php echo BASE_URL; ?>index.php?controller=Payment&action=applyDiscount', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    discount_code: discountCode,
                    total_amount: totalAmount
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('discount_result').innerHTML = `<span class="text-success">Mã giảm giá hợp lệ! Giảm giá: ${data.discount_amount} VND</span>`;
                } else {
                    document.getElementById('discount_result').innerHTML = `<span class="text-danger">${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('discount_result').innerHTML = '<span class="text-danger">Có lỗi xảy ra. Vui lòng thử lại.</span>';
            });
    });
</script>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
