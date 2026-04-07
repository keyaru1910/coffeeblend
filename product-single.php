<?php 
require_once 'config/config.php';
$page_title = "Chi Tiết Sản Phẩm - Coffee Blend";
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
						<h1 class="mb-3 mt-5 bread">Product Detail</h1>
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span>
							<span>Product
								Detail</span>
						</p>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Chi tiết Sản phẩm -->
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="images/drink/vietnamese_coffee.jpg" class="image-popup"><img src="images/drink/vietnamese_coffee.jpg"
							class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3>Best Seller: Cà Phê Sữa Nóng</h3>
					<p class="price"><span>35.000đ</span></p>
					<p>Tận hưởng hương vị cà phê tuyệt hảo trong không gian yên tĩnh và ấm cúng. It
						is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
					<p>Cà phê không chỉ là một thức uống, đó là một nghệ thuật và là niềm đam mê của chúng tôi. Chúng
						chúng tôi cẩn thận lựa chọn từng hạt cà phê từ những vùng trồng tốt nhất, rang xay tỉ mỉ để giữ
						trọn
						vẹn hương vị nguyên bản. Tại đây, mỗi tách cà phê là một câu chuyện, một lời chào nồng ấm gửi
						đến bạn. Hãy cùng chúng tôi tận hưởng những giây phút thư giãn tuyệt vời nhất.
					</p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">Small</option>
										<option value="">Medium</option>
										<option value="">Large</option>
										<option value="">Extra Large</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="icon-minus"></i>
								</button>
							</span>
							<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1"
								min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
									<i class="icon-plus"></i>
								</button>
							</span>
						</div>
					</div>
					<p><a href="cart.php" class="btn btn-primary py-3 px-5">Thêm Vào Giỏ</a></p>
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
								<a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
									role="tab" aria-controls="v-pills-1" aria-selected="true">Cà phê truyền thống</a>
								<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab"
									aria-controls="v-pills-2" aria-selected="false">Trà </a>
								<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
									aria-controls="v-pills-3" aria-selected="false">Đồ uống đặc biệt</a>
								<a class="nav-link" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab"
									aria-controls="v-pills-4" aria-selected="false">Bánh ngọt</a>
							</div>
						</div>
						<div class="col-md-12 d-flex align-items-center">
							<div class="tab-content ftco-animate" id="v-pills-tabContent">

								<!-- Tab 1: Coffee Classics -->
								<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
									aria-labelledby="v-pills-1-tab">
									<div class="row">
										<!-- Espresso  -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/epressso.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Espresso </a></h3>
													<p>Hương vị đậm đà, tỉnh táo.</p>
													<p class="price"><span>35.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Latte  -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/latte.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Latte </a></h3>
													<p>Sự kết hợp hoàn hảo giữa cà phê và sữa béo ngậy.</p>
													<p class="price"><span>45.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Caramel Macchiato -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Caramel_Macchiato.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Caramel Macchiato</a></h3>
													<p>Ngọt ngào với lớp sốt caramel đặc trưng.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Cold Brew -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Cold_Brew.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Cold Brew</a></h3>
													<p>Cà phê ủ lạnh thanh khiết, ít chua.</p>
													<p class="price"><span>50.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Vietnamese Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/vietnamese_coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Vietnamese Coffee</a></h3>
													<p>Cà phê sữa đá truyền thống đậm đà.</p>
													<p class="price"><span>35.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Mocha Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/mocha_coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Mocha Coffee</a></h3>
													<p>Sự hòa quyện giữa Espresso và sốt Chocolate.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tab 2: Specialty Teas -->
								<div class="tab-pane fade" id="v-pills-2" role="tabpanel"
									aria-labelledby="v-pills-2-tab">
									<div class="row">
										<!-- Peach Orange Lemongrass -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/cam_xả.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Peach Orange Lemongrass Tea</a></h3>
													<p>Trà đào cam sả (món quốc dân).</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Lychee Rose Tea -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/rose_tea.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Lychee Rose Tea</a></h3>
													<p>Trà vải hoa hồng thơm dịu.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Matcha Latte -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Matcha_Latte.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Matcha Latte</a></h3>
													<p>Trà xanh Nhật Bản thượng hạng.</p>
													<p class="price"><span>60.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Earl Grey Milk Tea -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Earl_Grey_Milk_Tea.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Earl Grey Milk Tea</a></h3>
													<p>Trà sữa Bá tước đậm đà.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Strawberry Fruit Tea -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Strawberry_Fruit_Tea.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Strawberry Fruit Tea</a></h3>
													<p>Trà dâu tây tươi mát lạnh.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Oolong Milk Tea -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Oolong_Milk_Tea.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Oolong Milk Tea</a></h3>
													<p>Trà sữa Ôlong thơm lừng trân châu.</p>
													<p class="price"><span>50.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tab 3: Signature Drinks -->
								<div class="tab-pane fade" id="v-pills-3" role="tabpanel"
									aria-labelledby="v-pills-3-tab">
									<div class="row">
										<!-- Signature Egg Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Egg_Coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Signature Egg Coffee</a></h3>
													<p>Cà phê trứng béo ngậy, không tanh.</p>
													<p class="price"><span>65.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Salted Cream Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Salted_Coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Salted Cream Coffee</a></h3>
													<p>Cà phê kem muối đang cực kỳ hot.</p>
													<p class="price"><span>65.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Tropical Fruit Punch -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Tropical_Fruit_Punch.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Tropical Fruit Punch</a></h3>
													<p>Nước ép trái cây nhiệt đới tổng hợp.</p>
													<p class="price"><span>70.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Coconut Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Coconut_Coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Coconut Coffee</a></h3>
													<p>Cà phê cốt dừa béo ngậy đặc sản.</p>
													<p class="price"><span>60.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Bac Xiu Cream -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Bac_Xiu_Cream.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Bac Xiu Cream</a></h3>
													<p>Bạc xỉu với lớp kem sữa mịn màng.</p>
													<p class="price"><span>45.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Avocado Coffee -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/drink/Avocado_Coffee.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Avocado Coffee</a></h3>
													<p>Sự kết hợp lạ miệng giữa bơ và cà phê.</p>
													<p class="price"><span>65.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Tab 4: Pastries & Desserts -->
								<div class="tab-pane fade" id="v-pills-4" role="tabpanel"
									aria-labelledby="v-pills-4-tab">
									<div class="row">
										<!-- Croissant -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/food/Croissant.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Croissant</a></h3>
													<p>Bánh sừng bò giòn tan.</p>
													<p class="price"><span>45.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Tiramisu -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/food/Tiramisu.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Tiramisu</a></h3>
													<p>Bánh quyện vị cà phê và phô mai.</p>
													<p class="price"><span>65.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Red Velvet -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url('images/food/Red Velvet.jpg');">
												</a>
												<div class="text">
													<h3><a href="#">Red Velvet</a></h3>
													<p>Bánh nhung đỏ sang trọng.</p>
													<p class="price"><span>60.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Cheesecake Berry -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/food/Cheesecake_Berry.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Cheesecake Berry</a></h3>
													<p>Bánh phô mai tan chảy cùng quả mọng.</p>
													<p class="price"><span>60.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Macarons Set -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/food/Macarons_Set.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Macarons Set</a></h3>
													<p>Bộ 3 bánh Macaron nhiều màu sắc.</p>
													<p class="price"><span>55.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
										<!-- Chocolate Brownie -->
										<div class="col-md-4 text-center">
											<div class="menu-wrap">
												<a href="#" class="menu-img img mb-4"
													style="background-image: url(images/food/Chocolate_Brownie.jpg);">
												</a>
												<div class="text">
													<h3><a href="#">Chocolate Brownie</a></h3>
													<p>Bánh Brownie socola hạnh nhân.</p>
													<p class="price"><span>50.000đ</span></p>
													<p><a href="#" class="btn btn-primary btn-outline-primary">Đặt
															ngay</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include 'includes/footer.php'; ?>

	<script>
		$(document).ready(function () {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function (e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function (e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>





