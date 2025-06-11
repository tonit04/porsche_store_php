<?php
require_once __DIR__ . '/BaseAdminController.php';
require_once './models/Order.php';
require_once './models/User.php';
require_once './models/Car.php';

class AdminController extends BaseAdminController
{
    public function dashboard()
    {
        // Tổng số liệu
        $orderModel = new Order();
        $userModel = new User();
        $carModel = new Car();

        $totalOrders = $orderModel->countOrders();
        $totalUsers = $userModel->countUsers();
        $totalCars = $carModel->countCars();
        $totalRevenue = $orderModel->getTotalRevenue();

        // Đơn hàng gần đây
        $recentOrders = $orderModel->getRecentOrders(5);

        require_once './views/admin/dashboard.php';
    }
}
