# Tài khoản đăng nhập hệ thống

(Mật khẩu chung cho tất cả tài khoản)
**Mật khẩu:** `Nguanhmotnang123@`

---

## Hiệu trưởng
- Tên đăng nhập: `hieutruong`

## Tổ trưởng chuyên môn
- `toan_tt`
- `van_tt`
- `anh_tt`
- `ly_tt`
- `hoa_tt`
- `sinh_tt`
- `su_tt`
- `dia_tt`
- `mythuat_tt`
- `amnhac_tt`

## Giáo viên bộ môn
- Ví dụ: `toan_gv1`, `toan_gv2`
- Các môn khác tương tự: `van_gv1`, `anh_gv1`, `ly_gv1`, ...

## Nhân viên quản lý thiết bị
- `qltb1`
- `qltb2`

## Nhân viên kỹ thuật
- `kythuat1`
- `kythuat2`

## Quản trị hệ thống
- `admin`

# Phân công chức năng - Đồ án quản lý thiết bị trường học

## VĂN TIẾN (6 chức năng)
- **Đăng nhập**  
  `App/Views/common/dangnhap.php`
- **Đăng xuất**  
  `App/Views/common/dangxuat.php`
- **Cập nhật thông tin cá nhân**  
  `App/Views/common/thongtincanhan.php`  
  `App/Views/common/suathongtincanhan.php`  
  => Nếu sửa tên đăng nhập thì tên đăng nhập ở trên menu sẽ đổi theo
- **Thay đổi mật khẩu**  
  `App/Views/common/thaydoimatkhau.php`  
  => Đổi mật khẩu xong thì đăng xuất cho đăng nhập lại với mật khẩu mới
- **Tìm kiếm thiết bị** (theo tên + lọc theo bộ môn)  
  `App/Views/common/thietbi.php`
- **Xem chi tiết thiết bị**  
  `App/Views/common/chitietthietbi.php`  
  => Tích hợp nút "Thêm vào phiếu mượn" và chức năng lưu tạm session

## MINH TRUNG (4 chức năng)
- **Lập kế hoạch mua sắm thiết bị** (tìm kiếm + thêm + xem + xóa)  
  `App/Views/totruong/kehoachmuasam`  
  Nhân viên thiết bị thì muốn mua cái gì cũng được, tổ trưởng chuyên môn thì chỉ được mua những thiết bị thuộc bộ môn của họ thôi. Những kế hoạch đã được hiệu trưởng duyệt (`trangThai = Chấp thuận/Từ chối`) sẽ không thể xóa.
- **Lập kế hoạch thanh lý thiết bị** (tìm kiếm + thêm + xem + xóa)  
  `App/Views/thietbi/kehoachthanhly`  
  Chỉ được thanh lý những thiết bị có `tinhTrang = "Thanh lý"` (đi theo luồng từ chức năng của ông Thịnh và ông Quân: nhân viên thiết bị báo hỏng rồi nhân viên kỹ thuật sửa không được nữa => trong bảng `yeucauscbtbh` đổi `tienDo = "Không thể sửa"` => trong bảng `chitietthietbi` tự động đổi `tinhTrang = "Thanh lý"`). Những kế hoạch đã được hiệu trưởng duyệt (`trangThai = Chấp thuận/Từ chối`) sẽ không thể xóa.
- **Báo cáo thống kê**  
  `App/Views/thietbi/baocaothongke.php` và `App/Views/hieutruong/baocao.php`  
  Chức năng này ban đầu có lập nhưng cô Trang bảo chỉ cần source biểu đồ từ cơ sở dữ liệu sẵn có thôi, không có lập thủ công. Tui nhờ AI làm giùm rồi sửa lại xíu, tui vẫn chưa hiểu lắm, nhưng cái này không phải chức năng quan trọng nên không ai hỏi đâu, chứ tự làm chắc 1 tuần chưa xong =)))

## TRỌNG THUẦN (4 chức năng)
- **Duyệt kế hoạch mua sắm thiết bị** (cập nhật)  
  `App/Views/hieutruong/kehoachmuasam`  
  Duyệt bình thường, nếu `trangThai = Chấp thuận/Từ chối` thì khi ấn "Xem" sẽ xuất hiện thêm chữ ký hiệu trưởng, còn nếu "Chờ duyệt" thì chỉ có chữ ký người lập.
- **Duyệt kế hoạch thanh lý thiết bị** (cập nhật)  
  `App/Views/hieutruong/kehoachthanhly`  
  Duyệt bình thường, nếu `trangThai = Chấp thuận/Từ chối` thì khi ấn "Xem" sẽ xuất hiện thêm chữ ký hiệu trưởng, còn nếu "Chờ duyệt" thì chỉ có chữ ký người lập.
- **Quản lý nhà cung cấp** (tìm kiếm + xem + thêm + xóa + sửa)
- **Xem thiết bị bộ môn**  
  `App/Views/totruong/thietbi_bomon`  
  Chức năng này của tổ trưởng chuyên môn, chỉ lấy những thiết bị có `boMon` = bộ môn của tổ trưởng đang đăng nhập.

