<!-- views/payment/failed.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thất bại - Porsche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/porsche/assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include __DIR__ . '/../layouts/header.php'; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Thanh toán thất bại</h5>
                    </div>
                    <div class="card-body text-center py-5">
                        <div class="failed-icon mb-4">
                            <i class="fas fa-times-circle fa-5x text-danger"></i>
                        </div>
                        <h3 class="mb-3">Đã xảy ra lỗi trong quá trình thanh toán</h3>
                        <div class="alert alert-danger d-inline-block">
                            <?= htmlspecialchars($error) ?>
                        </div>
                        <p class="my-4">Đơn hàng của bạn không thể được xử lý do lỗi thanh toán. Vui lòng thử lại hoặc chọn phương thức thanh toán khác.</p>
                        <div class="payment-options mb-4">
                            <h5 class="mb-3">Bạn có thể thử lại với các tùy chọn sau:</h5>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <i class="fas fa-credit-card fa-2x mb-3 text-primary"></i>
                                            <h6>Thanh toán qua VNPAY</h6>
                                            <p class="small text-muted">Thanh toán nhanh chóng và an toàn với thẻ ngân hàng hoặc ví điện tử VNPAY</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <i class="fas fa-truck fa-2x mb-3 text-primary"></i>
                                            <h6>Thanh toán khi nhận hàng (COD)</h6>
                                            <p class="small text-muted">Thanh toán tiền mặt khi nhận được sản phẩm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="/porsche/payment" class="btn btn-primary me-2">Thử lại thanh toán</a>
                            <a href="/porsche/cart" class="btn btn-outline-secondary">Quay lại giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>