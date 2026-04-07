<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>

<!-- Content Header -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Quản lý Blog</h2>
            <p class="text-muted">Đăng tải và chỉnh sửa các bài viết tâm huyết của bạn.</p>
        </div>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i> Viết bài mới</button>
    </div>
</div>

<!-- Blog Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Ảnh</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Tóm tắt</th>
                        <th>Lượt xem</th>
                        <th>Trạng thái</th>
                        <th>Ngày đăng</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
<?php
// Xử lý xóa bài viết
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $pdo->prepare("DELETE FROM blog_posts WHERE post_id = ?")->execute([$id]);
    $success = "Đã xóa bài viết thành công!";
}

try {
    $query = "SELECT * FROM blog_posts ORDER BY post_id DESC";
    $stmt = $pdo->query($query);
    $posts = $stmt->fetchAll();

    if (isset($success)): ?><div class="alert alert-success mx-4 mt-4"><?php echo $success; ?></div><?php endif;

    if (count($posts) > 0) {
        foreach ($posts as $post) {
            $status_badge = ($post['status'] == 'published') ? 'bg-success' : (($post['status'] == 'draft') ? 'bg-secondary' : 'bg-danger');
            $status_text = ($post['status'] == 'published') ? 'Công khai' : (($post['status'] == 'draft') ? 'Bản nháp' : 'Đã ẩn');
?>
<tr>
    <td class="ps-4">
        <img src="../<?php echo $post['featured_image']; ?>" alt="" class="rounded shadow-sm" width="50" height="50" style="object-fit: cover;">
    </td>
    <td>
        <div class="fw-bold"><?php echo sanitize($post['title']); ?></div>
        <small class="text-muted"><?php echo sanitize($post['slug']); ?></small>
    </td>
    <td title="<?php echo sanitize($post['excerpt']); ?>"><?php echo mb_substr(sanitize($post['excerpt'] ?? ''), 0, 50) . '...'; ?></td>
    <td><?php echo number_format($post['views']); ?> <i class="fas fa-eye small text-muted ms-1"></i></td>
    <td><span class="badge <?php echo $status_badge; ?> rounded-pill px-3"><?php echo $status_text; ?></span></td>
    <td><?php echo date('d/m/Y', strtotime($post['published_at'] ?? $post['created_at'])); ?></td>
    <td class="text-center">
        <a href="edit-blog.php?id=<?php echo $post['post_id']; ?>" class="btn btn-sm btn-info text-white rounded-circle p-2" title="Sửa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-edit"></i></a>
        <a href="blog.php?action=delete&id=<?php echo $post['post_id']; ?>" class="btn btn-sm btn-danger rounded-circle p-2" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')" title="Xóa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-trash"></i></a>
    </td>
</tr>
<?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4'>Chưa có bài viết nào.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='7' class='text-center py-4 text-danger'>Lỗi: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
