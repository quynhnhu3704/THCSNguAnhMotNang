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
            $truyvan = "select * from nguoidung nd
                        left join bomon bm on bm.maBoMon=nd.maBoMon
                        left join vaitro vt on vt.maVaiTro=nd.maVaiTro
                        order by tenDangNhap";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function searchNguoiDung($keyword) {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung nd
                        left join bomon bm on bm.maBoMon=nd.maBoMon
                        left join vaitro vt on vt.maVaiTro=nd.maVaiTro
                        where hoTen like N'%$keyword%'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function select01NguoiDung($maNguoiDung) {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung where maNguoiDung=$maNguoiDung";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function checkName($tenDangNhap) {
            $p = new clsKetNoi();
            $truyvan = "select * from nguoidung where tenDangNhap=N'$tenDangNhap'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon)  {
            $p = new clsKetNoi();
            $truyvan = "insert into nguoidung(tenDangNhap, hoTen, matKhau, soDienThoai, email, maVaiTro, maBoMon)
                        values(N'$tenDangNhap', N'$hoTen', N'$matKhauTamThoi', N'$soDienThoai', N'$email', $maVaiTro, $maBoMon)";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function updateNguoiDung($maNguoiDung, $tenDangNhap, $matKhauMoi, $hoTen, $maVaiTro, $maBoMon, $soDienThoai, $email) {
            $p = new clsKetNoi();

            // Nếu maBoMon là NULL
            $maBoMon = empty($maBoMon) ? "NULL" : $maBoMon;

            if($matKhauMoi == "") {
                $truyvan = "update nguoidung set tenDangNhap=N'$tenDangNhap',
                            hoTen=N'$hoTen',
                            soDienThoai=N'$soDienThoai',
                            email=N'$email',
                            maVaiTro=$maVaiTro,
                            maBoMon=$maBoMon
                            where maNguoiDung=$maNguoiDung";
            } else {
                $truyvan = "update nguoidung set tenDangNhap=N'$tenDangNhap',
                            hoTen=N'$hoTen',
                            matKhau=N'$matKhauMoi',
                            soDienThoai=N'$soDienThoai',
                            email=N'$email',
                            maVaiTro=$maVaiTro,
                            maBoMon=$maBoMon
                            where maNguoiDung=$maNguoiDung";
            }
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function deleteNguoiDung($maNguoiDung) {
            $p = new clsKetNoi();
            $truyvan = "delete from nguoidung where maNguoiDung=$maNguoiDung";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>