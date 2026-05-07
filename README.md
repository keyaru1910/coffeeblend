# Hướng dẫn cài đặt Project Coffee Blend

Để chạy mượt mà project này trên máy tính khác (XAMPP), vui lòng thực hiện theo các bước sau:

## 1. Sao chép project
- Copy toàn bộ thư mục `coffee_blend` vào thư mục `C:\xampp\htdocs\`.

## 2. Cài đặt Cơ sở dữ liệu (Database)
- Mở trình duyệt, truy cập: `http://localhost/phpmyadmin/`.
- Tạo một database mới tên là: `coffee_blend` (với collation là `utf8mb4_general_ci`).
- Chọn database vừa tạo, nhấn vào tab **Import**.
- Chọn file `backups/coffee_blend.sql` trong thư mục project và nhấn **Import**.
- **Lưu ý**: File SQL này đã bao gồm đầy đủ **24 món trong thực đơn**.

## 3. Cấu hình hệ thống (Nếu cần)
- Project đã được cài đặt **Tự động nhận diện đường dẫn (Dynamic BASE_URL)**, nên bạn không cần sửa code dù đặt project trong thư mục nào.
- Nếu MySQL của bạn có mật khẩu hoặc dùng port khác, hãy sửa tại file: `config/config.php`.

## 4. Kiểm tra
- Truy cập website qua địa chỉ: `http://localhost/coffee_blend/`.
- Tài khoản quản trị mặc định (nếu có):
  - **Username**: `admin`
  - **Password**: `admin123` (Nếu không được, hãy kiểm tra file `backups/reset_admin.php`).

---
*Chúc bạn có trải nghiệm tốt với hệ thống Coffee Blend!*
