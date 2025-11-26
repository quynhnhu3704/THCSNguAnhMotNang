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

    public function insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "INSERT INTO phieumuon (maNguoiDung, ngayMuon, ngayTra, trangThai, ghiChu) 
                    VALUES ($maNguoiDung, '$ngayMuon', '$ngayTra', N'$trangThai', N'$ghiChu')";
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

        foreach($chiTiet as $maThietBi => $soLuong) {
            // kiểm tra tình trạng "Khả dụng" và số lượng
            $truyvan = "SELECT tinhTrang, soLuong FROM thietbi tb 
                        JOIN chitietthietbi ct ON tb.maThietBi = ct.maThietBi
                        WHERE maThietBi=$maThietBi LIMIT 1";
            $kq = mysqli_query($con, $truyvan);
            $r = mysqli_fetch_assoc($kq);
            if($r && $r['tinhTrang'] === 'Khả dụng' && $soLuong <= $r['soLuong']) {
                $truyvan = "INSERT INTO chitietphieumuon (maPhieuMuon, maThietBi, soLuong) 
                            VALUES ($maPhieuMuon, $maThietBi, $soLuong)";
                mysqli_query($con, $truyvan);
            }
        }

        $p->dongketnoi($con);
    }
}
?>