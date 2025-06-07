<?php
require_once __DIR__ . '/../models/Car.php';

class ProductController
{
    public function __construct() 
    {
        // Đảm bảo BASE_URL và BASE_ASSET_URL được định nghĩa
        if (!defined('BASE_URL')) {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $host = $_SERVER['HTTP_HOST'];
            $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
            if ($scriptPath === '/' || $scriptPath === '\\') $scriptPath = '';
            $base_url_path = rtrim($scriptPath, '/');
            define('BASE_URL', $protocol . $host . $base_url_path . '/');
        }

        if (!defined('BASE_ASSET_URL')) {
            if (defined('BASE_URL')) {
                define('BASE_ASSET_URL', BASE_URL . 'public/assets/');
            } else {
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $host = $_SERVER['HTTP_HOST'];
                $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
                if ($scriptPath === '/' || $scriptPath === '\\') $scriptPath = '';
                $base_url_path = rtrim($scriptPath, '/');
                define('BASE_ASSET_URL', $protocol . $host . $base_url_path . '/public/assets/');
            }
        }
    }



public function Details()
{
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $slug = filter_input(INPUT_GET, 'slug', FILTER_SANITIZE_STRING);

    if (!$id && !$slug) {
        header("Location: " . BASE_URL);
        exit;
    }

    $carModel = new Car();
    $car = null;

    if ($id) {
        $car = $carModel->findById($id);
    } elseif ($slug) {
        $car = $carModel->findBySlug($slug);
    }

    if (!$car) {
        include __DIR__ . '/../views/product/notfound.php';
    } else {
        include __DIR__ . '/../views/product/details.php';
    }
}

    // Đổi tên từ listByCategory thành list để khớp với tham số action=list trong URL
    public function list()
    {
        try {
            $categoryId = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

            if (!$categoryId) {
                echo "Category ID không hợp lệ.";
                exit;
            }

            $carModel = new Car();
            $category = $carModel->getCategoryById($categoryId);

            if (!$category) {
                echo "Không tìm thấy dòng xe này.";
                exit;
            }

            // Phân trang cơ bản
            $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
            $itemsPerPage = 4; // Số xe hiển thị trên mỗi trang
            $totalItems = $carModel->countCarsByCategoryId($categoryId);
            $totalPages = ceil($totalItems / $itemsPerPage);
            $offset = ($page - 1) * $itemsPerPage;

            $carsInCategory = $carModel->getCarsByCategoryId($categoryId, $itemsPerPage, $offset);
            
            // Debug information - có thể gỡ bỏ sau khi xác nhận mọi thứ hoạt động
            /*
            echo "<h1>Debug Info (Xóa sau khi sửa xong)</h1>";
            echo "<p>BASE_URL: " . (defined('BASE_URL') ? BASE_URL : 'Not defined') . "</p>";
            echo "<p>BASE_ASSET_URL: " . (defined('BASE_ASSET_URL') ? BASE_ASSET_URL : 'Not defined') . "</p>";
            echo "<p>Category ID: " . $categoryId . "</p>";
            echo "<p>Category Name: " . $category->name . "</p>";
            echo "<p>Total Cars: " . $totalItems . "</p>";
            echo "<p>View File Path: " . __DIR__ . '/../views/product/category.php' . "</p>";
            echo "<pre>";
            echo "Cars in Category: ";  
            print_r($carsInCategory);
            echo "</pre>";
            */
            
            // Load view
            include __DIR__ . '/../views/product/category.php';
        } catch (Exception $e) {
            // Hiển thị thông báo lỗi chi tiết để dễ debug
            echo "<div style='padding: 20px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin: 20px; border-radius: 5px;'>";
            echo "<h3>Lỗi xảy ra: " . $e->getMessage() . "</h3>";
            echo "<pre>File: " . $e->getFile() . " dòng " . $e->getLine() . "</pre>";
            echo "<div style='background-color: #fff; padding: 15px; border-radius: 5px; margin-top: 15px;'>";
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
            echo "</div></div>";
        }
    }
}
?>