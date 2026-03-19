# 🚀 Elite Shop: Professional Full-Stack E-Commerce System

Một hệ thống quản trị bán hàng và thương mại điện tử toàn diện được phát triển bằng **PHP**, tuân thủ nghiêm ngặt kiến trúc **Hybrid MVC**. Dự án sở hữu hệ thống quản lý (CMS) mạnh mẽ dành cho Admin và quy trình mua sắm tối ưu cho khách hàng.

---

## 💎 Điểm Nhấn Hệ Thống (Key Highlights)

* **Professional Admin Dashboard:** Giao diện quản trị hiện đại với các chỉ số thống kê doanh thu, đơn hàng trực quan.
* **Smart Inventory:** Quản lý kho hàng thông minh, hỗ trợ **Live Image Preview** (Xem trước ảnh ngay khi chọn từ thư viện).
* **Hybrid MVC Pattern:** Tách biệt hoàn toàn Logic (Controller), Dữ liệu (Model) và Giao diện (Assets/Inc), giúp hệ thống vận hành mượt mà và dễ mở rộng.
* **High Security:** Bảo mật hệ thống với Prepared Statements, Regex Validation và cơ chế phân quyền Role-based Access Control.

---

## 🌟  Chức Năng

### 🛡️ Trung Tâm Quản Trị (Admin Panel)
Hệ thống CMS chuyên sâu giúp vận hành kinh doanh hiệu quả:
- **Real-time Statistics:** Theo dõi tổng số đơn hàng, đơn hàng chờ duyệt, đơn đã hoàn thành và **tổng doanh thu thực tế** ngay tại màn hình chính.
- **Product Management:** CRUD sản phẩm chuyên nghiệp. Hỗ trợ quản lý số lượng tồn kho, giá bán và danh mục.
- **Category System:** Quản lý phân loại sản phẩm linh hoạt.
- **Order Fulfillment:** Kiểm soát chi tiết từng hóa đơn, cập nhật trạng thái đơn hàng (Pending, Complete, Cancelled) một cách nhanh chóng.
- **User Oversight:** Giám sát toàn bộ danh sách người dùng và vai trò trong hệ thống.

### 🛒 Trải Nghiệm Khách Hàng (User Interface)
- **Seamless Shopping:** Tìm kiếm, lọc sản phẩm theo ngành hàng và xem thông tin chi tiết.
- **Flexible Cart:** Giỏ hàng thông minh lưu trữ qua Session, cập nhật số lượng và tính toán tổng tiền tự động.
- **Standard Checkout:** Quy trình đặt hàng chuẩn với đầy đủ thông tin giao hàng và phương thức thanh toán.
- **Order History:** Người dùng dễ dàng theo dõi hành trình đơn hàng và quản lý tài khoản cá nhân.

---

## 🛠️ Stack Công Nghệ

| Thành phần | Công nghệ sử dụng |
| :--- | :--- |
| **Backend** | PHP 7.4+ (Core), Session Management |
| **Database** | Xampp(Xampp, Prepared Statements) |
| **Frontend** | Bootstrap 5, jQuery, JavaScript |
| **UI/UX** | FontAwesome 6, Google Fonts |
| **Validation** | Regular Expression (Email, Phone) |

---

## 📂 Cấu Trúc Dự Án

* `/controller`: Tiếp nhận yêu cầu và điều hướng xử lý logic.
* `/model`: Định nghĩa cấu trúc dữ liệu OOP cho User, Product, Category.
* `/views`: Các file entry-point của trang web.
* `/assets/inc`: Chứa các thành phần giao diện (Partial Views) giúp tối ưu hóa code.
* `/impl`: Lớp thực thi chi tiết các nghiệp vụ giỏ hàng và thanh toán.
* `db.php`: Kết nối cơ sở dữ liệu tập trung, bảo mật.

---

## 🚀 Cài Đặt Nhanh

1.  Clone mã nguồn vào thư mục web server (`htdocs` hoặc `www`).
2.  Import file `.sql` vào MySQL.
3.  Cấu hình Database tại `db.php`.


---
*Phát triển bởi ❤️ **Khánh Linh**.