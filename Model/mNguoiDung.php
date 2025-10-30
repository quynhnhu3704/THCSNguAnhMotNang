<?php
    include_once('mketnoi.php');

    class modelNguoiDung {
        public function mLogin($tenDangNhap, $matKhau) {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung where tenDangNhap = '$tenDangNhap' and matKhau = '$matKhau'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function mCheckTenDangNhap($tenDangNhap) {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung where tenDangNhap = '$tenDangNhap'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function selectAllNguoiDung() {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>