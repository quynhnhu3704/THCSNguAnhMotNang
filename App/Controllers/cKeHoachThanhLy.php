<!-- App/Controllers/cKeHoachThanhLy.php -->
<?php
include_once('App/Models/mKeHoachThanhLy.php');

class controlKeHoachThanhLy {
    public function getAllKeHoachThanhLy() {
        $p = new modelKeHoachThanhLy();
        $kq = $p->selectAllKeHoachThanhLy();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01KeHoachThanhLy($maKeHoachThanhLy) {
        $p = new modelKeHoachThanhLy();
        $kq = $p->select01KeHoachThanhLy($maKeHoachThanhLy);
        return $kq;
    }

    public function searchKeHoachThanhLy($keyword) {
        $p = new modelKeHoachThanhLy();
        $kq = $p->searchKeHoachThanhLy($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01ChiTietKHThanhLy($maKeHoachThanhLy) {
        $p = new modelKeHoachThanhLy();
        $kq = $p->select01ChiTietKHThanhLy($maKeHoachThanhLy);
        if(mysqli_num_rows($kq) > 0) return $kq;
        return false;
    }

    public function insertKeHoachThanhLy($maNguoiDung, $ngayLap, $tongThuNhap, $trangThai, $ghiChu) {
        $p = new modelKeHoachThanhLy();
        return $p->insertKeHoachThanhLy($maNguoiDung, $ngayLap, $tongThuNhap, $trangThai, $ghiChu);
    }

    public function insertChiTietKHThanhLy($maKeHoachThanhLy, $chiTiet) {
        $p = new modelKeHoachThanhLy();
        return $p->insertChiTietKHThanhLy($maKeHoachThanhLy, $chiTiet); // truyền mảng chi tiết
    }

    public function deleteKeHoachThanhLy($maKeHoachThanhLy) {
        $p = new modelKeHoachThanhLy();
        return $p->deleteKeHoachThanhLy($maKeHoachThanhLy);
    }

    public function updateKeHoachThanhLy($maKeHoachThanhLy, $trangThai, $ghiChu) {
        $p = new modelKeHoachThanhLy();
        return $p->updateKeHoachThanhLy($maKeHoachThanhLy, $trangThai, $ghiChu);
    }
}
?>