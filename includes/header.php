<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porsche</title> <?php  ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/custom.css">

    <style>
        body { background-color: #f8f9fa;  padding-top: 75px;}
        .footer-dark { background-color: #212529; color: #adb5bd; }
        .footer-dark a { color: #f8f9fa; text-decoration: none; }
        .footer-dark a:hover { color: #dee2e6; text-decoration: underline; }
        .footer-dark h5 { color: #ffffff; margin-bottom: 1rem; }
        .footer-dark .list-unstyled li { margin-bottom: 0.5rem; }
        .navbar-brand img, .footer-dark img { height: 30px; }
        .main-content-area { background-color: #ffffff; min-height: 50vh; padding: 2rem; }
        /* Tùy chỉnh cho ảnh trong dropdown */
        .dropdown-item img {
            width: 50px; 
            height: auto; 
            margin-right: 10px; 
            vertical-align: middle; 
            object-fit: contain; 
        }

        /* Optional: Kích hoạt dropdown bằng hover trên màn hình lớn  */
        @media (min-width: 992px) { 
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0; 
            }
            .navbar .nav-item.dropdown .dropdown-menu:hover {
                 display: block;
                 margin-top: 0;
            }
        }
        /* Làm cho dropdown menu rộng hơn*/
        .dropdown-menu-wide {
             min-width: 250px; 
        }
        .navbar .dropdown-toggle::after {
            display: none; 
        }
    </style>
</head>
<body>

    <!-- ==================== HEADER ==================== -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php"> <?php // Link về trang chủ ?>
                    <strong>PORSCHE</strong> <span style="font-size: 0.7em; vertical-align: super;">VIETNAM</span>
                </a>
                <!-- Nút bật tắt menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Menu điều hướng -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCars" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dòng xe
                            </a>
                            <ul class="dropdown-menu dropdown-menu-wide" aria-labelledby="navbarDropdownCars">
                                
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#"> <?php  ?>
                                        <img src="assets/images/cars/911_carrera_silver_metallic.png" alt="Porsche 911">
                                        <span>Porsche 911</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#"> <?php  ?>
                                        <img src="assets/images/cars/911_carrera_silver_metallic.png" alt="Porsche Taycan">
                                        <span>Porsche Taycan</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#"> <?php  ?>
                                         <img src="assets/images/cars/911_carrera_silver_metallic.png" alt="Porsche Cayenne"> <?php ?>
                                        <span>Porsche Cayenne</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#"> <?php  ?>
                                         <img src="assets/images/cars/911_carrera_silver_metallic.png" alt="Porsche Panamera"> <?php ?>
                                        <span>Porsche Panamera</span>
                                    </a>
                                </li>
                                 <!-- Porsche Macan (Chưa có ảnh, dùng placeholder) -->
                                 <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#"> <?php  ?>
                                         <img src="assets/images/cars/911_carrera_silver_metallic.png" alt="Porsche Macan"> <?php ?>
                                        <span>Porsche Macan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Trải nghiệm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                    <!-- Form tìm kiếm và nút -->
                    <form class="d-flex me-3 mb-2 mb-lg-0" action="search.php" method="get"> <?php  ?>
                        <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm xe..." aria-label="Search">
                    </form>
                    <a href="register-test-drive.php" class="btn btn-danger">Đăng ký lái thử</a> <?php ?>
                </div>
            </div>
        </nav>
        <div>
            
        </div>
    </header>
