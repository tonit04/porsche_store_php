<?php

// Include phần Header
require_once 'includes/header.php';
?>

<!-- ==================== MAIN CONTENT AREA for index.php ==================== -->
<main>
    <!-- 1. ĐỘC BẢN KINH ĐIỂN (Carousel 1) -->
    <section class="my-5">
        <div id="carouselKinhDien" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- Sử dụng div với background image để dễ dàng đặt text overlay -->
                    <div style="background-image: url('https://porsche-vietnam.vn/wp-content/uploads/2025/03/992-II-headbanner-1600x616.jpg'); height: 60vh; background-size: cover; background-position: center;" class="d-block w-100">
                         <div class="carousel-caption d-none d-md-block text-center" style="background-color: rgba(0,0,0, 0.3); padding: 20px; bottom: 10%;">
                            <h2>Độc Bản Kinh Điển</h2>
                            <p>Khám phá những thiết kế độc đáo và di sản lịch sử.</p>
                        </div>
                    </div>
                </div>
                 <div class="carousel-item">
                     <div style="background-image: url('https://porsche-vietnam.vn/wp-content/uploads/2024/12/MA24T4COX0001_low-headbanner-1600x615.jpg'); height: 60vh; background-size: cover; background-position: center;" class="d-block w-100">
                         <div class="carousel-caption d-none d-md-block text-center" style="background-color: rgba(0,0,0, 0.3); padding: 20px; bottom: 10%;">
                            <h2>Một Câu Chuyện Khác</h2>
                            <p>Mô tả thêm về một dòng xe hoặc sự kiện đặc biệt.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselKinhDien" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselKinhDien" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- 2. DÒNG XE MỚI (Carousel 2 - Panamera) -->
    <section class="my-5">
         <div id="carouselXeMoi" class="carousel slide" data-bs-ride="false"> <?php // data-bs-ride="false" để không tự chạy ?>
            <div class="carousel-inner">
                <div class="carousel-item active">
                     <div style="background-image: url('assets/images/cars/911_carrera_silver_metallic.png'); height: 75vh; background-size: cover; background-position: center; position: relative;" class="d-block w-100">
                         <div class="container h-100 d-flex flex-column justify-content-end pb-5 text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
                            <h1 class="display-4 fw-bold">Panamera</h1>
                            <p class="lead fw-bold" style="color: #ffdddd;">Từ 5.570.000.000 VNĐ</p>
                            <p class="mb-1"><small>Sedan thể thao đẳng cấp</small></p>
                            <p class="mb-4"><small>Công suất: 325 HP | Tăng tốc 0-100km/h</small></p>
                            <div>
                                <a href="#" class="btn btn-danger btn-lg">Đăng ký lái thử</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselXeMoi" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselXeMoi" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- 1. KHÁM PHÁ CÁC DÒNG XE -->
