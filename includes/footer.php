<?php
// views/includes/footer.php
if (!defined('BASE_ASSET_URL')) {
    define('BASE_ASSET_URL', '/assets');
}
if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $subfolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    define('BASE_URL', $protocol . $host . $subfolder . '/');
}
?>

<footer class="porsche-footer py-5 bg-dark text-white">
    <div class="container px-md-4 px-lg-5">
        <div class="row gy-4">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <!-- Thay thế img bằng div CSS-drawn cho footer -->
                <a class="porsche-logo-container footer-logo-container d-flex align-items-center mb-4 text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>">
                    <div class="porsche-css-logo-circle-footer me-2"></div>
                    <span class="porsche-logo-text">
                        PORSCHE
                        <small class="porsche-logo-subtext">VIETNAM</small>
                    </span>
                </a>
                <p class="footer-address">
                    Porsche Việt Nam<br>
                    140 Lê Trọng Tấn, Phường Tây Thạnh<br>
                    Quận Tân Phú, TP.HCM
                </p>
            </div>
            <div class="col-sm-6 col-lg-2">
                <h6 class="footer-heading">LIÊN KẾT NHANH</h6>
                <ul class="list-unstyled footer-links">
                    <li><a class="text-white text-decoration-none" href="<?php echo BASE_URL; ?>#car-models">Dòng xe</a></li>
                    <li><a class="text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>/index.php?controller=home&action=about">Giới thiệu</a></li>
                    <li><a class="text-white text-decoration-none" href="<?php echo BASE_URL; ?>#Lien-he">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3">
                <h6 class="footer-heading">DỊCH VỤ</h6>
                <ul class="list-unstyled footer-links">
                    <li><a class="text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>service.php#maintenance">Bảo dưỡng</a></li>
                    <li><a class="text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>service.php#parts">Phụ tùng chính hãng</a></li>
                    <li><a class="text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>service.php#warranty">Bảo hành</a></li>
                    <li><a class="text-white text-decoration-none" href="<?php echo rtrim(BASE_URL, '/'); ?>finance.php">Tài chính</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="footer-heading">KẾT NỐI VỚI CHÚNG TÔI</h6>
                <div class="social-icons mb-4">
                    <a href="#" class="me-3 text-white" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-3 text-white" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3 text-white" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-white" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <p class="mb-0">
                    <i class="fas fa-phone me-2"></i> 1800 1234<br>
                    <i class="fas fa-envelope me-2"></i> porsche@gmail.vn
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/template/js/main.js"></script>




</body>

</html>