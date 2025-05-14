<?php
class Cart
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addToCart($user_id, $car_id, $quantity, $price)
    {
        // Check if the item is already in the cart for this user
        $query = "SELECT id FROM cart_details WHERE user_id = :user_id AND car_id = :car_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':car_id', $car_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Item exists, update the quantity
            $query = "UPDATE cart_details SET quantity = quantity + :quantity WHERE user_id = :user_id AND car_id = :car_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':car_id', $car_id);
            return $stmt->execute();
        } else {
            // Item doesn't exist, insert a new record
            $query = "INSERT INTO cart_details (user_id, car_id, quantity, price) VALUES (:user_id, :car_id, :quantity, :price)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':car_id', $car_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            return $stmt->execute();
        }
    }

    public function updateQuantity($user_id, $car_id, $quantity)
    {
        $query = "UPDATE cart_details SET quantity = :quantity WHERE user_id = :user_id AND car_id = :car_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':car_id', $car_id);
        return $stmt->execute();
    }
    public function getCartTotal($user_id)
    {
        $query = "SELECT SUM(quantity * price) AS total 
              FROM cart_details 
              WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }


    public function removeProduct($user_id, $car_id)
    {
        $query = "DELETE FROM cart_details WHERE user_id = :user_id AND car_id = :car_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':car_id', $car_id);
        return $stmt->execute();
    }

    public function getCartItems($user_id)
    {
        $query = "SELECT cd.*, c.name, c.price, c.image_url 
                  FROM cart_details cd
                  JOIN cars c ON cd.car_id = c.id
                  WHERE cd.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCart($user_id)
    {
        $query = "DELETE FROM cart_details WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
