<!-- views/payment/checkout.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Porsche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/porsche/assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Thông tin thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['payment_error'])): ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['payment_error'];
                                unset($_SESSION['payment_error']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="index.php?controller=Payment&action=processPayment" method="POST">
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                                    <label class="form-check-label" for="cod">
                                        <i class="fas fa-truck me-2"></i> Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="VNPAY">
                                    <label class="form-check-label" for="vnpay">
                                        <i class="fas fa-credit-card me-2"></i> Thanh toán qua VNPAY
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi chú đơn hàng</label>
                                <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Nhập ghi chú về đơn hàng của bạn"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Giỏ hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($cartItems)): ?>
                            <p class="text-muted">Giỏ hàng trống</p>
                        <?php else: ?>
                            <div class="cart-items">
                                <?php foreach ($cartItems as $item): ?>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                            <p class="text-muted small mb-0">
                                                <?= number_format($item['price']) ?> VNĐ x <?= $item['quantity'] ?>
                                            </p>
                                        </div>
                                        <span class="fw-bold"><?= number_format($item['price'] * $item['quantity']) ?> VNĐ</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Tổng tiền:</h5>
                                <span class="fw-bold fs-5"><?= number_format($cartTotal) ?> VNĐ</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Lấy thông tin người dùng
                        $userQuery = "SELECT * FROM users WHERE id = :user_id";
                        $userStmt = $this->db->prepare($userQuery);
                        $userStmt->bindParam(':user_id', $user_id);
                        $userStmt->execute();
                        $user = $userStmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <p><strong>Họ tên:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
                        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($user['address']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                        <a href="/porsche/profile/edit" class="btn btn-outline-secondary btn-sm">Thay đổi thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>