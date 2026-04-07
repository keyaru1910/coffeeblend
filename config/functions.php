<?php
/**
 * Chứa các hàm dùng chung cho toàn bộ dự án
 */

/**
 * Định dạng tiền tệ VNĐ
 */
function format_price($price) {
    return number_format($price, 0, ',', '.') . 'đ';
}

/**
 * Làm sạch dữ liệu đầu vào
 */
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Chuyển tiêu đề thành slug (URL thân thiện)
 */
function create_slug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

/**
 * Kiểm tra trạng thái đăng nhập
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Kiểm tra quyền Admin
 */
function is_admin() {
    return (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
}

/**
 * Lấy tên người dùng hiện tại
 */
function get_current_user_name() {
    return isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Khách';
}
?>
