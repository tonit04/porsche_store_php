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
                $_SESSION['registration_success'] = 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.';
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
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=User&action=login");
            exit;
        }

        // 2. Lấy user_id từ session
        $user_id = $_SESSION['user_id'];

        // 3. Tạo một thể hiện của User model
        $userModel = new User();

        // 4. Lấy thông tin người dùng từ database
        $user_data = $userModel->findById($user_id);

        // 5. Lấy danh sách đơn hàng của người dùng từ database
        $user_orders = $userModel->getUserOrders($user_id); // Gọi phương thức mới

        // 6. Kiểm tra xem có tìm thấy người dùng không
        if (!$user_data) {
            $_SESSION['error_message'] = 'Không tìm thấy thông tin người dùng.';
            header("Location: index.php?controller=Home&action=index");
            exit;
        }

        // 7. Truyền dữ liệu người dùng và đơn hàng vào view profile.php
        include 'views/User/profile.php';
    }
    public function Orderdetails()
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=User&action=login");
            exit;
        }

        // 2. Lấy order_id từ URL
        $order_id = $_GET['id'] ?? null;

        if (!$order_id) {
            $_SESSION['error_message'] = 'Mã đơn hàng không hợp lệ.';
            header("Location: index.php?controller=User&action=profile"); // Chuyển hướng về trang profile nếu không có ID
            exit;
        }

        $userModel = new User();

        // 3. Lấy thông tin chính của đơn hàng
        $order_info = $userModel->getSingleOrder($order_id);

        // 4. Lấy chi tiết các sản phẩm trong đơn hàng
        $order_details = $userModel->getOrderDetails($order_id);

        // 5. Kiểm tra xem đơn hàng có tồn tại và thuộc về người dùng hiện tại không (quan trọng cho bảo mật)
        if (!$order_info || $order_info['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Bạn không có quyền truy cập đơn hàng này hoặc đơn hàng không tồn tại.';
            header("Location: index.php?controller=User&action=profile");
            exit;
        }

        // 6. Tính toán phí ship và tổng cộng (nếu có logic phí ship)
        // Ví dụ: phí ship cố định 30.000 VND
        $shipping_fee = 30000;
        $grand_total = $order_info['total_amount']; // total_amount đã bao gồm sản phẩm. Nếu bạn muốn hiển thị phí ship riêng và tổng cuối cùng, bạn có thể tính lại ở đây.
        // Hoặc: $grand_total = $order_info['total_amount'] + $shipping_fee;

        // 7. Truyền dữ liệu vào view
        include 'views/User/Orderdetails.php';
    }

    // Bạn có thể thêm phương thức 'cancel' ở đây để xử lý việc hủy đơn hàng
    public function cancel()
    {
        // ... (Logic hủy đơn hàng, cập nhật status trong bảng orders)
        // Sau khi xử lý, chuyển hướng người dùng về trang profile hoặc một trang thông báo
        header("Location: index.php?controller=User&action=profile");
        exit;
    }
}
