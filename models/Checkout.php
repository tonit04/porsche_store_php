<?php
// models/Checkout.php

class Checkout
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Xử lý thanh toán
    public function processCheckout($user_id, $payment_method, $notes)
    {
        $this->conn->beginTransaction();

        try {
            // Lấy thông tin giỏ hàng
            $cart = new Cart($this->conn);
            $cartItems = $cart->getCartItems($user_id);
            $cartTotal = $cart->getCartTotal($user_id);

            if (empty($cartItems)) {
                return [
                    'success' => false,
                    'message' => 'Giỏ hàng trống'
                ];
            }

            // Tạo đơn hàng mới
            $createOrderQuery = "INSERT INTO orders 
                             SET user_id = :user_id, 
                                 total_amount = :total_amount, 
                                 order_date = CURRENT_TIMESTAMP, 
                                 status = :status, 
                                 payment_method = :payment_method, 
                                 notes = :notes";

            $orderStmt = $this->conn->prepare($createOrderQuery);
            $status = ($payment_method === 'COD') ? 'Pending' : 'Processing';

            $orderStmt->bindParam(':user_id', $user_id);
            $orderStmt->bindParam(':total_amount', $cartTotal);
            $orderStmt->bindParam(':status', $status);
            $orderStmt->bindParam(':payment_method', $payment_method);
            $orderStmt->bindParam(':notes', $notes);

            $orderStmt->execute();
            $order_id = $this->conn->lastInsertId();

            // Tạo chi tiết đơn hàng
            foreach ($cartItems as $item) {
                $createDetailQuery = "INSERT INTO order_details
                                 SET order_id = :order_id,
                                     car_id = :product_id,
                                     quantity = :quantity,
                                     price = :price,
                                     subtotal = :subtotal";

                $detailStmt = $this->conn->prepare($createDetailQuery);
                $detailStmt->bindParam(':order_id', $order_id);
                $detailStmt->bindParam(':product_id', $item['car_id']);
                $detailStmt->bindParam(':quantity', $item['quantity']);
                $detailStmt->bindParam(':price', $item['price']);
                $detailStmt->bindValue(':subtotal', $item['price'] * $item['quantity']);

                $detailStmt->execute();
            }

            // Nếu phương thức thanh toán là VNPAY, tạo URL thanh toán
            if ($payment_method === 'VNPAY') {
                $this->conn->commit();
                $vnpayUrl = $this->createVnpayUrl($order_id, null, $cartTotal);

                // Trả về URL thanh toán để người dùng thực hiện thanh toán
                return [
                    'success' => true,
                    'order_id' => $order_id,
                    'payment_url' => $vnpayUrl
                ];
            }

            // Nếu là COD, lưu thông tin thanh toán ngay lập tức
            $payment = new Payment($this->conn);
            $payment->order_id = $order_id;
            $payment->amount = $cartTotal;
            $payment->transaction_id = '';
            $payment->payment_gateway = $payment_method;
            $payment->payment_status = 'Pending';
            $payment->create();
            $payment_id = $payment->id;

            // Xóa giỏ hàng sau khi đặt hàng thành công
            $cart->clearCart($user_id);

            $this->conn->commit();

            return [
                'success' => true,
                'order_id' => $order_id,
                'payment_id' => $payment_id,
                'total_amount' => $cartTotal
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ];
        }
    }

    // Tạo URL thanh toán VNPAY
    public function createVnpayUrl($order_id, $payment_id, $amount)
    {
        // Cấu hình VNPAY
        $vnp_TmnCode = "9HZKBNNN"; // Mã website tại VNPAY
        $vnp_HashSecret = "8HGHV2MT8QI5NLICKG28HOBLJ0AATIE6"; // Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/porsche_store_php/index.php?controller=payment&action=vnpayReturn";

        // Thời gian giao dịch
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đảm bảo múi giờ chính xác
        $vnp_CreateDate = date('YmdHis'); // Thời gian tạo giao dịch
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes')); // Hết hạn sau 15 phút

        // Thông tin thanh toán
        $vnp_TxnRef = $order_id . '-' . time(); // Mã đơn hàng + timestamp để tránh trùng lặp
        $vnp_OrderInfo = "Thanh toan don hang #" . $order_id;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = 100000 * 100; // Số tiền * 100 (VNPAY yêu cầu)
        $vnp_Locale = "vn";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // Tạo mảng dữ liệu gửi đến VNPAY
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        // Sắp xếp dữ liệu theo thứ tự từ điển
        ksort($inputData);
        $query = "";
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Xóa dấu & cuối cùng
        $hashdata = rtrim($hashdata, '&');
        $query = rtrim($query, '&');

        // Tạo chữ ký
        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $query .= '&vnp_SecureHash=' . $vnp_SecureHash;

        // Tạo URL thanh toán
        $vnpayUrl = $vnp_Url . "?" . $query;

        return $vnpayUrl;
    }
}
