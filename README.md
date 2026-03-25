🏸 BADMINTON CF - HỆ THỐNG QUẢN LÝ CỬA HÀNG CẦU LÔNG
Chào mừng bạn đến với dự án Badminton Shop. Đây là hệ thống thương mại điện tử chuyên biệt cho đồ cầu lông, được phát triển trên nền tảng Laravel Framework 10.x.

Tác giả: Phan Nhật Huy

Năm thực hiện: 2026

🛠 Yêu cầu hệ thống
Trước khi bắt đầu, hãy đảm bảo máy tính của bạn đã cài đặt các công cụ sau:

PHP: >= 8.1 (Khuyên dùng XAMPP phiên bản mới nhất)

MySQL: Hoặc MariaDB

Composer: getcomposer.org

🚀 Hướng dẫn cài đặt (A-Z)
Hãy thực hiện theo các bước sau để chạy dự án trên máy cục bộ (Localhost):

Bước 1: Tải mã nguồn và cài đặt thư viện
Mở Terminal/CMD tại thư mục dự án và chạy lệnh:

Bash
composer install

Bước 2: Thiết lập cấu hình môi trường (.env)
Copy file mẫu .env.example thành file .env:

Windows: copy .env.example .env

Mac/Linux: cp .env.example .env

Mở file .env bằng Notepad hoặc VS Code và cập nhật thông tin Database của bạn:

Đoạn mã
DB_DATABASE=badminton_shop
DB_USERNAME=root
DB_PASSWORD=
Tạo mã khóa bảo mật cho ứng dụng:

Bash
php artisan key:generate
Bước 3: Thiết lập Cơ sở dữ liệu
Mở phpMyAdmin và tạo một database mới với tên: badminton_shop.

Quay lại Terminal và chạy lệnh để tạo bảng và nạp dữ liệu mồi (bao gồm sản phẩm và doanh thu ảo):

Bash
php artisan migrate --seed
Bước 4: Liên kết thư mục hình ảnh
Để hình ảnh sản phẩm hiển thị chính xác, hãy chạy lệnh:

Bash
php artisan storage:link
Bước 5: Khởi động ứng dụng
Bash
php artisan serve
Truy cập địa chỉ: http://127.0.0.1:8000

🔐 Thông tin đăng nhập mặc định (Dành cho Test)
👔 Tài khoản Admin (Quản trị viên)
Email: admin@example.com

Mật khẩu: password

👤 Tài khoản Customer (Khách hàng)
Email: customer@example.com

Mật khẩu: password

✨ Các tính năng chính của hệ thống
Người dùng: Xem sản phẩm, Tìm kiếm, Giỏ hàng, Đặt hàng, Lịch sử đơn hàng cá nhân.

Admin: Dashboard thống kê doanh thu 7 ngày (Biểu đồ Chart.js), Quản lý sản phẩm, Quản lý đơn hàng (Duyệt/Xóa), Quản lý khách hàng.

Tính năng khác: Responsive giao diện (Tailwind CSS), Thông báo thành công/thất bại, Bảo mật phân quyền (Middleware).

💡 Ghi chú dành cho người nhận:
Nếu gặp lỗi liên quan đến file app.blade.php, hãy kiểm tra lại kết nối mạng để tải CDN của Tailwind và FontAwesome.
