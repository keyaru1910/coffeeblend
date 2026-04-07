<?php 
require_once 'config/config.php';

// Chuyển hướng nếu đã đăng nhập
if (is_logged_in()) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_input = sanitize($_POST['username']);
    $password = $_POST['password'];

    if (empty($login_input) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        // Tìm người dùng theo username hoặc email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND status = 1");
        $stmt->execute([$login_input, $login_input]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // Ghi nhận lần đăng nhập cuối
            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?");
            $stmt->execute([$user['user_id']]);

            // Chuyển hướng theo vai trò (Admin hoặc Khách hàng)
            if ($user['role'] == 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    }
}

$page_title = "Đăng Nhập - Coffee Blend";
include 'includes/header.php'; 
?>
<link rel="stylesheet" href="css/login.css">

    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image: url(images/bg/bg_1.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container d-flex align-items-center justify-content-center h-100">
                <div class="row w-100 justify-content-center">

                    <div class="col-md-6 col-lg-5 text-left ftco-animate">
                        <!-- Form Đăng Nhập -->
                        <div class="login-wrap mt-5">
                            <h3 class="mb-4 text-center">Đăng Nhập</h3>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger text-center"><?php echo sanitize($error); ?></div>
                            <?php endif; ?>

                            <form action="login.php" method="POST" class="login-form">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Tên đăng nhập / Email" 
                                        value="<?php echo isset($_POST['username']) ? sanitize($_POST['username']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu"
                                        required>
                                </div>
                                <div class="form-group d-flex justify-content-between align-items-center mt-4">
                                    <label class="form-check-label"><input type="checkbox" name="remember" class="mr-2"> Nhớ mật khẩu</label>
                                    <a href="#" class="forgot-pass">Quên mật khẩu?</a>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-login w-100 text-center">Đăng Nhập</button>
                                </div>
                            </form>
                            <p class="login-footer-text">Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
