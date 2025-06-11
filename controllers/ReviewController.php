<?php
require_once __DIR__ . '/../models/Review.php';

class ReviewController
{
    // Hiển thị tất cả review của một xe
    public function listByCar()
    {
        if (!isset($_GET['car_id'])) {
            echo "Thiếu thông tin xe.";
            return;
        }
        $car_id = $_GET['car_id'];
        $reviewModel = new Review();
        $reviews = $reviewModel->getByCar($car_id);
        require_once __DIR__ . '/../views/product/review_list.php';
    }

    public function create()
    {
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || !isset($_GET['car_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $car_id = $_GET['car_id'];
        $reviewModel = new Review();

        // Kiểm tra quyền đánh giá
        if (!$reviewModel->hasPurchased($user_id, $car_id)) {
            $error = "Bạn chỉ có thể đánh giá sau khi đã mua xe này.";
            require_once __DIR__ . '/../views/product/review_form.php';
            return;
        }
        if ($reviewModel->getByUserAndCar($user_id, $car_id)) {
            $error = "Bạn đã đánh giá xe này rồi.";
            require_once __DIR__ . '/../views/product/review_form.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
            $comment = trim($_POST['comment'] ?? '');

            if ($rating < 1 || $rating > 5) {
                $error = "Vui lòng chọn số sao từ 1 đến 5.";
            } elseif (empty($comment)) {
                $error = "Vui lòng nhập nhận xét.";
            } else {
                $data = [
                    'user_id' => $user_id,
                    'car_id' => $car_id,
                    'rating' => $rating,
                    'comment' => $comment
                ];
                if ($reviewModel->create($data)) {
                    // Lưu thông báo vào session
                    $_SESSION['review_success'] = "Đánh giá của bạn đã được ghi nhận!";
                    header("Location: index.php?controller=Product&action=details&id=$car_id");
                    exit;
                } else {
                    $error = "Có lỗi xảy ra, vui lòng thử lại.";
                }
            }
        }

        require_once __DIR__ . '/../views/product/review_form.php';
    }
}