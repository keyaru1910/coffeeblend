<?php 
require_once 'config/config.php';
$page_title = "Dịch Vụ - Coffee Blend";
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
            <h1 class="mb-3 mt-5 bread">Dịch Vụ</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Dịch Vụ</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Phần Dịch vụ nổi bật (Our Services) -->
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

<?php include 'includes/footer.php'; ?>




