<!-- App/Controllers/cYeuCauSCBTBH.php -->
<?php
include_once('App/Models/mYeuCauSCBTBH.php');

class controlYeuCauSCBTBH {
    public function searchYeuCauSCBTBH($keyword) {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->searchYeuCauSCBTBH($keyword);
        return $kq;
    }

    public function getAllYeuCauSCBTBH() {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->selectAllYeuCauSCBTBH();
        return $kq;
    }

    public function get01YeuCauSCBTBH($maYeuCau) {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->select01YeuCauSCBTBH($maYeuCau);
        return $kq;
    }

    public function updateYeuCauSCBTBH($maYeuCau, $loaiYeuCau, $tienDo, $ghiChu) {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->updateYeuCauSCBTBH($maYeuCau, $loaiYeuCau, $tienDo, $ghiChu);
        return $kq;
    }

    public function getAllYeuCauSCCBTBHDaGui() {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->selectAllYeuCauSCCBTBHDaGui();
        return $kq;
    }

    public function searchYeuCauSCBTBHDaGui($keyword) {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->searchYeuCauSCBTBHDaGui($keyword);
        return $kq;
    }

    public function updateTienDo($maYeuCau, $maChiTietTB, $tienDo, $ghiChu) {
        $p = new modelYeuCauSCBTBH();
        $kq = $p->updateTienDo($maYeuCau, $maChiTietTB,$tienDo, $ghiChu);
        return $kq;
    }
}
?>