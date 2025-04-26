<?php
require_once 'models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;

                // Kiểm tra redirect_url để quay lại trang trước
                if (!empty($_SESSION['redirect_url'])) {
                    $redirectUrl = $_SESSION['redirect_url'];
                    unset($_SESSION['redirect_url']);
                    header("Location: $redirectUrl");
                } else {
                    header("Location: index.php?controller=User&action=profile");
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

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $userModel = new User();
            $user = $userModel->findByUsername($_POST['username']);
            if(!empty($user)) {
                $error = 'Tên đăng nhập đã tồn tại';
                include 'views/User/register.php';
                return;
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $error = "Email không hợp lệ";
                include 'views/User/register.php';
                return;
            }
            $data = [
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'email' => $_POST['email'],
                'full_name' => $_POST['full_name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'role' => 'user'
            ];
            if ($userModel->create($data)) 
            {
                header("Location: index.php?controller=User&action=login");
                exit;
            } else 
            {
                $error = "Đăng ký thất bại";
            }
        }
        include 'views/User/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $user = $_SESSION['user'];
        include 'views/User/profile.php';
    }
    
}
