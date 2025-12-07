<!-- App/Controllers/cDashboard.php -->
<?php
include_once('App/Models/mBaoCaoThongKe.php');

class controlDashboard {
    public function getDashboardData() {
        $p = new modelDashboard();
        $data = [
            'totalThietBi' => $p->getTotalThietBi(),
            'tinhTrang' => $p->getThietBiByTinhTrang(),
            'byBoMon' => $p->getThietBiByBoMon(),
            'byNhaCungCap'       => $p->getThietBiByNhaCungCap(),        // MỚI
            'dangSuaChua'        => $p->getThietBiDangSuaChua(),         // MỚI
            'muaSamStats' => $p->getKeHoachMuaSamStats(),
            'thietBiHong' => $p->getThietBiHong(),
            'dangMuon' => $p->getDangMuon()
        ];
        return $data;
    }
}
?>