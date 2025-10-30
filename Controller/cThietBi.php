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
    }
?>