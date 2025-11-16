<?php
    include_once('mketnoi.php');

    class modelNhaCungCap{
        public function selectAllNhaCungCap() {
            $p = new clsKetNoi();
            $truyvan = "select * from nhacungcap";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function select01NhaCungCap($maNhaCungCap) {
            $p = new clsKetNoi();
            $truyvan = "select * from nhacungcap where maNhaCungCap=$maNhaCungCap";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function searchNhaCungCap($keyword) {
            $p = new clsKetNoi();
            $truyvan = "select * from nhacungcap where tenNhaCungCap like N'%$keyword%'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>