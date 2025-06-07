<?php
// Views/product/category.php

// Các biến $category, $carsInCategory, $totalPages, $page, BASE_URL, BASE_ASSET_URL được truyền từ ProductController@list

require_once __DIR__ . '/../../includes/header.php'; // Đi lên 2 cấp để vào includes
?>

<main class="container my-5">
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <?php if ($category): ?>
                <h1 class="display-4 fw-bold text-center mb-3">Dòng xe <?php echo htmlspecialchars($category->name); ?></h1>
                <?php if (!empty($category->image_url) && file_exists(__DIR__ . '/../../public/assets/images/categories/' . $category->image_url)): ?>
                    <div class="text-center mb-5">
                        <img src="<?php echo BASE_ASSET_URL; ?>images/categories/<?php echo htmlspecialchars($category->image_url); ?>" alt="Ảnh bìa <?php echo htmlspecialchars($category->name); ?>" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <h1 class="display-4 fw-bold text-center mb-5">Danh sách xe</h1>
            <?php endif; ?>

            <?php if (!empty($carsInCategory) && is_array($carsInCategory)): ?>
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                    <?php foreach ($carsInCategory as $car): ?>
                        <div class="col mb-5">
                            <div class="card h-100 shadow-sm border-0">
                                <?php
                                $imageUrl = 'default-car.png';
                                if (!empty($car->image_url)) {
                                    $imagePath = __DIR__ . '/../../assets/images/cars/' . $car->image_url;
                                    if (file_exists($imagePath)) {
                                        $imageUrl = $car->image_url;
                                    }
                                }
                                $fullCarImagePath = BASE_URL . 'assets/images/cars/' . htmlspecialchars($imageUrl);
                                ?>
                                <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=Details&<?php echo !empty($car->slug) ? 'slug=' . htmlspecialchars($car->slug) : 'id=' . htmlspecialchars($car->id); ?>">
                                    <img class="card-img-top p-3" src="<?php echo $fullCarImagePath; ?>" alt="<?php echo htmlspecialchars($car->name); ?>" style="aspect-ratio: 4/3; object-fit: contain;"/>
                                </a>
                                <div class="card-body p-4 pt-0">
                                    <div class="text-center">
                                        <h5 class="fw-bolder"><?php echo htmlspecialchars($car->name); ?></h5>
                                        <?php if (isset($car->model) && is_object($car->model) && !empty($car->model->name)): ?>
                                            <p class="small text-muted">Model: <?php echo htmlspecialchars($car->model->name); ?></p>
                                        <?php endif; ?>
                                        <p class="fs-5 text-danger fw-bold">
                                            <?php echo number_format($car->price, 0, ',', '.'); ?> VNĐ
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                    <a class="btn btn-outline-danger mt-auto" href="<?php echo BASE_URL; ?>index.php?controller=product&action=details&<?php echo !empty($car->slug) ? 'slug=' . htmlspecialchars($car->slug) : 'id=' . htmlspecialchars($car->id); ?>">
                                        Xem chi tiết
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Phân trang -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo $category->id; ?>&page=<?php echo $page - 1; ?>">Trước</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo $category->id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo $category->id; ?>&page=<?php echo $page + 1; ?>">Sau</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <p class="text-center lead mt-5">Không có xe nào trong dòng xe "<?php echo htmlspecialchars($category->name ?? 'này'); ?>" để hiển thị.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
require_once __DIR__ . '/../../includes/footer.php'; // Đi lên 2 cấp để vào includes
?> 