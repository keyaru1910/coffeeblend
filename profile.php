<?php 
require_once 'config/config.php';
$page_title = "Trang Cá Nhân - Coffee Blend";
include 'includes/header.php'; 
?>

<section class="ftco-section mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0 text-white">Trang Cá Nhân</h2>
                    </div>
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4">
                                <img src="images/person/person_1.jpg" alt="Avatar" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                <button class="btn btn-outline-primary btn-sm">Thay đổi ảnh đại diện</button>
                            </div>
                            <div class="col-md-8">
                                <form action="#">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Tên đăng nhập</label>
                                        <input type="text" class="form-control" value="admin" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Họ và Tên</label>
                                        <input type="text" class="form-control" value="Administrator">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Email</label>
                                        <input type="email" class="form-control" value="admin@coffeeblend.com">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Số điện thoại</label>
                                        <input type="text" class="form-control" placeholder="Chưa cập nhật">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold">Địa chỉ</label>
                                        <textarea class="form-control" rows="3" placeholder="Chưa cập nhật"></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary px-4">Lưu cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>


