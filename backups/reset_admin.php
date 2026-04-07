<?php
require_once 'config/config.php';

$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
    if ($stmt->execute([$hashed_password])) {
        echo "Cập nhật mật khẩu Admin thành công! Mật khẩu mới là: " . $password;
    } else {
        echo "Lỗi khi cập nhất mật khẩu.";
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
