<?php
require_once 'config/config.php';

echo "<h3>Kiểm tra hệ thống:</h3>";

// 1. Kiểm tra kết nối PDO
if (isset($pdo)) {
    echo "✅ Kết nối Cơ sở dữ liệu: THÀNH CÔNG<br>";
} else {
    echo "❌ Kết nối Cơ sở dữ liệu: THẤT BẠI<br>";
}

// 2. Kiểm tra tài khoản admin
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user) {
        echo "✅ Tài khoản 'admin': TÌM THẤY<br>";
        echo "   - Vai trò: " . $user['role'] . "<br>";
        echo "   - Trạng thái: " . ($user['status'] == 1 ? 'Hoạt động' : 'Bị khóa') . "<br>";
        
        // 3. Thực hiện RESET mật khẩu luôn cho chắc chắn
        $new_pass = 'admin123';
        $hashed = password_hash($new_pass, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password = ?, status = 1 WHERE username = 'admin'");
        if ($update->execute([$hashed])) {
            echo "✅ Mật khẩu Admin đã được đặt lại thành: <b>" . $new_pass . "</b><br>";
        }
    } else {
        echo "❌ Tài khoản 'admin': KHÔNG TÌM THẤY TRONG DATABASE<br>";
    }
} catch (PDOException $e) {
    echo "❌ Lỗi truy vấn: " . $e->getMessage() . "<br>";
}

echo "<br><a href='login.php'>Thử Đăng Nhập Lại</a>";
?>
