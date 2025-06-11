<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>
    <div class="container my-5">
        <h2>Quên mật khẩu</h2>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        <form action="<?= BASE_URL ?>index.php?controller=User&action=forgotPassword" method="POST">
            <div class="mb-3">
                <label for="identifier" class="form-label">Nhập username hoặc email</label>
                <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Username hoặc Email">
            </div>
            <button type="submit" class="btn btn-primary">Khôi phục mật khẩu</button>
        </form>
    </div>
</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
