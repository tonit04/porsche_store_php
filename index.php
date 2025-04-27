<?php
$controllerName = $_GET['controller'] ?? 'home';
$actionName = $_GET['action'] ?? 'index';

// Chuẩn hóa tên
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/controllers/' . $controllerClass . '.php';
session_start();

// Kiểm tra và gọi Controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerClass();

    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {
        echo "Không tìm thấy action: $actionName";
    }
} else {
    echo "Không tìm thấy controller: $controllerClass";
}
