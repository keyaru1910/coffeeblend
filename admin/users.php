<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>

<!-- Content Header -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-0">Quản lý Người dùng</h2>
            <p class="text-muted">Danh sách tài khoản khách hàng và nhân viên.</p>
        </div>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i> Thêm người dùng</button>
    </div>
</div>

<!-- Users Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tên người dùng</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
<?php
// Xử lý xóa người dùng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Không cho phép tự xóa mình (nếu admin đang đăng nhập)
    if ($id != $_SESSION['user_id']) {
        $pdo->prepare("DELETE FROM users WHERE user_id = ?")->execute([$id]);
        $success = "Đã xóa người dùng thành công!";
    } else {
        $error = "Bạn không thể tự xóa tài khoản của chính mình!";
    }
}

try {
    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll();

    if (isset($success)): ?><div class="alert alert-success mx-4 mt-4"><?php echo $success; ?></div><?php endif;
    if (isset($error)): ?><div class="alert alert-danger mx-4 mt-4"><?php echo $error; ?></div><?php endif;

    if (count($users) > 0) {
        foreach ($users as $user) {
            $role_badge = ($user['role'] == 'admin') ? 'bg-danger' : (($user['role'] == 'staff') ? 'bg-primary' : 'bg-info');
            $role_text = ($user['role'] == 'admin') ? 'Quản trị' : (($user['role'] == 'staff') ? 'Nhân viên' : 'Khách hàng');
?>
<tr>
    <td class="ps-4 fw-bold"><?php echo sanitize($user['username']); ?></td>
    <td><?php echo sanitize($user['email']); ?></td>
    <td><?php echo sanitize($user['full_name']); ?></td>
    <td><span class="badge <?php echo $role_badge; ?> rounded-pill px-3"><?php echo $role_text; ?></span></td>
    <td>
        <?php if ($user['status'] == 1): ?>
            <span class="badge bg-success rounded-pill px-3">Hoạt động</span>
        <?php else: ?>
            <span class="badge bg-secondary rounded-pill px-3">Khóa</span>
        <?php endif; ?>
    </td>
    <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
    <td class="text-center">
        <a href="edit-user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-info text-white rounded-circle p-2" title="Sửa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-edit"></i></a>
        <a href="users.php?action=delete&id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger rounded-circle p-2" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')" title="Xóa" style="width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;"><i class="fas fa-trash"></i></a>
    </td>
</tr>
<?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4'>Chưa có người dùng nào.</td></tr>";
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
