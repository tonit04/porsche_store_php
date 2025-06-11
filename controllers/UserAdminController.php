<?php
require_once './models/User.php';
require_once __DIR__ . '/BaseAdminController.php';

class UserAdminController extends BaseAdminController
{
    public function index()
    {
        $user = new User();

        // Lấy số trang hiện tại từ URL, mặc định là 1
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $limit = 4; // Số xe mỗi trang
        $offset = ($page - 1) * $limit;

        $users = $user->getPaginated($limit, $offset); // Gọi hàm mới
        $totalUsers = $user->countUsers(); // Tổng số user
        $totalPages = ceil($totalUsers / $limit);

        require_once './views/admin/user_list.php';
    }

    public function update()
    {
        $user = new User();
        $id = $_GET['id'];
        $user = $user->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->update($id, $_POST);
            header('Location: index.php?controller=UserAdmin');
            exit;
        }
        require_once './views/admin/user_update.php';
    }

    public function detail()
    {
        $user = new User();
        $id = $_GET['id'];
        $user = $user->findById($id);
        require_once './views/admin/user_detail.php';
    }


    public function delete()
    {
        $user = new User();
        $id = $_GET['id'];
        $user->delete($id);
        header('Location: index.php?controller=UserAdmin');
        exit;
    }
}
