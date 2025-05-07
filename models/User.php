<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
    public $id, $username, $password, $email, $full_name, $phone, $address, $role,
    $created_at, $updated_at, $is_verified;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function findByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO users 
            (username, password, email, full_name, phone, address, role, created_at, updated_at, is_verified)
            VALUES (:username, :password, :email, :full_name, :phone, :address, :role, NOW(), NOW(), 0)");
        return $stmt->execute($data);
    }

    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $dataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($dataList as $data) {
            $user = new User();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $users[] = $user;
        }

        return $users;
    }

    public function countUsers()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            return $user;
        }
        return null;
    }
    public function update($id, $data)
    {
        $sql = "UPDATE users SET                     
                    role = :role, is_verified = :is_verified
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'role' => $data['role'],
            'is_verified' => isset($data['is_verified']) ? $data['is_verified'] : 0,
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
