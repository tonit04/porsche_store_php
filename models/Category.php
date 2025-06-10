<?php
require_once __DIR__ . '/../config/Database.php';

class Category
{

    public $id, $name,$image_url;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM categories");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        foreach ($data as $row) {
            $category = new Category();
            foreach ($row as $key => $value) {
                $category->$key = $value;
            }
            $categories[] = $category;
        }
        return $categories;
    }   
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO categories 
            (name,image_url)
            VALUES (:name, :image_url)");
        return $stmt->execute($data);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new Category();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            return $user;
        }
        return null;
    }
    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE categories SET 
            name = :name, 
            image_url = :image_url
            WHERE id = :id");
        $data['id'] = $id; // Thêm id vào dữ liệu để cập nhật
        return $stmt->execute($data);
       
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
