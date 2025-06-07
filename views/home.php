<?php
// views/home.php

// Biến $featuredCars được truyền từ HomeController
// Biến BASE_ASSET_URL và BASE_URL đã được định nghĩa trong HomeController

// Include phần Header
// Từ views/home.php, đi lên 1 cấp ra porsche_store, rồi vào includes/
require_once __DIR__ . '/../includes/header.php';

?>

<!-- ==================== MAIN CONTENT AREA for home.php ==================== -->
<main>
    <!-- 1. ĐỘC BẢN KINH ĐIỂN (Carousel 1) -->
    <section class="my-5">
        <div id="carouselKinhDien" class="carousel slide" data-bs-ride="carousel">
            <!-- ... Nội dung carousel 1 giữ nguyên ... -->
             <div class="carousel-inner">
                <div class="carousel-item active">
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

    <!-- 2. DÒNG XE MỚI (Carousel 2 - Hiển thị xe mới nhất) -->
    <section class="my-5">
        <?php if ($latestCar): // Kiểm tra xem có xe mới nhất không ?>
            <div id="carouselXeMoi" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php
                        // Xử lý ảnh cho xe mới nhất
                        $latestCarImage = 'default-car.png'; // Ảnh mặc định nếu không có ảnh xe
                        if (!empty($latestCar->image_url)) {
                            $imagePath = __DIR__ . '/../assets/images/cars/' . $latestCar->image_url;
                            if (file_exists($imagePath)) {
                                $latestCarImage = $latestCar->image_url;
                            }
                        }
                        $fullLatestCarImagePath = BASE_URL . 'assets/images/cars/' . htmlspecialchars($latestCarImage);
                        ?>
                        <div style="background-image: url('<?php echo $fullLatestCarImagePath; ?>'); height: 75vh; background-size: cover; background-position: center; position: relative;" class="d-block w-100">
                            <div class="container h-100 d-flex flex-column justify-content-end pb-5 text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">
                                <h1 class="display-4 fw-bold">
                                    <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=Details&<?php echo !empty($latestCar->slug) ? 'slug=' . htmlspecialchars($latestCar->slug) : 'id=' . htmlspecialchars($latestCar->id); ?>" class="text-white text-decoration-none">
                                        <?php echo htmlspecialchars($latestCar->name); ?>
                                    </a>
                                </h1>
                                <?php if (isset($latestCar->model) && is_object($latestCar->model) && !empty($latestCar->model->name)): ?>
                                <p class="lead mb-1"><small>Model: <?php echo htmlspecialchars($latestCar->model->name); ?></small></p>
                                <?php endif; ?>
                                <p class="lead fw-bold" style="color: #ffdddd;">
                                    Giá từ <?php echo number_format($latestCar->price, 0, ',', '.'); ?> VNĐ
                                </p>
                                <?php if (!empty($latestCar->description)): ?>
                                <p class="mb-1"><small><?php echo nl2br(htmlspecialchars(substr($latestCar->description, 0, 150))); ?><?php echo strlen($latestCar->description) > 150 ? '...' : ''; ?></small></p>
                                <?php endif; ?>
                                <div class="mt-4">
                                    <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=Details&<?php echo !empty($latestCar->slug) ? 'slug=' . htmlspecialchars($latestCar->slug) : 'id=' . htmlspecialchars($latestCar->id); ?>" class="btn btn-danger btn-lg">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container text-center my-5">
                <p>Hiện chưa có thông tin xe mới.</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- 3. KHÁM PHÁ CÁC DÒNG XE (Sử dụng dữ liệu $carCategories) -->
    <section id ="car-models" class="container my-5">
        <h2 class="text-center mb-4">KHÁM PHÁ CÁC DÒNG XE</h2>
        <?php if (!empty($carCategories) && is_array($carCategories)): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center"> 
                <?php foreach ($carCategories as $category): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 text-center">
                            <?php
                            // Xử lý ảnh cho category
                            $categoryImage = 'default-car.png'; // Ảnh mặc định
                            if (!empty($category->image_url)) {
                                $imagePath = __DIR__ . '/../assets/images/cars/' . $category->image_url;
                                if (file_exists($imagePath)) {
                                    $categoryImage = $category->image_url;
                                }
                            }
                            $fullImagePath = BASE_URL . 'assets/images/cars/' . htmlspecialchars($categoryImage);
                            ?>
                            <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo htmlspecialchars($category->id); ?>" class="text-decoration-none">
                                <img src="<?php echo $fullImagePath; ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($category->name); ?>" style="aspect-ratio: 16/9; object-fit: contain; max-height: 200px;">
                                <div class="card-body pt-0">
                                    <h5 class="card-title text-danger"><?php echo htmlspecialchars($category->name); ?></h5>
                                </div>
                            </a>
                            <div class="card-footer bg-transparent border-0 pb-3">
                                <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo htmlspecialchars($category->id); ?>" class="btn btn-outline-danger btn-sm">Xem các mẫu <?php echo htmlspecialchars($category->name); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Hiện chưa có dòng xe nào để hiển thị.</p>
        <?php endif; ?>
    </section>

    

    <!-- 6. LIÊN HỆ -->
    <section id="Lien-he" class="container my-5">
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
                         Số 140 Lê Trọng Tấn, Phường Tây Thạnh, Quận Tân Phú, TP.HCM <!-- Cập nhật địa chỉ ví dụ -->
                     </div>
                 </div>
             </div>
              <div class="col-md-4 mb-3">
                 <div class="d-flex align-items-start">
                     <i class="bi bi-telephone-fill fs-4 text-danger me-3"></i>
                     <div>
                         <strong>Hotline</strong><br>
                         0909xxxxxx <!-- Cập nhật hotline ví dụ -->
                     </div>
                 </div>
             </div>
              <div class="col-md-4 mb-3">
                 <div class="d-flex align-items-start">
                     <i class="bi bi-envelope-fill fs-4 text-danger me-3"></i>
                     <div>
                         <strong>Email</strong><br>
                         info@porsche-vietnam.com <!-- Cập nhật email ví dụ -->
                     </div>
                 </div>
             </div>
         </div>
    </section>

</main>

<?php
// Include phần Footer
// Từ views/home.php, đi lên 1 cấp ra porsche_store, rồi vào includes/
require_once __DIR__ . '/../includes/footer.php';
?>


