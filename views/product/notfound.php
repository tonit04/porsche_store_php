<?php
// Sử dụng header và footer chung
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container py-5 my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-danger">Không tìm thấy sản phẩm</h1>
            <p class="lead mb-4">Sản phẩm bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <div>
                <a href="<?php echo BASE_URL; ?>index.php?controller=home&action=index" class="btn btn-danger me-2">Quay về trang chủ</a>
                <a href="javascript:history.back()" class="btn btn-outline-dark">Quay lại trang trước</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?> 