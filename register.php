<?php 
require_once 'config/config.php';

// Chuyển hướng nếu đã đăng nhập
if (is_logged_in()) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = sanitize($_POST['full_name']);
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra tính hợp lệ
    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu nhập lại không khớp.";
    } elseif (strlen($password) < 6) {
        $error = "Mật khẩu phải có ít nhất 6 ký tự.";
    } else {
        // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại chưa
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Tên đăng nhập hoặc Email đã tồn tại.";
        } else {
            // Hash mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Thêm người dùng mới
            $stmt = $pdo->prepare("INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'customer')");
            if ($stmt->execute([$full_name, $username, $email, $hashed_password])) {
                $success = "Đăng ký thành công! Đang chuyển tới trang đăng nhập...";
                header("refresh:2;url=login.php");
            } else {
                $error = "Đã xảy ra lỗi, vui lòng thử lại sau.";
            }
        }
    }
}

$page_title = "Đăng Ký - Coffee Blend";
include 'includes/header.php'; 
?>
<link rel="stylesheet" href="css/login.css">

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container d-flex align-items-center justify-content-center h-100">
                <div class="row w-100 justify-content-center">

                    <div class="col-md-6 col-lg-5 text-left ftco-animate">
                        <!-- Form Đăng Ký -->
                        <div class="login-wrap mt-5">
                            <h3 class="mb-4 text-center">Đăng Ký Tài Khoản</h3>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo sanitize($error); ?></div>
                            <?php endif; ?>
                            
                            <?php if ($success): ?>
                                <div class="alert alert-success"><?php echo sanitize($success); ?></div>
                            <?php endif; ?>

                            <form action="register.php" method="POST" class="login-form">
                                <div class="form-group">
                                    <input type="text" name="full_name" class="form-control" placeholder="Họ và Tên" 
                                           value="<?php echo isset($_POST['full_name']) ? sanitize($_POST['full_name']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" 
                                           value="<?php echo isset($_POST['username']) ? sanitize($_POST['username']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" 
                                           value="<?php echo isset($_POST['email']) ? sanitize($_POST['email']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-login w-100 text-center">Đăng Ký</button>
                                </div>
                            </form>
                            <p class="login-footer-text">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>


