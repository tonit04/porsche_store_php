<?php
class Payment
{
    private $conn;
    public $id;
    public $order_id;
    public $amount;
    public $payment_date;
    public $transaction_id;
    public $payment_gateway;
    public $payment_status;

    public function __construct($db = null)
    {
        if ($db) {
            $this->conn = $db;
        } else {
            $database = new Database();
            $this->conn = $database->connect();
        }
    }

    // Tạo payment mới
    public function create()
    {
        $query = "INSERT INTO payments 
                  SET order_id = :order_id,
                      amount = :amount,
                      payment_date = CURRENT_TIMESTAMP,
                      transaction_id = :transaction_id,
                      payment_gateway = :payment_gateway,
                      payment_status = :payment_status";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->transaction_id = htmlspecialchars(strip_tags($this->transaction_id));
        $this->payment_gateway = htmlspecialchars(strip_tags($this->payment_gateway));
        $this->payment_status = htmlspecialchars(strip_tags($this->payment_status));

        // Gán giá trị cho tham số
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':transaction_id', $this->transaction_id);
        $stmt->bindParam(':payment_gateway', $this->payment_gateway);
        $stmt->bindParam(':payment_status', $this->payment_status);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // Nếu thất bại
        $errorInfo = $stmt->errorInfo();
        printf("Error: %s.\n", $errorInfo[2]);
        return false;
    }

    // Cập nhật trạng thái thanh toán
    public function updateStatus()
    {
        $query = "UPDATE payments
                  SET payment_status = :payment_status,
                      transaction_id = :transaction_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $this->payment_status = htmlspecialchars(strip_tags($this->payment_status));
        $this->transaction_id = htmlspecialchars(strip_tags($this->transaction_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Gán giá trị cho tham số
        $stmt->bindParam(':payment_status', $this->payment_status);
        $stmt->bindParam(':transaction_id', $this->transaction_id);
        $stmt->bindParam(':id', $this->id);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }

        // Nếu thất bại
        $errorInfo = $stmt->errorInfo();
        printf("Error: %s.\n", $errorInfo[2]);
        return false;
    }

    // Lấy thông tin thanh toán theo order_id
    public function getByOrderId($order_id)
    {
        $query = "SELECT * FROM payments WHERE order_id = :order_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->order_id = $row['order_id'];
            $this->amount = $row['amount'];
            $this->payment_date = $row['payment_date'];
            $this->transaction_id = $row['transaction_id'];
            $this->payment_gateway = $row['payment_gateway'];
            $this->payment_status = $row['payment_status'];
            return true;
        }

        return false;
    }
}
