<!-- App/Models/mNguoiDung.php -->
<?php
include_once('mketnoi.php');

class modelNguoiDung {
    public function mLogin($tenDangNhap, $matKhau) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung WHERE tenDangNhap=N'$tenDangNhap' AND matKhau=N'$matKhau'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function mCheckTenDangNhap($tenDangNhap) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung WHERE tenDangNhap=N'$tenDangNhap'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllNguoiDung() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN bomon bm ON bm.maBoMon=nd.maBoMon
                    LEFT JOIN vaitro vt ON vt.maVaiTro=nd.maVaiTro
                    ORDER BY tenDangNhap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchNguoiDung($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN bomon bm ON bm.maBoMon=nd.maBoMon
                    LEFT JOIN vaitro vt ON vt.maVaiTro=nd.maVaiTro
                    WHERE hoTen LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01NguoiDung($maNguoiDung) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN bomon bm ON bm.maBoMon=nd.maBoMon
                    LEFT JOIN vaitro vt ON vt.maVaiTro=nd.maVaiTro
                    WHERE maNguoiDung=$maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function checkName($tenDangNhap) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung WHERE tenDangNhap=N'$tenDangNhap'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon)  {
        $p = new clsKetNoi();
        $truyvan = "INSERT INTO nguoidung (tenDangNhap, hoTen, matKhau, soDienThoai, email, maVaiTro, maBoMon)
                    VALUES (N'$tenDangNhap', N'$hoTen', N'$matKhauTamThoi', N'$soDienThoai', N'$email', $maVaiTro, $maBoMon)";
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
            $truyvan = "UPDATE nguoidung SET tenDangNhap=N'$tenDangNhap',
                        hoTen=N'$hoTen',
                        soDienThoai=N'$soDienThoai',
                        email=N'$email',
                        maVaiTro=$maVaiTro,
                        maBoMon=$maBoMon
                        WHERE maNguoiDung=$maNguoiDung";
        } else {
            $truyvan = "UPDATE nguoidung SET tenDangNhap=N'$tenDangNhap',
                        hoTen=N'$hoTen',
                        matKhau=N'$matKhauMoi',
                        soDienThoai=N'$soDienThoai',
                        email=N'$email',
                        maVaiTro=$maVaiTro,
                        maBoMon=$maBoMon
                        WHERE maNguoiDung=$maNguoiDung";
        }
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteNguoiDung($maNguoiDung) {
        $p = new clsKetNoi();
        $truyvan = "DELETE FROM nguoidung WHERE maNguoiDung=$maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateThongTinCaNhan($maNguoiDung, $tenDangNhap, $hoTen, $soDienThoai, $email) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE nguoidung SET
                    tenDangNhap=N'$tenDangNhap',
                    hoTen=N'$hoTen',
                    soDienThoai=N'$soDienThoai',
                    email=N'$email'
                    WHERE maNguoiDung=$maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateMatKhau($maNguoiDung, $matKhauMoi) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE nguoidung SET matKhau=N'$matKhauMoi' WHERE maNguoiDung=$maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateQuyen($maNguoiDung, $maVaiTro, $maBoMon) {
        $p = new clsKetNoi();

        // Nếu maBoMon là NULL
        $maBoMon = empty($maBoMon) ? "NULL" : $maBoMon;
        
        $truyvan = "UPDATE nguoidung SET
                    maVaiTro=$maVaiTro,
                    maBoMon=$maBoMon
                    WHERE maNguoiDung=$maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>