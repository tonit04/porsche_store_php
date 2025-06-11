<?php
require_once './models/Contact.php';

class ContactController 
{
    public function create()
    {
        $success = $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactModel = new Contact();
            $data = [
                'user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'message' => $_POST['message']
            ];
            if ($contactModel->create($data)) {
                $success = "Gửi liên hệ thành công!";
            } else {
                $error = "Có lỗi xảy ra, vui lòng thử lại.";
            }
        }
        require './views/product/contact.php';
    }
}