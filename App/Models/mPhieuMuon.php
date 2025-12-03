<!-- App/Models/mPhieuMuon.php -->
<?php
include_once('mketnoi.php');

class modelPhieuMuon {
    public function selectAllPhieuMuon() {
        $p = new clsKetNoi();
        $truyvan = "SELECT pm.*, nd.hoTen, vt.tenVaiTro, bm.tenBoMon, COUNT(ct.maChiTietPM) AS soLuongMuon
                    FROM phieumuon pm
                    LEFT JOIN nguoidung nd ON pm.maNguoiDung = nd.maNguoiDung
                    LEFT JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    LEFT JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    LEFT JOIN chitietphieumuon ct ON pm.maPhieuMuon = ct.maPhieuMuon
                    GROUP BY pm.maPhieuMuon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01PhieuMuon($maPhieuMuon) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phieumuon pm
                    JOIN nguoidung nd ON pm.maNguoiDung = nd.maNguoiDung
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    WHERE maPhieuMuon = $maPhieuMuon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchPhieuMuon($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT pm.*, nd.hoTen, vt.tenVaiTro, bm.tenBoMon, COUNT(ct.maChiTietPM) AS soLuongMuon
                    FROM phieumuon pm
                    LEFT JOIN nguoidung nd ON pm.maNguoiDung = nd.maNguoiDung
                    LEFT JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    LEFT JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    LEFT JOIN chitietphieumuon ct ON pm.maPhieuMuon = ct.maPhieuMuon
                    WHERE hoTen LIKE N'%$keyword%'
                    GROUP BY pm.maPhieuMuon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllChiTietPM() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietphieumuon ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap = tb.maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ChiTietPM($maPhieuMuon) {
        $p = new clsKetNoi();
        $truyvan = "SELECT ct.maThietBi, tb.tenThietBi, COUNT(ct.maChiTietTB) AS soLuong FROM chitietphieumuon ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN phieumuon pm ON ct.maPhieuMuon = pm.maPhieuMuon
                    JOIN nguoidung nd ON pm.maNguoiDung = nd.maNguoiDung
                    WHERE ct.maPhieuMuon = $maPhieuMuon
                    GROUP BY ct.maThietBi";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "INSERT INTO phieumuon (maNguoiDung, ngayMuon, ngayTra, trangThai, ghiChu) 
                    VALUES ($maNguoiDung, '$ngayMuon', '$ngayTra', N'$trangThai', N'$ghiChu')";
        if(mysqli_query($con, $truyvan)) {
            $id = mysqli_insert_id($con); // lấy mã phiếu mượn vừa thêm để dùng chèn chi tiết phiếu mượn
            $p->dongketnoi($con);
            return $id;
        } else {
            $p->dongketnoi($con);
            return false;
        }
    }

    public function insertChiTietPM($maPhieuMuon, $chiTiet) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // Bước 1: Kiểm tra đủ thiết bị khả dụng
        foreach($chiTiet as $maThietBi => $soLuongMuon) {
            // 1. Đếm số lượng khả dụng
            $truyvan = "SELECT COUNT(*) AS soLuongKhaDung 
                        FROM chitietthietbi 
                        WHERE maThietBi = $maThietBi AND tinhTrang = 'Khả dụng'";
            $kq = mysqli_query($con, $truyvan);
            $r = mysqli_fetch_assoc($kq);
            $soLuongKhaDung = (int)$r['soLuongKhaDung'];

            if($soLuongMuon > $soLuongKhaDung) {
                $p->dongketnoi($con);
                return false; // Không đủ thiết bị khả dụng
            }
        }

        // Bước 2: Thực hiện insert chi tiết phiếu mượn
        foreach($chiTiet as $maThietBi => $soLuongMuon) {
            // 2. Lấy các chi tiết khả dụng
            $truyvan = "SELECT maChiTietTB 
                        FROM chitietthietbi 
                        WHERE maThietBi = $maThietBi AND tinhTrang = N'Khả dụng'
                        LIMIT $soLuongMuon";
            $kq = mysqli_query($con, $truyvan);

            // 3. Insert vào chi tiết phiếu mượn và cập nhật tình trạng
            while($r = mysqli_fetch_assoc($kq)) {
                $maChiTietTB = $r['maChiTietTB'];
                $insert = mysqli_query($con, "INSERT INTO chitietphieumuon (maPhieuMuon, maThietBi, maChiTietTB) VALUES ($maPhieuMuon, $maThietBi, $maChiTietTB)");
                if(!$insert) {
                    $p->dongketnoi($con);
                    return false; // Insert thất bại => rollback bên controller
                }
                
                mysqli_query($con, "UPDATE chitietthietbi SET tinhTrang = N'Đang mượn' WHERE maChiTietTB = $maChiTietTB");
            }
        }
        $p->dongketnoi($con);
        return true;
    }

    public function restoreThietBi($maPhieuMuon) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // Lấy tất cả chi tiết thiết bị thuộc phiếu mượn
        $truyvan = "SELECT maChiTietTB FROM chitietphieumuon WHERE maPhieuMuon = $maPhieuMuon";
        $kq = mysqli_query($con, $truyvan);

        // Trả từng thiết bị về trạng thái Khả dụng
        while($r = mysqli_fetch_assoc($kq)) {
            $maChiTietTB = $r['maChiTietTB'];
            mysqli_query($con, "UPDATE chitietthietbi SET tinhTrang = N'Khả dụng' WHERE maChiTietTB = $maChiTietTB");
        }

        $p->dongketnoi($con);
        return true;
    }

    public function deletePhieuMuon($maPhieuMuon) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // Xóa chi tiết phiếu mượn trước
        mysqli_query($con,  "DELETE FROM chitietphieumuon WHERE maPhieuMuon = $maPhieuMuon");

        // Xóa phiếu mượn
        $kq = mysqli_query($con, "DELETE FROM phieumuon WHERE maPhieuMuon = $maPhieuMuon");

        $p->dongketnoi($con);
        return $kq;
    }

    public function updatePhieuMuon($maPhieuMuon, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "UPDATE phieumuon SET 
                    trangThai = N'$trangThai',
                    ghiChu = N'$ghiChu'
                    WHERE maPhieuMuon = $maPhieuMuon";
        $kq = mysqli_query($con, $truyvan);

        if($kq) {
            // Lấy danh sách thiết bị chi tiết
            $truyvan = "SELECT maChiTietTB FROM chitietphieumuon WHERE maPhieuMuon = $maPhieuMuon";
            $kq = mysqli_query($con, $truyvan);

            if($trangThai == "Đã trả") {
                // Trả thiết bị → cập nhật thành Khả dụng
                while($r = mysqli_fetch_assoc($kq)) {
                    $maChiTietTB = $r['maChiTietTB'];
                    $truyvan = "UPDATE chitietthietbi SET tinhTrang = N'Khả dụng' WHERE maChiTietTB = $maChiTietTB";
                    mysqli_query($con, $truyvan);
                }
            } else {
                // Các trạng thái khác → "Đang mượn"
                while($r = mysqli_fetch_assoc($kq)) {
                    $maChiTietTB = $r['maChiTietTB'];
                    $truyvan = "UPDATE chitietthietbi SET tinhTrang = N'Đang mượn' WHERE maChiTietTB = $maChiTietTB";
                    mysqli_query($con, $truyvan);
                }
            }
        }

        $p->dongketnoi($con);
        return $kq;
    }
}
?>