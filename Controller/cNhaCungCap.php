<?php
    include_once('Model/mNhaCungCap.php');

    class controlNhaCungCap {
        public function getAllNhaCungCap() {
            $p = new modelNhaCungCap();
            $kq = $p->selectAllNhaCungCap();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function get01NhaCungCap($maNhaCungCap) {
            $p = new modelNhaCungCap();
            $kq = $p->select01NhaCungCap($maNhaCungCap);
            return $kq;
        }

        public function searchNhaCungCap($keyword) {
            $p = new modelNhaCungCap();
            $kq = $p->searchNhaCungCap($keyword);

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }
    }
?>