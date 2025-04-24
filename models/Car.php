<?php
require_once __DIR__ . '/../config/Database.php';

class Car
{
    public $id, $name, $slug, $year, $color, $engine, $horsepower, $max_speed,
    $transmission, $fuel_type, $price, $stock, $description, $image_url, $status;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM cars";
        $stmt = $this->conn->query($sql);
        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cars = [];
        foreach ($dataList as $data) {
            $car = new Car(); // hoặc self::class nếu trong cùng class
            foreach ($data as $key => $value) {
                $car->$key = $value;
            }
            $cars[] = $car;
        }

        return $cars; // Trả về mảng các object Car
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM cars WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($data) {
            $car = new Car();
            // Gán dữ liệu vào thuộc tính của $car
            foreach ($data as $key => $value) {
                $car->$key = $value;
            }
            return $car;
        }
    
        return null;
    }


    public function create($data, $imageUrl)
    {
        $sql = "INSERT INTO cars (name, slug, year, color, engine, horsepower, max_speed, 
                    transmission, fuel_type, price, stock, description, status, image_url) 
                    VALUES (:name, :slug, :year, :color, :engine, :horsepower, :max_speed, 
                    :transmission, :fuel_type, :price, :stock, :description, :status, :image_url)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'year' => $data['year'],
            'color' => $data['color'],
            'engine' => $data['engine'],
            'horsepower' => $data['horsepower'],
            'max_speed' => $data['max_speed'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'description' => $data['description'],
            'status' => $data['status'],
            'image_url' => $imageUrl
        ]);
    }


    public function update($id, $data, $imageUrl)
    {
        $sql = "UPDATE cars SET 
                    name = :name, slug = :slug, year = :year, color = :color,
                    engine = :engine, horsepower = :horsepower, max_speed = :max_speed,
                    transmission = :transmission, fuel_type = :fuel_type,
                    price = :price, stock = :stock, description = :description, status = :status,
                    image_url = :image_url
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'year' => $data['year'],
            'color' => $data['color'],
            'engine' => $data['engine'],
            'horsepower' => $data['horsepower'],
            'max_speed' => $data['max_speed'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'description' => $data['description'],
            'status' => $data['status'],
            'image_url' => $imageUrl
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM cars WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
