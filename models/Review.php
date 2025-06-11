<?php
require_once __DIR__ . '/../config/Database.php';

class Review
{
    public $id, $user_id, $car_id, $rating, $comment, $created_at;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Thêm đánh giá mới (chỉ khi chưa tồn tại review của user cho car này)
    public function create($data)
    {
        $sql = "INSERT INTO reviews (user_id, car_id, rating, comment) VALUES (:user_id, :car_id, :rating, :comment)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'user_id' => $data['user_id'],
            'car_id' => $data['car_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]);
    }

    // Lấy tất cả review của 1 sản phẩm (car)
    public function getByCar($car_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE car_id = :car_id ORDER BY created_at DESC");
        $stmt->execute(['car_id' => $car_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reviews = [];
        foreach ($data as $row) {
            $review = new Review();
            foreach ($row as $key => $value) {
                $review->$key = $value;
            }
            $reviews[] = $review;
        }
        return $reviews;
    }

    // Lấy review của 1 user cho 1 sản phẩm (car)
    public function getByUserAndCar($user_id, $car_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE user_id = :user_id AND car_id = :car_id");
        $stmt->execute(['user_id' => $user_id, 'car_id' => $car_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $review = new Review();
            foreach ($data as $key => $value) {
                $review->$key = $value;
            }
            return $review;
        }
        return null;
    }

    // Kiểm tra user đã mua xe này chưa (giả sử có bảng orders)
    public function hasPurchased($user_id, $car_id)
    {
        
        $sql = "SELECT COUNT(*) 
                FROM orders o
                JOIN order_details od ON o.id = od.order_id
                WHERE o.user_id = :user_id 
                  AND od.car_id = :car_id 
                  AND o.status = 'Confirmed'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'car_id' => $car_id]);
        return $stmt->fetchColumn() > 0;
    }

    // Cập nhật review (nếu muốn cho phép sửa)
    public function update($id, $data)
    {
        $sql = "UPDATE reviews SET rating = :rating, comment = :comment WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Xóa review
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}