<section class="container my-5">
    <h2 class="text-center mb-4">KHÁM PHÁ CÁC DÒNG XE</h2>
    <!-- Container chính cho slider -->
    <div class="car-slider-container" style="position: relative; overflow: hidden;">
        <!-- Dải băng chứa các xe -->
        <div class="car-slider-track d-flex" style="transition: transform 0.5s ease;">
            <?php
            $cars = [
                ['name' => 'Porsche 911', 'desc' => 'Biểu tượng thể thao đỉnh cao', 'price' => '$99,200', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'],
                ['name' => 'Porsche Cayenne', 'desc' => 'SUV sang trọng đa năng', 'price' => '$72,200', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'], // Dùng tạm ảnh Cayman
                ['name' => 'Porsche Taycan', 'desc' => 'Tương lai của xe điện', 'price' => '$86,700', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'],
                ['name' => 'Porsche Panamera', 'desc' => 'Sedan thể thao hạng sang', 'price' => '$88,550', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'], // Dùng tạm ảnh Targa
                ['name' => 'Porsche Macan', 'desc' => 'SUV nhỏ gọn, linh hoạt', 'price' => '$57,500', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'], // Dùng ảnh placeholder
                ['name' => 'Porsche 718 Cayman S', 'desc' => 'Cảm giác lái thuần khiết', 'price' => '$74,600', 'img' => 'assets/images/cars/911_carrera_silver_metallic.png', 'link' => '#'],
            ];
            ?>

            <?php foreach ($cars as $car): ?>
            <!-- Mỗi xe là một 'car-item' -->
            <div class="car-item px-2" style="flex: 0 0 33.3333%; max-width: 33.3333%;">
                 <div class="card h-100 shadow-sm border-0">
                    <img src="<?php echo htmlspecialchars($car['img']); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($car['name']); ?>">
                    <div class="card-body pt-0">
                        <h5 class="card-title"><?php echo htmlspecialchars($car['name']); ?></h5>
                        <p class="card-text small text-muted"><?php echo htmlspecialchars($car['desc']); ?></p>
                        <p class="card-text fw-bold text-danger fs-5"><?php echo htmlspecialchars($car['price']); ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3 text-end">
                         <a href="<?php echo htmlspecialchars($car['link']); ?>" class="btn btn-danger btn-sm">Chi tiết</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div> 

        <!-- Nút Previous -->
        <button class="carousel-control-prev car-slider-btn prev" type="button" id="prevCarSlide"
                style="position: absolute; top: 50%; transform: translateY(-50%); left: -15px; z-index: 10; background-color: rgba(255,255,255,0.7); border:none; width: 40px; height: 40px; border-radius: 50%;">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'%23dc3545\'%3e%3cpath d=\'M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z\'/%3e%3c/svg%3e');"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <!-- Nút Next -->
        <button class="carousel-control-next car-slider-btn next" type="button" id="nextCarSlide"
                 style="position: absolute; top: 50%; transform: translateY(-50%); right: -15px; z-index: 10; background-color: rgba(255,255,255,0.7); border:none; width: 40px; height: 40px; border-radius: 50%;">
             <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 16 16\' fill=\'%23dc3545\'%3e%3cpath d=\'M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z\'/%3e%3c/svg%3e');"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> 
</section>

    <!-- 4. TRẢI NGHIỆM PORSCHE -->
    <section class="container my-5 py-5 bg-light">
        <h2 class="text-center mb-4">Trải nghiệm Porsche</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Card Trải nghiệm 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Đăng ký lái thử">
                    <div class="card-body">
                        <h5 class="card-title">Đăng ký lái thử</h5>
                        <p class="card-text small">Trải nghiệm cảm giác lái đỉnh cao cùng các dòng xe Porsche.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3 text-center">
                        <a href="#" class="btn btn-danger">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            <!-- Card Trải nghiệm 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Dịch vụ bảo dưỡng">
                    <div class="card-body">
                        <h5 class="card-title">Dịch vụ bảo dưỡng</h5>
                        <p class="card-text small">Chăm sóc xe của bạn với đội ngũ kỹ thuật viên chuyên nghiệp.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3 text-center">
                        <a href="#" class="btn btn-danger">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>
             <!-- Card Trải nghiệm 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                     <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Tư vấn tài chính">
                    <div class="card-body">
                        <h5 class="card-title">Tư vấn tài chính</h5>
                        <p class="card-text small">Giải pháp tài chính linh hoạt cho khách hàng Porsche.</p>
                    </div>
                     <div class="card-footer bg-transparent border-0 pb-3 text-center">
                         <a href="#" class="btn btn-danger">Tư vấn ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- 5. TIN TỨC & SỰ KIỆN -->
     <section class="container my-5 py-5">
        <h2 class="text-center mb-4">Tin tức & Sự kiện</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Tin tức 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Tin tức 1">
                    <div class="card-body">
                        <small class="text-muted">15/07/2023</small>
                        <h5 class="card-title mt-1">Ra mắt Porsche 911 GT3 RS mới</h5>
                        <p class="card-text small">Mẫu xe thể thao hiệu suất cao nhất của Porsche chính thức ra mắt tại Việt Nam.</p>
                        <a href="#" class="text-danger small">Xem thêm</a>
                    </div>
                </div>
            </div>
             <!-- Tin tức 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Tin tức 2">
                    <div class="card-body">
                         <small class="text-muted">10/07/2023</small>
                        <h5 class="card-title mt-1">Sự kiện trải nghiệm Porsche Taycan</h5>
                        <p class="card-text small">Khám phá công nghệ xe điện đỉnh cao cùng Porsche Taycan.</p>
                         <a href="#" class="text-danger small">Xem thêm</a>
                    </div>
                </div>
            </div>
             <!-- Tin tức 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="assets/images/cars/911_carrera_silver_metallic.png" class="card-img-top" alt="Tin tức 3">
                    <div class="card-body">
                         <small class="text-muted">05/07/2023</small>
                        <h5 class="card-title mt-1">Porsche Cayenne 2024 cập bến</h5>
                        <p class="card-text small">Phiên bản nâng cấp của SUV hạng sang Porsche Cayenne chính thức có mặt tại Việt Nam.</p>
                         <a href="#" class="text-danger small">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. LIÊN HỆ -->
    <section class="container my-5">
         <h2 class="text-center mb-4">Liên hệ</h2>
         <div class="row justify-content-center">
             <div class="col-md-8 text-center">
                <p class="lead mb-5">Porsche Việt Nam luôn sẵn sàng hỗ trợ mọi thắc mắc của quý khách</p>
             </div>
         </div>
         <div class="row">
             <div class="col-md-4 mb-3">
                 <div class="d-flex align-items-start">
                     <i class="bi bi-geo-alt-fill fs-4 text-danger me-3"></i>
                     <div>
                         <strong>Địa chỉ</strong><br>
                         Số 666 Đường ABC, Quận 1, TP.HCM
                     </div>
                 </div>
             </div>
              <div class="col-md-4 mb-3">
                 <div class="d-flex align-items-start">
                     <i class="bi bi-telephone-fill fs-4 text-danger me-3"></i>
                     <div>
                         <strong>Hotline</strong><br>
                         1800 1234
                     </div>
                 </div>
             </div>
              <div class="col-md-4 mb-3">
                 <div class="d-flex align-items-start">
                     <i class="bi bi-envelope-fill fs-4 text-danger me-3"></i>
                     <div>
                         <strong>Email</strong><br>
                         info@porsche.vn
                     </div>
                 </div>
             </div>
         </div>
    </section>

</main>

<?php
// Include phần Footer
require_once 'includes/footer.php';
?>
<script src="assets/template/js/home.js"></script>
