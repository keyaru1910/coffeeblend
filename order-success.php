<?php 
require_once 'config/config.php';

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$order_code = '';

if ($order_id) {
    $stmt = $pdo->prepare("SELECT order_code FROM orders WHERE order_id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch();
    if ($order) {
        $order_code = $order['order_code'];
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

$page_title = "Đặt Hàng Thành Công - Coffee Blend";
include 'includes/header.php'; 
?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center ftco-animate">
                <div class="icon-circle mb-4" style="font-size: 80px; color: #fac564;">
                    <span class="icon-check_circle"></span>
                </div>
                <h2 class="mb-4">Đặt Hàng Thành Công!</h2>
                <p>Cảm ơn bạn đã tin tưởng Coffee Blend. Mã đơn hàng của bạn là <strong>#<?php echo $order_code; ?></strong>.</p>
                <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
                <p class="mt-5">
                    <a href="shop.php" class="btn btn-primary py-3 px-4">Tiếp tục mua sắm</a>
                    <?php if (is_logged_in()): ?>
                        <a href="my-orders.php" class="btn btn-white btn-outline-white py-3 px-4">Xem đơn hàng của tôi</a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
