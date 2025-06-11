<?php
require_once './models/Contact.php';
require_once __DIR__ . '/BaseAdminController.php';

class ContactAdminController extends BaseAdminController
{
    // Hiển thị danh sách liên hệ
    public function index()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getAll();
        require_once './views/admin/contact_list.php';
    }

    // Xem chi tiết liên hệ (nếu cần)
    public function detail()
    {
        $contactModel = new Contact();
        $id = $_GET['id'];
        $contacts = $contactModel->getAll();
        $contact = null;
        foreach ($contacts as $item) {
            if ($item->id == $id) {
                $contact = $item;
                break;
            }
        }

        // Lấy tên người gửi nếu có user_id
        $userName = 'Khách (chưa đăng nhập)';
        $userInfo = null;
        if ($contact && $contact->user_id) {
            require_once './models/User.php';
            $userModel = new User();
            $user = $userModel->findById($contact->user_id);
            if ($user) {
                $userName = $user->username;
                $userInfo = $user; // Truyền toàn bộ user sang view
            }
        }

        require './views/admin/contact_detail.php';
    }

    public function comfirmed()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=ContactAdmin');
            exit;
        }
        $id = $_GET['id'];
        $contactModel = new Contact();
        $contactModel->setConfirmed($id); // Gọi model thay vì viết SQL ở controller
        header('Location: index.php?controller=ContactAdmin');
        exit;
    }
}