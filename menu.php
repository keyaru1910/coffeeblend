<?php 
require_once 'config/config.php';
$page_title = "Thực Đơn - Coffee Blend";
include 'includes/header.php'; 

// Lấy danh sách danh mục (Categories)
$stmt_cats = $pdo->prepare("SELECT * FROM categories WHERE status = 1 ORDER BY display_order ASC");
$stmt_cats->execute();
$categories = $stmt_cats->fetchAll();

// Lấy tất cả sản phẩm đang hoạt động (Products)
$stmt_prods = $pdo->prepare("SELECT p.*, c.category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.status = 1");
$stmt_prods->execute();
$all_products = $stmt_prods->fetchAll();

// Phân loại sản phẩm theo category_id để dễ truy xuất
$products_by_cat = [];
foreach ($all_products as $product) {
    $products_by_cat[$product['category_id']][] = $product;
}
?>

	<!-- END nav -->

	<!-- Phần Tiêu đề Trang (Header Slider) -->
	<section class="home-slider owl-carousel">

		<div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center">

					<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread">Thực Đơn Của Chúng Tôi</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Thực
								Đơn</span>
						</p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Phần Thông tin Liên hệ nhanh và Gợi ý Đặt bàn -->
	<section class="ftco-intro">
		<div class="container-wrap">
			<div class="wrap d-md-flex align-items-xl-end">
				<div class="info">
					<div class="row no-gutters">
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-phone"></span></div>
							<div class="text">
								<h3>
									0796470522</h3>
								<p>Hương vị đậm đà, khó quên.</p>
							</div>
						</div>
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-my_location"></span></div>
							<div class="text">
								<h3>Thanh Trì Hà Nội</h3>
								<p> 60 QL1A, Văn Binh, Thường Tín, Hà Nội, Việt Nam</p>
							</div>
						</div>
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-clock-o"></span></div>
							<div class="text">
								<h3>Mở cửa Thứ 2 - Thứ 6</h3>
								<p>6:00am - 11:00pm</p>
							</div>
						</div>
					</div>
				</div>
				<div class="book p-4">
					<h3>Đặt Bàn</h3>
					<form action="#" class="appointment-form">
						<div class="d-md-flex">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Tên">
							</div>
							<div class="form-group ml-md-4">
								<input type="text" class="form-control" placeholder="Họ">
							</div>
						</div>
						<div class="d-md-flex">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" class="form-control appointment_date" placeholder="Ngày">
								</div>
							</div>
							<div class="form-group ml-md-4">
								<div class="input-wrap">
									<div class="icon"><span class="ion-ios-clock"></span></div>
									<input type="text" class="form-control appointment_time" placeholder="Thời gian">
								</div>
							</div>
							<div class="form-group ml-md-4">
								<input type="text" class="form-control" placeholder="Số điện thoại">
							</div>
						</div>
						<div class="d-md-flex">
							<div class="form-group">
								<textarea name="" id="" cols="30" rows="2" class="form-control"
									placeholder="Tin nhắn"></textarea>
							</div>
							<div class="form-group ml-md-4">
								<input type="submit" value="Đặt Bàn" class="btn btn-white py-3 px-4">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Bảng giá Thực đơn - 4 nhóm đồ uống -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Thực Đơn</span>
					<h2 class="mb-4">Các Loại Đồ Uống</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, pha chế tỉ mỉ mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row">
				<?php if (!empty($categories)): ?>
				<?php 
				$count_row = 0; 
				foreach ($categories as $cat): 
					if ($count_row >= 4) break; 
					$cat_id = $cat['category_id'];
					$cat_products = isset($products_by_cat[$cat_id]) ? array_slice($products_by_cat[$cat_id], 0, 6) : [];
					if (empty($cat_products)) continue;
				?>
				<div class="col-md-6 mb-5 pb-3">
					<h3 class="mb-5 heading-pricing ftco-animate"><?php echo sanitize($cat['category_name']); ?></h3>
					<?php foreach ($cat_products as $prod): ?>
					<div class="pricing-entry d-flex ftco-animate">
						<div class="img" style="background-image: url('<?php echo BASE_URL . sanitize($prod['image_main']); ?>');">
						</div>
						<div class="desc pl-3">
							<div class="d-flex text align-items-center">
								<h3><span><?php echo sanitize($prod['product_name']); ?></span></h3>
								<span class="price"><?php echo format_price($prod['price']); ?></span>
							</div>
							<div class="d-block">
								<p><?php echo sanitize($prod['short_description']); ?></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php 
					$count_row++;
				endforeach; 
				?>
				<?php endif; ?>
			</div>

		</div>
	</section>

	<!-- Phần Tương tác menu chi tiết theo Tab (Coffee, Trà, Signature, Bánh) -->
	<section class="ftco-menu mb-5 pb-5">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Khám Phá</span>
					<h2 class="mb-4">Thực Đơn Đồ Uống</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row d-md-flex">
				<div class="col-lg-12 ftco-animate p-md-5">
					<div class="row">
						<div class="col-md-12 nav-link-wrap mb-5">
							<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab"
								role="tablist" aria-orientation="vertical">
								<?php foreach ($categories as $index => $cat): ?>
								<a class="nav-link <?php echo ($index == 0) ? 'active' : ''; ?>" 
								   id="v-pills-<?php echo $cat['category_id']; ?>-tab" 
								   data-toggle="pill" 
								   href="#v-pills-<?php echo $cat['category_id']; ?>" 
								   role="tab" 
								   aria-controls="v-pills-<?php echo $cat['category_id']; ?>" 
								   aria-selected="<?php echo ($index == 0) ? 'true' : 'false'; ?>">
									<?php echo sanitize($cat['category_name']); ?>
								</a>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-12 d-flex align-items-center">
							<div class="tab-content ftco-animate" id="v-pills-tabContent">
								<?php foreach ($categories as $index => $cat): ?>
								<?php 
									$cat_id = $cat['category_id'];
									$cat_products = isset($products_by_cat[$cat_id]) ? $products_by_cat[$cat_id] : [];
								?>
								<div class="tab-pane fade <?php echo ($index == 0) ? 'show active' : ''; ?>" 
									 id="v-pills-<?php echo $cat_id; ?>" 
									 role="tabpanel" 
									 aria-labelledby="v-pills-<?php echo $cat_id; ?>-tab">
									<div class="row">
										<?php if (empty($cat_products)): ?>
											<div class="col-md-12 text-center">
												<p>Hiện chưa có sản phẩm nào trong danh mục này.</p>
											</div>
										<?php else: ?>
											<?php foreach ($cat_products as $prod): ?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="product-single.php?id=<?php echo $prod['product_id']; ?>" 
													   class="menu-img img mb-4"
													   style="background-image: url('<?php echo BASE_URL . sanitize($prod['image_main']); ?>');">
													</a>
													<div class="text">
														<h3><a href="product-single.php?id=<?php echo $prod['product_id']; ?>">
															<?php echo sanitize($prod['product_name']); ?></a>
														</h3>
														<p><?php echo sanitize($prod['short_description']); ?></p>
														<p class="price"><span><?php echo format_price($prod['price']); ?></span></p>
														<p>
															<a href="cart.php?action=add&id=<?php echo $prod['product_id']; ?>" 
															   class="btn btn-primary btn-outline-primary">Đặt ngay</a>
														</p>
													</div>
												</div>
											</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'includes/footer.php'; ?>




