<?php 
require_once 'config/config.php';
$page_title = "Đơn Hàng Của Tôi - Coffee Blend";
include 'includes/header.php'; 
?>

<section class="ftco-section mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0 text-white">Đơn Hàng Của Tôi</h2>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Mã ĐH</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Giả lập ID người dùng là 1
                                    $user_id = 1;
                                    try {
                                        $query = "SELECT * FROM orders WHERE user_id = :user_id OR user_id IS NULL ORDER BY order_id DESC";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute(['user_id' => $user_id]);
                                        $orders = $stmt->fetchAll();

                                        if (count($orders) > 0) {
                                            foreach ($orders as $order) {
                                                $status_badge = 'bg-warning text-dark';
                                                $status_text = 'Chờ xử lý';
                                                switch($order['order_status']) {
                                                    case 'confirmed': $status_badge = 'bg-info text-white'; $status_text = 'Đã xác nhận'; break;
                                                    case 'preparing': $status_badge = 'bg-primary text-white'; $status_text = 'Đang chuẩn bị'; break;
                                                    case 'shipping': $status_badge = 'bg-info'; $status_text = 'Đang giao'; break;
                                                    case 'delivered': $status_badge = 'bg-success'; $status_text = 'Đã giao'; break;
                                                    case 'cancelled': $status_badge = 'bg-danger'; $status_text = 'Đã hủy'; break;
                                                }
                                    ?>
                                    <tr>
                                        <td class="ps-4 fw-bold">#<?php echo sanitize($order['order_code']); ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                                        <td class="text-danger fw-bold"><?php echo format_price($order['total']); ?></td>
                                        <td><span class="badge <?php echo $status_badge; ?>"><?php echo $status_text; ?></span></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-info me-1"><i class="fas fa-eye"></i> Xem chi tiết</button>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center py-5'>Bạn chưa có đơn hàng nào.</td></tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "<tr><td colspan='5' class='text-center py-5 text-danger'>Lỗi: " . $e->getMessage() . "</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>


