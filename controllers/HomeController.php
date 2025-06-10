<?php
// REMOVED CONSTANT DEFINITIONS - They are now in index.php

require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/Banner.php';

class HomeController {
    public function index() {
        // Khởi tạo model Car
        $carModel = new Car();

        // Lấy một số xe nổi bật (ví dụ: 6 xe đầu tiên, hoặc bạn có thể thêm logic phức tạp hơn)
        // Giả sử phương thức getPaginated có thể dùng để lấy N xe đầu tiên
        // Hoặc tạo một phương thức mới trong Car.php như getFeaturedCars(6)
        // $featuredCars = $carModel->getPaginated(6, 0); // Lấy 6 xe, bắt đầu từ offset 0

        // LẤY DỮ LIỆU CATEGORIES
        $carCategories = $carModel->getAllCategories();

        // LẤY XE MỚI NHẤT CHO PHẦN DÒNG XE MỚI
        $latestCar = $carModel->getLatestCar();

        // Lấy tất cả banner
        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();

        // Load view home và truyền dữ liệu
        require_once __DIR__ . '/../views/home.php';
    }

    public function about() {
        // Chỉ cần load view về trang giới thiệu
        require_once __DIR__ . '/../views/product/about.php';
    }
}
?>
