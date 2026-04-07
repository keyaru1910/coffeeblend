<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Quản Trị - Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../images/favicon/logo.png">
</head>
<body>
    <div class="login-bg">
        <div class="glass-panel text-center">
            <h2 class="mb-4 fw-bold">Trang Quản Trị</h2>
            <p class="mb-4 text-white-50">Vui lòng đăng nhập để vào hệ thống</p>
            
            <form action="index.php" method="POST">
                <div class="mb-3 text-start">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Nhập admin..." required>
                </div>
                <div class="mb-4 text-start">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu..." required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm" style="background: #c49b63; border: none;">
                    Đăng Nhập
                </button>
            </form>
            
            <div class="mt-4">
                <a href="../index.html" class="text-white-50 text-decoration-none"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>
</html>
