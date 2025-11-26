<!-- App/Models/mVaiTro.php -->
<?php
include_once('mketnoi.php');

class modelVaiTro{
    public function selectAllVaiTro() {
        $p = new clsKetNoi();
        $truyvan = "select * from vaitro";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>