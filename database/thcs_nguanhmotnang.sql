-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 10, 2025 lúc 12:11 PM
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
(31, 19, 20, 1, 3500000.00, 3500000.00),
(32, 19, 11, 3, 1200000.00, 3600000.00),
(33, 19, 2, 5, 800000.00, 4000000.00),
(34, 20, 3, 5, 135000.00, 675000.00),
(35, 20, 4, 2, 90000.00, 180000.00),
(36, 21, 14, 4, 265000.00, 1060000.00),
(37, 22, 5, 5, 135000.00, 675000.00),
(38, 22, 6, 2, 500000.00, 1000000.00);

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
(14, 8, 2, 1, 50000.00, 50000.00),
(15, 9, 78, 2, 25000.00, 50000.00),
(16, 9, 10, 1, 65000.00, 65000.00),
(17, 10, 15, 1, 150000.00, 150000.00),
(18, 11, 20, 1, 1500000.00, 1500000.00);

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
(100, 68, 3, 7),
(101, 68, 3, 8),
(102, 68, 4, 10),
(103, 69, 16, 46),
(104, 69, 16, 47),
(105, 69, 16, 48),
(106, 69, 15, 43),
(107, 70, 78, 144),
(108, 70, 18, 52),
(109, 70, 18, 53),
(110, 70, 17, 49),
(111, 71, 9, 25),
(112, 71, 10, 28),
(113, 71, 10, 29);

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
(4, 2, 'Khả dụng', 'Dùng tốt, không lỗi.'),
(5, 2, 'Khả dụng', 'Đang được mượn phục vụ bài kiểm tra.'),
(6, 2, 'Thanh lý', 'Hỏng do rơi vỡ.'),
(7, 3, 'Đang mượn', 'Trang sách còn mới.'),
(8, 3, 'Đang mượn', 'Giáo viên Ngữ văn mượn sử dụng.'),
(9, 3, 'Khả dụng', 'Rách gáy, cần sửa.'),
(10, 4, 'Đang mượn', 'Không trầy xước.'),
(11, 4, 'Khả dụng', 'Mượn trong tiết Ngữ văn.'),
(12, 4, 'Khả dụng', 'Bị cong góc.'),
(13, 5, 'Khả dụng', 'Sách còn rất mới.'),
(14, 5, 'Khả dụng', 'HS lớp 7 mượn nghiên cứu.'),
(15, 5, 'Khả dụng', 'Sách bị ướt, nhòe chữ.'),
(16, 6, 'Khả dụng', 'Âm thanh hoạt động bình thường.'),
(17, 6, 'Khả dụng', 'Dùng trong giờ sinh hoạt.'),
(18, 6, 'Báo hỏng', 'Pin chai, không bật được.'),
(19, 7, 'Khả dụng', 'Đo chính xác.'),
(20, 7, 'Khả dụng', 'Tổ Lý mượn thực hành.'),
(21, 7, 'Khả dụng', 'Nứt màn hình.'),
(22, 8, 'Khả dụng', 'Dùng tốt.'),
(23, 8, 'Khả dụng', 'Mượn cho tiết Vật lý.'),
(24, 8, 'Khả dụng', 'Dây treo bị đứt.'),
(25, 9, 'Đang mượn', 'Không rò rỉ.'),
(26, 9, 'Khả dụng', 'Dùng trong thí nghiệm cháy.'),
(27, 9, 'Báo hỏng', 'Bị nứt bình cồn.'),
(28, 10, 'Đang mượn', 'Đo chính xác.'),
(29, 10, 'Đang mượn', 'GV Hóa đang sử dụng.'),
(30, 10, 'Thanh lý', 'Đầu đo gãy.'),
(31, 11, 'Khả dụng', 'Kính trong, rõ.'),
(32, 11, 'Khả dụng', 'Dùng trong giờ Sinh học.'),
(33, 11, 'Báo hỏng', 'Bị lệch trục quang.'),
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
(44, 15, 'Khả dụng', 'GV Địa lý mượn.'),
(45, 15, 'Thanh lý', 'Trục xoay cứng.'),
(46, 16, 'Đang mượn', 'Không cong mép.'),
(47, 16, 'Đang mượn', 'Dùng trong tiết Địa lý.'),
(48, 16, 'Đang mượn', 'Bị ố màu chỗ viền.'),
(49, 17, 'Khả dụng', 'Màu còn đầy.'),
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
(60, 20, 'Thanh lý', 'Một phím bị kẹt.'),
(144, 78, 'Khả dụng', NULL),
(145, 78, 'Thanh lý', 'Một vài trang bị lem mực, cần phân loại để sử dụng cho bài tập phác thảo.'),
(146, 78, 'Thanh lý', 'Giấy rách một số trang, bìa hư hỏng, không ảnh hưởng đến tất cả bộ, cần kiểm tra trước khi dùng lại.');

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
(19, 32, '2025-12-10', 11100000.00, 'Chấp thuận', 'Mua sắm bổ sung thiết bị dạy học phục vụ học kỳ II, ưu tiên chất lượng vừa phải, chi phí hợp lý.'),
(20, 3, '2025-12-15', 855000.00, 'Chờ duyệt', 'Bổ sung tài liệu và tranh minh họa phục vụ giảng dạy, ưu tiên chi phí hợp lý và đáp ứng nhu cầu học sinh.'),
(21, 33, '2025-12-12', 1060000.00, 'Từ chối', 'Mua bổ sung băng tư liệu phục vụ học sinh nghe và nghiên cứu lịch sử, ưu tiên số lượng vừa đủ và bảo quản cẩn thận.'),
(22, 4, '2025-12-25', 1675000.00, 'Chờ duyệt', 'Mua bổ sung phục vụ học sinh lớp 6–9, đảm bảo đủ số lượng thiết bị cho các tiết học tiếng Anh thực hành nghe – nói.');

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
(8, 32, '2025-12-11', 50000.00, 'Từ chối', 'Thanh lý thiết bị hỏng, không thể sửa chữa, thu hồi một phần chi phí để mua sắm mới.'),
(9, 33, '2025-12-12', 115000.00, 'Chấp thuận', 'Thanh lý các thiết bị hư hỏng, không thể sử dụng tiếp; thu hồi một phần chi phí để mua sắm mới phục vụ giảng dạy.'),
(10, 33, '2025-12-20', 150000.00, 'Chờ duyệt', 'Thiết bị hư hỏng nhẹ, không còn sử dụng được trong giảng dạy; thanh lý để thu hồi một phần chi phí mua sắm mới.'),
(11, 32, '2025-12-25', 1500000.00, 'Chấp thuận', 'Thiết bị đã hư hỏng nặng, không còn khả năng sử dụng trong giảng dạy, đề xuất thanh lý để thay thế.');

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
(1, 'hieutruong', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Văn Hiệu', 'hieutruong@truong.edu.vn', '0901000001', NULL, 1),
(2, 'toan_tt', '81c093a2740b0196eac42391210ecf6b', 'Trần Minh Toán', 'toan_tt@truong.edu.vn', '0902000001', 1, 2),
(3, 'van_tt', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Thị Văn', 'van_tt@truong.edu.vn', '0902000002', 2, 2),
(4, 'anh_tt', '81c093a2740b0196eac42391210ecf6b', 'Lê Hồng Anh', 'anh_tt@truong.edu.vn', '0902000003', 3, 2),
(5, 'ly_tt', '81c093a2740b0196eac42391210ecf6b', 'Phạm Quốc Lý', 'ly_tt@truong.edu.vn', '0902000004', 4, 2),
(6, 'hoa_tt', '81c093a2740b0196eac42391210ecf6b', 'Đỗ Văn Hóa', 'hoa_tt@truong.edu.vn', '0902000005', 5, 2),
(7, 'sinh_tt', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Lan Sinh', 'sinh_tt@truong.edu.vn', '0902000006', 6, 2),
(8, 'su_tt', '81c093a2740b0196eac42391210ecf6b', 'Phan Quốc Sử', 'su_tt@truong.edu.vn', '0902000007', 7, 2),
(9, 'dia_tt', '81c093a2740b0196eac42391210ecf6b', 'Lý Hải Địa', 'dia_tt@truong.edu.vn', '0902000008', 8, 2),
(10, 'mythuat_tt', '81c093a2740b0196eac42391210ecf6b', 'Trịnh Mỹ Thuật', 'mythuat_tt@truong.edu.vn', '0902000009', 9, 2),
(11, 'amnhac_tt', '81c093a2740b0196eac42391210ecf6b', 'Vũ Thanh Nhạc', 'amnhac_tt@truong.edu.vn', '0902000010', 10, 2),
(12, 'toan_gv1', '81c093a2740b0196eac42391210ecf6b', 'Lê Văn Số', 'toan_gv1@truong.edu.vn', '0903000001', 1, 3),
(13, 'toan_gv2', '81c093a2740b0196eac42391210ecf6b', 'Ngô Thị Hàm', 'toan_gv2@truong.edu.vn', '0903000002', 1, 3),
(14, 'van_gv1', '81c093a2740b0196eac42391210ecf6b', 'Trần Minh Thơ', 'van_gv1@truong.edu.vn', '0903000003', 2, 3),
(15, 'van_gv2', '81c093a2740b0196eac42391210ecf6b', 'Phạm Ngọc Vân', 'van_gv2@truong.edu.vn', '0903000004', 2, 3),
(16, 'anh_gv1', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Thu Hương', 'anh_gv1@truong.edu.vn', '0903000005', 3, 3),
(17, 'anh_gv2', '81c093a2740b0196eac42391210ecf6b', 'Hoàng Minh Quân', 'anh_gv2@truong.edu.vn', '0903000006', 3, 3),
(18, 'ly_gv1', '81c093a2740b0196eac42391210ecf6b', 'Phan Quốc Bảo', 'ly_gv1@truong.edu.vn', '0903000007', 4, 3),
(19, 'ly_gv2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Thị Hằng', 'ly_gv2@truong.edu.vn', '0903000008', 4, 3),
(20, 'hoa_gv1', '81c093a2740b0196eac42391210ecf6b', 'Lưu Hồng Hoa', 'hoa_gv1@truong.edu.vn', '0903000009', 5, 3),
(21, 'hoa_gv2', '81c093a2740b0196eac42391210ecf6b', 'Phạm Tiến Dũng', 'hoa_gv2@truong.edu.vn', '0903000010', 5, 3),
(22, 'sinh_gv1', '81c093a2740b0196eac42391210ecf6b', 'Đỗ Bích Hạnh', 'sinh_gv1@truong.edu.vn', '0903000011', 6, 3),
(23, 'sinh_gv2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Văn Sinh', 'sinh_gv2@truong.edu.vn', '0903000012', 6, 3),
(24, 'su_gv1', '81c093a2740b0196eac42391210ecf6b', 'Phan Thị Sửu', 'su_gv1@truong.edu.vn', '0903000013', 7, 3),
(25, 'su_gv2', '81c093a2740b0196eac42391210ecf6b', 'Trần Quốc Việt', 'su_gv2@truong.edu.vn', '0903000014', 7, 3),
(26, 'dia_gv1', '81c093a2740b0196eac42391210ecf6b', 'Lê Thanh Bình', 'dia_gv1@truong.edu.vn', '0903000015', 8, 3),
(27, 'dia_gv2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Hà Địa', 'dia_gv2@truong.edu.vn', '0903000016', 8, 3),
(28, 'mythuat_gv1', '81c093a2740b0196eac42391210ecf6b', 'Trịnh Ngọc Vẽ', 'mythuat_gv1@truong.edu.vn', '0903000017', 9, 3),
(29, 'mythuat_gv2', '81c093a2740b0196eac42391210ecf6b', 'Phạm Mỹ Linh', 'mythuat_gv2@truong.edu.vn', '0903000018', 9, 3),
(30, 'amnhac_gv1', '81c093a2740b0196eac42391210ecf6b', 'Vũ Hoàng Ca', 'amnhac_gv1@truong.edu.vn', '0903000019', 10, 3),
(31, 'amnhac_gv2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Minh Âm', 'amnhac_gv2@truong.edu.vn', '0903000020', 10, 3),
(32, 'qltb1', '81c093a2740b0196eac42391210ecf6b', 'Lê Quản Lý', 'qltb1@truong.edu.vn', '0904000001', NULL, 4),
(33, 'qltb2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Thiết Bị', 'qltb2@truong.edu.vn', '0904000002', NULL, 4),
(34, 'kythuat1', '81c093a2740b0196eac42391210ecf6b', 'Phạm Văn Kỹ', 'kythuat1@truong.edu.vn', '0905000001', NULL, 5),
(35, 'kythuat2', '81c093a2740b0196eac42391210ecf6b', 'Nguyễn Công Nghệ', 'kythuat2@truong.edu.vn', '0905000002', NULL, 5),
(36, 'admin', '81c093a2740b0196eac42391210ecf6b', 'Trần Quốc Hệ', 'admin@truong.edu.vn', '0909000001', NULL, 6);

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
(68, 3, '2025-12-10', '2025-12-20', 'Đã xác nhận', 'Sử dụng cho tiết dạy lớp 6–9, lưu ý giữ nguyên trạng sách và tranh, tránh làm hư hỏng khi di chuyển giữa các lớp.'),
(69, 26, '2025-12-11', '2025-12-25', 'Đang mượn', 'Sử dụng cho các tiết học địa lý lớp 6–9, lưu ý bảo quản bản đồ và quả địa cầu cẩn thận, tránh làm rách hoặc hỏng thiết bị khi di chuyển.'),
(70, 28, '2025-12-12', '2025-12-22', 'Đã trả', 'Sử dụng cho các tiết học mỹ thuật, lưu ý giữ nguyên trạng thiết bị, tránh làm rách giấy hoặc làm hỏng màu và bút khi sử dụng trong lớp.'),
(71, 21, '2025-12-10', '2025-12-30', 'Chờ xử lý', 'Thiết bị phục vụ thí nghiệm Hóa học cơ bản, chú ý an toàn khi sử dụng.');

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
(5, 'Từ điển tiếng Anh Oxford Advanced Learner', 'tu_dien_oxford_advanced.jpg', 'Bộ', 1, '6,7', 3, 5, 'Từ điển Oxford Advanced Learner’s Dictionary 10th Edition, xuất bản bởi Oxford University Press, hỗ trợ học sinh học từ vựng, ngữ pháp, phát âm, cải thiện kỹ năng đọc, viết, nghe, nói trong học tập tiếng Anh.'),
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
(78, 'Sketch Pad vẽ Mỹ thuật - MathMaster Deluxe Edition', 'sketch-pad-ve-my-thuat_1765361948.jpg', 'Bộ', 3, '6,7,8,9', 9, 1, 'Sketch Pad vẽ Mỹ thuật MathMaster Deluxe Edition, giấy chất lượng cao, phục vụ vẽ tranh, phác thảo, phối màu, giúp học sinh thực hành kỹ năng mỹ thuật cơ bản và nâng cao, phát triển tư duy sáng tạo và thẩm mỹ.');

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
(19, 6, 'Sửa chữa', 'Không thể sửa', 'Lỗi mạch bàn phím, không thay thế được linh kiện.'),
(20, 42, 'Bảo trì', 'Đã sửa', 'Đã vệ sinh và chỉnh lại băng, âm thanh ổn định.'),
(21, 18, 'Bảo hành', 'Đang xử lý', 'Đang kiểm tra pin và module Bluetooth.'),
(22, 30, 'Sửa chữa', 'Không thể sửa', 'Cảm biến hỏng nặng, không khắc phục được.'),
(23, 27, 'Bảo hành', 'Chờ xác nhận', 'Ngọn lửa không đều, khó điều chỉnh van gió.'),
(24, 33, NULL, NULL, NULL),
(25, 45, 'Bảo trì', 'Không thể sửa', 'Trục xoay bị cong, không có linh kiện thay thế.'),
(27, 146, 'Sửa chữa', 'Không thể sửa', 'Bìa và gáy hư nặng, không thể khắc phục; cần mua bộ mới thay thế.'),
(28, 145, 'Bảo hành', 'Không thể sửa', 'Một số trang bị rách và bìa hư, đang chờ xác nhận bảo hành từ nhà cung cấp.'),
(29, 60, 'Sửa chữa', 'Không thể sửa', 'Hư hỏng nặng, cần thay thế linh kiện chuyên dụng; tạm thời không thể sửa chữa.');

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
  ADD KEY `fk_ctkh_tb` (`maThietBi`),
  ADD KEY `fk_ctkh_ms` (`maKeHoachMuaSam`);

--
-- Chỉ mục cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  ADD PRIMARY KEY (`maChiTietKHThanhLy`),
  ADD KEY `fk_ctkhtl_tb` (`maThietBi`),
  ADD KEY `fk_ctkh_tl` (`maKeHoachThanhLy`);

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
  MODIFY `maBoMon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `chitietkehoachmuasam`
--
ALTER TABLE `chitietkehoachmuasam`
  MODIFY `maChiTietKHMuaSam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  MODIFY `maChiTietKHThanhLy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `chitietphieumuon`
--
ALTER TABLE `chitietphieumuon`
  MODIFY `maChiTietPM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT cho bảng `chitietthietbi`
--
ALTER TABLE `chitietthietbi`
  MODIFY `maChiTietTB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `kehoachmuasam`
--
ALTER TABLE `kehoachmuasam`
  MODIFY `maKeHoachMuaSam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `kehoachthanhly`
--
ALTER TABLE `kehoachthanhly`
  MODIFY `maKeHoachThanhLy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `maNhaCungCap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `maPhieuMuon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `maThietBi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `maVaiTro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `yeucauscbtbh`
--
ALTER TABLE `yeucauscbtbh`
  MODIFY `maYeuCau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietkehoachmuasam`
--
ALTER TABLE `chitietkehoachmuasam`
  ADD CONSTRAINT `fk_ctkh_ms` FOREIGN KEY (`maKeHoachMuaSam`) REFERENCES `kehoachmuasam` (`maKeHoachMuaSam`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ctkh_tb` FOREIGN KEY (`maThietBi`) REFERENCES `thietbi` (`maThietBi`);

--
-- Các ràng buộc cho bảng `chitietkehoachthanhly`
--
ALTER TABLE `chitietkehoachthanhly`
  ADD CONSTRAINT `fk_ctkh_tl` FOREIGN KEY (`maKeHoachThanhLy`) REFERENCES `kehoachthanhly` (`maKeHoachThanhLy`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_thietbi_bomon` FOREIGN KEY (`maBoMon`) REFERENCES `bomon` (`maBoMon`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thietbi_nhacungcap` FOREIGN KEY (`maNhaCungCap`) REFERENCES `nhacungcap` (`maNhaCungCap`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `yeucauscbtbh`
--
ALTER TABLE `yeucauscbtbh`
  ADD CONSTRAINT `fk_chitietthietbi` FOREIGN KEY (`maChiTietTB`) REFERENCES `chitietthietbi` (`maChiTietTB`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