## ĐIỀN THỊNH (4 chức năng)
- **Quản lý thiết bị** (tìm kiếm + xem + thêm + xóa + sửa)  
  `App/Views/thietbi/qlthietbi`  
  Khi thêm 1 thiết bị mới với số lượng = 3 (ví dụ thôi) thì sẽ tự động tạo ra 3 bản ghi `chitietthietbi` (vì mình cần quản lý `tinhTrang` của từng cái). Số lượng tối đa của mỗi thiết bị = 3 (để dễ quản lý). Khi sửa: nếu tăng số lượng => tự động thêm 1 bản ghi `chitietthietbi` với `tinhTrang = "Khả dụng"`, nếu giảm số lượng => tự động xóa 1 bản ghi `chitietthietbi` với `tinhTrang = "Khả dụng"` (nếu không còn bản ghi nào "Khả dụng" thì thông báo không cho giảm nữa). Khi xóa thiết bị thì nếu `chitietthietbi` đó có trong phiếu mượn hay kế hoạch thanh lý nào thì thông báo không thể xóa do còn đang được sử dụng. Ông đọc thêm mô tả chức năng "Quản lý phiếu mượn" của Quỳnh Như và chức năng "Ghi nhận SC/BT/BH" với "Cập nhật tiến độ SC/BT/BH" của Văn Quân để hiểu thêm nha.
- **Ghi nhận báo hỏng thiết bị** (cập nhật)  
  `App/Views/thietbi/baohong`  
  Đổi `tinhTrang` trong bảng `chitietthietbi` thành "Báo hỏng", sau đó sẽ tự động được thêm vào chức năng "Ghi nhận SC/BT/BH" của Văn Quân (ông có thể đọc mô tả ở dưới). Chỉ những thiết bị có `tinhTrang = "Khả dụng"` mới được báo hỏng.
- **Xem thông tin giáo viên bộ môn**  
  `App/Views/totruong/thongtin_giaovienbomon`  
  Chức năng của tổ trưởng chuyên môn, chỉ lấy `vaiTro = "Giáo viên bộ môn"` và `boMon` = bộ môn của tổ trưởng chuyên môn đang đăng nhập.
- **Xem thông tin giáo viên/nhân viên**  
  `App/Views/hieutruong/thongtin_giaovien_nhanvien`  
  Chức năng của hiệu trưởng, không được lấy `vaiTro = "Hiệu trưởng"` (vì ổng tự xem ổng làm gì?).

## QUỲNH NHƯ (5 chức năng)
- **Đăng ký mượn thiết bị** (thêm)
- **Quản lý phiếu mượn** (tìm kiếm + xem + thêm + xóa + sửa)  
  Thiết bị nào đã được lập trong phiếu mượn thì `tinhTrang = "Đang mượn"`, khi phiếu mượn được set `tinhTrang = "Đã trả"` thì tự động `tinhTrang = "Khả dụng"` trong bảng `chitietthietbi`.
- **Quản lý bộ môn** (tìm kiếm + xem + thêm + xóa + sửa)  
  `App/Views/thietbi/qlbomon`  
  Quản lý bình thường thôi, nếu bộ môn đang được sử dụng (làm khóa ngoại cho bảng `thietbi` và `nguoidung`) thì chỉ được đổi tên chứ không được xóa.
- **Xem phiếu mượn**
- **Xem phiếu mượn bộ môn**

## VĂN QUÂN (4 chức năng)
- **Ghi nhận SC/BT/BH** (cập nhật)  
  `App/Views/thietbi/ghinhanscbtbh/dsghinhan.php`  
  Những `chitietthietbi` nào được nhân viên thiết bị báo hỏng thì sẽ tự động add vào đây, nhân viên thiết bị chọn yêu cầu (sửa chữa/bảo trì/bảo hành), tiếp theo chuyển tiếp cho nhân viên kỹ thuật.
- **Cập nhật tiến độ SC/BT/BH** (cập nhật)  
  `App/Views/thietbi/ghinhanscbtbh`  
  Cập nhật trường `tienDo`:  
  - Nếu `tienDo = "Không thể sửa"` => tự động `tinhTrang = "Thanh lý"`  
  - Nếu `tienDo = "Đã sửa"` => tự động `tinhTrang = "Khả dụng"`  
  - Còn lại thì vẫn `tinhTrang = "Báo hỏng"`
- **Quản lý người dùng** (tìm kiếm + xem + thêm + xóa + sửa)  
  `App/Views/admin/qlnguoidung`  
  Đã ẩn tài khoản admin (admin muốn sửa thông tin thì sửa ở phần cập nhật thông tin cá nhân và thay đổi mật khẩu).
- **Phân quyền** (cập nhật)  
  `App/Views/admin/phanquyen`  
  Admin cũng không được phân quyền cho chính mình luôn, lỡ phân nhầm sang quyền khác thì hệ thống mất admin luôn =)))))