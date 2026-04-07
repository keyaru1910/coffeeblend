<?php 
require_once 'config/config.php';

$page_title = "Coffee Blend - Trang chủ";
include 'includes/header.php'; 

// Lấy sản phẩm nổi bật / bán chạy (Best Sellers)
$stmt_best = $pdo->prepare("SELECT * FROM products WHERE (best_seller = 1 OR featured = 1) AND status = 1 LIMIT 4");
$stmt_best->execute();
$best_sellers = $stmt_best->fetchAll();

// Lấy sản phẩm theo danh mục cho tab (Đồ uống: ID 1, 2, 3)
$stmt_drinks = $pdo->prepare("SELECT * FROM products WHERE category_id IN (1, 2, 3) AND status = 1 LIMIT 6");
$stmt_drinks->execute();
$drinks = $stmt_drinks->fetchAll();

$stmt_desserts = $pdo->prepare("SELECT * FROM products WHERE category_id = 4 AND status = 1 LIMIT 6");
$stmt_desserts->execute();
$desserts = $stmt_desserts->fetchAll();

// Lấy bài viết Blog mới nhất (3 bài)
$stmt_recent_blog = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3");
$recent_blogs = $stmt_recent_blog->fetchAll();

// Lấy 4 ảnh ngẫu nhiên từ sản phẩm để làm thư viện ảnh (Gallery)
$stmt_gallery = $pdo->query("SELECT image_main FROM products WHERE status = 1 ORDER BY RAND() LIMIT 4");
$gallery_items = $stmt_gallery->fetchAll();

