<?php 
require_once '../config/config.php';

// Kiểm tra quyền Admin
if (!is_admin()) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Tùy chọn: Xóa ảnh cũ trước khi xóa record
    /*
    $stmt_img = $pdo->prepare("SELECT image_main FROM products WHERE product_id = ?");
    $stmt_img->execute([$id]);
    $img = $stmt_img->fetch();
    if ($img && $img['image_main'] != 'images/drink/default.jpg') {
        @unlink('../' . $img['image_main']);
    }
    */
    
    $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
    if ($stmt->execute([$id])) {
        header("Location: products.php?msg=deleted");
    } else {
        header("Location: products.php?error=fail");
    }
    exit();
}

header("Location: products.php");
exit();
?>
