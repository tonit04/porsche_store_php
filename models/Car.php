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
    public function countRows()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM cars");
        return $stmt->fetchColumn();
    }
    public function countModels()
    {
        $stmt = $this->conn->query("SELECT COUNT(DISTINCT model_id) FROM cars");
        return $stmt->fetchColumn();
    }
    // Đếm tổng số xe
    public function countCars()
    {
        $stmt = $this->conn->query("SELECT sum(stock) FROM cars WHERE status = 'Active'");
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

    public function getFilteredAndPaginated($filters, $limit, $offset) 
    {
        $sql = "SELECT c.*, m.name as model_name 
                FROM cars c
                LEFT JOIN models m ON c.model_id = m.id
                WHERE 1=1";
        $params = [];

        // Search by name
        if (!empty($filters['search'])) {
            $sql .= " AND (c.name LIKE :search OR m.name LIKE :search)";
            $params[':search'] = "%{$filters['search']}%";
        }

        // Filter by price range
        if (!empty($filters['min_price'])) {
            $sql .= " AND c.price >= :min_price";
            $params[':min_price'] = $filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $sql .= " AND c.price <= :max_price";
            $params[':max_price'] = $filters['max_price'];
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $sql .= " AND m.category_id = :category_id";
            $params[':category_id'] = $filters['category_id'];
        }

        // Sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $sql .= " ORDER BY c.price ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY c.price DESC";
                    break;
                case 'name_asc':
                    $sql .= " ORDER BY c.name ASC";
                    break;
                case 'name_desc':
                    $sql .= " ORDER BY c.name DESC";
                    break;
                default:
                    $sql .= " ORDER BY c.id DESC";
            }
        } else {
            $sql .= " ORDER BY c.id DESC";
        }

        $sql .= " LIMIT :limit OFFSET :offset";
        $params[':limit'] = (int)$limit;
        $params[':offset'] = (int)$offset;

        $stmt = $this->conn->prepare($sql);
        
        // Bind tất cả params cùng một lúc
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $stmt->execute();
        
        $cars = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $car = new Car();
            foreach ($row as $key => $value) {
                if (property_exists($car, $key)) {
                    $car->$key = $value;
                }
            }
            // Thêm tên model
            if (!is_object($car->model)) {
                $car->model = new stdClass();
            }
            $car->model->name = $row['model_name'];
            $cars[] = $car;
        }
        
        return $cars;
    }

    // Method to get filtered and paginated cars
    public function getFilteredCars($categoryId = null, $sortBy = 'name_asc', $minPrice = null, $maxPrice = null, $year = null, $color = null, $engine = null, $limit = 4, $offset = 0)
{
    $sql = "SELECT c.*, m.name as model_name
            FROM cars c
            LEFT JOIN models m ON c.model_id = m.id
            WHERE 1=1";
    $queryParams = [];

    if (!empty($categoryId)) {
        $sql .= " AND m.category_id = :category_id";
        $queryParams[':category_id'] = $categoryId;
    }

    if (!empty($minPrice)) {
        $sql .= " AND c.price >= :min_price";
        $queryParams[':min_price'] = $minPrice;
    }

    if (!empty($maxPrice)) {
        $sql .= " AND c.price <= :max_price";
        $queryParams[':max_price'] = $maxPrice;
    }

    if (!empty($year)) {
        $sql .= " AND c.year = :year";
        $queryParams[':year'] = $year;
    }

    if (!empty($color)) {
        $sql .= " AND c.color LIKE :color";
        $queryParams[':color'] = '%' . $color . '%';
    }

    if (!empty($engine)) {
        $sql .= " AND c.engine LIKE :engine";
        $queryParams[':engine'] = '%' . $engine . '%';
    }

    // Sửa lại điều kiện sắp xếp
    switch ($sortBy) {
        case 'name_asc':
            $sql .= " ORDER BY c.name ASC";
            break;
        case 'name_desc':
            $sql .= " ORDER BY c.name DESC";
            break;
        case 'price_asc':
            $sql .= " ORDER BY CAST(c.price AS DECIMAL) ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY CAST(c.price AS DECIMAL) DESC";
            break;
        default:
            $sql .= " ORDER BY c.name ASC";
            break;
    }


        // Directly concatenate LIMIT and OFFSET after casting to int
        $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

        $stmt = $this->conn->prepare($sql);

        // Bind parameters (excluding LIMIT and OFFSET)
        foreach ($queryParams as $key => $value) {
            if ($key === ':category_id' || $key === ':year') {
                $stmt->bindValue($key, $value, PDO::PARAM_INT);
            } else if (strpos($key, 'price') !== false) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            } else {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
        }

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
            // Assign model name if available from JOIN
            if (isset($data['model_name'])) {
                if (!is_object($car->model)) {
                    $car->model = new stdClass();
                }
                $car->model->name = $data['model_name'];
            }
            $cars[] = $car;
        }
        return $cars;
    }

    // Method to count filtered cars
    public function countFilteredCars($categoryId = null, $minPrice = null, $maxPrice = null, $year = null, $color = null, $engine = null)
    {
        $sql = "SELECT COUNT(c.id)
                FROM cars c
                LEFT JOIN models m ON c.model_id = m.id
                WHERE 1=1";
        $queryParams = [];

        if ($categoryId !== null) {
            $sql .= " AND m.category_id = :category_id";
            $queryParams[':category_id'] = $categoryId;
        }

        if ($minPrice !== null && is_numeric($minPrice)) {
            $sql .= " AND c.price >= :min_price";
            $queryParams[':min_price'] = $minPrice;
        }

        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $sql .= " AND c.price <= :max_price";
            $queryParams[':max_price'] = $maxPrice;
        }

        if ($year !== null && $year !== '') {
            $sql .= " AND c.year = :year";
            $queryParams[':year'] = $year;
        }

        if ($color !== null && $color !== '') {
            $sql .= " AND c.color LIKE :color";
            $queryParams[':color'] = '%' . $color . '%';
        }

        if ($engine !== null && $engine !== '') {
            $sql .= " AND c.engine LIKE :engine";
            $queryParams[':engine'] = '%' . $engine . '%';
        }

        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        foreach ($queryParams as $key => $value) {
            if ($key === ':category_id' || $key === ':year') {
                $stmt->bindValue($key, $value, PDO::PARAM_INT);
            } else if (strpos($key, 'price') !== false) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            } else {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getUniqueColors()
    {
        $sql = "SELECT DISTINCT color FROM cars ORDER BY color ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getUniqueEngines()
    {
        $sql = "SELECT DISTINCT engine FROM cars ORDER BY engine ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

}
