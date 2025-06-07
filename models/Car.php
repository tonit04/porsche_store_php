<?php
require_once __DIR__ . '/../config/Database.php';

class Car
{
    public $id, $name, $slug, $year, $color, $engine, $horsepower, $max_speed,
    $transmission, $fuel_type, $price, $stock, $description, $image_url, $status, $model_id;
    public $model;
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
    // Đếm tổng số xe
    public function countCars()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM cars");
        return $stmt->fetchColumn();
    }

    // Lấy xe có phân trang
    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cars LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cars = [];
        foreach ($dataList as $data) {
            $car = new Car();
            foreach ($data as $key => $value) {
                $car->$key = $value;
            }
            $car->model =$this->getModelByModel_id($car->model_id);
            $cars[] = $car;
        }

        return $cars;
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
            $car->model =$this->getModelByModel_id($car->model_id);
            return $car;
        }

        return null;
    }


    public function findBySlug($slug)
    {
        $sql = "SELECT * FROM cars WHERE slug = :slug LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $car = new Car();
        // Gán dữ liệu vào thuộc tính của $car
        foreach ($data as $key => $value) {
            $car->$key = $value;
        }
        $car->model = $this->getModelByModel_id($car->model_id);
        return $car;
        }

        return null;
    }

    public function create($data, $imageUrl)
    {
        $sql = "INSERT INTO cars (name, slug, year, color, engine, horsepower, max_speed, 
                    transmission, fuel_type, price, stock, description, status, image_url,model_id) 
                    VALUES (:name, :slug, :year, :color, :engine, :horsepower, :max_speed, 
                    :transmission, :fuel_type, :price, :stock, :description, :status, :image_url,:model_id)";

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
            'image_url' => $imageUrl,
            'model_id' => $data['model_id']
        ]);
    }


    public function update($id, $data, $imageUrl)
    {
        $sql = "UPDATE cars SET 
                    name = :name, slug = :slug, year = :year, color = :color,
                    engine = :engine, horsepower = :horsepower, max_speed = :max_speed,
                    transmission = :transmission, fuel_type = :fuel_type,
                    price = :price, stock = :stock, description = :description, status = :status,
                    image_url = :image_url,model_id = :model_id
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
            'image_url' => $imageUrl,
            'model_id' => $data['model_id']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM cars WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getAllModels()
    {
        $sql = "SELECT * FROM models";
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);  // Trả về kiểu đối tượng

        return $data;
    }

    public function getModelByModel_id($model_id)
    {
        $sql = "SELECT * FROM models WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $model_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $model = new stdClass();
            $model->id = $data['id'];
            $model->name = $data['name'];
            $model->image_url = $data['image_url'];
            return $model;
        } else {
            return null;
        }
    }

    // === PHƯƠNG THỨC MỚI ĐỂ LẤY TẤT CẢ CATEGORIES ===
    public function getAllCategories()
    {
        $sql = "SELECT id, name, image_url FROM categories ORDER BY name ASC"; // Sắp xếp theo tên cho nhất quán
        $stmt = $this->conn->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_OBJ); // Trả về mảng các đối tượng category
        return $categories;
    }
    // === KẾT THÚC PHƯƠNG THỨC MỚI ===

    // === PHƯƠNG THỨC MỚI ĐỂ LẤY XE MỚI NHẤT ===
    public function getLatestCar()
    {
        // Sắp xếp theo ID giảm dần và lấy chiếc đầu tiên
        // Hoặc có thể dùng created_at nếu có và muốn dựa vào thời gian tạo
        $sql = "SELECT c.*, md.name as model_name 
                FROM cars c 
                LEFT JOIN models md ON c.model_id = md.id 
                ORDER BY c.id DESC 
                LIMIT 1";
        $stmt = $this->conn->query($sql);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $car = new Car(); // Tạo instance mới để không ghi đè thuộc tính của instance hiện tại nếu đang dùng
            foreach ($data as $key => $value) {
                if (property_exists($car, $key)) {
                    $car->$key = $value;
                }
            }
            // Gán tên model vào thuộc tính model của đối tượng car (nếu có)
            if (isset($data['model_name'])) {
                if (!is_object($car->model)) {
                    $car->model = new stdClass();
                }
                $car->model->name = $data['model_name'];
            }
            return $car;
        }
        return null;
    }
    // === KẾT THÚC PHƯƠNG THỨC LẤY XE MỚI NHẤT ===

    // === PHƯƠNG THỨC LẤY XE THEO CATEGORY ID ===
    public function getCarsByCategoryId($categoryId, $limit = 10, $offset = 0)
    {
        $sql = "SELECT c.*, md.name as model_name 
                FROM cars c 
                JOIN models md ON c.model_id = md.id
                JOIN categories cat ON md.category_id = cat.id
                WHERE cat.id = :categoryId
                ORDER BY c.name ASC
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cars = [];
        foreach ($dataList as $data) {
            $car = new Car();
            foreach ($data as $key => $value) {
                if (property_exists($car, $key)) {
                    $car->$key = $value;
                }
            }
            if (isset($data['model_name'])) {
                 if (!is_object($car->model)) {
                    $car->model = new stdClass();
                }
                $car->model->name = $data['model_name']; // Gán tên model
            }
            $cars[] = $car;
        }
        return $cars;
    }

    // === PHƯƠNG THỨC ĐẾM XE THEO CATEGORY ID ===
    public function countCarsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(c.id) 
                FROM cars c
                JOIN models md ON c.model_id = md.id
                JOIN categories cat ON md.category_id = cat.id
                WHERE cat.id = :categoryId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // === PHƯƠNG THỨC LẤY THÔNG TIN CATEGORY BẰNG ID ===
    public function getCategoryById($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // Trả về object category
    }

    public function searchSuggestions($term) {
        $term = "%{$term}%";
        $query = "SELECT c.id, c.name, c.year, c.price, m.name as model_name 
                 FROM cars c
                 LEFT JOIN models m ON c.model_id = m.id
                 WHERE c.name LIKE ? 
                 OR c.year LIKE ? 
                 OR m.name LIKE ?
                 LIMIT 5";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$term, $term, $term]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Format suggestions for display
            return array_map(function($car) {
                $displayName = $car['name'];
                if (!empty($car['model_name'])) {
                    $displayName = $car['model_name'] . ' ' . $car['name'];
                }
                return [
                    'id' => $car['id'],
                    'label' => "{$displayName} ({$car['year']})",
                    'value' => $displayName,
                    'price' => number_format($car['price'], 0, ',', '.') . ' VNĐ'
                ];
            }, $results);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function searchCars($keyword) {
        $keyword = "%{$keyword}%";
        $query = "SELECT c.*, m.name as model_name 
                 FROM cars c
                 LEFT JOIN models m ON c.model_id = m.id
                 WHERE c.name LIKE ? 
                 OR c.year LIKE ? 
                 OR m.name LIKE ?
                 OR c.description LIKE ?
                 ORDER BY c.name ASC";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$keyword, $keyword, $keyword, $keyword]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Format the results to include model name
            foreach ($results as &$car) {
                if (!empty($car['model_name'])) {
                    $car['full_name'] = $car['model_name'] . ' ' . $car['name'];
                } else {
                    $car['full_name'] = $car['name'];
                }
            }
            
            return $results;
        } catch (PDOException $e) {
            return [];
        }
    }
}
