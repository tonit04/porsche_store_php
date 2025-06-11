<?php
require_once __DIR__ . '/../config/Database.php';
class OrderDetail
{
    public $id, $quantity, $price, $subtotal, $order_id, $car_id;
    public $order, $car, $payment;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getPaymentByOrderId($order_id) 
    {
        $sql = "SELECT * FROM payments WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $payment = new stdClass();
            $payment->id = $data['id'];
            $payment->order_id = $data['order_id'];
            $payment->amount = $data['amount'];
            $payment->payment_date = $data['payment_date'];
            $payment->transaction_id = $data['transaction_id'];
            $payment->payment_gateway = $data['payment_gateway'];
            $payment->payment_status = $data['payment_status'];
            return $payment;
        }
        return null;
    }

    public function findById($order_id)
    {
        $sql = "SELECT * FROM order_details WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orderDetails = [];
        foreach ($dataList as $data) {
            $orderDetail = new OrderDetail();
            foreach ($data as $key => $value) {
                $orderDetail->$key = $value;
            }
            $orderDetail->order = $this->getOrderByOrder_id($orderDetail->order_id);
            $orderDetail->car = $this->getCarByCar_id($orderDetail->car_id);
            $orderDetail->payment = $this->getPaymentByOrderId($orderDetail->order_id); // Add this line
            $orderDetails[] = $orderDetail;
        }

        return $orderDetails;
    }

    public function getOrderByOrder_id($order_id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $order_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $order = new stdClass();
            $order->id = $data['id'];
            $order->user_id = $data['user_id'];
            $order->status = $data['status'];
            $order->total_amount = $data['total_amount'];
            $order->user = $this->getUserByUser_id($data['user_id']);
            return $order;
        } else {
            return null;
        }
    }

    public function getCarByCar_id($car_id)
    {
        $sql = "SELECT * FROM cars WHERE  id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $car_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $car = new stdClass();
            $car->id = $data['id'];
            $car->name = $data['name'];
            return $car;
        } else {
            return null;
        }
    }

    public function getUserByUser_id($user_id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $user_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new stdClass();
            $user->id = $data['id'];
            $user->full_name = $data['full_name'];
            return $user;
        } else {
            return null;
        }
    }

}
