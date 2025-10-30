<?php
    include_once('mketnoi.php');

    class modelBoMon{
        public function selectAllBoMon() {
            $p = new clsKetNoi();
            $truyvan = "select * from bomon";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function select01BoMon($maBoMon) {
            $p = new clsKetNoi();
            $truyvan = "select * from bomon where maBoMon=$maBoMon";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>