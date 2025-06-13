<?php
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/Category.php';

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
                define('BASE_ASSET_URL', BASE_URL . 'assets/');
            } else {
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $host = $_SERVER['HTTP_HOST'];
                $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
                if ($scriptPath === '/' || $scriptPath === '\\') $scriptPath = '';
                $base_url_path = rtrim($scriptPath, '/');
                define('BASE_ASSET_URL', $protocol . $host . $base_url_path . '/assets/');
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



public function list() {
    try {
        // Get current page and filters
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
        $categoryId = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        error_log("DEBUG: Category ID from GET: " . var_export($categoryId, true));
        $sortBy = filter_input(INPUT_GET, 'sort_by', FILTER_SANITIZE_STRING) ?? 'name_asc';
        $minPrice = filter_input(INPUT_GET, 'min_price', FILTER_VALIDATE_FLOAT);
        $maxPrice = filter_input(INPUT_GET, 'max_price', FILTER_VALIDATE_FLOAT);
        $year = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);
        $color = filter_input(INPUT_GET, 'color', FILTER_SANITIZE_STRING);
        $engine = filter_input(INPUT_GET, 'engine', FILTER_SANITIZE_STRING);

        // Items per page
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;

        $carModel = new Car();
        
        // Get total items count for pagination
        $totalItems = $carModel->countFilteredCars(
            $categoryId,
            $minPrice,
            $maxPrice,
            $year,
            $color,
            $engine
        );

        // Calculate total pages
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Get filtered cars
        $carsInCategory = $carModel->getFilteredCars(
            $categoryId,
            $sortBy,
            $minPrice,
            $maxPrice,
            $year,
            $color,
            $engine,
            $itemsPerPage,
            $offset
        );

        // Store current filters
        $currentFilters = [
            'category_id' => $categoryId,
            'sort_by' => $sortBy,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'year' => $year,
            'color' => $color,
            'engine' => $engine
        ];

        // Get other data needed for view
        $categoryModel = new Category();
        $allCategories = $categoryModel->getAllCategories();
        $category = $categoryId ? $categoryModel->findById($categoryId) : null;
        $uniqueColors = $carModel->getUniqueColors();
        $uniqueEngines = $carModel->getUniqueEngines();

        // Include the view
        include __DIR__ . '/../views/product/category.php';
        
    } catch (Exception $e) {
        echo "<div style='padding: 20px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin: 20px; border-radius: 5px;'>";
        echo "<h3>Lỗi xảy ra: " . $e->getMessage() . "</h3>";
        echo "<pre>File: " . $e->getFile() . " dòng " . $e->getLine() . "</pre>";
        echo "<div style='background-color: #fff; padding: 15px; border-radius: 5px; margin-top: 15px;'>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
        echo "</div></div>";
    }
}
}