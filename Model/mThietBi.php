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
                        join nhacungcap ncc on tb.maNhaCungCap=ncc.maNhaCungCap
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

        public function updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $tinhTrang, $ghiChu) {
            $p = new clsKetNoi();
            $truyvan = "update thietbi set tenThietBi=N'$tenThietBi', hinhAnh=N'$hinh', donVi=N'$donVi', soLuong=$soLuong, lop=N'$lop', maBoMon=$maBoMon, maNhaCungCap=$maNhaCungCap, tinhTrang=N'$tinhTrang', ghiChu=N'$ghiChu' where maThietBi=$maThietBi";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>