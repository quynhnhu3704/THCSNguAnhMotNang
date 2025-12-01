<!-- App/Models/mBoMon.php -->
<?php
include_once('mketnoi.php');

class modelBoMon {
    public function selectAllBoMon() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM bomon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01BoMon($maBoMon) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM bomon WHERE maBoMon = $maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchBoMon($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM bomon WHERE tenBoMon like N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function checkName($tenBoMon) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM bomon WHERE tenBoMon = N'$tenBoMon'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertBoMon($tenBoMon, $moTa) {
        $p = new clsKetNoi();
        $truyvan = "INSERT INTO bomon (tenBoMon, moTa) VALUES (N'$tenBoMon', N'$moTa')";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateBoMon($maBoMon, $tenBoMon, $moTa) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE bomon SET tenBoMon = N'$tenBoMon', moTa = N'$moTa' WHERE maBoMon = $maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteBoMon($maBoMon) {
        $p = new clsKetNoi();
        $truyvan = "DELETE FROM bomon WHERE maBoMon = $maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>