<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>

<!-- Content Header -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Quản lý Đơn hàng</h2>
            <p class="text-muted">Xem và cập nhật trạng thái đơn hàng của khách hàng.</p>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $query = "SELECT * FROM orders ORDER BY order_id DESC";
                        $stmt = $pdo->query($query);
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
                        <td class="ps-4 fw-bold text-primary">#<?php echo sanitize($order['order_code']); ?></td>
                        <td><?php echo sanitize($order['customer_name']); ?></td>
                        <td><?php echo sanitize($order['customer_phone']); ?></td>
                        <td class="text-danger fw-bold"><?php echo format_price($order['total']); ?></td>
                        <td><span class="badge <?php echo $status_badge; ?> rounded-pill px-3"><?php echo $status_text; ?></span></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                        <td class="text-center">
                            <a href="order-detail.php?id=<?php echo $order['order_id']; ?>" class="btn btn-sm btn-info text-white rounded-circle p-2" title="Xem chi tiết" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-eye"></i></a>
                            <button class="btn btn-sm btn-success rounded-circle p-2" title="Xác nhận" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-check"></i></button>
                        </td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4'>Chưa có đơn hàng nào.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='7' class='text-center py-4 text-danger'>Lỗi: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
