<?php
// controllers/PaymentController.php

class PaymentController
{
    private $checkout;
    private $cart;
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../config/Database.php';
        require_once __DIR__ . '/../models/Cart.php';
        require_once __DIR__ . '/../models/Payment.php';
        require_once __DIR__ . '/../models/Checkout.php';

        $database = new Database();
        $this->db = $database->connect();
        $this->cart = new Cart($this->db);
        $this->checkout = new Checkout($this->db);
    }

    // Hiển thị trang thanh toán
    public function index()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header('Location: /porsche/auth/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];

        // Lấy thông tin giỏ hàng
        $cartItems = $this->cart->getCartItems($user_id);
        $cartTotal = $this->cart->getCartTotal($user_id);

        // Nếu giỏ hàng trống, chuyển về trang giỏ hàng
        if (empty($cartItems)) {
            header('Location: /porsche/cart');
            exit;
        }

        // Render view thanh toán
        require_once __DIR__ . '/../views/payment/checkout.php';
    }

    // Xử lý thanh toán
    public function processPayment()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /porsche/auth/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];

        // Kiểm tra dữ liệu gửi lên
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /porsche/payment');
            exit;
        }

        // Lấy thông tin thanh toán
        $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
        $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

        // Kiểm tra phương thức thanh toán hợp lệ
        if (!in_array($payment_method, ['COD', 'VNPAY'])) {
            $_SESSION['payment_error'] = 'Phương thức thanh toán không hợp lệ';
            header('Location: /porsche/payment');
            exit;
        }

        // Xử lý đặt hàng
        $result = $this->checkout->processCheckout($user_id, $payment_method, $notes);

        if (!$result['success']) {
            $_SESSION['payment_error'] = $result['message'];
            header('Location: /porsche/payment');
            exit;
        }

        // Nếu thanh toán COD, chuyển đến trang cảm ơn
        if ($payment_method === 'COD') {
            $_SESSION['order_success'] = true;
            $_SESSION['order_id'] = $result['order_id'];
            header('Location: index.php?controller=Payment&action=success');
            exit;
        }

        // Nếu thanh toán VNPAY, chuyển đến cổng thanh toán
        if ($payment_method === 'VNPAY') {
            $vnpayUrl = $this->checkout->createVnpayUrl(
                $result['order_id'],
                $result['payment_id'],
                $result['total_amount']
            );
            header('Location: ' . $vnpayUrl);
            exit;
        }
    }

    // Xử lý kết quả thanh toán VNPAY
    public function vnpayReturn()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /porsche/auth/login');
            exit;
        }

        // Kiểm tra dữ liệu từ VNPAY
        if (empty($_GET)) {
            header('Location: /porsche/payment');
            exit;
        }

        // Lấy thông tin từ VNPAY
        $vnp_ResponseCode = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '';
        $vnp_TxnRef = isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : '';
        $vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] / 100 : 0; // Chia 100 để lấy số tiền gốc

        // Tách order_id từ vnp_TxnRef (format là order_id-timestamp)
        $txnRefParts = explode('-', $vnp_TxnRef);
        $order_id = $txnRefParts[0] ?? 0;

        // Cập nhật trạng thái thanh toán
        require_once __DIR__ . '/../models/Payment.php';
        $payment = new Payment($this->db);

        if ($vnp_ResponseCode == '00') {
            // Thanh toán thành công
            $payment->order_id = $order_id;
            $payment->amount = $vnp_Amount;
            $payment->payment_date = date('Y-m-d H:i:s'); // Thời gian hiện tại
            $payment->transaction_id = $vnp_TxnRef;
            $payment->payment_gateway = 'VNPAY';
            $payment->payment_status = 'Success';
            $payment->create(); // Lưu thông tin thanh toán vào bảng payments
            $payment_id = $payment->id;

            // Cập nhật trạng thái đơn hàng
            $orderQuery = "UPDATE orders SET status = 'Confirmed' WHERE id = :order_id";
            $orderStmt = $this->db->prepare($orderQuery);
            $orderStmt->bindParam(':order_id', $order_id);
            $orderStmt->execute();

            $_SESSION['order_success'] = true;
            $_SESSION['order_id'] = $order_id;

            header('Location: index.php?controller=payment&action=success');
            exit;
        } else {
            // Thanh toán thất bại
            $payment->payment_status = 'Failed';
            $payment->updateStatus();

            $_SESSION['payment_error'] = 'Thanh toán thất bại. Mã lỗi: ' . $vnp_ResponseCode;
            header('Location: /porsche/payment/failed');
            exit;
        }
    }

    // Hiển thị trang thanh toán thành công
    public function success()
    {
        if (!isset($_SESSION['order_success']) || !isset($_SESSION['order_id'])) {
            header('Location: /porsche/');
            exit;
        }

        $order_id = $_SESSION['order_id'];

        // Lấy thông tin đơn hàng
        require_once __DIR__ . '/../models/Order.php';
        require_once __DIR__ . '/../models/OrderDetail.php';

        $order = new Order();
        $orderInfo = $order->findById($order_id);

        $orderDetail = new OrderDetail();
        $orderItems = $orderDetail->findById($order_id);

        // Xóa thông tin đơn hàng trong session
        unset($_SESSION['order_success']);
        unset($_SESSION['order_id']);

        require_once __DIR__ . '/../views/payment/success.php';
    }

    // Hiển thị trang thanh toán thất bại
    public function failed()
    {
        session_start();
        $error = isset($_SESSION['payment_error']) ? $_SESSION['payment_error'] : 'Đã xảy ra lỗi trong quá trình thanh toán';

        // Xóa thông báo lỗi trong session
        unset($_SESSION['payment_error']);

        require_once __DIR__ . '/../views/payment/failed.php';
    }
}
