<!-- App/Models/mNhaCungCap.php -->
<?php
include_once('mketnoi.php');

class modelNhaCungCap {
    public function selectAllNhaCungCap() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nhacungcap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01NhaCungCap($maNhaCungCap) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nhacungcap WHERE maNhaCungCap = $maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchNhaCungCap($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nhacungcap WHERE tenNhaCungCap LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function checkName($tenNhaCungCap) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nhacungcap WHERE tenNhaCungCap = N'$tenNhaCungCap'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertNhaCungCap($tenNhaCungCap, $diaChi, $soDienThoai, $email) {
        $p = new clsKetNoi();
        $truyvan = "INSERT INTO nhacungcap (tenNhaCungCap, diaChi, soDienThoai, email) 
                    VALUES (N'$tenNhaCungCap', N'$diaChi', N'$soDienThoai', N'$email')";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateNhaCungCap($maNhaCungCap, $tenNhaCungCap, $diaChi, $soDienThoai, $email) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE nhacungcap SET 
                    tenNhaCungCap = N'$tenNhaCungCap', 
                    diaChi = N'$diaChi', 
                    soDienThoai = N'$soDienThoai', 
                    email = N'$email' 
                    WHERE maNhaCungCap = $maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteNhaCungCap($maNhaCungCap) {
        $p = new clsKetNoi();
        $truyvan = "DELETE FROM nhacungcap WHERE maNhaCungCap = $maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>