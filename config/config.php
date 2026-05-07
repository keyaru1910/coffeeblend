<?php
/**
 * Tệp cấu hình trung tâm (Central Configuration File)
 * Chứa cấu hình cơ sở dữ liệu và các hàm dùng chung
 */

// Bắt đầu phiên làm việc (session) nếu chưa bắt đầu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cấu hình Cơ sở dữ liệu
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'coffee_blend');

// Kết nối PDO
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    die("Lỗi kết nối Cơ sở dữ liệu: " . $e->getMessage());
}

// Chèn các hàm tiện ích dùng chung
require_once __DIR__ . '/functions.php';

// Tự động xác định BASE_URL
if (!defined('BASE_URL')) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    
    $script_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $project_path = str_replace(['/config', '/admin', '/includes', '/backups', '/api'], '', $script_path);
    $project_path = rtrim($project_path, '/') . '/';
    
    define('BASE_URL', $protocol . $host . $project_path);
}
?>
