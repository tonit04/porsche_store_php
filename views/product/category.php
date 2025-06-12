<?php
// Views/product/category.php

// Các biến $category, $carsInCategory, $totalPages, $page, BASE_URL, BASE_ASSET_URL được truyền từ ProductController@list

require_once __DIR__ . '/../../includes/header.php'; // Đi lên 2 cấp để vào includes
?>

<main class="container my-5">
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <?php if (isset($category) && $category): ?>
                <h1 class="display-4 fw-bold text-center mb-3">Dòng xe <?php echo htmlspecialchars($category->name); ?></h1>
                <?php if (!empty($category->image_url) && file_exists(__DIR__ . '/../../public/assets/images/categories/' . $category->image_url)): ?>
                    <div class="text-center mb-5">
                        <img src="<?php echo BASE_ASSET_URL; ?>images/categories/<?php echo htmlspecialchars($category->image_url); ?>" alt="Ảnh bìa <?php echo htmlspecialchars($category->name); ?>" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <h1 class="display-4 fw-bold text-center mb-5">Danh sách xe</h1>
            <?php endif; ?>

            <div class="text-center mb-4">
                <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=list" class="btn btn-outline-primary <?php echo (!isset($currentFilters['category_id']) || $currentFilters['category_id'] === null) ? 'active' : ''; ?> me-2">Tất cả dòng xe</a>
                <?php foreach ($allCategories as $cat): ?>
                    <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=list&category_id=<?php echo htmlspecialchars($cat->id); ?>" class="btn btn-outline-primary <?php echo (isset($currentFilters['category_id']) && $currentFilters['category_id'] == $cat->id) ? 'active' : ''; ?> me-2">
                        <?php echo htmlspecialchars($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <!-- Sidebar for Filters -->
                <div class="col-lg-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-danger text-white">
                            Bộ lọc tìm kiếm
                        </div>
                        <div class="card-body">
                            <form action="<?php echo BASE_URL; ?>index.php" method="get">
                                <input type="hidden" name="controller" value="product">
                                <input type="hidden" name="action" value="list">
                                <?php if (isset($currentFilters['category_id']) && $currentFilters['category_id'] !== null): ?>
                                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($currentFilters['category_id']); ?>">
                                <?php endif; ?>

                                <!-- Sort By -->
                                <div class="mb-3">
                                    <label for="sortBy" class="form-label">Sắp xếp theo:</label>
                                    <select class="form-select" id="sortBy" name="sort_by">
                                        <option value="name_asc" <?php echo ($currentFilters['sort_by'] ?? '') == 'name_asc' ? 'selected' : ''; ?>>Tên (A-Z)</option>
                                        <option value="name_desc" <?php echo ($currentFilters['sort_by'] ?? '') == 'name_desc' ? 'selected' : ''; ?>>Tên (Z-A)</option>
                                        <option value="price_asc" <?php echo ($currentFilters['sort_by'] ?? '') == 'price_asc' ? 'selected' : ''; ?>>Giá (Thấp đến Cao)</option>
                                        <option value="price_desc" <?php echo ($currentFilters['sort_by'] ?? '') == 'price_desc' ? 'selected' : ''; ?>>Giá (Cao đến Thấp)</option>
                                    </select>
                                </div>

                                <!-- Price Range -->
                                <div class="mb-3">
                                    <label class="form-label">Giá:</label>
                                    <div class="d-flex">
                                        <input type="number" class="form-control me-2" name="min_price" placeholder="Từ" value="<?php echo htmlspecialchars($currentFilters['min_price'] ?? ''); ?>">
                                        <input type="number" class="form-control" name="max_price" placeholder="Đến" value="<?php echo htmlspecialchars($currentFilters['max_price'] ?? ''); ?>">
                                    </div>
                                </div>

                                <!-- Filter by Year -->
                                <div class="mb-3">
                                    <label for="year" class="form-label">Năm sản xuất:</label>
                                    <input type="number" class="form-control" id="year" name="year" placeholder="Nhập năm" value="<?php echo htmlspecialchars($currentFilters['year'] ?? ''); ?>">
                                </div>

                                <!-- Filter by Color -->
                                <div class="mb-3">
                                    <label for="color" class="form-label">Màu sắc:</label>
                                    <select class="form-select" id="color" name="color">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($uniqueColors as $colorOption): ?>
                                            <option value="<?php echo htmlspecialchars($colorOption); ?>" <?php echo ($currentFilters['color'] ?? '') == $colorOption ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($colorOption); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Filter by Engine -->
                                <div class="mb-3">
                                    <label for="engine" class="form-label">Động cơ:</label>
                                    <select class="form-select" id="engine" name="engine">
                                        <option value="">Tất cả</option>
                                        <?php foreach ($uniqueEngines as $engineOption): ?>
                                            <option value="<?php echo htmlspecialchars($engineOption); ?>" <?php echo ($currentFilters['engine'] ?? '') == $engineOption ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($engineOption); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-danger w-100">Áp dụng bộ lọc</button>
                                <a href="<?php echo BASE_URL; ?>index.php?controller=product&action=list" class="btn btn-secondary w-100 mt-2">Xóa bộ lọc</a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Car Listing -->
                <div class="col-lg-9">
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
            <?php
            // Tạo URL base với tất cả các tham số lọc hiện tại
            $params = $_GET;
            unset($params['page']); // Xóa tham số page cũ
            $queryString = http_build_query($params);
            $baseUrl = BASE_URL . 'index.php?' . $queryString;
            
            // Nút Previous
            if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $baseUrl . '&page=' . ($page - 1); ?>">Trước</a>
                </li>
            <?php endif;

            // Các số trang
            for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo $baseUrl . '&page=' . $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor;

            // Nút Next
            if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $baseUrl . '&page=' . ($page + 1); ?>">Sau</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>

                    <?php else: ?>
                        <p class="text-center lead mt-5">Không có xe nào phù hợp với bộ lọc của bạn.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require_once __DIR__ . '/../../includes/footer.php'; // Đi lên 2 cấp để vào includes
?> 