<?php
    include_once('mketnoi.php');

    class modelTOR{
        public function selectAllTOR() {
            $p = new clsKetNoi();
            $truyvan = "select * from typeofrooms";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function select01TOR($type_id) {
            $p = new clsKetNoi();
            $truyvan = "select * from typeofrooms where type_id=$type_id";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>