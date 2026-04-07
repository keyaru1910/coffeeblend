<?php
require_once 'config/config.php';

echo "<h3>Đang nạp dữ liệu thực đơn phong phú...</h3>";

try {
    // 1. Làm sạch bảng products
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE products");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✅ Đã làm sạch danh sách món cũ.<br>";

    $products = [
        // Nhóm 1: Cà Phê Truyền Thống (Category ID: 1)
        ['Cà Phê Sữa Đá', 'ca-phe-sua-da', 1, 35000, 'Hương vị Việt truyền thống đậm đà.', 'images/drink/vietnamese_coffee.jpg'],
        ['Espresso', 'espresso', 1, 35000, 'Đậm đặc, tinh chất từ hạt Robusta.', 'images/drink/epressso.jpg'],
        ['Latte Macchiato', 'latte-macchiato', 1, 45000, 'Sự kết hợp hoàn hảo giữa sữa và cafe.', 'images/drink/latte.jpg'],
        ['Cappuccino', 'cappuccino', 1, 50000, 'Lớp bọt sữa mịn màng nghệ thuật.', 'images/drink/cappuchino.jpg'],
        ['Americano', 'americano', 1, 40000, 'Cafe đen truyền thống pha loãng kiểu Mỹ.', 'images/drink/americano.jpg'],
        ['Mocha Coffee', 'mocha-coffee', 1, 55000, 'Sự hòa quyện giữa Cafe và Chocolate.', 'images/drink/mocha_coffee.jpg'],

        // Nhóm 2: Trà & Trà Sữa (Category ID: 2)
        ['Trà Đào Cam Sả', 'tra-dao-cam-sa', 2, 55000, 'Thanh mát, giải nhiệt cực tốt.', 'images/drink/cam_xả.jpg'],
        ['Trà Vải Hoa Hồng', 'tra-vai-hoa-hong', 2,  55000, 'Hương vị hoa hồng dịu nhẹ bí truyền.', 'images/drink/rose_tea.jpg'],
        ['Matcha Latte', 'matcha-latte', 2, 60000, 'Trà xanh Nhật Bản thượng hạng.', 'images/drink/Matcha_Latte.jpg'],
        ['Trà Sữa Bá Tước', 'earl-grey-milk-tea', 2, 55000, 'Hương vị Earl Grey đặc trưng.', 'images/drink/Earl_Grey_Milk_Tea.jpg'],
        ['Trà Dâu Tây Tươi', 'strawberry-fruit-tea', 2, 55000, 'Trái dâu tươi mọng, vị chua ngọt.', 'images/drink/Strawberry_Fruit_Tea.jpg'],
        ['Trà Sữa Ô Long', 'oolong-milk-tea', 2, 50000, 'Trà Ô Long thơm lừng kết hợp sữa.', 'images/drink/Oolong_Milk_Tea.jpg'],

        // Nhóm 3: Đồ Uống Đặc Biệt (Category ID: 3)
        ['Cà Phê Trứng', 'ca-phe-trung', 3, 65000, 'Đặc sản Hà Nội béo ngậy, thơm lừng.', 'images/drink/Egg_Coffee.jpg'],
        ['Cà Phê Kem Muối', 'ca-phe-kem-muoi', 3, 65000, 'Vị mặn nhẹ của kem quyện cùng cafe.', 'images/drink/Salted_Coffee.jpg'],
        ['Tropical Fruit Punch', 'tropical-fruit-punch', 3, 70000, 'Hỗn hợp trái cây nhiệt đới tươi.', 'images/drink/Tropical_Fruit_Punch.jpg'],
        ['Cà Phê Cốt Dừa', 'ca-phe-cot-dua', 3, 60000, 'Béo ngậy hương dừa, mát lạnh.', 'images/drink/Coconut_Coffee.jpg'],
        ['Bạc Xỉu Cream', 'bac-xiu-cream', 3, 45000, 'Nhiều sữa, ít cafe kết hợp lớp kem mịn.', 'images/drink/Bac_Xiu_Cream.jpg'],
        ['Cà Phê Bơ', 'avocado-coffee', 3, 65000, 'Sự kết hợp độc đáo giữa bơ sáp và cafe.', 'images/drink/Avocado_Coffee.jpg'],

        // Nhóm 4: Bánh Ngọt (Category ID: 4)
        ['Bánh Sừng Bò', 'croissant', 4, 45000, 'Bánh sừng bò Pháp giòn tan thơm bơ.', 'images/food/Croissant.jpg'],
        ['Tiramisu Ý', 'tiramisu', 4, 65000, 'Bánh phô mai cà phê trứ danh.', 'images/food/Tiramisu.jpg'],
        ['Bánh Nhung Đỏ', 'red-velvet', 4, 60000, 'Vẻ ngoài quý phái, vị ngọt dịu.', 'images/food/Red Velvet.jpg'],
        ['Cheesecake Berry', 'cheesecake-berry', 4, 60000, 'Phô mai béo ngậy và mứt quả mọng.', 'images/food/Cheesecake_Berry.jpg'],
        ['Bộ 3 Macarons', 'macarons-set', 4, 55000, 'Bánh Macaron nhiều màu sắc ngọt ngào.', 'images/food/Macarons_Set.jpg'],
        ['Chocolate Brownie', 'chocolate-brownie', 4, 50000, 'Bánh socola đậm đà, ít ngọt.', 'images/food/Chocolate_Brownie.jpg'],
    ];

    $stmt = $pdo->prepare("INSERT INTO products (product_name, slug, category_id, price, short_description, image_main, status, best_seller, created_at) VALUES (?, ?, ?, ?, ?, ?, 1, ?, NOW())");
    
    foreach ($products as $p) {
        $best_seller = (rand(1, 10) > 7) ? 1 : 0; // Random một số món bán chạy
        $stmt->execute([$p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $best_seller]);
        echo "✅ Đã thêm món: " . $p[0] . "<br>";
    }

    echo "<h3>🎉 HOÀN TẤT THÊM 24 MÓN VÀO THỰC ĐƠN!</h3>";
    echo "<a href='menu.php'>Quay lại Menu</a>";

} catch (PDOException $e) {
    die("❌ Lỗi: " . $e->getMessage());
}
?>
