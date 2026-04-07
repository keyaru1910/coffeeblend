<?php 
require_once 'config/config.php';

// Kiểm tra giỏ hàng
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$error = '';
$success = '';

// Lấy thông tin người dùng nếu đã đăng nhập
$user_id = is_logged_in() ? $_SESSION['user_id'] : null;
$full_name = is_logged_in() ? $_SESSION['full_name'] : '';
$email = '';
$phone = '';
$address = '';

if ($user_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $u = $stmt->fetch();
    if ($u) {
        $email = $u['email'];
        $phone = $u['phone'];
        $address = $u['address'];
    }
}

// Tính tổng tiền
$total_amount = 0;
$cart_items = [];
$ids = implode(',', array_keys($_SESSION['cart']));
$stmt = $pdo->query("SELECT * FROM products WHERE product_id IN ($ids)");
while ($row = $stmt->fetch()) {
    $id = $row['product_id'];
    $qty = $_SESSION['cart'][$id];
    $row['qty'] = $qty;
    $row['subtotal'] = $row['price'] * $qty;
    $total_amount += $row['subtotal'];
    $cart_items[] = $row;
}

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $cust_name = sanitize($_POST['name']);
    $cust_email = sanitize($_POST['email']);
    $cust_phone = sanitize($_POST['phone']);
    $cust_address = sanitize($_POST['address']);
    $note = sanitize($_POST['note']);
    $payment_method = sanitize($_POST['payment_method']);

    if (empty($cust_name) || empty($cust_phone) || empty($cust_address)) {
        $error = "Vui lòng điền đầy đủ Họ tên, Số điện thoại và Địa chỉ.";
    } else {
        try {
            $pdo->beginTransaction();
            
            // 1. Tạo đơn hàng
            $order_code = "ORD" . strtoupper(substr(uniqid(), -6));
            $stmt = $pdo->prepare("INSERT INTO orders (order_code, user_id, customer_name, customer_email, customer_phone, customer_address, note, subtotal, total, payment_method, order_status, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())");
            $stmt->execute([$order_code, $user_id, $cust_name, $cust_email, $cust_phone, $cust_address, $note, $total_amount, $total_amount, $payment_method]);
            $order_id = $pdo->lastInsertId();
            
            // 2. Thêm chi tiết đơn hàng (Sửa từ order_items sang order_details)
            $stmt_item = $pdo->prepare("INSERT INTO order_details (order_id, product_id, product_name, quantity, unit_price, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($cart_items as $item) {
                $stmt_item->execute([$order_id, $item['product_id'], $item['product_name'], $item['qty'], $item['price'], $item['subtotal']]);
            }
            
            $pdo->commit();
            
            // 3. Xóa giỏ hàng và chuyển hướng
            $_SESSION['cart'] = [];
            header("Location: order-success.php?id=" . $order_id);
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Có lỗi xảy ra: " . $e->getMessage();
        }
    }
}

$page_title = "Thanh Toán - Coffee Blend";
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
            <h1 class="mb-3 mt-5 bread">Thanh Toán</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang Chủ</a></span> <span>Checout</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Phần Thanh toán và Thông tin Giao hàng (Checkout & Billing) -->
  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 ftco-animate">
          
          <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo sanitize($error); ?></div>
          <?php endif; ?>

          <form action="checkout.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
            <h3 class="mb-4 billing-heading">Thông Tin Giao Hàng</h3>
            <div class="row align-items-end">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Họ và Tên</label>
                  <input type="text" name="name" class="form-control" placeholder="" 
                         value="<?php echo sanitize($full_name); ?>" required>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email (Tùy chọn)</label>
                  <input type="email" name="email" class="form-control" placeholder="" 
                         value="<?php echo sanitize($email); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Số điện thoại</label>
                  <input type="text" name="phone" class="form-control" placeholder="" 
                         value="<?php echo sanitize($phone); ?>" required>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address">Địa chỉ giao hàng</label>
                  <input type="text" name="address" class="form-control" placeholder="Số nhà, tên đường, phường..." 
                         value="<?php echo sanitize($address); ?>" required>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="note">Ghi chú đơn hàng</label>
                  <textarea name="note" class="form-control" rows="3" placeholder="Ghi chú về thời gian giao hàng hoặc yêu cầu đặc biệt..."></textarea>
                </div>
              </div>
            </div>

            <div class="row mt-5 pt-3 d-flex">
              <div class="col-md-6 d-flex">
                <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                  <h3 class="billing-heading mb-4">Tổng Giỏ Hàng</h3>
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
              </div>
              <div class="col-md-6">
                <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                  <h3 class="billing-heading mb-4">Phương Thức Thanh Toán</h3>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="payment_method" value="COD" class="mr-2" checked> Thanh toán khi nhận hàng (COD)</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="payment_method" value="Bank" class="mr-2"> Chuyển khoản ngân hàng</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="checkbox">
                        <label><input type="checkbox" value="" class="mr-2" required> Tôi đã đọc và chấp nhận các điều khoản.</label>
                      </div>
                    </div>
                  </div>
                  <p><button type="submit" name="place_order" class="btn btn-primary py-3 px-4 w-100">Đặt Hàng Ngay</button></p>
                </div>
              </div>
            </div>
          </form>
        </div> <!-- .col-md-8 -->




        <div class="col-xl-4 sidebar ftco-animate">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <div class="icon">
                  <span class="icon-search"></span>
                </div>
                <input type="text" class="form-control" placeholder="Search...">
              </div>
            </form>
          </div>
          <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Categories</h3>
              <li><a href="#">Tour <span>(12)</span></a></li>
              <li><a href="#">Hotel <span>(22)</span></a></li>
              <li><a href="#">Coffee <span>(37)</span></a></li>
              <li><a href="#">Đồ Uống<span>(42)</span></a></li>
              <li><a href="#">Foods <span>(14)</span></a></li>
              <li><a href="#">Travel <span>(140)</span></a></li>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Recent Blog</h3>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/blog/image_1.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Khám phá bí quyết tạo nên ly cà phê hoàn hảo và đắm chìm the blind texts</a>
                </h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                  <div><a href="#"><span class="icon-person"></span>Quản trị viên</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/blog/image_2.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Khám phá bí quyết tạo nên ly cà phê hoàn hảo và đắm chìm the blind texts</a>
                </h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                  <div><a href="#"><span class="icon-person"></span>Quản trị viên</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/blog/image_3.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Khám phá bí quyết tạo nên ly cà phê hoàn hảo và đắm chìm the blind texts</a>
                </h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                  <div><a href="#"><span class="icon-person"></span>Quản trị viên</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Tag Cloud</h3>
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">dish</a>
              <a href="#" class="tag-cloud-link">Thực Đơn</a>
              <a href="#" class="tag-cloud-link">food</a>
              <a href="#" class="tag-cloud-link">sweet</a>
              <a href="#" class="tag-cloud-link">tasty</a>
              <a href="#" class="tag-cloud-link">delicious</a>
              <a href="#" class="tag-cloud-link">Tráng Miệng</a>
              <a href="#" class="tag-cloud-link">Đồ Uống</a>
            </div>
          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Paragraph</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate
              quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos
              fugit cupiditate numquam!</p>
          </div>
        </div>

      </div>
    </div>
  </section> <!-- .section -->

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






