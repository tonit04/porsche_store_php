<?php
// controllers/BaseAdminController.php

class BaseAdminController
{
    public function __construct()
    {
        $this->checkAdminAccess(); // Gọi phương thức kiểm tra ngay khi controller được khởi tạo
    }

    protected function checkAdminAccess()
    {
        // 1. Kiểm tra xem session có tồn tại không (người dùng đã đăng nhập chưa)
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // Lưu URL hiện tại để chuyển hướng lại sau khi đăng nhập
            header("Location: index.php?controller=User&action=login");
            exit;
        }

        // 2. Kiểm tra vai trò của người dùng trong session
        if ($_SESSION['user_role'] !== 'admin') {
            // Nếu vai trò không phải là admin (ví dụ: customer), chuyển hướng về trang chủ
            // (Bạn có thể muốn chuyển hướng đến một trang lỗi hoặc trang không có quyền truy cập thay vì trang chủ)
            header("Location: index.php?controller=Home&action=index"); // Hoặc trang phù hợp cho customer
            exit;
        }
    }
}
