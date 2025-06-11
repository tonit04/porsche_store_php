<?php
require_once './models/Banner.php';
require_once __DIR__ . '/BaseAdminController.php';

class BannerAdminController extends BaseAdminController
{
    public function index()
    {
        $bannerModel = new Banner();
        $banners = $bannerModel->getAll();
        require_once './views/admin/banner_list.php';
    }

    public function update()
    {
        $bannerModel = new Banner();
        $id = $_GET['id'];
        $banner = $bannerModel->findById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image_url = $banner->image_url; // giữ ảnh cũ mặc định

            // Nếu có upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $targetDir = 'assets/images/banners/';
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $image_url = $fileName;
                }
            }

            $data = [
                'name' => $name,
                'description' => $description,
                'image_url' => $image_url
            ];

            $bannerModel->update($id, $data);
            header('Location: index.php?controller=BannerAdmin');
            exit;
        }
        require_once './views/admin/banner_update.php';
    }

    public function delete()
    {
        $bannerModel = new Banner();
        $id = $_GET['id'];
        $bannerModel->delete($id);
        header('Location: index.php?controller=BannerAdmin');
        exit;
    }

    public function create()
    {
        $bannerModel = new Banner();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image_url = '';

            // Xử lý upload ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $targetDir = 'assets/images/banners/';
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $image_url = $fileName;
                }
            }

            $data = [
                'name' => $name,
                'description' => $description,
                'image_url' => $image_url
            ];

            if ($bannerModel->create($data)) {
                header('Location: index.php?controller=BannerAdmin');
                exit;
            } else {
                $error = "Không thể thêm banner. Vui lòng thử lại.";
            }
        }

        require './views/admin/banner_create.php';
    }
}
