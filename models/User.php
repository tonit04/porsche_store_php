<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
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
}
