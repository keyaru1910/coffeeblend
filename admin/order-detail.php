<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$order_id) {
    header("Location: orders.php");
    exit();
}

// Xử lý cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $new_status = sanitize($_POST['order_status']);
    $stmt_update = $pdo->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt_update->execute([$new_status, $order_id]);
    $success = "Cập nhật trạng thái thành công!";
}

// Lấy thông tin đơn hàng
$stmt_order = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt_order->execute([$order_id]);
$order = $stmt_order->fetch();

if (!$order) {
    header("Location: orders.php");
    exit();
}

// Lấy chi tiết đơn hàng
$stmt_details = $pdo->prepare("SELECT * FROM order_details WHERE order_id = ?");
$stmt_details->execute([$order_id]);
$details = $stmt_details->fetchAll();
?>

<!-- Content Header -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Chi tiết Đơn hàng #<?php echo sanitize($order['order_code']); ?></h2>
            <p class="text-muted">Xem thông chi tiết và cập nhật trạng thái đơn hàng.</p>
        </div>
        <a href="orders.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Quay lại</a>
    </div>
</div>

<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<div class="row">
    <!-- Thông tin khách hàng & Trạng thái -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Thông tin Khách hàng</div>
            <div class="card-body">
                <p class="mb-1"><strong>Họ tên:</strong> <?php echo sanitize($order['customer_name']); ?></p>
                <p class="mb-1"><strong>Số điện thoại:</strong> <?php echo sanitize($order['customer_phone']); ?></p>
                <p class="mb-1"><strong>Email:</strong> <?php echo sanitize($order['customer_email'] ?: 'N/A'); ?></p>
                <p class="mb-1"><strong>Địa chỉ:</strong> <?php echo sanitize($order['customer_address']); ?></p>
                <p class="mb-0"><strong>Ghi chú:</strong> <?php echo sanitize($order['note'] ?: 'Không có'); ?></p>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Trạng thái & Thanh toán</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Cập nhật trạng thái</label>
                        <select name="order_status" class="form-select mb-3">
                            <option value="pending" <?php echo ($order['order_status'] == 'pending') ? 'selected' : ''; ?>>Chờ xử lý</option>
                            <option value="confirmed" <?php echo ($order['order_status'] == 'confirmed') ? 'selected' : ''; ?>>Xác nhận</option>
                            <option value="preparing" <?php echo ($order['order_status'] == 'preparing') ? 'selected' : ''; ?>>Đang chuẩn bị</option>
                            <option value="shipping" <?php echo ($order['order_status'] == 'shipping') ? 'selected' : ''; ?>>Đang giao</option>
                            <option value="delivered" <?php echo ($order['order_status'] == 'delivered') ? 'selected' : ''; ?>>Đã giao</option>
                            <option value="cancelled" <?php echo ($order['order_status'] == 'cancelled') ? 'selected' : ''; ?>>Đã hủy</option>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-primary w-100">Lưu thay đổi</button>
                    </div>
                </form>
                <hr>
                <p class="mb-1"><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
                <p class="mb-1"><strong>Phương thức:</strong> <?php echo strtoupper($order['payment_method']); ?></p>
                <p class="mb-0"><strong>Thanh toán:</strong> 
                    <span class="badge <?php echo ($order['payment_status'] == 'paid') ? 'bg-success' : 'bg-warning'; ?>">
                        <?php echo ($order['payment_status'] == 'paid') ? 'Đã thanh toán' : 'Chưa thanh toán'; ?>
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Danh sách Sản phẩm</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end pe-4">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $item): ?>
                            <tr>
                                <td class="ps-4"><?php echo sanitize($item['product_name']); ?></td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-end"><?php echo format_price($item['unit_price']); ?></td>
                                <td class="text-end pe-4 fw-bold"><?php echo format_price($item['subtotal']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Tạm tính:</td>
                                <td class="text-end pe-4 fw-bold"><?php echo format_price($order['subtotal']); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Phí giao hàng:</td>
                                <td class="text-end pe-4 fw-bold"><?php echo format_price($order['shipping_fee']); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold fs-5 text-danger">Tổng cộng:</td>
                                <td class="text-end pe-4 fw-bold fs-5 text-danger"><?php echo format_price($order['total']); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
