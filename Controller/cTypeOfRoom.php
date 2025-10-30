<?php
    include_once('Model/mTypeOfRoom.php');

    class controlTOR {
        public function getAllTOR() {
            $p = new modelTOR();
            $kq = $p->selectAllTOR();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function get01TOR($type_id) {
            $p = new modelTOR();
            $kq = $p->select01TOR($type_id);
            return $kq;
        }
    }
?>