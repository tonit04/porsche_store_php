<?php
require_once __DIR__ . '/../../includes/header.php';
?>

<body>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); // Hủy session sau khi hiển thị 
        ?>
    <?php endif; ?>



    <div class="container-fluid py-5"></div>
    <div class="container-fluid py-5">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Thông Tin Cá Nhân</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text"><strong>Họ và Tên:</strong> <?php echo htmlspecialchars($user_data->full_name ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user_data->email ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Số Điện Thoại:</strong> <?php echo htmlspecialchars($user_data->phone ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($user_data->address ?? 'N/A'); ?></p>
                    <a href="<?php echo BASE_URL; ?>index.php?controller=User&action=changePassword" class="btn btn-primary">Đổi Mật Khẩu</a>
                    <a href="<?php echo BASE_URL; ?>index.php?controller=User&action=editProfile" class="btn btn-success">Cập Nhật Thông Tin</a>
                </div>
            </div>

            <h2 class="text-center mb-4">Đơn Hàng Của Bạn</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($user_orders)): ?>
                                    <?php foreach ($user_orders as $order): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($order['order_id'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($order['order_date'] ?? 'N/A'))); ?></td>
                                            <td class="<?php
                                                        // Thêm class màu sắc dựa trên trạng thái
                                                        if (isset($order['status'])) {

                                                            echo 'text-success'; // Trạng thái khác

                                                        }
                                                        ?>">
                                                <?php
                                                if ($order['status'] == 'Pending')
                                                    echo htmlspecialchars('Đã xác nhận' ?? 'N/A');
                                                else
                                                    echo htmlspecialchars('Đã giao' ?? 'N/A');
                                                ?>
                                            </td>
                                            <td><?php echo number_format($order['total_amount'] ?? 0, 0, ',', '.'); ?> VND</td>
                                            <td><?php echo htmlspecialchars($order['delivery_address'] ?? 'N/A'); ?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL; ?>index.php?controller=User&action=Orderdetails&id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                                <?php
                                                // Chỉ hiển thị nút "Hủy" nếu trạng thái là "Đang xử lý" (hoặc trạng thái bạn muốn cho phép hủy)
                                                if (isset($order['status']) && $order['status'] == 'Đang xử lý'): ?>
                                                    <a href="<?php echo BASE_URL; ?>index.php?controller=Order&action=cancel&id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">Hủy</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Bạn chưa có đơn hàng nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-danger border-3 border-danger rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>



    <!-- JavaScript Libraries -->

</body>

</html>
<?php
require_once __DIR__ . '/../../includes/footer.php';
