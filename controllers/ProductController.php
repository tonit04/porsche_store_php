<?php
require_once './models/Car.php';

class ProductController
{
    public function Details()
    {
        if (!isset($_GET['id'])) {
            // Nếu không có ID thì quay về trang chủ hoặc báo lỗi
            header("Location: /");
            exit;
        }

        $id = (int)$_GET['id']; // Ép kiểu ID cho an toàn
        $carModel = new Car(); // hoặc Product()
        $car = $carModel->findById($id);

        if (!$car) {
            // Nếu không tìm thấy sản phẩm
            include 'views/product/notfound.php';
        } else {
            // Nếu tìm thấy sản phẩm
            include 'views/product/details.php';
        }
    }

    
}

?>