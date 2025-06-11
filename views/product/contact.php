<?php
require_once __DIR__ . '/../../includes/header.php';
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Liên hệ với chúng tôi</h2>
                    <p class="text-muted text-center mb-4">
                        Hãy điền thông tin vào form bên dưới, chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc
                    </p>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <!-- Thông tin liên hệ nhanh -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-phone-alt fa-2x mb-2 text-primary"></i>
                            <p class="mb-0">Hotline</p>
                            <p class="text-muted">1800 1234</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-envelope fa-2x mb-2 text-primary"></i>
                            <p class="mb-0">Email</p>
                            <p class="text-muted">porsche@gmail.vn</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-map-marker-alt fa-2x mb-2 text-primary"></i>
                            <p class="mb-0">Địa chỉ</p>
                            <p class="text-muted">140 Lê Trọng Tấn, TP.HCM</p>
                        </div>
                    </div>

                    <form method="POST" action="index.php?controller=Contact&action=create">
                        <div class="mb-3">
                            <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required 
                                placeholder="Nhập họ tên của bạn">
                            <div class="form-text">Vui lòng nhập đầy đủ họ tên để chúng tôi tiện xưng hô</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required
                                placeholder="example@domain.com">
                            <div class="form-text">Chúng tôi sẽ phản hồi qua địa chỉ email này</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nội dung cần tư vấn <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="5" required
                                placeholder="Nhập nội dung bạn cần tư vấn..."></textarea>
                            <div class="form-text">
                                Hãy mô tả chi tiết nhu cầu để chúng tôi có thể tư vấn tốt nhất
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-paper-plane me-2"></i>Gửi liên hệ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/../../includes/footer.php';
?>