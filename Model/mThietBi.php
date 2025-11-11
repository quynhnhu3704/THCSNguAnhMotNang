<?php
    include_once('mketnoi.php');

    class modelThietBi{
        public function selectAllThietBi() {
            $p = new clsKetNoi();
            $truyvan = "select * from thietbi tb
                        join bomon bm on tb.maBoMon=bm.maBoMon
                        join nhacungcap ncc on ncc.maNhaCungCap=tb.maNhaCungCap";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function select01ThietBi($maThietBi) {
            $p = new clsKetNoi();
            $truyvan = "select * from thietbi tb
                        join bomon bm on tb.maBoMon=bm.maBoMon
                        join nhacungcap ncc on tb.maNhaCungCap=ncc.maNhaCungCap
                        where maThietBi=$maThietBi";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function searchThietBi($keyword) {
            $p = new clsKetNoi();
            $truyvan = "select * from thietbi tb
                        join bomon bm on tb.maBoMon=bm.maBoMon
                        where tenThietBi like N'%$keyword%'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function selectAllThietBiTheoBoMon($maBoMon) {
            $p = new clsKetNoi();
            $truyvan = "select * from thietbi tb
                        join bomon bm on tb.maBoMon=bm.maBoMon
                        where tb.maBoMon=$maBoMon";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>