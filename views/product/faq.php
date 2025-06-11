<?php
require_once __DIR__ . '/../../models/Faq.php';
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Câu hỏi thường gặp (FAQ)</h1>
    <p class="text-center text-muted mb-5">
        Tổng hợp các câu hỏi thường gặp về sản phẩm và dịch vụ của Porsche Vietnam
    </p>

    <div class="accordion" id="faqAccordion">
        <?php if (!empty($faqs)): ?>
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?= $faq->id ?>"
                                aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                                aria-controls="collapse<?= $faq->id ?>">
                            <span class="me-2"><?= ($index + 1) ?>.</span>
                            <?= htmlspecialchars($faq->question) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $faq->id ?>" 
                         class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?= nl2br(htmlspecialchars($faq->answer)) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Hiện chưa có câu hỏi thường gặp nào.
            </div>
        <?php endif; ?>
    </div>

    <!-- Contact section -->
    <div class="text-center mt-5">
        <p class="mb-3">Không tìm thấy câu trả lời cho câu hỏi của bạn?</p>
        <a href="index.php?controller=Contact&action=create" class="btn btn-primary">
            <i class="bi bi-envelope"></i> Liên hệ với chúng tôi
        </a>
    </div>
</div>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>