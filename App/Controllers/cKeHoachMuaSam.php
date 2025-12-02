<!-- App/Controllers/cKeHoachMuaSam.php -->
<?php
include_once('App/Models/mKeHoachMuaSam.php');

class controlKeHoachMuaSam {
    public function getAllKeHoachMuaSam() {
        $p = new modelKeHoachMuaSam();
        $kq = $p->selectAllKeHoachMuaSam();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01KeHoachMuaSam($maKeHoachMuaSam) {
        $p = new modelKeHoachMuaSam();
        $kq = $p->select01KeHoachMuaSam($maKeHoachMuaSam);
        return $kq;
    }

    public function searchKeHoachMuaSam($keyword) {
        $p = new modelKeHoachMuaSam();
        $kq = $p->searchKeHoachMuaSam($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01ChiTietKHMuaSam($maKeHoachMuaSam) {
        $p = new modelKeHoachMuaSam();
        $kq = $p->select01ChiTietKHMuaSam($maKeHoachMuaSam);
        if(mysqli_num_rows($kq) > 0) return $kq;
        return false;
    }

    public function insertKeHoachMuaSam($maNguoiDung, $ngayLap, $tongChiPhi, $trangThai, $ghiChu) {
        $p = new modelKeHoachMuaSam();
        return $p->insertKeHoachMuaSam($maNguoiDung, $ngayLap, $tongChiPhi, $trangThai, $ghiChu);
    }

    public function insertChiTietKHMuaSam($maKeHoachMuaSam, $chiTiet) {
        $p = new modelKeHoachMuaSam();
        return $p->insertChiTietKHMuaSam($maKeHoachMuaSam, $chiTiet); // truyền mảng chi tiết
    }
}
?>