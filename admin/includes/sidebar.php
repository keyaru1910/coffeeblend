        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3 vh-100" style="width: 250px;">
            <a href="../index.php" class="text-decoration-none d-block">
                <h3 class="text-center mb-4 text-warning">Coffee Blend Admin</h3>
            </a>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="index.php" class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'index.php')
    echo 'active'; ?>">
                        <i class="fas fa-home me-2"></i> Tổng quan
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="products.php" class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'products.php')
    echo 'active'; ?>">
                        <i class="fas fa-coffee me-2"></i> Sản phẩm
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="orders.php" class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'orders.php')
    echo 'active'; ?>">
                        <i class="fas fa-shopping-cart me-2"></i> Đơn hàng
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="users.php" class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'users.php')
    echo 'active'; ?>">
                        <i class="fas fa-users me-2"></i> Người dùng
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="blog.php" class="nav-link text-white <?php if (basename($_SERVER['PHP_SELF']) == 'blog.php')
    echo 'active'; ?>">
                        <i class="fas fa-newspaper me-2"></i> Bài viết Blog
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a href="login.php" class="nav-link text-danger fw-bold">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Main Content Wrapper -->
        <div class="flex-grow-1 bg-light">
            <!-- Topbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h4 fw-bold">Dashboard Tổng Quan</span>
                    <div class="d-flex align-items-center">
                        <span class="me-3">Xin chào, <strong>Admin</strong></span>
                        <img src="../images/person/person_1.jpg" alt="Admin" class="rounded-circle" width="40" height="40" style="object-fit: cover; border: 2px solid #c49b63;">
                    </div>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="container-fluid px-4">
