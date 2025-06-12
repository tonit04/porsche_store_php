<?php
// Assuming you have included the Database class and Cart model
require_once 'config/Database.php';
require_once 'models/Cart.php';
require_once 'models/Car.php';

class CartController
{
    private $cart;
    private $db;
    private $carModel;

    public function __construct()
    {
        $this->db = (new Database())->connect();
        $this->cart = new Cart($this->db);
        $this->carModel = new Car();
    }
    private function checkLogin()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=User&action=login"); // Redirect to login page
            exit();
        }
    }

    public function addToCart()
    {
        $this->checkLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Assuming you're sending car_id, quantity, and price via POST
            $user_id = $_SESSION['user_id']; // Get user ID from session
            $car_id = $_POST['car_id'];
            $quantity = (int)$_POST['quantity'];
            $price = $_POST['price']; // It's safer to fetch the price from the database

            // Validate stock quantity
            $car = $this->carModel->findById($car_id);
            if (!$car || $quantity < 1 || $quantity > $car->stock) {
                $_SESSION['add_to_cart_error'] = 'Số lượng đặt vượt quá số lượng tồn kho hoặc không hợp lệ.';
                if (!empty($_SERVER['HTTP_REFERER'])) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                } else {
                    header("Location: index.php?controller=product&action=details&id=" . $car_id); // Fallback
                }
                exit();
            }

            if ($this->cart->addToCart($user_id, $car_id, $quantity, $price)) {
                // Redirect back to the product page or wherever you want
                header("Location: index.php?controller=cart&action=showCart");
                exit();
            } else {
                // Handle error (e.g., display a message)
                echo "Failed to add to cart.";
            }
        }
    }

    public function tang()
    {
        $this->checkLogin();
        $this->updateQuantity(1);
    }

    public function giam()
    {
        $this->checkLogin();
        $this->updateQuantity(-1);
    }

    private function updateQuantity($change)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user_id = $_SESSION['user_id'];
            $car_id = $_GET['carid'];

            // Fetch current quantity
            $cartItems = $this->cart->getCartItems($user_id);
            $currentQuantity = 0;
            foreach ($cartItems as $item) {
                if ($item['car_id'] == $car_id) {
                    $currentQuantity = $item['quantity'];
                    break;
                }
            }

            $newQuantity = max(1, $currentQuantity + $change);

            // Fetch car stock
            $car = $this->carModel->findById($car_id);
            if (!$car) {
                $_SESSION['error'] = "Xe không tồn tại.";
                $this->showCart();
                return;
            }

            // Validate against car stock
            if ($newQuantity > $car->stock) {
                $_SESSION['error'] = "Số lượng không được vượt quá số lượng tồn kho (" . $car->stock . ").";
                $this->showCart();
                return;
            }

            if ($this->cart->updateQuantity($user_id, $car_id, $newQuantity)) {
                $this->showCart(); // Refresh the cart view
            } else {
                $_SESSION['error'] = "Không thể cập nhật số lượng.";
                $this->showCart();
            }
        }
    }

    public function removeProduct()
    {
        $this->checkLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user_id = $_SESSION['user_id'];
            $car_id = $_GET['carid'];

            if ($this->cart->removeProduct($user_id, $car_id)) {
                $this->showCart(); // Refresh the cart view
            } else {
                echo "Failed to remove product.";
            }
        }
    }

    public function showCart()
    {
        $this->checkLogin();
        $user_id = $_SESSION['user_id'];
        $total = $this->cart->getCartTotal($user_id);
        $cartItems = $this->cart->getCartItems($user_id);
        include 'views/Cart/cart.php'; // Load the cart view
    }
}
