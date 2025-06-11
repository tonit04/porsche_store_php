<?php
require_once './models/Category.php';
require_once __DIR__ . '/BaseAdminController.php';

class CategoryAdminController extends BaseAdminController
{
    public function index()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        require_once './views/admin/category_list.php';
    }

    public function update()
    {
        $categoryModel = new Category();
        $id = $_GET['id'];
        $category = $categoryModel->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $image_url = $category->image_url; // giữ ảnh cũ mặc định

            // Nếu có upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $targetDir = 'assets/images/categories/';
                $targetFile = $targetDir . $fileName;

                // Di chuyển file upload
                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $image_url = $fileName;
                }
            }

            $data = [
                'name' => $name,
                'image_url' => $image_url
            ];

            $categoryModel->update($id, $data);
            header('Location: index.php?controller=CategoryAdmin');
            exit;
        }
        require_once './views/admin/category_update.php';
    }

    public function delete()
    {
        $categoryModel = new Category();
        $id = $_GET['id'];
        $categoryModel->delete($id);
        header('Location: index.php?controller=CategoryAdmin');
        exit;
    }

    public function create()
    {
        $categoryModel = new Category();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $image_url = '';

            // Xử lý upload ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $targetDir = 'assets/images/categories/';
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $image_url = $fileName;
                }
            }

            $data = [
                'name' => $name,
                'image_url' => $image_url
            ];

            if ($categoryModel->create($data)) {
                header('Location: index.php?controller=CategoryAdmin');
                exit;
            } else {
                $error = "Không thể thêm danh mục. Vui lòng thử lại.";
            }
        }

        require './views/admin/category_create.php';
    }
}
