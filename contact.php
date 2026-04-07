<?php 
require_once 'config/config.php';
$page_title = "Liên Hệ - Coffee Blend";
include 'includes/header.php'; 
?>

  <!-- Phần Tiêu đề Trang (Header Slider) -->
  <section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Contact Us</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Liên Hệ</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Phần Thông tin Liên hệ và Form gửi tin nhắn -->
  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
        <div class="col-md-4 contact-info ftco-animate">
          <div class="row">
            <div class="col-md-12 mb-4">
              <h2 class="h4">Contact Information</h2>
            </div>
            <div class="col-md-12 mb-3">
              <p><span>Address:</span> Thanh Trì Hà Nội</p>
            </div>
            <div class="col-md-12 mb-3">
              <p><span>Phone:</span> <a href="tel://1234567920">0796470522</a></p>
            </div>
            <div class="col-md-12 mb-3">
              <p><span>Email:</span> <a href="mailto:info@yoursite.com">tlam8641@gmail.com</a></p>
            </div>
            <div class="col-md-12 mb-3">
              <p><span>Website:</span> <a href="index.php">CoffeeBlend.com</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6 ftco-animate">
          <form action="#" class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Your Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email của bạn">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Chủ đề">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Tin nhắn"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Gửi Tin Nhắn" class="btn btn-primary py-3 px-5">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Bản đồ vị trí -->
  <div id="map">
    <iframe
      src="https://maps.google.com/maps?q=Tr%C6%B0%E1%BB%9Dng%20Cao%20%C4%91%E1%BA%B3ng%20K%E1%BB%B9%20thu%E1%BA%ADt%20-%20C%C3%B4ng%20ngh%E1%BB%87%20B%C3%A1ch%20Khoa%20(CTECH)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
      width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>


<?php include 'includes/footer.php'; ?>


