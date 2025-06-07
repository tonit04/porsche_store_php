<?php
// views/includes/header.php
if (!defined('BASE_ASSET_URL')) {
    // Mặc định nếu chưa được định nghĩa ở controller
    define('BASE_ASSET_URL', '/assets'); 
}
if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $subfolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    define('BASE_URL', $protocol . $host . $subfolder . '/');
}

// Bắt đầu session nếu chưa được bắt đầu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porsche Việt Nam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo rtrim(BASE_ASSET_URL, '/'); ?>/css/style.css">
    <style>
    /* Thêm padding-top cho body để tạo khoảng trống dưới header fixed-top */
    body {
        padding-top: 100px; /* Điều chỉnh giá trị này cho phù hợp */
    }

    /* CSS cho logo hình tròn được vẽ bằng CSS */
    .porsche-css-logo-circle {
        width: 30px; /* Kích thước logo */
        height: 30px;
        border-radius: 150%; /* Biến thành hình tròn */
        background-color:rgb(0, 0, 0); /* Màu đỏ đặc trưng của Porsche */
        border: 5px solid white; /* Thêm viền  */
        display: flex; /* Để căn giữa nội dung nếu có */
        justify-content: center;
        align-items: center;
        flex-shrink: 0; /* Ngăn không cho logo bị co lại trên màn hình nhỏ */
        /* Bạn có thể thêm chữ P hoặc biểu tượng đơn giản bên trong bằng ::before/::after */
        /* Ví dụ: */
        /* font-weight: bold; */
        /* font-size: 1.2em; */
        /* color: white; */
        /* text-transform: uppercase; */
        /* content: "P"; */
    }

    /* CSS cho logo hình tròn ở footer (nếu bạn muốn kích thước khác) */
    .porsche-css-logo-circle-footer {
        width: 30px; /* Kích thước lớn hơn cho footer */
        height: 30px;
        border-radius: 150%;
        background-color:rgb(0, 0, 0); /* Màu đỏ */
        border: 5px solid white; /* Viền  */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
    }


    /* Đảm bảo text logo cũng trắng trên nền tối, mặc dù navbar-dark có thể xử lý rồi */
    /* Thêm !important nếu cần để ghi đè các style khác */
    .porsche-logo-text, .porsche-logo-subtext {
        color: #fff;
    }

    .ui-autocomplete {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 9999 !important;
    }
    .ui-menu-item {
        padding: 8px;
        border-bottom: 1px solid #eee;
    }
    .ui-menu-item:last-child {
        border-bottom: none;
    }
    .search-suggestion-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .search-suggestion-price {
        color: #d5001c;
        font-size: 0.9em;
        margin-left: 15px;
    }
    /* Custom styles for dark header search input */
    .porsche-header .search-input {
        background-color: rgba(255, 255, 255, 0.1); /* Slightly transparent white for input background */
        color: #fff; /* Text color for input */
        border-color: rgba(255, 255, 255, 0.2); /* Border color for input */
    }
    .porsche-header .search-input::placeholder { /* Placeholder text color */
        color: rgba(255, 255, 255, 0.7);
        opacity: 1; /* Firefox fix */
    }
    .porsche-header .search-input:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }
    </style>
</head>
<body>
    <header class="porsche-header border-bottom fixed-top bg-dark shadow-sm">
        <div class="container-fluid px-md-4 px-lg-5">
            <nav class="navbar navbar-dark navbar-expand-lg py-3">
                <!-- Thay thế img bằng div CSS-drawn -->
                <a class="navbar-brand porsche-logo-container d-flex align-items-center" href="<?php echo rtrim(BASE_URL, '/'); ?>">
                    <div class="porsche-css-logo-circle me-2"></div>
                    <span class="porsche-logo-text">
                        PORSCHE
                        <small class="porsche-logo-subtext">VIETNAM</small>
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain" aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavMain">
                    <ul class="navbar-nav porsche-main-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="<?php echo rtrim(BASE_URL, '/'); ?>">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>#car-models">Dòng xe</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo rtrim(BASE_URL, '/'); ?>/index.php?controller=home&action=about">Giới thiệu</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>#Lien-he">Liên hệ</a></li>
                    </ul>
                    <div class="d-flex align-items-center porsche-header-actions">
                        <form class="d-flex me-3" role="search" action="<?php echo rtrim(BASE_URL, '/'); ?>/index.php" method="GET">
                            <input type="hidden" name="controller" value="Search">
                            <input type="hidden" name="action" value="results">
                            <input class="form-control search-input" name="keyword" type="search" 
                                   placeholder="Tìm kiếm xe..." aria-label="Search" 
                                   id="searchInput" autocomplete="off">
                        </form>
                        <div class="d-flex gap-2">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <!-- Chưa đăng nhập -->
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/index.php?controller=User&action=register" class="btn btn-danger btn-sm text-nowrap">
                                    <i class="fas fa-user-plus me-1"></i> Đăng ký
                                </a>
                                <a href="<?php echo rtrim(BASE_URL, '/'); ?>/index.php?controller=User&action=login" class="btn btn-outline-light btn-sm text-nowrap">
                                    <i class="fas fa-sign-in-alt me-1"></i> Đăng nhập
                                </a>
                            <?php else: ?>
                                <!-- Đã đăng nhập -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Tài khoản'); ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                                        <li><a class="dropdown-item" href="<?php echo rtrim(BASE_URL, '/'); ?>index.php?controller=User&action=profile">
                                            <i class="fas fa-user-circle me-2"></i> Thông tin tài khoản
                                        </a></li>
                                        <li><a class="dropdown-item" href="<?php echo rtrim(BASE_URL, '/'); ?>index.php?controller=Order&action=history">
                                            <i class="fas fa-history me-2"></i> Lịch sử đơn hàng
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="<?php echo rtrim(BASE_URL, '/'); ?>index.php?controller=User&action=logout">
                                            <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                        </a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Nội dung chính sẽ được chèn bởi home.php -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#searchInput").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo rtrim(BASE_URL, '/'); ?>/index.php",
                    dataType: "json",
                    data: {
                        controller: "Search",
                        action: "getSuggestions",
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $(this).val(ui.item.value);
                $(this).closest('form').submit();
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div class='search-suggestion-item'>" +
                        "<span>" + item.label + "</span>" +
                        "<span class='search-suggestion-price'>" + item.price + "</span>" +
                        "</div>")
                .appendTo(ul);
        };
    });
    </script>
</body>
</html>