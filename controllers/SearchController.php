<?php
require_once 'models/Car.php';

class SearchController {
    private $carModel;

    public function __construct() {
        $this->carModel = new Car();
    }

    // Xử lý AJAX suggestions
    public function getSuggestions() {
        if (!isset($_GET['term'])) {
            echo json_encode([]);
            return;
        }

        $term = $_GET['term'];
        $suggestions = $this->carModel->searchSuggestions($term);
        
        header('Content-Type: application/json');
        echo json_encode($suggestions);
    }

    // Xử lý trang kết quả tìm kiếm
    public function results() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $searchResults = $this->carModel->searchCars($keyword);
        
        // Load view
        require_once 'views/search/results.php';
    }
} 