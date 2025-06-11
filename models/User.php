<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../config/Database.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



class User
{

    public $id, $username, $password, $email, $full_name, $phone, $address, $role,
        $created_at, $updated_at, $is_verified;

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function findByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO users 
            (username, password, email, full_name, phone, address, role, created_at, updated_at, is_verified)
            VALUES (:username, :password, :email, :full_name, :phone, :address, :role, NOW(), NOW(), 1)");
        return $stmt->execute($data);
    }
    public function getUserOrders($user_id)
    {
        // Lấy tất cả thông tin từ bảng orders cho user_id cụ thể
        // Sắp xếp theo order_date giảm dần để hiển thị đơn hàng mới nhất trước
        $sql = "SELECT
                    o.id AS order_id,
                    o.order_date,
                    o.total_amount,
                    o.status,
                    O.delivery_address,
                    o.payment_method,
                    o.notes
                FROM orders o
                WHERE o.user_id = :user_id
                ORDER BY o.order_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả đơn hàng dưới dạng mảng kết hợp
    }

    // Nếu bạn muốn hiển thị chi tiết từng sản phẩm trong mỗi đơn hàng
    // bạn có thể thêm một phương thức khác để lấy order_details
    public function getSingleOrder($order_id)
    {
        $sql = "SELECT * FROM orders WHERE id = :order_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về mảng kết hợp
    }

    // Lấy chi tiết từng sản phẩm trong một đơn hàng
    public function getOrderDetails($order_id)
    {
        $sql = "SELECT
                    od.quantity,
                    c.name AS car_name,
                    c.price AS current_car_price,
                    c.image_url AS car_image,
                    od.car_id -- Thêm car_id để dùng nếu cần
                FROM order_details od
                JOIN cars c ON od.car_id = c.id
                WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($dataList as $data) {
            $user = new User();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $users[] = $user;
        }

        return $users;
    }
    public function updatePassword($user_id, $new_hashed_password)
    {
        $sql = "UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'password' => $new_hashed_password,
            'id' => $user_id
        ]);
    }

    public function countUsers()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            return $user;
        }
        return null;
    }
    public function update($id, $data)
    {
        $sql = "UPDATE users SET
                    full_name = :full_name,
                    email = :email,
                    phone = :phone,
                    address = :address,
                    updated_at = NOW()
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    public function forgotPassword($identifier)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :identifier OR email = :identifier LIMIT 1");
        $stmt->execute(['identifier' => $identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Không tìm thấy tài khoản với thông tin đã cung cấp.'
            ];
        }

        $newPassword = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateStmt = $this->conn->prepare("UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id");
        $updateStmt->execute([
            'password' => $hashedPassword,
            'id' => $user['id']
        ]);

        // Gửi email bằng PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'duynguyen1918@gmail.com'; // Email của bạn
            $mail->Password = 'nblv fuao dvrr zopd'; // Mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('porschevietnam123@gmail.com', 'Porsche Store');
            $mail->addAddress($user['email'], $user['full_name']);

            $mail->isHTML(true);
            $mail->Subject = 'Password recovery - Porsche Store';
            $mail->Body = "Xin chào " . $user['full_name'] . ",<br><br>Mật khẩu mới của bạn là: <strong>" . $newPassword . "</strong><br><br>Vui lòng đăng nhập và đổi mật khẩu ngay.";

            $mail->send();

            return [
                'success' => true,
                'message' => 'Mật khẩu mới đã được gửi đến email của bạn.'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Không thể gửi email. Lỗi: ' . $mail->ErrorInfo
            ];
        }
    }
}
