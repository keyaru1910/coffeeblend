<?php
require_once 'config/config.php';

// Hủy bỏ tất cả các biến session
$_SESSION = array();

// Nếu muốn xóa sạch cookie session, hãy thực hiện điều này
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Cuối cùng, hủy session
session_destroy();

// Chuyển hướng về trang chủ hoặc trang đăng nhập
header("Location: login.php");
exit();
?>
