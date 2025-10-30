<?php
    include_once('Model/mBoMon.php');

    class controlBoMon {
        public function getAllBoMon() {
            $p = new modelBoMon();
            $kq = $p->selectAllBoMon();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function get01BoMon($maBoMon) {
            $p = new modelBoMon();
            $kq = $p->select01BoMon($maBoMon);
            return $kq;
        }
    }
?>