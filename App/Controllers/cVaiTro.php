<!-- App/Controllers/cVaiTro.php -->
<?php
include_once('App/Models/mVaiTro.php');

class controlVaiTro {
    public function getAllVaiTro() {
        $p = new modelVaiTro();
        $kq = $p->selectAllVaiTro();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }
}
?>