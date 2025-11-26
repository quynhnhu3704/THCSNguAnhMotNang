<!-- App/Models/mPhieuMuon.php -->
<?php
include_once('mketnoi.php');

class modelPhieuMuon{
    public function selectAllPhieuMuon() {
        $p = new clsKetNoi();
        $truyvan = "select * from phieumuon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01PhieuMuon($maPhieuMuon) {
        $p = new clsKetNoi();
        $truyvan = "select * from phieumuon where maPhieuMuon=$maPhieuMuon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchPhieuMuon($keyword) {
        $p = new clsKetNoi();
        $truyvan = "select * from phieumuon where tenNguoiDung like N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllChiTietPM() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietphieumuon ct
                    JOIN thietbi tb ON ct.maThietBi=tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap=tb.maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ChiTietPM($maChiTietPM) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietphieumuon ct
                    JOIN thietbi tb ON ct.maThietBi=tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap=ncc.maNhaCungCap
                    WHERE maChiTietTB = $maChiTietPM";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "INSERT INTO phieumuon (maNguoiDung, ngayMuon, ngayTra, ghiChu) 
                    VALUES ($maNguoiDung, '$ngayMuon', '$ngayTra', N'$ghiChu')";
        if(mysqli_query($con, $truyvan)) {
            $id = mysqli_insert_id($con); // lấy mã phiếu mượn vừa thêm
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
                        WHERE maThietBi=$maThietBi AND tinhTrang='Khả dụng'";
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
                        WHERE maThietBi=$maThietBi AND tinhTrang='Khả dụng'
                        LIMIT $soLuongMuon";
            $kq = mysqli_query($con, $truyvan);

            // 3. Insert vào chi tiết phiếu mượn và cập nhật tình trạng
            while($r = mysqli_fetch_assoc($kq)) {
                $maChiTietTB = $r['maChiTietTB'];
                $insert = mysqli_query($con, "INSERT INTO chitietphieumuon (maPhieuMuon, maThietBi, maChiTietTB) 
                                                            VALUES ($maPhieuMuon, $maThietBi, $maChiTietTB)");
                if(!$insert) {
                    $p->dongketnoi($con);
                    return false; // Insert thất bại => rollback bên controller
                }
                
                mysqli_query($con, "UPDATE chitietthietbi SET tinhTrang='Đang mượn' 
                                    WHERE maChiTietTB=$maChiTietTB");
            }
        }
        $p->dongketnoi($con);
        return true;
    }

    public function deletePhieuMuon($maPhieuMuon) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "DELETE FROM phieumuon WHERE maPhieuMuon=$maPhieuMuon";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>