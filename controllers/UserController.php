<?php
require_once 'models/User.php';

class UserController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];

                // Chuyển hướng dựa trên vai trò của người dùng
                if ($user['role'] == 'admin') { // Nếu vai trò là admin
                    // Admin luôn chuyển hướng đến dashboard, bỏ qua redirect_url
                    header("Location: index.php?controller=Admin&action=dashboard");
                } else { // Nếu vai trò là customer (hoặc bất kỳ vai trò nào khác không phải admin)
                    // Customer kiểm tra redirect_url để quay lại trang trước
                    if (!empty($_SESSION['redirect_url'])) {
                        $redirectUrl = $_SESSION['redirect_url'];
                        unset($_SESSION['redirect_url']);
                        header("Location: $redirectUrl");
                    } else {
                        // Nếu không có redirect_url, chuyển đến trang profile mặc định cho customer
                        header("Location: index.php?controller=User&action=profile");
                    }
                }
                exit;
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu";
            }
        }

        // Nếu GET thì kiểm tra xem có redirect_url không (đã lưu từ middleware kiểm tra login)
        $redirectUrl = $_SESSION['redirect_url'] ?? '/dashboard.php';

        include 'views/User/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $email = $_POST['email'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            $userModel = new User();

            // 1. Kiểm tra tên đăng nhập đã tồn tại
            $userByUsername = $userModel->findByUsername($username);
            if (!empty($userByUsername)) {
                $error = 'Tên đăng nhập đã tồn tại';
                include 'views/User/register.php';
                return;
            }

            // 2. Kiểm tra email đã tồn tại
            $userByEmail = $userModel->findByEmail($email); // Sử dụng phương thức findByEmail mới
            if (!empty($userByEmail)) {
                $error = 'Email đã được sử dụng'; // Thông báo lỗi khi email đã tồn tại
                include 'views/User/register.php';
                return;
            }

            // 3. Kiểm tra định dạng email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ";
                include 'views/User/register.php';
                return;
            }

            // 4. Kiểm tra độ dài mật khẩu
            if (strlen($password) < 12) {
                $error = "Mật khẩu phải có ít nhất 12 ký tự";
                include 'views/User/register.php';
                return;
            }

            // 5. Kiểm tra số điện thoại (10 hoặc 11 số, bắt đầu bằng 0)
            if (!preg_match("/^0[0-9]{9,10}$/", $phone)) {
                $error = "Số điện thoại không hợp lệ (phải có 10 hoặc 11 số và bắt đầu bằng 0)";
                include 'views/User/register.php';
                return;
            }

            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'full_name' => $full_name,
                'phone' => $phone,
                'address' => $address,
                'role' => 'user'
            ];

            if ($userModel->create($data)) {
                header("Location: index.php?controller=User&action=login");
                exit;
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
        include 'views/User/register.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?controller=Home&action=index");
    }
    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $user = $_SESSION['user'];
        include 'views/User/profile.php';
    }
}
