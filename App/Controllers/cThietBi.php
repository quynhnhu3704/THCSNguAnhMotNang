<!-- App/Controllers/cThietBi.php -->
<?php
include_once('App/Models/mThietBi.php');

class controlThietBi {
    public function getAllThietBi() {
        $p = new modelThietBi();
        $kq = $p->selectAllThietBi();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01ThietBi($maThietBi) {
        $p = new modelThietBi();
        $kq = $p->select01ThietBi($maThietBi);
        return $kq;
    }

    public function searchThietBi($keyword) {
        $p = new modelThietBi();
        $kq = $p->searchThietBi($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function getAllThietBiTheoBoMon($maBoMon) {
        $p = new modelThietBi();
        $kq = $p->selectAllThietBiTheoBoMon($maBoMon);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function checkName($tenThietBi) {
        $p = new modelThietBi();
        $kq = $p->checkName($tenThietBi);
        
        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function getConnection() {
        $p = new modelThietBi();
        return $p->getConnection();
    }

    public function insertThietBi($tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa) {
        $p = new modelThietBi();
        $kq = $p->insertThietBi($tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa);
        return $kq;
    }

    public function updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa) {
        $p = new modelThietBi();
        $kq = $p->updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa);
        return $kq;
    }

    public function deleteThietBi($maThietBi) {
        $p = new modelThietBi();
        $kq = $p->deleteThietBi($maThietBi);
        return $kq;
    }

    public function getAllChiTietTB() {
        $p = new modelThietBi();
        $kq = $p->selectAllChiTietTB();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01ChiTietTB($maThietBi) {
        $p = new modelThietBi();
        $kq = $p->select01ChiTietTB($maThietBi);
        return $kq;
    }

    public function searchChiTietTB($keyword) {
        $p = new modelThietBi();
        $kq = $p->searchChiTietTB($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function updateHong($maChiTietTB, $tinhTrang, $ghiChu) {
        $p = new modelThietBi();
        $kq = $p->updateHong($maChiTietTB, $tinhTrang, $ghiChu);
        return $kq;
    }
}
?>