// Lấy thông tin giới thiệu (About) từ Settings
$stmt_about = $pdo->query("SELECT setting_key, setting_value FROM settings WHERE setting_key IN ('site_about_title', 'site_about_description')");
$settings_about = [];
while($row = $stmt_about->fetch()) {
    $settings_about[$row['setting_key']] = $row['setting_value'];
}
$about_title = $settings_about['site_about_title'] ?? 'Câu Chuyện Của Chúng Tôi';
$about_desc = $settings_about['site_about_description'] ?? 'Cà phê không chỉ là một thức uống, đó là một nghệ thuật và là niềm đam mê của chúng tôi. Chúng tôi cẩn thận lựa chọn từng hạt cà phê từ những vùng trồng tốt nhất, rang xay tỉ mỉ để giữ trọn vẹn hương vị nguyên bản.';
?>

	<!-- Phần Trình chiếu ảnh trang chủ (Slider) -->
	<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

					<div class="col-md-8 col-sm-12 text-center ftco-animate">
						<span class="subheading">Chào Mừng</span>
						<h1 class="mb-4">Trải Nghiệm Cà Phê Tuyệt Vời Nhất</h1>
						<p class="mb-4 mb-md-5">Tận hưởng hương vị cà phê tuyệt hảo trong không gian yên tĩnh và ấm
							cúng.</p>
						<p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Đặt Hàng Ngay</a> <a href="#"
								class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Thực Đơn</a></p>
					</div>

				</div>
			</div>
		</div>

		<div class="slider-item" style="background-image: url(images/bg/bg_2.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

					<div class="col-md-8 col-sm-12 text-center ftco-animate">
						<span class="subheading">Chào Mừng</span>
						<h1 class="mb-4">Hương Vị Tuyệt Hảo &amp; Không Gian Đẹp</h1>
						<p class="mb-4 mb-md-5">Tận hưởng hương vị cà phê tuyệt hảo trong không gian yên tĩnh và ấm
							cúng.</p>
						<p>
							<a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Đặt Hàng Ngay</a>
							<a href="menu.php" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Thực
								Đơn</a>
						</p>
					</div>

				</div>
			</div>
		</div>

		<div class="slider-item" style="background-image: url(images/bg/bg_3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

					<div class="col-md-8 col-sm-12 text-center ftco-animate">
						<span class="subheading">Chào Mừng</span>
						<h1 class="mb-4">Thơm Ngon Nóng Hổi Sẵn Sàng Phục Vụ</h1>
						<p class="mb-4 mb-md-5">Tận hưởng hương vị cà phê tuyệt hảo trong không gian yên tĩnh và ấm
							cúng.</p>
						<p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Đặt Hàng Ngay</a> <a href="#"
								class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Thực Đơn</a></p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Phần Thông tin cửa hàng (Địa chỉ, Giờ mở cửa) và Form Đặt bàn -->
	<section class="ftco-intro">
		<div class="container-wrap">
			<div class="wrap d-md-flex align-items-xl-end">
				<div class="info">
					<div class="row no-gutters">
						<div class="col-md-4 d-flex ftco-animate">
							<div class="icon"><span class="icon-phone"></span></div>
							<div class="text">
								<h3>0796470522</h3>
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

	<!-- Phần Giới thiệu Câu chuyện cửa hàng (Our Story) -->
	<section class="ftco-about d-md-flex">
		<div class="one-half img" style="background-image: url(images/bg/about.jpg);"></div>
		<div class="one-half ftco-animate">
			<div class="overlap">
				<div class="heading-section ftco-animate ">
					<span class="subheading">Khám Phá</span>
					<h2 class="mb-4"><?php echo sanitize($about_title); ?></h2>
				</div>
				<div>
					<p><?php echo sanitize($about_desc); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Dịch vụ nổi bật (Giao hàng, Chất lượng cafe...) -->
	<section class="ftco-section ftco-services">
		<div class="container">
			<div class="row">
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5">
							<span class="flaticon-choices"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Dễ Dàng Đặt Món</h3>
							<p>Chất lượng dịch vụ hoàn hảo mang đến cho bạn trải nghiệm tuyệt vời nhất.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5">
							<span class="flaticon-delivery-truck"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Giao Hàng Nhanh Chóng</h3>
							<p>Chất lượng dịch vụ hoàn hảo mang đến cho bạn trải nghiệm tuyệt vời nhất.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="media d-block text-center block-6 services">
						<div class="icon d-flex justify-content-center align-items-center mb-5">
							<span class="flaticon-coffee-bean"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Cà Phê Chất Lượng</h3>
							<p>Chất lượng dịch vụ hoàn hảo mang đến cho bạn trải nghiệm tuyệt vời nhất.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Giới thiệu Thực đơn cơ bản (Our Menu) -->
	<section class="ftco-section">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 pr-md-5">
					<div class="heading-section text-md-right ftco-animate">
						<span class="subheading">Khám Phá</span>
						<h2 class="mb-4">Thực Đơn Của Chúng Tôi</h2>
						<p class="mb-4">Được chắt lọc từ những hạt cà phê hảo hạng nhất, mang đến cho bạn trải nghiệm
							tuyệt vời.</p>
						<p><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">Xem Toàn Bộ Thực Đơn</a>
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<div class="menu-entry">
								<a href="#" class="img" style="background-image: url(images/drink/americano.jpg);"></a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="menu-entry mt-lg-4">
								<a href="#" class="img" style="background-image: url(images/drink/cappuchino.jpg);"></a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="menu-entry">
								<a href="#" class="img"
									style="background-image: url(images/drink/mocha_coffee.jpg);"></a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="menu-entry mt-lg-4">
								<a href="#" class="img" style="background-image: url(images/drink/latte.jpg);"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Thống kê số lượng (Khách hàng, Nhân viên, Giải thưởng...) -->
	<section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(images/bg/bg_2.jpg);"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<div class="icon"><span class="flaticon-coffee-cup"></span></div>
									<strong class="number" data-number="100">0</strong>
									<span>Chi Nhánh</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<div class="icon"><span class="flaticon-coffee-cup"></span></div>
									<strong class="number" data-number="85">0</strong>
									<span>Giải Thưởng</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<div class="icon"><span class="flaticon-coffee-cup"></span></div>
									<strong class="number" data-number="10567">0</strong>
									<span>Khách Hàng Hài Lòng</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<div class="icon"><span class="flaticon-coffee-cup"></span></div>
									<strong class="number" data-number="900">0</strong>
									<span>Nhân Viên</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Các sản phẩm bán chạy nhất (Best Coffee Sellers) -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Khám Phá</span>
					<h2 class="mb-4">Cà Phê Bán Chạy Nhất</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row">
				<?php if (!empty($best_sellers)): ?>
					<?php foreach ($best_sellers as $prod): ?>
					<div class="col-md-3">
						<div class="menu-entry">
							<a href="product-single.php?id=<?php echo $prod['product_id']; ?>" 
							   class="img" 
							   style="background-image: url('<?php echo sanitize($prod['image_main']); ?>');"></a>
							<div class="text text-center pt-4">
								<h3><a href="product-single.php?id=<?php echo $prod['product_id']; ?>">
									<?php echo sanitize($prod['product_name']); ?></a>
								</h3>
								<p><?php echo sanitize($prod['short_description']); ?></p>
								<p class="price"><span><?php echo format_price($prod['price']); ?></span></p>
								<p>
									<a href="cart.php?action=add&id=<?php echo $prod['product_id']; ?>" 
									   class="btn btn-primary btn-outline-primary">Thêm Vào Giỏ</a>
								</p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-md-12 text-center">
						<p>Hiện đang cập nhật sản phẩm bán chạy.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Phần Thư viện hình ảnh (Gallery) -->
	<section class="ftco-gallery">
		<div class="container-wrap">
			<div class="row no-gutters">
				<?php foreach($gallery_items as $item): ?>
				<div class="col-md-3 ftco-animate">
					<a href="shop.php" class="gallery img d-flex align-items-center"
						style="background-image: url('<?php echo sanitize($item['image_main']); ?>');">
						<div class="icon mb-4 d-flex align-items-center justify-content-center">
							<span class="icon-search"></span>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Phần Hiển thị Sản phẩm chi tiết chia theo danh mục (Món ăn, Đồ uống, Tráng miệng) -->
	<section class="ftco-menu">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Khám Phá</span>
					<h2 class="mb-4">Sản Phẩm Của Chúng Tôi</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row d-md-flex">
				<div class="col-lg-12 ftco-animate p-md-5">
					<div class="row">
						<div class="col-md-12 nav-link-wrap mb-5">
							<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab"
								role="tablist" aria-orientation="vertical">
								<a class="nav-link active" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
									role="tab" aria-controls="v-pills-2" aria-selected="true">Đồ Uống</a>

								<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
									aria-controls="v-pills-3" aria-selected="false">Tráng Miệng</a>
							</div>
						</div>
						<div class="col-md-12 d-flex align-items-center">

							<div class="tab-content ftco-animate" id="v-pills-tabContent">
								<!-- Tab 1: Đồ Uống -->
								<div class="tab-pane fade show active" id="v-pills-2" role="tabpanel"
									aria-labelledby="v-pills-2-tab">
									<div class="row">
										<?php if (!empty($drinks)): ?>
											<?php foreach ($drinks as $prod): ?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="product-single.php?id=<?php echo $prod['product_id']; ?>" 
													   class="menu-img img mb-4"
													   style="background-image: url('<?php echo sanitize($prod['image_main']); ?>');"></a>
													<div class="text">
														<h3><a href="product-single.php?id=<?php echo $prod['product_id']; ?>">
															<?php echo sanitize($prod['product_name']); ?></a>
														</h3>
														<p><?php echo sanitize($prod['short_description']); ?></p>
														<p class="price"><span><?php echo format_price($prod['price']); ?></span></p>
														<p><a href="cart.php?action=add&id=<?php echo $prod['product_id']; ?>" 
															  class="btn btn-primary btn-outline-primary">Thêm vào giỏ</a></p>
													</div>
												</div>
											</div>
											<?php endforeach; ?>
										<?php else: ?>
											<p class="text-center w-100">Hiện đang cập nhật đồ uống.</p>
										<?php endif; ?>
									</div>
								</div>

								<!-- Tab 2: Tráng Miệng -->
								<div class="tab-pane fade" id="v-pills-3" role="tabpanel"
									aria-labelledby="v-pills-3-tab">
									<div class="row">
										<?php if (!empty($desserts)): ?>
											<?php foreach ($desserts as $prod): ?>
											<div class="col-md-4 text-center">
												<div class="menu-wrap">
													<a href="product-single.php?id=<?php echo $prod['product_id']; ?>" 
													   class="menu-img img mb-4"
													   style="background-image: url('<?php echo sanitize($prod['image_main']); ?>');"></a>
													<div class="text">
														<h3><a href="product-single.php?id=<?php echo $prod['product_id']; ?>">
															<?php echo sanitize($prod['product_name']); ?></a>
														</h3>
														<p><?php echo sanitize($prod['short_description']); ?></p>
														<p class="price"><span><?php echo format_price($prod['price']); ?></span></p>
														<p><a href="cart.php?action=add&id=<?php echo $prod['product_id']; ?>" 
															  class="btn btn-primary btn-outline-primary">Thêm vào giỏ</a></p>
													</div>
												</div>
											</div>
											<?php endforeach; ?>
										<?php else: ?>
											<p class="text-center w-100">Hiện đang cập nhật món tráng miệng.</p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Cảm nhận của khách hàng (Testimony) -->
	<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/bg/bg_1.jpg);"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Cảm Nhận</span>
					<h2 class="mb-4">Khách Hàng Nói Gì</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
		</div>
		<div class="container-wrap">
			<div class="row d-flex no-gutters">
				<div class="col-lg ftco-animate">
					<div class="testimony">
						<blockquote>
							<p>&ldquo;Tôi thực sự ấn tượng với chất lượng cà phê và bánh ngọt ở đây. Cực kỳ đáng
								thử!&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">
							<div class="image mr-3 align-self-center">
								<img src="images/person/person_1.jpg" alt="">
							</div>
							<div class="name align-self-center">Nguyễn Minh Thư <span class="position">Nhân viên văn
									phòng</span></div>
						</div>
					</div>
				</div>
				<div class="col-lg">
					<div class="testimony overlay">
						<blockquote>
							<p>&ldquo;Không gian rất chill và nhân viên tuyệt vời. Một nơi hoàn hảo để thư giãn và
								thưởng thức cà phê ngon.&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">
							<div class="image mr-3 align-self-center">
								<img src="images/person/person_2.jpg" alt="">
							</div>
							<div class="name align-self-center">Trần Hoàng Nam <span class="position">Freelancer</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg ftco-animate">
					<div class="testimony">
						<blockquote>
							<p>&ldquo;Sự kết hợp hoàn hảo giữa hương vị và không gian. Tuyệt vời!
								&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">
							<div class="image mr-3 align-self-center">
								<img src="images/person/person_3.jpg" alt="">
							</div>
							<div class="name align-self-center">Lê Khánh Linh <span class="position">Sáng tạo nội
									dung</span></div>
						</div>
					</div>
				</div>
				<div class="col-lg">
					<div class="testimony overlay">
						<blockquote>
							<p>&ldquo;Đồ uống đa dạng, giá cả hợp lý, nhân viên vô cùng thân thiện.&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">
							<div class="image mr-3 align-self-center">
								<img src="images/person/person_4.jpg" alt="">
							</div>
							<div class="name align-self-center">Phạm Minh Đức <span class="position">INhiếp ảnh gia tự
									do</span></div>
						</div>
					</div>
				</div>
				<div class="col-lg ftco-animate">
					<div class="testimony">
						<blockquote>
							<p>&ldquo;Sự kết hợp hoàn hảo giữa hương vị và không gian. Tuyệt vời!
								&rdquo;</p>
						</blockquote>
						<div class="author d-flex mt-4">
							<div class="image mr-3 align-self-center">
								<img src="images/person/person_5.jpg" alt="">
							</div>
							<div class="name align-self-center">Đặng Thu Thảo <span class="position">Sinh viên Đại
									học</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Phần Các bài blog / Blog mới nhất -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<h2 class="mb-4">Blog Mới Nhất</h2>
					<p>Tuyển chọn từ nguyên liệu tươi ngon nhất, mang đến hương vị đậm đà khó cưỡng.</p>
				</div>
			</div>
			<div class="row d-flex">
				<?php if (!empty($recent_blogs)): ?>
					<?php foreach ($recent_blogs as $post): 
						$date_formatted = date('d', strtotime($post['published_at'])) . ' Tháng ' . date('m, Y', strtotime($post['published_at']));
					?>
					<div class="col-md-4 d-flex ftco-animate">
						<div class="blog-entry align-self-stretch">
							<a href="blog-single.php?slug=<?php echo $post['slug']; ?>" class="block-20"
								style="background-image: url('<?php echo sanitize($post['featured_image']); ?>');">
							</a>
							<div class="text py-4 d-block">
								<div class="meta">
									<div><a href="#"><?php echo $date_formatted; ?></a></div>
									<div><a href="#">Quản trị viên</a></div>
									<div><a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo $post['comments_count']; ?></a></div>
								</div>
								<h3 class="heading mt-2"><a href="blog-single.php?slug=<?php echo $post['slug']; ?>">
									<?php echo sanitize($post['title']); ?></a>
								</h3>
								<p><?php echo sanitize($post['excerpt']); ?></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-md-12 text-center"><p>Đang cập nhật blog mới nhất.</p></div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Phần Bản đồ hiển thị vị trí và Form đặt bàn nằm cạnh nhau -->
	<section class="ftco-appointment">
		<div class="overlay"></div>
		<div class="container-wrap">
			<div class="row no-gutters d-md-flex align-items-center">
				<div class="col-md-6 d-flex align-self-stretch">
					<div id="map">
						<iframe
							src="https://maps.google.com/maps?q=Tr%C6%B0%E1%BB%9Dng%20Cao%20%C4%91%E1%BA%B3ng%20K%E1%BB%B9%20thu%E1%BA%ADt%20-%20C%C3%B4ng%20ngh%E1%BB%87%20B%C3%A1ch%20Khoa%20(CTECH)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
							width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				<div class="col-md-6 appointment ftco-animate">
					<h3 class="mb-3">Đặt Bàn</h3>
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
								<input type="submit" value="Đặt Bàn" class="btn btn-primary py-3 px-4">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php include 'includes/footer.php'; ?>


