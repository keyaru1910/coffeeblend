<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>

<!-- Content Header -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Quản lý Sản phẩm</h2>
            <p class="text-muted">Xem và cập nhật danh sách sản phẩm của bạn.</p>
        </div>
        <a href="add-product.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Thêm sản phẩm mới</a>
    </div>
</div>

<!-- Products Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $query = "SELECT p.*, c.category_name 
                                  FROM products p 
                                  LEFT JOIN categories c ON p.category_id = c.category_id 
                                  ORDER BY p.product_id DESC";
                        $stmt = $pdo->query($query);
                        $products = $stmt->fetchAll();

                        if (count($products) > 0) {
                            foreach ($products as $product) {
                    ?>
                    <tr>
                        <td class="ps-4">
                            <img src="../<?php echo $product['image_main']; ?>" alt="" class="rounded" width="50" height="50" style="object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo sanitize($product['product_name']); ?></div>
                            <small class="text-muted"><?php echo sanitize($product['slug']); ?></small>
                        </td>
                        <td><?php echo sanitize($product['category_name'] ?? 'Chưa phân loại'); ?></td>
                        <td class="text-danger fw-bold"><?php echo format_price($product['price']); ?></td>
                        <td>
                            <?php if ($product['status'] == 1): ?>
                                <span class="badge bg-success rounded-pill px-3">Đang bán</span>
                            <?php else: ?>
                                <span class="badge bg-secondary rounded-pill px-3">Ngừng bán</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="edit-product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-info text-white rounded-circle p-2" title="Sửa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-edit"></i></a>
                            <a href="delete-product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-danger rounded-circle p-2" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" title="Xóa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4'>Chưa có sản phẩm nào.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='6' class='text-center py-4 text-danger'>Lỗi: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
