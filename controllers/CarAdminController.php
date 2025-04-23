<?php
require_once './models/Car.php';

class CarAdminController
{
    public function index()
    {
        $carModel = new Car();
        $cars = $carModel->getAll();
        require_once './views/car_list.php';
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
            // Lấy dữ liệu từ form
            $data = [
                'name' => $_POST['name'],
                'slug' => $_POST['slug'],
                'year' => $_POST['year'],
                'color' => $_POST['color'],
                'engine' => $_POST['engine'],
                'horsepower' => $_POST['horsepower'],
                'max_speed' => $_POST['max_speed'],
                'transmission' => $_POST['transmission'],
                'fuel_type' => $_POST['fuel_type'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'image_url' => $imageUrl 
            ];

            // Tạo xe mới
            $carModel = new Car();
            $carModel->create($data);

            // Redirect về trang danh sách xe
            header('Location: index.php?controller=CarAdmin');
            exit;
        }

        // Hiển thị form thêm xe
        require_once './views/car_create.php';
    }

    public function edit()
    {
        $carModel = new Car();
        $id = $_GET['id'];
        $car = $carModel->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carModel->update($id, $_POST);
            header('Location: index.php?controller=CarAdmin');
            exit;
        }

        require_once './views/car_edit.php';
    }

    public function delete()
    {
        $carModel = new Car();
        $id = $_GET['id'];
        $carModel->delete($id);
        header('Location: index.php?controller=CarAdmin');
        exit;
    }
}

?>