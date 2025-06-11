<?php
require_once 'models/Discount.php';
class Discount
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByCode($code)
    {
        $query = "SELECT * FROM vouchers WHERE code = :code LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':code', $code, PDO::PARAM_STR); // Sử dụng bindValue cho PDO
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Sử dụng fetch với PDO
    }

    public function incrementUsage($id)
    {
        $query = "UPDATE vouchers SET used_count = used_count + 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Sử dụng bindValue cho PDO
        $stmt->execute();
    }
}
