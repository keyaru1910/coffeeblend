<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>
<!-- Content Header -->
<?php
// Thống kê số liệu
$revenue = $pdo->query("SELECT SUM(total) FROM orders WHERE order_status = 'delivered'")->fetchColumn() ?: 0;
$new_orders = $pdo->query("SELECT COUNT(*) FROM orders WHERE order_status = 'pending'")->fetchColumn();
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn();

// Lấy 5 đơn đặt hàng gần đây nhất
$stmt_recent = $pdo->query("SELECT * FROM orders ORDER BY order_id DESC LIMIT 5");
$recent_orders = $stmt_recent->fetchAll();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0">Tổng quan hệ thống</h2>
        <p class="text-muted">Thống kê dữ liệu cửa hàng cà phê hôm nay.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white h-100 p-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Tổng Doanh Thu</h6>
                        <h3 class="mb-0 fw-bold"><?php echo format_price($revenue); ?></h3>
                    </div>
                    <div class="fs-1 opacity-50"><i class="fas fa-dollar-sign"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white h-100 p-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Đơn Hàng Mới</h6>
                        <h3 class="mb-0 fw-bold"><?php echo $new_orders; ?></h3>
                    </div>
                    <div class="fs-1 opacity-50"><i class="fas fa-shopping-bag"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark h-100 p-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Sản Phẩm</h6>
                        <h3 class="mb-0 fw-bold"><?php echo $total_products; ?></h3>
                    </div>
                    <div class="fs-1 opacity-50"><i class="fas fa-coffee"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white h-100 p-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Khách Hàng</h6>
                        <h3 class="mb-0 fw-bold"><?php echo $total_users; ?></h3>
                    </div>
                    <div class="fs-1 opacity-50"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-bottom">
        <h5 class="mb-0 fw-bold text-dark">Đơn hàng gần đây</h5>
        <a href="orders.php" class="btn btn-sm btn-outline-primary px-3 rounded-pill">Xem tất cả</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng cộng</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recent_orders)): ?>
                        <tr><td colspan="6" class="text-center py-4">Chưa có đơn hàng nào hôm nay.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recent_orders as $order): 
                            $status_badge = 'bg-warning text-dark';
                            $status_text = 'Chờ xử lý';
                            switch($order['order_status']) {
                                case 'confirmed': $status_badge = 'bg-info text-white'; $status_text = 'Đã xác nhận'; break;
                                case 'preparing': $status_badge = 'bg-primary text-white'; $status_text = 'Đang chuẩn bị'; break;
                                case 'shipping': $status_badge = 'bg-info'; $status_text = 'Đang giao'; break;
                                case 'delivered': $status_badge = 'bg-success text-white'; $status_text = 'Đã giao'; break;
                                case 'cancelled': $status_badge = 'bg-danger text-white'; $status_text = 'Đã hủy'; break;
                            }
                        ?>
                        <tr>
                            <td class="ps-4 fw-bold text-primary">#<?php echo sanitize($order['order_code']); ?></td>
                            <td><?php echo sanitize($order['customer_name']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                            <td class="text-danger fw-bold"><?php echo format_price($order['total']); ?></td>
                            <td><span class="badge <?php echo $status_badge; ?> rounded-pill px-3"><?php echo $status_text; ?></span></td>
                            <td class="text-center">
                                <a href="order-detail.php?id=<?php echo $order['order_id']; ?>" class="btn btn-sm btn-info text-white rounded-circle p-2" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
