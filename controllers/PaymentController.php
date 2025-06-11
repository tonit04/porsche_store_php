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
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Discount.php';

        $database = new Database();
        $this->db = $database->connect();
        $this->cart = new Cart($this->db);
        $this->checkout = new Checkout($this->db);
    }
    public function applyDiscount()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $discountCode = $input['discount_code'] ?? '';
        $totalAmount = $input['total_amount'] ?? 0;

        $discountModel = new Discount($this->db);
        $discount = $discountModel->findByCode($discountCode);

        if ($discount && $discount['expires_at'] >= date('Y-m-d H:i:s') && $discount['used_count'] < $discount['max_uses']) {
            $discountAmount = 0;
            if ($discount['discount_type'] === 'PERCENT') {
                $discountAmount = $totalAmount * ($discount['discount_value'] / 100);
            } elseif ($discount['discount_type'] === 'AMOUNT') {
                $discountAmount = $discount['discount_value'];
            }

            echo json_encode([
                'success' => true,
                'discount_amount' => number_format($discountAmount, 0, ',', '.'),
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.',
            ]);
        }
        exit;
    }

    // Hiển thị trang thanh toán
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = BASE_URL . 'index.php?controller=Payment&action=index';
            header('Location: ' . BASE_URL . 'index.php?controller=User&action=login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $user = $userModel->findById($user_id);

        if (!$user) {
            $_SESSION['error_message'] = 'Không tìm thấy thông tin người dùng.';
            header('Location: ' . BASE_URL . 'index.php');
            exit;
        }

        $cartItems = $this->cart->getCartItems($user_id);
        $cartTotal = $this->cart->getCartTotal($user_id);

        if (empty($cartItems)) {
            header('Location: ' . BASE_URL . 'index.php?controller=Cart&action=index');
            exit;
        }

        $error = '';
        $discountAmount = 0;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment_method = $_POST['payment_method'] ?? 'COD';
            $notes = $_POST['notes'] ?? null;
            $delivery_address = $_POST['delivery_address'] ?? '';
            $discount_code = $_POST['discount_code'] ?? '';

            // Kiểm tra mã giảm giá
            if (!empty($discount_code)) {
                $discountModel = new Discount($this->db);
                $discount = $discountModel->findByCode($discount_code);

                if ($discount && $discount['expires_at'] >= date('Y-m-d H:i:s') && $discount['used_count'] < $discount['max_uses']) {
                    if ($discount['discount_type'] === 'PERCENT') {
                        $discountAmount = $cartTotal * ($discount['discount_value'] / 100);
                    } elseif ($discount['discount_type'] === 'AMOUNT') {
                        $discountAmount = $discount['discount_value'];
                    }
                    $cartTotal -= $discountAmount;
                    $discountModel->incrementUsage($discount['id']); // Tăng số lần sử dụng mã
                } else {
                    $error = 'Mã giảm giá không hợp lệ hoặc đã hết hạn.';
                }
            }

            if (empty($delivery_address)) {
                $error = 'Vui lòng nhập địa chỉ giao hàng.';
            } else {
                if ($payment_method === 'VNPAY') {
                    $vnpay_url = $this->checkout->createVnPayUrl($user_id, $cartTotal, 'Thanh toan don hang');
                    $_SESSION['delivery_address'] = $delivery_address;
                    $_SESSION['discount_amount'] = $discountAmount; // Lưu số tiền giảm giá vào session
                    $_SESSION['discount_code'] = $discount_code;
                    header('Location: ' . $vnpay_url);
                    exit;
                } else {
                    $checkoutResult = $this->checkout->processCheckout(
                        $user_id,
                        $payment_method,
                        $notes,
                        $delivery_address,
                        $discountAmount,
                        $discount_code // Truyền mã giảm giá
                    );

                    if ($checkoutResult['success']) {
                        $payment = new Payment($this->db);
                        $payment->order_id = $checkoutResult['order_id'];
                        $payment->amount = $checkoutResult['total_amount'];
                        $payment->payment_date = date('Y-m-d H:i:s');
                        $payment->transaction_id = null;
                        $payment->payment_gateway = 'COD';
                        $payment->payment_status = 'Pending';
                        $payment->create();

                        $_SESSION['order_success'] = 'Đơn hàng của bạn đã được đặt thành công!';
                        $_SESSION['order_id'] = $checkoutResult['order_id'];
                        $_SESSION['order_total_amount'] = $checkoutResult['total_amount'];
                        $_SESSION['order_payment_method'] = $checkoutResult['payment_method'];
                        header('Location: ' . BASE_URL . 'index.php?controller=Payment&action=success');
                        exit;
                    } else {
                        $error = $checkoutResult['message'];
                    }
                }
            }
        }

        require_once __DIR__ . '/../views/payment/checkout.php';
    }
    // Xử lý thanh toán
    // public function processPayment()
    // {
    //     session_start();
    //     if (!isset($_SESSION['user_id'])) {
    //         header('Location: /porsche/auth/login');
    //         exit;
    //     }

    //     $user_id = $_SESSION['user_id'];

    //     // Kiểm tra dữ liệu gửi lên
    //     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //         header('Location: /porsche/payment');
    //         exit;
    //     }

    //     // Lấy thông tin thanh toán
    //     $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    //     $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

    //     // Kiểm tra phương thức thanh toán hợp lệ
    //     if (!in_array($payment_method, ['COD', 'VNPAY'])) {
    //         $_SESSION['payment_error'] = 'Phương thức thanh toán không hợp lệ';
    //         header('Location: /porsche/payment');
    //         exit;
    //     }

    //     // Xử lý đặt hàng
    //     $result = $this->checkout->processCheckout($user_id, $payment_method, $notes);

    //     if (!$result['success']) {
    //         $_SESSION['payment_error'] = $result['message'];
    //         header('Location: /porsche/payment');
    //         exit;
    //     }

    //     // Nếu thanh toán COD, chuyển đến trang cảm ơn
    //     if ($payment_method === 'COD') {
    //         $_SESSION['order_success'] = true;
    //         $_SESSION['order_id'] = $result['order_id'];
    //         header('Location: index.php?controller=Payment&action=success');
    //         exit;
    //     }

    //     // Nếu thanh toán VNPAY, chuyển đến cổng thanh toán
    //     if ($payment_method === 'VNPAY') {
    //         $vnpayUrl = $this->checkout->createVnpayUrl(
    //             $result['order_id'],
    //             $result['payment_id'],
    //             $result['total_amount']
    //         );
    //         header('Location: ' . $vnpayUrl);
    //         exit;
    //     }
    // }

    // Xử lý kết quả thanh toán VNPAY
    public function vnpayReturn()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /porsche/auth/login');
            exit;
        }

        if (empty($_GET)) {
            header('Location: /porsche/payment');
            exit;
        }

        $vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? '';
        $vnp_TxnRef = $_GET['vnp_TxnRef'] ?? '';
        $vnp_Amount = ($_GET['vnp_Amount'] ?? 0) / 100;

        if ($vnp_ResponseCode == '00') {
            $user_id = $_SESSION['user_id'];
            $delivery_address = $_SESSION['delivery_address'] ?? '';
            $discountAmount = $_SESSION['discount_amount'] ?? 0; // Lấy số tiền giảm giá từ session
            $discountCode = $_SESSION['discount_code'] ?? null; // Lấy mã giảm giá từ session

            $checkoutResult = $this->checkout->processCheckout(
                $user_id,
                'VNPAY',
                null,
                $delivery_address,
                $discountAmount,
                $discountCode // Truyền mã giảm giá
            );

            if ($checkoutResult['success']) {
                $payment = new Payment($this->db);
                $payment->order_id = $checkoutResult['order_id'];
                $payment->amount = $vnp_Amount;
                $payment->payment_date = date('Y-m-d H:i:s');
                $payment->transaction_id = $vnp_TxnRef;
                $payment->payment_gateway = 'VNPAY';
                $payment->payment_status = 'Success';
                $payment->create();

                $_SESSION['order_success'] = true;
                $_SESSION['order_id'] = $checkoutResult['order_id'];

                header('Location: index.php?controller=payment&action=success');
                exit;
            } else {
                $_SESSION['payment_error'] = 'Không thể tạo đơn hàng sau khi thanh toán thành công.';
                header('Location: index.php?controller=payment&action=failed');
                exit;
            }
        } else {
            header('Location: index.php?controller=payment&action=index');
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
