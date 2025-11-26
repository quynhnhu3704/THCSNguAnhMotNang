<!-- App/Controllers/cPhieuMuon.php -->
<?php
include_once('App/Models/mPhieuMuon.php');

class controlPhieuMuon {
    public function getAllPhieuMuon() {
        $p = new modelPhieuMuon();
        $kq = $p->selectAllPhieuMuon();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01PhieuMuon($maPhieuMuon) {
        $p = new modelPhieuMuon();
        $kq = $p->select01PhieuMuon($maPhieuMuon);
        return $kq;
    }

    public function searchPhieuMuon($keyword) {
        $p = new modelPhieuMuon();
        $kq = $p->searchPhieuMuon($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01ChiTietPM($maPhieuMuon) {
        $p = new modelPhieuMuon();
        $kq = $p->select01ChiTietPM($maPhieuMuon);
        if(mysqli_num_rows($kq) > 0) return $kq;
        return false;
    }

    public function insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $ghiChu) {
        $p = new modelPhieuMuon();
        return $p->insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $ghiChu);
    }

    public function insertChiTietPM($maPhieuMuon, $chiTiet) {
        $p = new modelPhieuMuon();
        return $p->insertChiTietPM($maPhieuMuon, $chiTiet); // truyền mảng maThietBi => soLuong
    }

    public function deletePhieuMuon($maPhieuMuon) {
        $p = new modelPhieuMuon();
        return $p->deletePhieuMuon($maPhieuMuon);
    }
}
?>