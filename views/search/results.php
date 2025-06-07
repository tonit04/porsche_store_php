<?php require_once 'includes/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4">Kết quả tìm kiếm cho "<?php echo htmlspecialchars($keyword); ?>"</h2>
    
    <?php if (empty($searchResults)): ?>
        <div class="alert alert-info">
            Không tìm thấy kết quả nào cho từ khóa này.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($searchResults as $car): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php if (!empty($car['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['full_name']); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($car['full_name']); ?></h5>
                            <p class="card-text">
                                <strong>Năm sản xuất:</strong> <?php echo htmlspecialchars($car['year']); ?><br>
                                <strong>Giá:</strong> <?php echo number_format($car['price'], 0, ',', '.'); ?> VNĐ
                            </p>
                            <a href="<?php echo rtrim(BASE_URL, '/'); ?>/index.php?controller=Product&action=Details&id=<?php echo $car['id']; ?>" 
   class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?> 