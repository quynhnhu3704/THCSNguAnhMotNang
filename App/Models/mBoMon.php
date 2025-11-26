<!-- App/Models/mBoMon.php -->
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

    public function searchBoMon($keyword) {
        $p = new clsKetNoi();
        $truyvan = "select * from bomon where tenBoMon like N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function checkName($tenBoMon) {
        $p = new clsKetNoi();
        $truyvan = "select * from bomon where tenBoMon=N'$tenBoMon'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertBoMon($tenBoMon, $moTa) {
        $p = new clsKetNoi();
        $truyvan = "insert into bomon(tenBoMon, moTa) values(N'$tenBoMon', N'$moTa')";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateBoMon($maBoMon, $tenBoMon, $moTa) {
        $p = new clsKetNoi();
        $truyvan = "update bomon set tenBoMon=N'$tenBoMon', moTa=N'$moTa' where maBoMon=$maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteBoMon($maBoMon) {
        $p = new clsKetNoi();
        $truyvan = "delete from bomon where maBoMon=$maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>