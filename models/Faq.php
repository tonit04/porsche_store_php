<?php
require_once __DIR__ . '/../config/Database.php';

class Faq
{
    public $id, $question, $answer;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM faqs");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $faqs = [];
        foreach ($data as $row) {
            $faq = new Faq();
            foreach ($row as $key => $value) {
                $faq->$key = $value;
            }
            $faqs[] = $faq;
        }
        return $faqs;
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO faqs (question, answer) VALUES (:question, :answer)");
        return $stmt->execute([
            'question' => $data['question'],
            'answer' => $data['answer']
        ]);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM faqs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $faq = new Faq();
            foreach ($data as $key => $value) {
                $faq->$key = $value;
            }
            return $faq;
        }
        return null;
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE faqs SET question = :question, answer = :answer WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM faqs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
