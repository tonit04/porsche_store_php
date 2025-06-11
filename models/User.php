<?php
require_once __DIR__ . '/../config/Database.php';

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
    public function editProfile()
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=User&action=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $user_data = $userModel->findById($user_id); // Lấy thông tin hiện tại của người dùng

        $message = '';
        $error = '';

        if (!$user_data) {
            $_SESSION['error_message'] = 'Không tìm thấy thông tin người dùng.';
            header("Location: index.php?controller=Home&action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $full_name = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            // 2. Kiểm tra dữ liệu đầu vào
            if (empty($full_name) || empty($email) || empty($phone) || empty($address)) {
                $error = 'Vui lòng điền đầy đủ tất cả các trường.';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ.";
            } else if (!preg_match("/^0[0-9]{9,10}$/", $phone)) {
                $error = "Số điện thoại không hợp lệ (phải có 10 hoặc 11 số và bắt đầu bằng 0).";
            } else {
                // Kiểm tra email trùng lặp (nếu email thay đổi và trùng với email của người dùng khác)
                if ($email !== $user_data->email) {
                    $existing_user_by_email = $userModel->findByEmail($email);
                    if ($existing_user_by_email && $existing_user_by_email['id'] !== $user_id) {
                        $error = 'Email đã được sử dụng bởi một tài khoản khác.';
                    }
                }
            }

            // Nếu không có lỗi, tiến hành cập nhật
            if (empty($error)) {
                $data_to_update = [
                    'full_name' => $full_name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address
                ];

                if ($userModel->update($user_id, $data_to_update)) {
                    // Cập nhật lại session user để thông tin mới hiển thị ngay lập tức
                    $_SESSION['user']['full_name'] = $full_name;
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['phone'] = $phone;
                    $_SESSION['user']['address'] = $address;
                    $message = 'Cập nhật thông tin thành công!';
                    // Cập nhật lại $user_data để hiển thị trên form sau khi submit thành công
                    $user_data = $userModel->findById($user_id);
                } else {
                    $error = 'Có lỗi xảy ra khi cập nhật thông tin. Vui lòng thử lại.';
                }
            }
        }

        // Load view cập nhật thông tin
        include 'views/User/edit_profile.php';
    }
}
