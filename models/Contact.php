<?php
require_once __DIR__ . '/../config/Database.php';

class Contact
{
    public $id, $user_id, $name, $email, $message, $status,$created_at;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Tạo liên hệ mới
    public function create($data)
    {
        $sql = "INSERT INTO contacts (user_id, name, email, message) VALUES (:user_id, :name, :email, :message)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'user_id' => $data['user_id'] ?? null,
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message']
        ]);
    }

    // Lấy tất cả liên hệ
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $contacts = [];
        foreach ($data as $row) {
            $contact = new Contact();
            foreach ($row as $key => $value) {
                $contact->$key = $value;
            }
            $contacts[] = $contact;
        }
        return $contacts;
    }
    public function setConfirmed($id)
    {
        $sql = "UPDATE contacts SET status = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}