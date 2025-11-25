-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 25, 2025 lúc 09:32 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE thcs_nguanhmotnang;

--
-- Cơ sở dữ liệu: `thcs_nguanhmotnang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bomon`
--

CREATE TABLE `bomon` (
  `maBoMon` int(11) NOT NULL,
  `tenBoMon` varchar(100) NOT NULL,
  `moTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bomon`
--

INSERT INTO `bomon` (`maBoMon`, `tenBoMon`, `moTa`) VALUES
(1, 'Toán học', 'Giảng dạy toán học cơ bản và nâng cao tư duy.'),
(2, 'Ngữ văn', 'Học đọc, viết và phân tích văn học.'),
(3, 'Tiếng Anh', 'Nghe, nói, đọc, viết tiếng Anh cơ bản.'),
(4, 'Vật lý', 'Cơ sở vật lý và thí nghiệm đơn giản.'),
(5, 'Hóa học', 'Kiến thức hóa học cơ bản và thí nghiệm.'),
(6, 'Sinh học', 'Sinh học cơ bản, môi trường và sinh thái.'),
(7, 'Lịch sử', 'Lịch sử Việt Nam và lịch sử thế giới cơ bản.'),
(8, 'Địa lý', 'Địa lý tự nhiên, kinh tế và xã hội.'),
(9, 'Mỹ thuật', 'Vẽ, tạo hình và cảm thụ nghệ thuật.'),
(10, 'Âm nhạc', 'Học nhạc lý cơ bản, hát và cảm thụ âm nhạc.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietthietbi`
--

CREATE TABLE `chitietthietbi` (
  `maChiTietTB` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `tinhTrang` varchar(50) NOT NULL DEFAULT 'Khả dụng',
  `ghiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietthietbi`
--

INSERT INTO `chitietthietbi` (`maChiTietTB`, `maThietBi`, `tinhTrang`, `ghiChu`) VALUES
(1, 1, 'Khả dụng', 'Dùng tốt, không lỗi.'),
(2, 1, 'Đang mượn', 'Đang được mượn phục vụ giảng dạy.'),
(3, 1, 'Báo hỏng', 'Hỏng do sử dụng lâu ngày.'),
(4, 2, 'Khả dụng', 'Dùng tốt, không lỗi.'),
(5, 2, 'Đang mượn', 'Đang được mượn phục vụ bài kiểm tra.'),
(6, 2, 'Báo hỏng', 'Hỏng do rơi vỡ.'),
(7, 3, 'Khả dụng', 'Trang sách còn mới.'),
(8, 3, 'Đang mượn', 'Giáo viên Ngữ văn mượn sử dụng.'),
(9, 3, 'Báo hỏng', 'Rách gáy, cần sửa.'),
(10, 4, 'Khả dụng', 'Không trầy xước.'),
(11, 4, 'Đang mượn', 'Mượn trong tiết Ngữ văn.'),
(12, 4, 'Báo hỏng', 'Bị cong góc.'),
(13, 5, 'Khả dụng', 'Sách còn rất mới.'),
(14, 5, 'Đang mượn', 'HS lớp 7 mượn nghiên cứu.'),
(15, 5, 'Báo hỏng', 'Sách bị ướt, nhòe chữ.'),
(16, 6, 'Khả dụng', 'Âm thanh hoạt động bình thường.'),
(17, 6, 'Đang mượn', 'Dùng trong giờ sinh hoạt.'),
(18, 6, 'Báo hỏng', 'Pin chai, không bật được.'),
(19, 7, 'Khả dụng', 'Đo chính xác.'),
(20, 7, 'Đang mượn', 'Tổ Lý mượn thực hành.'),
(21, 7, 'Báo hỏng', 'Nứt màn hình.'),
(22, 8, 'Khả dụng', 'Dùng tốt.'),
(23, 8, 'Đang mượn', 'Mượn cho tiết Vật lý.'),
(24, 8, 'Báo hỏng', 'Dây treo bị đứt.'),
(25, 9, 'Khả dụng', 'Không rò rỉ.'),
(26, 9, 'Đang mượn', 'Dùng trong thí nghiệm cháy.'),
(27, 9, 'Báo hỏng', 'Bị nứt bình cồn.'),
(28, 10, 'Khả dụng', 'Đo chính xác.'),
(29, 10, 'Đang mượn', 'GV Hóa đang sử dụng.'),
(30, 10, 'Báo hỏng', 'Đầu đo gãy.'),
(31, 11, 'Khả dụng', 'Kính trong, rõ.'),
(32, 11, 'Đang mượn', 'Dùng trong giờ Sinh học.'),
(33, 11, 'Báo hỏng', 'Bị lệch trục quang.'),
(34, 12, 'Khả dụng', 'Đầy đủ chi tiết.'),
(35, 12, 'Đang mượn', 'Tổ Sinh đang sử dụng.'),
(36, 12, 'Báo hỏng', 'Thiếu 1 chi tiết nhỏ.'),
(37, 13, 'Khả dụng', 'Hình ảnh rõ.'),
(38, 13, 'Đang mượn', 'GV Lịch sử đang dùng.'),
(39, 13, 'Báo hỏng', 'Rách mép giấy bên phải.'),
(40, 14, 'Khả dụng', 'Băng chạy tốt.'),
(41, 14, 'Đang mượn', 'HS lớp 8 dùng cho bài thuyết trình.'),
(42, 14, 'Báo hỏng', 'Băng bị rối, không tua được.'),
(43, 15, 'Khả dụng', 'Quả cầu xoay mượt.'),
(44, 15, 'Đang mượn', 'GV Địa lý mượn.'),
(45, 15, 'Báo hỏng', 'Trục xoay cứng.'),
(46, 16, 'Khả dụng', 'Không cong mép.'),
(47, 16, 'Đang mượn', 'Dùng trong tiết Địa lý.'),
(48, 16, 'Báo hỏng', 'Bị ố màu chỗ viền.'),
(49, 17, 'Khả dụng', 'Màu còn đầy.'),
(50, 17, 'Đang mượn', 'HS lớp 6 đang dùng.'),
(51, 17, 'Báo hỏng', 'Hộp bị gãy nắp.'),
(52, 18, 'Khả dụng', 'Chưa sử dụng nhiều.'),
(53, 18, 'Đang mượn', 'GV Mỹ thuật đang dùng.'),
(54, 18, 'Báo hỏng', 'Một lọ màu bị khô.'),
(55, 19, 'Khả dụng', 'Âm thanh ổn định.'),
(56, 19, 'Đang mượn', 'Dùng cho buổi sinh hoạt lớp.'),
(57, 19, 'Báo hỏng', 'Rách mặt trống.'),
(58, 20, 'Khả dụng', 'Phím đàn nhạy tốt.'),
(59, 20, 'Đang mượn', 'GV Âm nhạc đang luyện đàn.'),
(60, 20, 'Báo hỏng', 'Một phím bị kẹt.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(11) NOT NULL,
  `tenDangNhap` varchar(255) NOT NULL,
  `matKhau` varchar(255) NOT NULL,
  `hoTen` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `soDienThoai` varchar(255) DEFAULT NULL,
  `maBoMon` int(11) DEFAULT NULL,
  `maVaiTro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `tenDangNhap`, `matKhau`, `hoTen`, `email`, `soDienThoai`, `maBoMon`, `maVaiTro`) VALUES
(1, 'hieutruong', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn Hiệu', 'hieutruong@truong.edu.vn', '0901000001', NULL, 1),
(2, 'toan_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Minh Toán', 'toan_tt@truong.edu.vn', '0902000001', 1, 2),
(3, 'van_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Văn', 'van_tt@truong.edu.vn', '0902000002', 2, 2),
(4, 'anh_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Hồng Anh', 'anh_tt@truong.edu.vn', '0902000003', 3, 2),
(5, 'ly_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Quốc Lý', 'ly_tt@truong.edu.vn', '0902000004', 4, 2),
(6, 'hoa_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Văn Hóa', 'hoa_tt@truong.edu.vn', '0902000005', 5, 2),
(7, 'sinh_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Lan Sinh', 'sinh_tt@truong.edu.vn', '0902000006', 6, 2),
(8, 'su_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Phan Quốc Sử', 'su_tt@truong.edu.vn', '0902000007', 7, 2),
(9, 'dia_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Lý Hải Địa', 'dia_tt@truong.edu.vn', '0902000008', 8, 2),
(10, 'mythuat_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Trịnh Mỹ Thuật', 'mythuat_tt@truong.edu.vn', '0902000009', 9, 2),
(11, 'amnhac_tt', 'e10adc3949ba59abbe56e057f20f883e', 'Vũ Thanh Nhạc', 'amnhac_tt@truong.edu.vn', '0902000010', 10, 2),
(12, 'toan_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Văn Số', 'toan_gv1@truong.edu.vn', '0903000001', 1, 3),
(13, 'toan_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Thị Hàm', 'toan_gv2@truong.edu.vn', '0903000002', 1, 3),
(14, 'van_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Minh Thơ', 'van_gv1@truong.edu.vn', '0903000003', 2, 3),
(15, 'van_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Ngọc Vân', 'van_gv2@truong.edu.vn', '0903000004', 2, 3),
(16, 'anh_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thu Hương', 'anh_gv1@truong.edu.vn', '0903000005', 3, 3),
(17, 'anh_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Hoàng Minh Quân', 'anh_gv2@truong.edu.vn', '0903000006', 3, 3),
(18, 'ly_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Phan Quốc Bảo', 'ly_gv1@truong.edu.vn', '0903000007', 4, 3),
(19, 'ly_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Hằng', 'ly_gv2@truong.edu.vn', '0903000008', 4, 3),
(20, 'hoa_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Lưu Hồng Hoa', 'hoa_gv1@truong.edu.vn', '0903000009', 5, 3),
(21, 'hoa_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Tiến Dũng', 'hoa_gv2@truong.edu.vn', '0903000010', 5, 3),
(22, 'sinh_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Bích Hạnh', 'sinh_gv1@truong.edu.vn', '0903000011', 6, 3),
(23, 'sinh_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Văn Sinh', 'sinh_gv2@truong.edu.vn', '0903000012', 6, 3),
(24, 'su_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Phan Thị Sửu', 'su_gv1@truong.edu.vn', '0903000013', 7, 3),
(25, 'su_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Quốc Việt', 'su_gv2@truong.edu.vn', '0903000014', 7, 3),
(26, 'dia_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Thanh Bình', 'dia_gv1@truong.edu.vn', '0903000015', 8, 3),
(27, 'dia_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Hà Địa', 'dia_gv2@truong.edu.vn', '0903000016', 8, 3),
(28, 'mythuat_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Trịnh Ngọc Vẽ', 'mythuat_gv1@truong.edu.vn', '0903000017', 9, 3),
(29, 'mythuat_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Mỹ Linh', 'mythuat_gv2@truong.edu.vn', '0903000018', 9, 3),
(30, 'amnhac_gv1', 'e10adc3949ba59abbe56e057f20f883e', 'Vũ Hoàng Ca', 'amnhac_gv1@truong.edu.vn', '0903000019', 10, 3),
(31, 'amnhac_gv2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Minh Âm', 'amnhac_gv2@truong.edu.vn', '0903000020', 10, 3),
(32, 'qltb1', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Quản Lý', 'qltb1@truong.edu.vn', '0904000001', NULL, 4),
(33, 'qltb2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thiết Bị', 'qltb2@truong.edu.vn', '0904000002', NULL, 4),
(34, 'kythuat1', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Kỹ', 'kythuat1@truong.edu.vn', '0905000001', NULL, 5),
(35, 'kythuat2', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Công Nghệ', 'kythuat2@truong.edu.vn', '0905000002', NULL, 5),
(36, 'admin', '0192023a7bbd73250516f069df18b500', 'Trần Quốc Hệ', 'admin@truong.edu.vn', '0909000001', NULL, 6),
(50, 'nguanhmotnang', 'e10adc3949ba59abbe56e057f20f883e', 'Ngũ Anh Một Nàng', 'nguanhmotnang@gmail.com', '0908000003', NULL, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `maNhaCungCap` int(11) NOT NULL,
  `tenNhaCungCap` varchar(100) NOT NULL,
  `diaChi` varchar(255) DEFAULT NULL,
  `soDienThoai` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`maNhaCungCap`, `tenNhaCungCap`, `diaChi`, `soDienThoai`, `email`) VALUES
(1, 'ToolPro', '123 Trần Hưng Đạo, TP.HCM', '0901123456', 'contact@toolpro.vn'),
(2, 'Alpha Solutions', '45 Nguyễn Văn Linh, Đà Nẵng', '0934567890', 'info@alphasolutions.vn'),
(3, 'NovaTech', '88 Hai Bà Trưng, Hà Nội', '0978123456', 'support@novatech.vn'),
(4, 'Platform E', '12 Lê Lợi, Huế', '0903456789', 'sales@platforme.vn'),
(5, 'GeniusKit', '67 Phan Đình Phùng, Đà Lạt', '0987654321', 'hello@geniuskit.vn'),
(6, 'Ascend Việt', '25 Cách Mạng Tháng 8, TP.HCM', '0912345678', 'contact@ascendviet.vn'),
(7, 'EduCore', '14 Nguyễn Huệ, Hà Nội', '0932123456', 'info@educore.vn'),
(8, 'Focus EQ', '78 Pasteur, TP.HCM', '0908234567', 'team@focuseq.vn'),
(9, 'Logic Supply', '33 Lý Thường Kiệt, Đà Nẵng', '0967123456', 'support@logicsupply.vn'),
(10, 'Innovate Corp', '59 Võ Văn Tần, TP.HCM', '0923456789', 'info@innovatecorp.vn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thietbi`
--

CREATE TABLE `thietbi` (
  `maThietBi` int(11) NOT NULL,
  `tenThietBi` varchar(255) NOT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL,
  `donVi` varchar(50) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `lop` varchar(50) NOT NULL,
  `maBoMon` int(11) NOT NULL,
  `maNhaCungCap` int(11) NOT NULL,
  `moTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thietbi`
--

INSERT INTO `thietbi` (`maThietBi`, `tenThietBi`, `hinhAnh`, `donVi`, `soLuong`, `lop`, `maBoMon`, `maNhaCungCap`, `moTa`) VALUES
(1, 'Bộ compa và thước kẻ học sinh Maped', 'bo_compa_thuoc_ke_maped.jpg', 'Bộ', 3, '6,7,8,9', 1, 1, 'Bộ compa và thước kẻ Maped, chất lượng cao, gồm các dụng cụ cơ bản phục vụ các tiết học hình học, giúp học sinh vẽ đường thẳng, đo góc, luyện kỹ năng toán học, đảm bảo an toàn và chính xác.'),
(2, 'Máy tính cầm tay Casio FX-580VN X', 'may_tinh_casio_fx580vnx.jpg', 'Chiếc', 3, '8,9', 1, 2, 'Máy tính Casio FX-580VN X, phục vụ các tiết học toán đại số, hình học, thống kê, giúp học sinh thực hiện các phép tính phức tạp nhanh chóng và chính xác.'),
(3, 'Sách tham khảo Ngữ văn THCS – Cambridge Edition', 'sach_tham_khao_ngu_van_thcs_cambridge.jpg', 'Bộ', 3, '6,7,8,9', 2, 3, 'Sách tham khảo Ngữ văn THCS – Cambridge Edition, cung cấp kiến thức bổ sung cho chương trình chính khóa, hướng dẫn phân tích văn bản, soạn bài, bài tập nâng cao, giải thích ngữ nghĩa, bài học mở rộng về văn học thế giới và Việt Nam, giúp học sinh phát triển kỹ năng đọc hiểu, viết luận, tư duy phản biện và cảm thụ văn học một cách sâu sắc.'),
(4, 'Tranh minh họa các tác phẩm văn học ArtMaster', 'tranh_van_hoc.jpg', 'Tấm', 3, '7,8,9', 2, 4, 'Tranh minh họa ArtMaster, giúp học sinh hình dung bối cảnh, nhân vật, cốt truyện các tác phẩm văn học, tăng hứng thú học tập, phát triển khả năng tư duy, sáng tạo và phân tích văn học.'),
(5, 'Từ điển tiếng Anh Oxford Advanced Learner', 'tu_dien_oxford_advanced.jpg', 'Cuốn', 3, '6,7', 3, 5, 'Từ điển Oxford Advanced Learner’s Dictionary 10th Edition, xuất bản bởi Oxford University Press, hỗ trợ học sinh học từ vựng, ngữ pháp, phát âm, cải thiện kỹ năng đọc, viết, nghe, nói trong học tập tiếng Anh.'),
(6, 'Loa Bluetooth mini JBL GO 3 Portable', 'loa_bluetooth_jbl_go3.jpg', 'Chiếc', 3, '8,9', 3, 6, 'Loa Bluetooth mini JBL GO 3 Portable, thiết kế nhỏ gọn, âm thanh rõ ràng, công suất phù hợp lớp học, phục vụ phát nhạc, nghe bài giảng, luyện nghe tiếng Anh, thuyết trình, hoạt động học tập nhóm, và nâng cao trải nghiệm âm nhạc, thính giác cho học sinh.'),
(7, 'Đồng hồ đo điện đa năng Fluke 115', 'dong_ho_do_dien_fluke_115.jpg', 'Cái', 3, '8,9', 4, 7, 'Đồng hồ đo điện đa năng Fluke 115, phục vụ đo điện áp AC/DC, dòng điện, điện trở, kiểm tra mạch, đảm bảo an toàn và chính xác cho học sinh thực hành điện – điện tử.'),
(8, 'Con lắc đơn PCE Instruments PL-100', 'con_lac_don_pl100.jpg', 'Cái', 3, '7,8,9', 4, 8, 'Con lắc đơn PCE Instruments PL-100, phục vụ thí nghiệm dao động cơ học, định luật con lắc, đo chu kỳ, biên độ, giúp học sinh nghiên cứu hiện tượng vật lý cơ bản về chuyển động điều hòa.'),
(9, 'Đèn cồn Bunsen LABTECH Classic', 'den_con_labtech.jpg', 'Cái', 3, '8,9', 5, 9, 'Đèn cồn Bunsen LABTECH Classic, thiết kế bền chắc, chất lượng cao, phục vụ thí nghiệm hóa học, đốt cồn an toàn, làm nóng mẫu, thử phản ứng hóa học, luyện tập kỹ năng thao tác phòng thí nghiệm, giảng dạy thực hành cho học sinh, và đảm bảo an toàn tối đa trong quá trình học tập.'),
(10, 'Nhiệt kế Timemore X1 Precision', 'nhiet_ke_timemore_x1.jpg', 'Cái', 3, '8,9', 5, 10, 'Nhiệt kế Timemore X1 Precision, dùng đo nhiệt độ chính xác trong các thí nghiệm vật lý, hóa học và sinh học, giúp học sinh học cách kiểm soát nhiệt độ và thực hành đo lường khoa học.'),
(11, 'Kính hiển vi học sinh Olympus CX23 Edu', 'kinh_hien_vi_olympus_cx23.jpg', 'Chiếc', 3, '8,9', 6, 1, 'Kính hiển vi học sinh Olympus CX23 Edu, sản phẩm chính hãng Olympus, hỗ trợ quan sát mẫu vật sinh học nhỏ, học sinh thực hành xem tế bào, mô và vật thể nhỏ, nâng cao kỹ năng quan sát, ghi chép, phân tích mẫu vật, thực hiện thí nghiệm khoa học, và phát triển hiểu biết về sinh học cơ bản và thực hành phòng lab.'),
(12, 'Mô hình cơ thể người 4D Anatomical', 'mo_hinh_co_the_nguoi_4d.jpg', 'Bộ', 3, '6,7,8,9', 6, 2, 'Mô hình cơ thể người 4D Anatomical, chi tiết, phục vụ giảng dạy giải phẫu học, sinh học, giúp học sinh hình dung các cơ quan, hệ thống cơ thể và tương tác 3D trực quan, nâng cao khả năng học tập thực tế.'),
(13, 'Bản đồ lịch sử Việt Nam – National Geographic', 'ban_do_lich_su_vn_chi_tiet.jpg', 'Tấm', 3, '6,7,8,9', 7, 3, 'Bản đồ lịch sử Việt Nam chi tiết, xuất bản bởi National Geographic, phục vụ học sinh quan sát các giai đoạn lịch sử, triều đại, sự kiện, thay đổi biên giới qua các thời kỳ, hỗ trợ nghiên cứu lịch sử, so sánh các giai đoạn phát triển văn hóa và chính trị, nâng cao khả năng đọc bản đồ và hiểu biết về lịch sử Việt Nam.'),
(14, 'Băng cassette tư liệu lịch sử Sony HF-S90', 'bang_cassette_lich_su_sony_hfs90.jpg', 'Cuộn', 3, '6,7,8,9', 7, 4, 'Băng cassette Sony HF-S90 ghi âm tư liệu lịch sử, bài giảng, thuyết minh và âm thanh minh họa phục vụ học sinh học môn lịch sử, giúp nghe, ghi nhớ và phân tích các sự kiện lịch sử quan trọng.'),
(15, 'Quả địa cầu Celestron Globe', 'qua_dia_cau_celestron.jpg', 'Cái', 3, '6,7,8,9', 8, 5, 'Quả địa cầu Celestron Globe, sản phẩm chất lượng cao từ Celestron, giúp học sinh hình dung vị trí địa lý, hướng lục địa, quốc gia, đại dương, phục vụ bài học địa lý, thiên văn học, nghiên cứu khoa học, và phát triển khả năng quan sát không gian.'),
(16, 'Bản đồ địa hình Việt Nam – National Geographic', 'ban_do_dia_hinh_vn_chi_tiet.jpg', 'Tấm', 3, '7,8,9', 8, 6, 'Bản đồ địa hình Việt Nam chi tiết, xuất bản bởi National Geographic, phục vụ giảng dạy địa lý tự nhiên, phân tích địa hình, nghiên cứu vùng miền, giúp học sinh so sánh đặc điểm địa lý của các tỉnh, vùng miền khác nhau, nâng cao kỹ năng đọc bản đồ và hiểu biết về địa lý.'),
(17, 'Bút màu học sinh Faber-Castell Grip', 'but_mau_faber_castell_12.jpg', 'Hộp', 3, '6,7,8,9', 9, 7, 'Bút màu học sinh Faber-Castell Grip, sản phẩm chính hãng Faber-Castell, thiết kế tiện cầm, giúp học sinh vẽ và phối màu trong các tiết học mỹ thuật, phát triển khả năng sáng tạo, phối hợp màu sắc, thực hành kỹ thuật vẽ cơ bản và nâng cao, đồng thời hỗ trợ rèn luyện tính tỉ mỉ và sự khéo léo của học sinh.'),
(18, 'Màu nước Crayola Washable Artist Set', 'mau_nuoc_crayola_24.jpg', 'Hộp', 3, '8,9', 9, 8, 'Màu nước Crayola Washable Artist Set, sản phẩm chính hãng Crayola, gồm 24 màu cơ bản, dụng cụ vẽ giúp học sinh thực hành hội họa, sáng tạo tác phẩm, phối hợp màu sắc, phát triển kỹ năng thẩm mỹ và nghệ thuật, đồng thời an toàn, dễ rửa sạch và phù hợp cho các hoạt động mỹ thuật trong lớp học.'),
(19, 'Đàn trống nhỏ học sinh Remo Rhythm Club', 'trong_nho_remo.jpg', 'Cái', 3, '6,7', 10, 9, 'Đàn trống nhỏ học sinh Remo Rhythm Club, nhạc cụ bộ gõ chất lượng cao, phục vụ các tiết học âm nhạc, giúp học sinh luyện nhịp điệu, phối hợp tay chân, phát triển kỹ năng cảm thụ âm nhạc, tăng sự hứng thú, khả năng sáng tạo và tham gia các hoạt động nhóm trong lớp học.'),
(20, 'Đàn piano cơ YAMAHA U1J PE Professional', 'piano_yamaha_u1j_pe.jpg', 'Cái', 3, '8,9', 10, 10, 'Đàn piano cơ YAMAHA U1J PE Professional, nhạc cụ bàn phím chất lượng cao, phục vụ tiết học âm nhạc, luyện kỹ năng đọc nhạc, cảm thụ giai điệu, thực hành chơi đàn, phát triển năng khiếu âm nhạc, kỹ năng biểu diễn và âm nhạc thính giác cho học sinh.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro`
--

CREATE TABLE `vaitro` (
  `maVaiTro` int(11) NOT NULL,
  `tenVaiTro` varchar(255) DEFAULT NULL,
  `moTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`maVaiTro`, `tenVaiTro`, `moTa`) VALUES
(1, 'Hiệu trưởng', 'Người chịu trách nhiệm quản lý toàn bộ hoạt động của nhà trường.'),
(2, 'Tổ trưởng chuyên môn', 'Phụ trách chuyên môn từng tổ bộ môn, giám sát chất lượng giảng dạy.'),
(3, 'Giáo viên bộ môn', 'Giảng dạy và quản lý học sinh trong từng môn học.'),
(4, 'Nhân viên quản lý thiết bị', 'Theo dõi, kiểm kê, và bảo dưỡng thiết bị dạy học trong trường.'),
(5, 'Nhân viên kỹ thuật', 'Hỗ trợ kỹ thuật, sửa chữa và đảm bảo hệ thống thiết bị vận hành tốt.'),
(6, 'Quản trị hệ thống', 'Quản lý, phân quyền và bảo mật hệ thống phần mềm của nhà trường.');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bomon`
--
ALTER TABLE `bomon`
  ADD PRIMARY KEY (`maBoMon`);

--
-- Chỉ mục cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  ADD PRIMARY KEY (`maChiTietTB`),
  ADD KEY `chitietthietbi_ibfk_1` (`maThietBi`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maNguoiDung`),
  ADD KEY `maBoMon` (`maBoMon`),
  ADD KEY `maVaiTro` (`maVaiTro`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`maNhaCungCap`);

--
-- Chỉ mục cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  ADD PRIMARY KEY (`maThietBi`),
  ADD KEY `fk_thietbi_bomon` (`maBoMon`),
  ADD KEY `fk_thietbi_nhacungcap` (`maNhaCungCap`);

--
-- Chỉ mục cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`maVaiTro`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bomon`
--
ALTER TABLE `bomon`
  MODIFY `maBoMon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  MODIFY `maChiTietTB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `maNhaCungCap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `maThietBi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `maVaiTro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  ADD CONSTRAINT `chitietthietbi_ibfk_1` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`maBoMon`) REFERENCES `bomon` (`maBoMon`),
  ADD CONSTRAINT `nguoidung_ibfk_2` FOREIGN KEY (`maVaiTro`) REFERENCES `vaitro` (`maVaiTro`);

--
-- Các ràng buộc cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  ADD CONSTRAINT `fk_thietbi_bomon` FOREIGN KEY (`maBoMon`) REFERENCES `bomon` (`maBoMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thietbi_nhacungcap` FOREIGN KEY (`maNhaCungCap`) REFERENCES `nhacungcap` (`maNhaCungCap`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
