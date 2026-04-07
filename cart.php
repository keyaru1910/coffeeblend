<?php 
require_once 'config/config.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Xử lý thêm vào giỏ hàng
if ($action == 'add' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $qty = isset($_GET['qty']) ? intval($_GET['qty']) : 1;
    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $qty;
    } else {
        $_SESSION['cart'][$id] = $qty;
    }
    header("Location: cart.php");
    exit();
}

// Xử lý cập nhật số lượng
if ($action == 'update' && isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $id = intval($id);
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
    header("Location: cart.php");
    exit();
}

// Xử lý xóa sản phẩm
if ($action == 'remove' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Xử lý làm trống giỏ hàng
if ($action == 'clear') {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit();
}

// Lấy thông tin sản phẩm trong giỏ hàng
$cart_products = [];
$total_amount = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE product_id IN ($ids)");
    while ($row = $stmt->fetch()) {
        $id = $row['product_id'];
        $qty = $_SESSION['cart'][$id];
        $subtotal = $row['price'] * $qty;
        $total_amount += $subtotal;
        
        $row['qty'] = $qty;
        $row['subtotal'] = $subtotal;
        $cart_products[] = $row;
    }
}

$page_title = "Giỏ Hàng - Coffee Blend";
include 'includes/header.php'; 
?>

	<!-- END nav -->

	<!-- Phần Tiêu đề Trang (Header Slider) -->
	<section class="home-slider owl-carousel">

		<div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center">

					<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread">Giỏ Hàng</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Giỏ Hàng</span>
						</p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Phần Giỏ hàng (Cart) -->
	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<form action="cart.php?action=update" method="POST">
						<div class="cart-list">
							<table class="table">
								<thead class="thead-primary">
									<tr class="text-center">
										<th>&nbsp;</th>
										<th>&nbsp;</th>
										<th>Sản Phẩm</th>
										<th>Giá</th>
										<th>Số Lượng</th>
										<th>Tổng Cộng</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($cart_products)): ?>
										<?php foreach ($cart_products as $prod): ?>
										<tr class="text-center">
											<td class="product-remove">
												<a href="cart.php?action=remove&id=<?php echo $prod['product_id']; ?>" 
												   onclick="return confirm('Xóa sản phẩm này?')">
													<span class="icon-close"></span>
												</a>
											</td>

											<td class="image-prod">
												<div class="img" style="background-image:url(<?php echo sanitize($prod['image_main']); ?>);"></div>
											</td>

											<td class="product-name">
												<h3><?php echo sanitize($prod['product_name']); ?></h3>
												<p><?php echo sanitize($prod['short_description']); ?></p>
											</td>

											<td class="price"><?php echo format_price($prod['price']); ?></td>

											<td class="quantity">
												<div class="input-group mb-3">
													<input type="number" name="qty[<?php echo $prod['product_id']; ?>]"
														class="form-control" value="<?php echo $prod['qty']; ?>" min="1" max="100">
												</div>
											</td>

											<td class="total"><?php echo format_price($prod['subtotal']); ?></td>
										</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="6" class="py-5">
												<h4>Giỏ hàng của bạn đang trống.</h4>
												<a href="shop.php" class="btn btn-primary mt-3">Quay lại cửa hàng</a>
											</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<?php if (!empty($cart_products)): ?>
							<div class="text-right mt-3 mb-5">
								<button type="submit" class="btn btn-black py-3 px-4">Cập nhật Giỏ hàng</button>
								<a href="cart.php?action=clear" class="btn btn-outline-danger py-3 px-4" 
								   onclick="return confirm('Dọn sạch rác?')">Dọn sạch Giỏ hàng</a>
							</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
			
			<?php if (!empty($cart_products)): ?>
			<div class="row justify-content-end">
				<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
						<p class="d-flex">
							<span>Tạm Tính</span>
							<span><?php echo format_price($total_amount); ?></span>
						</p>
						<p class="d-flex">
							<span>Phí Giao Hàng</span>
							<span>0đ</span>
						</p>
						<hr>
						<p class="d-flex total-price">
							<span>Tổng Cộng</span>
							<span><?php echo format_price($total_amount); ?></span>
						</p>
					</div>
					<p class="text-center">
						<a href="checkout.php" class="btn btn-primary py-3 px-4">Tiến hành Thanh toán</a>
					</p>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Phần Sản phẩm liên quan (Cross-selling) -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Khám Phá</span>
					<h2 class="mb-4">Related products</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="menu-entry">
						<a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
						<div class="text text-center pt-4">
							<h3><a href="#">Cà Phê Capuccino</a></h3>
							<p>Hương vị đậm đà, khó quên</p>
							<p class="price"><span>147.500đ</span></p>
							<p><a href="#" class="btn btn-primary btn-outline-primary">Thêm Vào Giỏ</a></p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="menu-entry">
						<a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
						<div class="text text-center pt-4">
							<h3><a href="#">Cà Phê Capuccino</a></h3>
							<p>Hương vị đậm đà, khó quên</p>
							<p class="price"><span>147.500đ</span></p>
							<p><a href="#" class="btn btn-primary btn-outline-primary">Thêm Vào Giỏ</a></p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="menu-entry">
						<a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
						<div class="text text-center pt-4">
							<h3><a href="#">Cà Phê Capuccino</a></h3>
							<p>Hương vị đậm đà, khó quên</p>
							<p class="price"><span>147.500đ</span></p>
							<p><a href="#" class="btn btn-primary btn-outline-primary">Thêm Vào Giỏ</a></p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="menu-entry">
						<a href="#" class="img" style="background-image: url(images/others/menu-4.jpg);"></a>
						<div class="text text-center pt-4">
							<h3><a href="#">Cà Phê Capuccino</a></h3>
							<p>Hương vị đậm đà, khó quên</p>
							<p class="price"><span>147.500đ</span></p>
							<p><a href="#" class="btn btn-primary btn-outline-primary">Thêm Vào Giỏ</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'includes/footer.php'; ?>






