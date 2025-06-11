<?php
require_once __DIR__ . '/../config/Database.php';
class Order
{
    public $id, $user_id, $order_date, $total_amount, $status, $payment_method, $note;
    public $user;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orders = [];

        foreach ($dataList as $data) {
            $order = new Order();
            foreach ($data as $key => $value) {
                $order->$key = $value;
            }
            $order->user = $this->getUserByUser_id($order->user_id);
            $orders[] = $order;
        }

        return $orders;
    }

    public function countOrders()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }

    public function getTotalRevenue()
    {
        $stmt = $this->conn->query("SELECT SUM(total_amount) FROM orders WHERE status = 'Confirmed'");
        return $stmt->fetchColumn() ?? 0;
    }

    public function getRecentOrders($limit = 5)
    {
        $sql = "SELECT o.*, u.full_name 
                FROM orders o
                JOIN users u ON o.user_id = u.id
                ORDER BY o.order_date DESC 
                LIMIT :limit";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $orders = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order();
            foreach ($row as $key => $value) {
                $order->$key = $value;
            }
            $order->user = (object)['full_name' => $row['full_name']];
            $orders[] = $order;
        }
        return $orders;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $order = new Order();
            foreach ($data as $key => $value) {
                $order->$key = $value;
            }
            return $order;
        }
        return null;
    }

    public function update($id, $data)
    {
        $sql = "UPDATE orders SET                     
                    status = :status
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'status' => $data['status']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
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
