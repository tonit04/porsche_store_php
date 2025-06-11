<?php
require_once './models/Order.php';
require_once './models/OrderDetail.php';
require_once __DIR__ . '/BaseAdminController.php';

class OrderAdminController extends BaseAdminController
{
    public function index()
    {
        $order = new Order();

        // Lấy số trang hiện tại từ URL, mặc định là 1
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $limit = 4; // Số xe mỗi trang
        $offset = ($page - 1) * $limit;

        $orders = $order->getPaginated($limit, $offset); // Gọi hàm mới
        $totalOrders = $order->countOrders();
        $totalPages = ceil($totalOrders / $limit);

        require_once './views/admin/order_list.php';
    }

    public function update()
    {
        $order = new Order();
        $id = $_GET['id'];
        $order = $order->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order->update($id, $_POST);
            header('Location: index.php?controller=OrderAdmin');
            exit;
        }
        require_once './views/admin/order_update.php';
    }

    public function detail()
    {
        $orderDetail = new OrderDetail();
        $order_id = $_GET['id'];
        $orderDetails = $orderDetail->findById($order_id);
        require_once './views/admin/order_detail.php';
    }


    public function delete()
    {
        $order = new Order();
        $id = $_GET['id'];
        $order->delete($id);
        header('Location: index.php?controller=OrderAdmin');
        exit;
    }
}
