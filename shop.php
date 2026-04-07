<?php 
require_once 'config/config.php';
$page_title = "Cửa Hàng - Coffee Blend";
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
						<h1 class="mb-3 mt-5 bread">Order Online</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Cửa
								Hàng</span>
						</p>
					</div>

				</div>
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
													   style="background-image: url('<?php echo sanitize($prod['image_main']); ?>');">
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




