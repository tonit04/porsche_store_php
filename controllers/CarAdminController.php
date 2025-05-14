<?php
require_once './models/Car.php';

class CarAdminController
{
    public function index()
    {
        $car = new Car();

        // Lấy số trang hiện tại từ URL, mặc định là 1
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $limit = 4; // Số xe mỗi trang
        $offset = ($page - 1) * $limit;

        $cars = $car->getPaginated($limit, $offset); // Gọi hàm mới
        $totalCars = $car->countCars(); // Tổng số xe
        $totalPages = ceil($totalCars / $limit);

        require_once './views/admin/car_list.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem có file ảnh được tải lên không
            $imageUrl = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Lấy thông tin ảnh
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imagePath = 'assets/images/cars/' . basename($imageName);

                // Di chuyển ảnh đến thư mục đích
                if (move_uploaded_file($imageTmpPath, $imagePath)) {
                    $imageUrl = $imageName; // Lưu tên ảnh vào cơ sở dữ liệu
                }
            }
            // Tạo xe mới
            $car = new Car();
            $car->create($_POST, $imageUrl);

            // Redirect về trang danh sách xe
            header('Location: index.php?controller=CarAdmin');
            exit;
        }
        $car = new Car();
        $models = $car->getAllModels();
        // Hiển thị form thêm xe
        require_once './views/admin/car_create.php';
    }

    public function update()
    {
        $car = new Car();
        $id = $_GET['id'];
        $car = $car->findById($id); // $car giờ là object Car

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem có file ảnh được tải lên không
            $imageUrl = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Lấy thông tin ảnh
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imagePath = 'assets/images/cars/' . basename($imageName);

                // Di chuyển ảnh đến thư mục đích
                if (move_uploaded_file($imageTmpPath, $imagePath)) {
                    $imageUrl = $imageName; // Lưu tên ảnh vào cơ sở dữ liệu
                }
            } else {
                $imageUrl = $car->image_url;
            }
            $car->update($id, $_POST, $imageUrl);
            header('Location: index.php?controller=CarAdmin');
            exit;
        }
        $models = $car->getAllModels();
        require_once './views/admin/car_update.php';
    }

    public function delete()
    {
        $car = new Car();
        $id = $_GET['id'];
        $car->delete($id);
        header('Location: index.php?controller=CarAdmin');
        exit;
    }
}
