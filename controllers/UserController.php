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
    public function changePassword()
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=User&action=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User();
        $user = $userModel->findById($user_id); // Lấy thông tin người dùng để xác thực mật khẩu cũ

        $message = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_new_password = $_POST['confirm_new_password'] ?? '';

            // 2. Xác thực mật khẩu cũ
            if (!password_verify($current_password, $user->password)) {
                $error = 'Mật khẩu hiện tại không đúng.';
            }
            // 3. Kiểm tra mật khẩu mới và xác nhận mật khẩu
            else if (empty($new_password) || empty($confirm_new_password)) {
                $error = 'Vui lòng nhập đầy đủ mật khẩu mới và xác nhận mật khẩu.';
            } else if ($new_password !== $confirm_new_password) {
                $error = 'Mật khẩu mới và xác nhận mật khẩu không khớp.';
            } else if (strlen($new_password) < 12) {
                $error = "Mật khẩu mới phải có ít nhất 12 ký tự.";
            } else {
                // 4. Mã hóa mật khẩu mới và cập nhật vào DB
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                if ($userModel->updatePassword($user_id, $new_hashed_password)) {
                    // Cập nhật session user nếu cần (ví dụ: để đảm bảo rằng mật khẩu được hash mới không bị kiểm tra lại bằng mật khẩu cũ)
                    // Hoặc đơn giản là đăng xuất người dùng để họ đăng nhập lại với mật khẩu mới.
                    $message = 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại.';
                    session_destroy();
                    header("Refresh: 3; url=index.php?controller=User&action=login"); // Chuyển hướng sau 3 giây
                    // exit; // Không exit ngay để thông báo có thể hiển thị
                } else {
                    $error = 'Có lỗi xảy ra khi đổi mật khẩu. Vui lòng thử lại.';
                }
            }
        }

        // 5. Load view đổi mật khẩu
        include 'views/User/change_password.php';
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
