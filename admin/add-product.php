<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 

$error = '';
$success = '';

// Lấy danh sách danh mục để hiển thị trong select
$stmt_cats = $pdo->query("SELECT * FROM categories WHERE status = 1");
$categories = $stmt_cats->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['product_name']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $short_desc = sanitize($_POST['short_description']);
    $description = $_POST['description']; // Giữ nguyên HTML nếu có
    $status = isset($_POST['status']) ? 1 : 0;
    $best_seller = isset($_POST['best_seller']) ? 1 : 0;
    
    // Xử lý slug mang tính duy nhất
    $slug = create_slug($name);

    // Xử lý upload ảnh
    $image_path = 'images/drink/default.jpg'; // Ảnh mặc định
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
        $error = "Vui lòng điền các trường bắt buộc (*).";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (product_name, slug, category_id, price, short_description, description, image_main, status, best_seller, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            if ($stmt->execute([$name, $slug, $category_id, $price, $short_desc, $description, $image_path, $status, $best_seller])) {
                $success = "Thêm sản phẩm thành công!";
            } else {
                $error = "Đã xảy ra lỗi khi thêm sản phẩm.";
            }
        } catch (PDOException $e) {
            $error = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="mb-0">Thêm Sản Phẩm Mới</h2>
        <p class="text-muted">Nhập thông tin chi tiết cho món mới của bạn.</p>
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

        <form action="add-product.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm *</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input type="text" name="short_description" class="form-control" placeholder="Ví dụ: Hương vị đậm đà, khó quên">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Giá (VNĐ) *</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['category_id']; ?>"><?php echo sanitize($cat['category_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" checked>
                            <label class="form-check-label">Cho phép kinh doanh</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="best_seller">
                            <label class="form-check-label">Sản phẩm bán chạy/nổi bật</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="products.php" class="btn btn-secondary me-2">Quay lại</a>
                <button type="submit" class="btn btn-primary px-4">Lưu sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
