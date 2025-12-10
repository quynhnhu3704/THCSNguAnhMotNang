# THCS Ngũ Anh Một Nàng – Phân công chức năng & mô tả hệ thống

## 1. VĂN TIẾN (6 chức năng)

### 1.1. Đăng nhập / Đăng xuất

* `App/Views/common/dangnhap.php`
* `App/Views/common/dangxuat.php`

### 1.2. Cập nhật thông tin cá nhân

* Xem thông tin: `App/Views/common/thongtincanhan.php`
* Sửa thông tin: `App/Views/common/suathongtincanhan.php`
* Nếu sửa tên đăng nhập: tên hiển thị trên menu cập nhật theo.

### 1.3. Thay đổi mật khẩu

* `App/Views/common/thaydoimatkhau.php`
* Đổi xong → tự động đăng xuất để đăng nhập lại bằng mật khẩu mới.

### 1.4. Tìm kiếm thiết bị

* Tìm theo **tên** + **lọc theo bộ môn**
* `App/Views/common/thietbi.php`

### 1.5. Xem chi tiết thiết bị

* `App/Views/common/chitietthietbi.php`
* Có nút **“Thêm vào phiếu mượn”**
* Lưu tạm thiết bị trong **session**

---

## 2. MINH TRUNG (4 chức năng)

### 2.1. Lập kế hoạch thanh lý thiết bị

* Trang: `App/Views/thietbi/kehoachthanhly`
* Chỉ được thanh lý những thiết bị có `tinhTrang = "Thanh lý"`
* Thiết bị có trạng thái "Thanh lý" là do:

  * NV thiết bị báo hỏng
  * NV kỹ thuật xác nhận `"Không thể sửa"` trong **yeucauscbtbh**
  * → chitietthietbi tự đổi sang `"Thanh lý"`
* Kế hoạch **đã duyệt (Chấp thuận / Từ chối)** → **không được xóa**

### 2.2. Duyệt kế hoạch thanh lý (Hiệu trưởng)

* `App/Views/hieutruong/kehoachthanhly`
* Nếu trạng thái:

  * `"Chờ duyệt"` → chỉ hiển thị **chữ ký người lập**
  * `"Chấp thuận"` hoặc `"Từ chối"` → hiển thị thêm **chữ ký hiệu trưởng**

### 2.3. Báo cáo thống kê

* `App/Views/thietbi/baocaothongke.php`
* `App/Views/hieutruong/baocao.php`
* Lấy biểu đồ từ dữ liệu trong CSDL (không lập báo cáo thủ công).

---

## 3. TRỌNG THUẦN (4 chức năng)

### 3.1. Lập kế hoạch mua sắm thiết bị

* `App/Views/totruong/kehoachmuasam`
* Quy tắc:

  * NV thiết bị: mua bất cứ thiết bị nào
  * Tổ trưởng: chỉ mua thiết bị thuộc **bộ môn của mình**
  * Kế hoạch **đã duyệt** → không được xóa

### 3.2. Duyệt kế hoạch mua sắm (Hiệu trưởng)

* `App/Views/hieutruong/kehoachmuasam`
* Hiển thị chữ ký giống chức năng duyệt thanh lý.

### 3.3. Xem thông tin giáo viên bộ môn (Tổ trưởng)

* `App/Views/totruong/thongtin_giaovienbomon`
* Lọc:

  * `vaiTro = "Giáo viên bộ môn"`
  * `boMon = boMon` của tổ trưởng đang đăng nhập

### 3.4. Xem thông tin giáo viên/nhân viên (Hiệu trưởng)

* `App/Views/hieutruong/thongtin_giaovien_nhanvien`
* **Không** lấy những user có `vaiTro = "Hiệu trưởng"`

---

## 4. ĐIỀN THỊNH (4 chức năng)

### 4.1. Quản lý thiết bị

* `App/Views/thietbi/qlthietbi`
* Khi thêm thiết bị số lượng **n** → tự tạo **n bản ghi chitietthietbi**
* Số lượng tối đa mỗi thiết bị: **3**
* Khi sửa:

  * Tăng SL → tự thêm chitietthietbi trạng thái `"Khả dụng"`
  * Giảm SL → xóa chitietthietbi `"Khả dụng"`
  * Không còn bản ghi khả dụng → không cho giảm
* Khi xóa:

  * Nếu thiết bị đang nằm trong phiếu mượn hoặc kế hoạch thanh lý → cấm xóa

### 4.2. Ghi nhận báo hỏng thiết bị

* `App/Views/thietbi/baohong`
* Chỉ thiết bị `"Khả dụng"` mới được báo hỏng
* Khi báo hỏng:

  * chitietthietbi → `"Báo hỏng"`
  * Tự động thêm vào danh sách xử lý SC/BT/BH của Văn Quân

### 4.3. Quản lý bộ môn

* `App/Views/thietbi/qlbomon`
* Nếu bộ môn đang dùng ở bảng **thietbi** hoặc **nguoidung**:

  * Không được xóa
  * Chỉ được sửa tên

### 4.4. Xem thiết bị bộ môn (Tổ trưởng)

* `App/Views/totruong/thietbi_bomon`
* Chỉ lấy thiết bị thuộc bộ môn của tổ trưởng

---

## 5. QUỲNH NHƯ (5 chức năng)

### 5.1. Đăng ký mượn thiết bị

* Thêm mới phiếu mượn + chọn thiết bị

### 5.2. Quản lý phiếu mượn

* `App/Views/...`
* Quy tắc:

  * Thiết bị trong phiếu mượn → chitietthietbi = `"Đang mượn"`
  * Khi phiếu mượn đặt trạng thái `"Đã trả"` → chuyển về `"Khả dụng"`

### 5.3. Quản lý nhà cung cấp

### 5.4. Xem phiếu mượn

### 5.5. Xem phiếu mượn bộ môn

---

## 6. VĂN QUÂN (4 chức năng)

### 6.1. Ghi nhận SC/BT/BH

* `App/Views/thietbi/ghinhanscbtbh/dsghinhan.php`
* Thiết bị báo hỏng từ nhân viên thiết bị sẽ tự động xuất hiện tại đây.

### 6.2. Cập nhật tiến độ SC/BT/BH

* `App/Views/thietbi/ghinhanscbtbh`
* Quy tắc:

  * `"Không thể sửa"` → chitietthietbi = `"Thanh lý"`
  * `"Đã sửa"` → `"Khả dụng"`
  * Còn lại → giữ `"Báo hỏng"`

### 6.3. Quản lý người dùng

* `App/Views/admin/qlnguoidung`
* Ẩn admin khỏi danh sách (admin tự sửa thông tin cá nhân riêng).

### 6.4. Phân quyền

* `App/Views/admin/phanquyen`
* Admin **không được phân quyền cho chính mình**.