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
    public function processCheckout($user_id, $payment_method, $notes, $delivery_address, $discountAmount = 0, $discountCode = null)
    {
        $this->conn->beginTransaction();

        try {
            $cart = new Cart($this->conn);
            $cartItems = $cart->getCartItems($user_id);
            $cartTotal = $cart->getCartTotal($user_id) - $discountAmount;

            if (empty($cartItems)) {
                return [
                    'success' => false,
                    'message' => 'Giỏ hàng trống'
                ];
            }

            // Kiểm tra tồn kho
            foreach ($cartItems as $item) {
                $productQuery = "SELECT stock FROM cars WHERE id = :car_id";
                $productStmt = $this->conn->prepare($productQuery);
                $productStmt->bindParam(':car_id', $item['car_id']);
                $productStmt->execute();
                $product = $productStmt->fetch(PDO::FETCH_ASSOC);

                if (!$product || $product['stock'] < $item['quantity']) {
                    return [
                        'success' => false,
                        'message' => 'Sản phẩm "' . $item['name'] . '" không đủ số lượng tồn kho.'
                    ];
                }
            }

            // Tạo đơn hàng
            $createOrderQuery = "INSERT INTO orders
                             SET user_id = :user_id,
                                 total_amount = :total_amount,
                                 discount_applied = :discount_applied,
                                 voucher_code = :voucher_code,
                                 order_date = CURRENT_TIMESTAMP,
                                 status = :status,
                                 payment_method = :payment_method,
                                 notes = :notes,
                                 delivery_address = :delivery_address";

            $orderStmt = $this->conn->prepare($createOrderQuery);
            $status = 'Pending';

            $orderStmt->bindParam(':user_id', $user_id);
            $orderStmt->bindParam(':total_amount', $cartTotal);
            $orderStmt->bindParam(':discount_applied', $discountAmount);
            $orderStmt->bindParam(':voucher_code', $discountCode);
            $orderStmt->bindParam(':status', $status);
            $orderStmt->bindParam(':payment_method', $payment_method);
            $orderStmt->bindParam(':notes', $notes);
            $orderStmt->bindParam(':delivery_address', $delivery_address);

            $orderStmt->execute();
            $order_id = $this->conn->lastInsertId();

            // Thêm chi tiết đơn hàng và trừ tồn kho
            foreach ($cartItems as $item) {
                $createOrderDetailQuery = "INSERT INTO order_details
                                       SET order_id = :order_id,
                                           car_id = :car_id,
                                           quantity = :quantity,
                                           price = :price,
                                           subtotal = :subtotal";
                $orderDetailStmt = $this->conn->prepare($createOrderDetailQuery);
                $orderDetailStmt->bindParam(':order_id', $order_id);
                $orderDetailStmt->bindParam(':car_id', $item['car_id']);
                $orderDetailStmt->bindParam(':quantity', $item['quantity']);
                $orderDetailStmt->bindParam(':price', $item['price']);
                $subtotal = $item['price'] * $item['quantity'];
                $orderDetailStmt->bindParam(':subtotal', $subtotal);
                $orderDetailStmt->execute();

                // Trừ tồn kho
                $updateStockQuery = "UPDATE cars SET stock = stock - :quantity WHERE id = :car_id";
                $updateStockStmt = $this->conn->prepare($updateStockQuery);
                $updateStockStmt->bindParam(':quantity', $item['quantity']);
                $updateStockStmt->bindParam(':car_id', $item['car_id']);
                $updateStockStmt->execute();
            }

            $cart->clearCart($user_id);

            $this->conn->commit();
            return [
                'success' => true,
                'order_id' => $order_id,
                'total_amount' => $cartTotal,
                'payment_method' => $payment_method
            ];
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Lỗi khi tạo đơn hàng: ' . $e->getMessage()
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
        $vnp_Amount = 90000000 * 100; // Số tiền * 100 (VNPAY yêu cầu)
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
