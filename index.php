<?php
session_start();

// === ĐỊNH NGHĨA URL GỐC ===
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];

// Đường dẫn đến thư mục chứa index.php này
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);
if ($scriptPath === '/' || $scriptPath === '\\') {
    $scriptPath = ''; // Nếu index.php nằm ở web root
}
$base_url_path = rtrim($scriptPath, '/');

define('BASE_URL', $protocol . $host . $base_url_path . '/');
define('BASE_ASSET_URL', BASE_URL . 'public/assets/');
// ==========================

// Xử lý tham số URL
$controllerName = $_GET['controller'] ?? 'home';
$actionName = $_GET['action'] ?? 'index';

// Chuẩn hóa tên
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/controllers/' . $controllerClass . '.php';

// Kiểm tra và gọi Controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        if (method_exists($controller, $actionName)) {
            try {
                $controller->$actionName();
            } catch (Exception $e) {
                // Xử lý lỗi khi gọi action
                echo "Có lỗi xảy ra khi thực thi action: " . $e->getMessage();
                error_log("Error in controller $controllerClass, action $actionName: " . $e->getMessage());
            }
        } else {
            // Không tìm thấy action
            header("HTTP/1.0 404 Not Found");
            echo "Không tìm thấy action: $actionName trong controller $controllerClass";
            
            // Tùy chọn: Chuyển hướng về trang lỗi 404 hoặc trang chủ
            // header("Location: " . BASE_URL . "index.php?controller=error&action=notFound");
        }
    } else {
        // Lớp controller không tồn tại dù tệp có tồn tại
        header("HTTP/1.0 404 Not Found");
        echo "Không tìm thấy lớp controller: $controllerClass trong tệp $controllerFile";
    }
} else {
    // Tệp controller không tồn tại
    header("HTTP/1.0 404 Not Found");
    echo "Không tìm thấy controller: $controllerClass";
    // Tùy chọn: Chuyển hướng về trang chủ
    // header("Location: " . BASE_URL . "index.php?controller=home&action=index");
}
