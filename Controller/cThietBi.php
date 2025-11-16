<?php
    include_once('Model/mThietBi.php');

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

        public function updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $tinhTrang, $ghiChu) {
            $p = new modelThietBi();
            $kq = $p->updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $tinhTrang, $ghiChu);
            return $kq;
        }
    }
?>