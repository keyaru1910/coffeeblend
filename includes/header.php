<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo isset($page_title) ? $page_title : "Coffee Blend"; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/animate.css">

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/magnific-popup.css">

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/aos.css">

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/ionicons.min.css">

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/jquery.timepicker.css">


	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/flaticon.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/icomoon.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
	<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>images/favicon/favicon.png">
</head>

<body>
	<!-- Phần Menu Điều hướng (Navbar) -->
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">Coffee<small>Blend</small></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span>Thực Đơn</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
                    <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                    ?>
					<li class="nav-item <?php if($current_page == 'index.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>index.php" class="nav-link">Trang Chủ</a></li>
					<li class="nav-item <?php if($current_page == 'menu.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>menu.php" class="nav-link">Thực Đơn</a></li>
					<li class="nav-item <?php if($current_page == 'services.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>services.php" class="nav-link">Dịch Vụ</a></li>
					<li class="nav-item <?php if($current_page == 'blog.php' || $current_page == 'blog-single.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>blog.php" class="nav-link">Blog</a></li>
					<li class="nav-item <?php if($current_page == 'about.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>about.php" class="nav-link">Giới Thiệu</a></li>
					<li class="nav-item dropdown <?php if(in_array($current_page, ['shop.php', 'product-single.php', 'cart.php', 'checkout.php'])) echo 'active'; ?>">
						<a class="nav-link dropdown-toggle" href="<?php echo BASE_URL; ?>shop.php" id="dropdown04" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">Cửa Hàng</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="<?php echo BASE_URL; ?>shop.php">Cửa Hàng</a>
							<a class="dropdown-item" href="<?php echo BASE_URL; ?>product-single.php">Chi Tiết Sản Phẩm</a>
							<a class="dropdown-item" href="<?php echo BASE_URL; ?>cart.php">Giỏ Hàng</a>
							<a class="dropdown-item" href="<?php echo BASE_URL; ?>checkout.php">Thanh Toán</a>
						</div>
					</li>
					<li class="nav-item <?php if($current_page == 'contact.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>contact.php" class="nav-link">Liên Hệ</a></li>
					
                    <?php if (is_logged_in()): ?>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="profile.php" id="dropdownAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="oi oi-person"></span> <?php echo sanitize($_SESSION['full_name']); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="<?php echo BASE_URL; ?>profile.php">Thông tin cá nhân</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL; ?>my-orders.php">Đơn hàng của tôi</a>
                                <?php if (is_admin()): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-primary" href="<?php echo BASE_URL; ?>admin/index.php">Quản trị hệ thống</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>logout.php">Đăng xuất</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?php if($current_page == 'login.php' || $current_page == 'register.php') echo 'active'; ?>"><a href="<?php echo BASE_URL; ?>login.php" class="nav-link">Đăng Nhập</a></li>
                    <?php endif; ?>

					<li class="nav-item cart">
						<a href="<?php echo BASE_URL; ?>cart.php" class="nav-link">
							<span class="icon icon-shopping_cart"></span>
							<span class="bag d-flex justify-content-center align-items-center">
								<small><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></small>
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
