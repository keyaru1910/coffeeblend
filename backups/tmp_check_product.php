<?php
require_once 'c:/xampp/htdocs/coffee_blend/config/config.php';
try {
    $stmt = $pdo->query("SELECT product_id, product_name, image_main FROM products WHERE product_name LIKE '%nhung đỏ%'");
    $rows = $stmt->fetchAll();
    echo "Found " . count($rows) . " matches:\n";
    foreach($rows as $row) {
        echo "- ID: {$row['product_id']}, Name: '{$row['product_name']}', Image: '{$row['image_main']}'\n";
    }
    
    // Check file existence
    if (count($rows) > 0) {
        $path = 'c:/xampp/htdocs/coffee_blend/' . $rows[0]['image_main'];
        if (file_exists($path)) {
            echo "SUCCESS: File exists at $path\n";
        } else {
            echo "FAILURE: File NOT FOUND at $path\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
