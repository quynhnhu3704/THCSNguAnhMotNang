<?php
    include_once('App/Models/mBoMon.php');

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

        public function searchBoMon($keyword) {
            $p = new modelBoMon();
            $kq = $p->searchBoMon($keyword);

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function checkName($tenBoMon) {
            $p = new modelBoMon();
            $kq = $p->checkName($tenBoMon);
            
            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function insertBoMon($tenBoMon, $moTa) {
            $p = new modelBoMon();
            $kq = $p->insertBoMon($tenBoMon, $moTa);
            return $kq;
        }

        public function updateBoMon($maBoMon, $tenBoMon, $moTa) {
            $p = new modelBoMon();
            $kq = $p->updateBoMon($maBoMon, $tenBoMon, $moTa);
            return $kq;
        }

        public function deleteBoMon($maBoMon) {
            $p = new modelBoMon();
            $kq = $p->deleteBoMon($maBoMon);
            return $kq;
        }
    }
?>