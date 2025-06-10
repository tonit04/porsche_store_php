<?php
require_once __DIR__ . '/../config/Database.php';

class Banner
{
    public $id, $name, $description, $image_url;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM banners");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $banners = [];
        foreach ($data as $row) {
            $banner = new Banner();
            foreach ($row as $key => $value) {
                $banner->$key = $value;
            }
            $banners[] = $banner;
        }
        return $banners;
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO banners (name, description, image_url) VALUES (:name, :description, :image_url)");
        return $stmt->execute($data);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM banners WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $banner = new Banner();
            foreach ($data as $key => $value) {
                $banner->$key = $value;
            }
            return $banner;
        }
        return null;
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE banners SET name = :name, description = :description, image_url = :image_url WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM banners WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
