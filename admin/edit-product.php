<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    header("Location: products.php");
    exit();
}

$error = '';
$success = '';

// Lấy thông tin sản phẩm hiện tại
$stmt_prod = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt_prod->execute([$id]);
$product = $stmt_prod->fetch();

if (!$product) {
    header("Location: products.php");
    exit();
}

// Lấy danh mục
$categories = $pdo->query("SELECT * FROM categories WHERE status = 1")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['product_name']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $short_desc = sanitize($_POST['short_description']);
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? 1 : 0;
    $best_seller = isset($_POST['best_seller']) ? 1 : 0;
    $slug = create_slug($name);

    $image_path = $product['image_main']; // Giữ ảnh cũ nếu không upload mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = time() . '_' . $filename;
            $upload_path = '../images/drink/' . $new_filename;
            if (move_uploaded_file($_FILES['image']['tmp_path'], $upload_path)) {
                $image_path = 'images/drink/' . $new_filename;
            }
        }
    }

    if (empty($name) || empty($price) || empty($category_id)) {
        $error = "Vui lòng điền đầy đủ các thông tin bắt buộc.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE products SET product_name = ?, slug = ?, category_id = ?, price = ?, short_description = ?, description = ?, image_main = ?, status = ?, best_seller = ?, updated_at = NOW() WHERE product_id = ?");
            if ($stmt->execute([$name, $slug, $category_id, $price, $short_desc, $description, $image_path, $status, $best_seller, $id])) {
                $success = "Cập nhật sản phẩm thành công!";
                // Refresh data
                $product['product_name'] = $name;
                $product['price'] = $price;
                $product['category_id'] = $category_id;
                $product['short_description'] = $short_desc;
                $product['description'] = $description;
                $product['image_main'] = $image_path;
                $product['status'] = $status;
                $product['best_seller'] = $best_seller;
            } else {
                $error = "Lỗi khi cập nhật.";
            }
        } catch (PDOException $e) {
            $error = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0">Chỉnh Sửa Sản Phẩm</h2>
        <p class="text-muted">Cập nhật thông tin cho <strong><?php echo sanitize($product['product_name']); ?></strong>.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="edit-product.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm *</label>
                        <input type="text" name="product_name" class="form-control" value="<?php echo sanitize($product['product_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input type="text" name="short_description" class="form-control" value="<?php echo sanitize($product['short_description']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="5"><?php echo $product['description']; ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Giá (VNĐ) *</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục *</label>
                        <select name="category_id" class="form-select" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['category_id']; ?>" <?php echo ($cat['category_id'] == $product['category_id']) ? 'selected' : ''; ?>>
                                    <?php echo sanitize($cat['category_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh hiện tại</label>
                        <div class="mb-2">
                            <img src="../<?php echo $product['image_main']; ?>" class="rounded" width="100" style="object-fit: cover;">
                        </div>
                        <label class="form-label">Thay đổi ảnh mới</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" <?php echo ($product['status'] == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Cho phép kinh doanh</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="best_seller" <?php echo ($product['best_seller'] == 1) ? 'checked' : ''; ?>>
                            <label class="form-check-label">Sản phẩm bán chạy/nổi bật</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="products.php" class="btn btn-secondary me-2">Hủy bỏ</a>
                <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
