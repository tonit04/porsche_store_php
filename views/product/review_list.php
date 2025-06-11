<?php
require_once __DIR__ . '/../../models/User.php';
$userModel = new User();
?>

<div class="mt-5">
    <h4 class="mb-4">Đánh giá của khách hàng</h4>
    <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>
                                <?php
                                $user = $userModel->findById($review->user_id);
                                echo $user ? htmlspecialchars($user->username) : 'Người dùng';
                                ?>
                            </strong>
                            <span class="text-muted ms-2" style="font-size: 0.9em;">
                                <?= date('d/m/Y H:i', strtotime($review->created_at)) ?>
                            </span>
                        </div>
                        <div>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $review->rating): ?>
                                    <span class="text-warning">&#9733;</span>
                                <?php else: ?>
                                    <span class="text-secondary">&#9734;</span>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div>
                        <?= nl2br(htmlspecialchars($review->comment)) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">Chưa có đánh giá nào cho sản phẩm này.</div>
    <?php endif; ?>
</div>