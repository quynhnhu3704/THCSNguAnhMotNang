-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2025 lúc 12:38 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
-- Cấu trúc bảng cho bảng `chitietkehoachmuasam`
--

CREATE TABLE `chitietkehoachmuasam` (
  `maChiTietKHMuaSam` int(11) NOT NULL,
  `maKeHoachMuaSam` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `donGia` decimal(18,2) DEFAULT NULL,
  `thanhTien` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietkehoachmuasam`
--

INSERT INTO `chitietkehoachmuasam` (`maChiTietKHMuaSam`, `maKeHoachMuaSam`, `maThietBi`, `soLuong`, `donGia`, `thanhTien`) VALUES
(1, 1, 10, 1, 200000.00, 200000.00),
(2, 1, 12, 3, 100000.00, 300000.00),
(3, 1, 15, 2, 100000.00, 200000.00),
(8, 5, 6, 3, 100000.00, 300000.00),
(9, 5, 14, 2, 50000.00, 100000.00),
(11, 8, 5, 5, 25000.00, 125000.00),
(12, 8, 6, 3, 6000.00, 18000.00),
(13, 9, 1, 2, 50000.00, 100000.00),
(14, 9, 63, 1, 400000.00, 400000.00),
(15, 10, 62, 2, 30000.00, 60000.00),
(16, 10, 16, 7, 10000.00, 70000.00),
(17, 11, 19, 10, 500000.00, 5000000.00),
(18, 11, 14, 5, 150000.00, 750000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkehoachthanhly`
--

CREATE TABLE `chitietkehoachthanhly` (
  `maChiTietKHThanhLy` int(11) NOT NULL,
  `maKeHoachThanhLy` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT 1,
  `donGia` decimal(18,2) DEFAULT 0.00,
  `thanhTien` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietkehoachthanhly`
--

INSERT INTO `chitietkehoachthanhly` (`maChiTietKHThanhLy`, `maKeHoachThanhLy`, `maThietBi`, `soLuong`, `donGia`, `thanhTien`) VALUES
(4, 2, 62, 2, 2000.00, 4000.00),
(5, 2, 63, 3, 5000.00, 15000.00),
(10, 5, 4, 1, 15000.00, 15000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphieumuon`
--

CREATE TABLE `chitietphieumuon` (
  `maChiTietPM` int(11) NOT NULL,
  `maPhieuMuon` int(11) NOT NULL,
  `maThietBi` int(11) NOT NULL,
  `maChiTietTB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphieumuon`
--

INSERT INTO `chitietphieumuon` (`maChiTietPM`, `maPhieuMuon`, `maThietBi`, `maChiTietTB`) VALUES
(24, 33, 10, 28),
(25, 33, 7, 19),
(26, 33, 8, 22),
(30, 38, 17, 49),
(31, 43, 4, 10),
(32, 43, 3, 7),
(62, 48, 15, 43),
(63, 48, 15, 44),
(64, 48, 16, 46),
(65, 48, 16, 47),
(66, 48, 16, 48);

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
(2, 1, 'Khả dụng', 'Đang được mượn phục vụ giảng dạy.'),
(3, 1, 'Khả dụng', 'Hỏng do sử dụng lâu ngày.'),
(4, 2, 'Báo hỏng', 'Dùng tốt, không lỗi.'),
(5, 2, 'Khả dụng', 'Đang được mượn phục vụ bài kiểm tra.'),
(6, 2, 'Khả dụng', 'Hỏng do rơi vỡ.'),
(7, 3, 'Khả dụng', 'Trang sách còn mới.'),
(8, 3, 'Khả dụng', 'Giáo viên Ngữ văn mượn sử dụng.'),
(9, 3, 'Khả dụng', 'Rách gáy, cần sửa.'),
(10, 4, 'Thanh lý', 'Không trầy xước.'),
(11, 4, 'Khả dụng', 'Mượn trong tiết Ngữ văn.'),
(12, 4, 'Khả dụng', 'Bị cong góc.'),
(13, 5, 'Khả dụng', 'Sách còn rất mới.'),
(14, 5, 'Khả dụng', 'HS lớp 7 mượn nghiên cứu.'),
(15, 5, 'Khả dụng', 'Sách bị ướt, nhòe chữ.'),
(16, 6, 'Khả dụng', 'Âm thanh hoạt động bình thường.'),
(17, 6, 'Khả dụng', 'Dùng trong giờ sinh hoạt.'),
(18, 6, 'Báo hỏng', 'Pin chai, không bật được.'),
(19, 7, 'Đang mượn', 'Đo chính xác.'),
(20, 7, 'Khả dụng', 'Tổ Lý mượn thực hành.'),
(21, 7, 'Khả dụng', 'Nứt màn hình.'),
(22, 8, 'Đang mượn', 'Dùng tốt.'),
(23, 8, 'Khả dụng', 'Mượn cho tiết Vật lý.'),
(24, 8, 'Khả dụng', 'Dây treo bị đứt.'),
(25, 9, 'Khả dụng', 'Không rò rỉ.'),
(26, 9, 'Khả dụng', 'Dùng trong thí nghiệm cháy.'),
(27, 9, 'Khả dụng', 'Bị nứt bình cồn.'),
(28, 10, 'Đang mượn', 'Đo chính xác.'),
(29, 10, 'Khả dụng', 'GV Hóa đang sử dụng.'),
(30, 10, 'Khả dụng', 'Đầu đo gãy.'),
(31, 11, 'Khả dụng', 'Kính trong, rõ.'),
(32, 11, 'Khả dụng', 'Dùng trong giờ Sinh học.'),
(33, 11, 'Khả dụng', 'Bị lệch trục quang.'),
(34, 12, 'Khả dụng', 'Đầy đủ chi tiết.'),
(35, 12, 'Khả dụng', 'Tổ Sinh đang sử dụng.'),
(36, 12, 'Khả dụng', 'Thiếu 1 chi tiết nhỏ.'),
(37, 13, 'Khả dụng', 'Hình ảnh rõ.'),
(38, 13, 'Khả dụng', 'GV Lịch sử đang dùng.'),
(39, 13, 'Khả dụng', 'Rách mép giấy bên phải.'),
(40, 14, 'Khả dụng', 'Băng chạy tốt.'),
(41, 14, 'Khả dụng', 'HS lớp 8 dùng cho bài thuyết trình.'),
(42, 14, 'Khả dụng', 'Băng bị rối, không tua được.'),
(43, 15, 'Đang mượn', 'Quả cầu xoay mượt.'),
(44, 15, 'Đang mượn', 'GV Địa lý mượn.'),
(45, 15, 'Báo hỏng', 'Trục xoay cứng.'),
(46, 16, 'Đang mượn', 'Không cong mép.'),
(47, 16, 'Đang mượn', 'Dùng trong tiết Địa lý.'),
(48, 16, 'Đang mượn', 'Bị ố màu chỗ viền.'),
(49, 17, 'Đang mượn', 'Màu còn đầy.'),
(50, 17, 'Khả dụng', 'HS lớp 6 đang dùng.'),
(51, 17, 'Khả dụng', 'Hộp bị gãy nắp.'),
(52, 18, 'Khả dụng', 'Chưa sử dụng nhiều.'),
(53, 18, 'Khả dụng', 'GV Mỹ thuật đang dùng.'),
(54, 18, 'Khả dụng', 'Một lọ màu bị khô.'),
(55, 19, 'Khả dụng', 'Âm thanh ổn định.'),
(56, 19, 'Khả dụng', 'Dùng cho buổi sinh hoạt lớp.'),
(57, 19, 'Khả dụng', 'Rách mặt trống.'),
(58, 20, 'Khả dụng', 'Phím đàn nhạy tốt.'),
(59, 20, 'Khả dụng', 'GV Âm nhạc đang luyện đàn.'),
(60, 20, 'Khả dụng', 'Một phím bị kẹt.'),
(110, 62, 'Thanh lý', 'con meo bi hong'),
(111, 62, 'Thanh lý', 'hong that nha'),
(112, 63, 'Thanh lý', ''),
(113, 63, 'Thanh lý', 'hong roi'),
(114, 63, 'Thanh lý', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kehoachmuasam`
--

CREATE TABLE `kehoachmuasam` (
  `maKeHoachMuaSam` int(11) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `ngayLap` date NOT NULL,
  `tongChiPhi` decimal(18,2) NOT NULL DEFAULT 0.00,
  `trangThai` varchar(50) NOT NULL,
  `ghiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kehoachmuasam`
--

INSERT INTO `kehoachmuasam` (`maKeHoachMuaSam`, `maNguoiDung`, `ngayLap`, `tongChiPhi`, `trangThai`, `ghiChu`) VALUES
(1, 3, '2025-01-15', 700000.00, 'Chờ duyệt', 'Mua bổ sung thiết bị thực hành CNTT'),
(5, 32, '2025-12-04', 400000.00, 'Chờ duyệt', 'test lan 1'),
(8, 4, '2025-12-04', 143000.00, 'Chấp thuận', 'đồng ý nha, cứ mua đi'),
(9, 2, '2025-12-05', 500000.00, 'Chờ duyệt', 'test với ttcm toán học'),
(10, 9, '2025-12-31', 130000.00, 'Từ chối', 'không cần thiết đâu'),
(11, 33, '2025-12-20', 5750000.00, 'Chờ duyệt', 'dantrong-10-500k/cassette-5-150.000 = 5tr750');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kehoachthanhly`
--

CREATE TABLE `kehoachthanhly` (
  `maKeHoachThanhLy` int(11) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `ngayLap` date DEFAULT NULL,
  `tongThuNhap` decimal(18,2) DEFAULT 0.00,
  `trangThai` varchar(50) DEFAULT NULL,
  `ghiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kehoachthanhly`
--

INSERT INTO `kehoachthanhly` (`maKeHoachThanhLy`, `maNguoiDung`, `ngayLap`, `tongThuNhap`, `trangThai`, `ghiChu`) VALUES
(2, 32, '2025-12-06', 19000.00, 'Chấp thuận', 'đem cho vựa sắt vụn'),
(5, 32, '2025-12-06', 15000.00, 'Chờ duyệt', 'dem ban cho ve chai');

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
-- Cấu trúc bảng cho bảng `phieumuon`
--

CREATE TABLE `phieumuon` (
  `maPhieuMuon` int(11) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `ngayMuon` date NOT NULL,
  `ngayTra` date NOT NULL,
  `trangThai` varchar(50) NOT NULL DEFAULT 'Chờ xử lý',
  `ghiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieumuon`
--

INSERT INTO `phieumuon` (`maPhieuMuon`, `maNguoiDung`, `ngayMuon`, `ngayTra`, `trangThai`, `ghiChu`) VALUES
(33, 16, '2025-11-28', '2025-12-05', 'Chờ xử lý', 'test tình trạng'),
(38, 29, '2025-11-28', '2025-12-03', 'Đã xác nhận', 'test lan 2'),
(43, 14, '2025-11-29', '2025-11-30', 'Đã trả', 'gv này trả rồi'),
(48, 27, '2025-12-03', '2025-12-04', 'Đã xác nhận', 'cho phép mượn');

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
(20, 'Đàn piano cơ YAMAHA U1J PE Professional', 'piano_yamaha_u1j_pe.jpg', 'Cái', 3, '8,9', 10, 10, 'Đàn piano cơ YAMAHA U1J PE Professional, nhạc cụ bàn phím chất lượng cao, phục vụ tiết học âm nhạc, luyện kỹ năng đọc nhạc, cảm thụ giai điệu, thực hành chơi đàn, phát triển năng khiếu âm nhạc, kỹ năng biểu diễn và âm nhạc thính giác cho học sinh.'),
(62, 'conmeosuagaugau', 'meomeo_1765035433.png', 'Bộ', 2, '7,8', 8, 7, 'gaugauconmeo'),
(63, 'Bộ thí nghiệm Khoa học tổng hợp STEM Junior Lab Kit', 'kiki_1765035336.png', 'Chiếc', 3, '6,7,8,9', 1, 10, 'bo thi nghiem lulu');

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeucauscbtbh`
--

CREATE TABLE `yeucauscbtbh` (
  `maYeuCau` int(11) NOT NULL,
  `maChiTietTB` int(11) NOT NULL,
  `loaiYeuCau` varchar(50) DEFAULT NULL,
  `tienDo` varchar(50) DEFAULT NULL,
  `ghiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `yeucauscbtbh`
--

INSERT INTO `yeucauscbtbh` (`maYeuCau`, `maChiTietTB`, `loaiYeuCau`, `tienDo`, `ghiChu`) VALUES
(1, 45, 'Bảo trì', 'Đang xử lý', 'chờ sửa xíu đi'),
(4, 110, 'Sửa chữa', 'Không thể sửa', 'thanh ly luon di'),
(8, 111, 'Bảo hành', 'Đã sửa', 'sua xong roi nha'),
(9, 113, 'Bảo trì', 'Không thể sửa', 'hu luon roi'),
(10, 1, 'Sửa chữa', 'Đã sửa', 'hết hư rồi nha'),
(11, 4, 'Sửa chữa', 'Chờ xác nhận', 'đem đi sửa đi'),
(12, 10, 'Sửa chữa', 'Không thể sửa', ''),
(13, 18, NULL, NULL, NULL),
(14, 111, 'Sửa chữa', 'Không thể sửa', ''),
(15, 112, 'Sửa chữa', 'Không thể sửa', ''),
(16, 114, 'Sửa chữa', 'Không thể sửa', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bomon`
--
ALTER TABLE `bomon`
  ADD PRIMARY KEY (`maBoMon`);

--
-- Chỉ mục cho bảng `chitietkehoachmuasam`
--
ALTER TABLE `chitietkehoachmuasam`
  ADD PRIMARY KEY (`maChiTietKHMuaSam`),
  ADD KEY `fk_ctkh_ms` (`maKeHoachMuaSam`),
  ADD KEY `fk_ctkh_tb` (`maThietBi`);

--
-- Chỉ mục cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  ADD PRIMARY KEY (`maChiTietKHThanhLy`),
  ADD KEY `fk_ctkh_tl` (`maKeHoachThanhLy`),
  ADD KEY `fk_ctkhtl_tb` (`maThietBi`);

--
-- Chỉ mục cho bảng `chitietphieumuon`
--
ALTER TABLE `chitietphieumuon`
  ADD PRIMARY KEY (`maChiTietPM`),
  ADD KEY `maPhieuMuon` (`maPhieuMuon`),
  ADD KEY `maThietBi` (`maThietBi`),
  ADD KEY `FK_ChiTietPhieuMuon_ChiTietTB` (`maChiTietTB`);

--
-- Chỉ mục cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  ADD PRIMARY KEY (`maChiTietTB`),
  ADD KEY `chitietthietbi_ibfk_1` (`maThietBi`);

--
-- Chỉ mục cho bảng `kehoachmuasam`
--
ALTER TABLE `kehoachmuasam`
  ADD PRIMARY KEY (`maKeHoachMuaSam`),
  ADD KEY `fk_khms_nguoidung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `kehoachthanhly`
--
ALTER TABLE `kehoachthanhly`
  ADD PRIMARY KEY (`maKeHoachThanhLy`),
  ADD KEY `fk_khtl_nd` (`maNguoiDung`);

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
-- Chỉ mục cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD PRIMARY KEY (`maPhieuMuon`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

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
-- Chỉ mục cho bảng `yeucauscbtbh`
--
ALTER TABLE `yeucauscbtbh`
  ADD PRIMARY KEY (`maYeuCau`),
  ADD KEY `fk_chitietthietbi` (`maChiTietTB`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bomon`
--
ALTER TABLE `bomon`
  MODIFY `maBoMon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `chitietkehoachmuasam`
--
ALTER TABLE `chitietkehoachmuasam`
  MODIFY `maChiTietKHMuaSam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  MODIFY `maChiTietKHThanhLy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chitietphieumuon`
--
ALTER TABLE `chitietphieumuon`
  MODIFY `maChiTietPM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  MODIFY `maChiTietTB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT cho bảng `kehoachmuasam`
--
ALTER TABLE `kehoachmuasam`
  MODIFY `maKeHoachMuaSam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `kehoachthanhly`
--
ALTER TABLE `kehoachthanhly`
  MODIFY `maKeHoachThanhLy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `maPhieuMuon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `maThietBi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `maVaiTro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `yeucauscbtbh`
--
ALTER TABLE `yeucauscbtbh`
  MODIFY `maYeuCau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietkehoachmuasam`
--
ALTER TABLE `chitietkehoachmuasam`
  ADD CONSTRAINT `fk_ctkh_ms` FOREIGN KEY (`maKeHoachMuaSam`) REFERENCES `kehoachmuasam` (`maKeHoachMuaSam`),
  ADD CONSTRAINT `fk_ctkh_tb` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`);

--
-- Các ràng buộc cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  ADD CONSTRAINT `fk_ctkh_tl` FOREIGN KEY (`maKeHoachThanhLy`) REFERENCES `kehoachthanhly` (`maKeHoachThanhLy`),
  ADD CONSTRAINT `fk_ctkhtl_tb` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`);

--
-- Các ràng buộc cho bảng `chitietphieumuon`
--
ALTER TABLE `chitietphieumuon`
  ADD CONSTRAINT `FK_ChiTietPhieuMuon_ChiTietTB` FOREIGN KEY (`maChiTietTB`) REFERENCES `chitietthietbi` (`maChiTietTB`),
  ADD CONSTRAINT `chitietphieumuon_ibfk_1` FOREIGN KEY (`maPhieuMuon`) REFERENCES `phieumuon` (`maPhieuMuon`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietphieumuon_ibfk_2` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`);

--
-- Các ràng buộc cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  ADD CONSTRAINT `chitietthietbi_ibfk_1` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `kehoachmuasam`
--
ALTER TABLE `kehoachmuasam`
  ADD CONSTRAINT `fk_khms_nguoidung` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `kehoachthanhly`
--
ALTER TABLE `kehoachthanhly`
  ADD CONSTRAINT `fk_khtl_nd` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`maBoMon`) REFERENCES `bomon` (`maBoMon`),
  ADD CONSTRAINT `nguoidung_ibfk_2` FOREIGN KEY (`maVaiTro`) REFERENCES `vaitro` (`maVaiTro`);

--
-- Các ràng buộc cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD CONSTRAINT `phieumuon_ibfk_1` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  ADD CONSTRAINT `fk_thietbi_bomon` FOREIGN KEY (`maBoMon`) REFERENCES `bomon` (`maBoMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thietbi_nhacungcap` FOREIGN KEY (`maNhaCungCap`) REFERENCES `nhacungcap` (`maNhaCungCap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `yeucauscbtbh`
--
ALTER TABLE `yeucauscbtbh`
  ADD CONSTRAINT `fk_chitietthietbi` FOREIGN KEY (`maChiTietTB`) REFERENCES `chitietthietbi` (`maChiTietTB`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
