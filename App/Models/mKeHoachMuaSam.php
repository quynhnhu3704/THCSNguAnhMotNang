<!-- App/Models/mKeHoachMuaSam.php -->
<?php
include_once('mketnoi.php');

class modelKeHoachMuaSam {
    public function selectAllKeHoachMuaSam() {
        $p = new clsKetNoi();
        $truyvan = "SELECT ms.*, nd.hoTen, vt.tenVaiTro, bm.tenBoMon, COUNT(ct.maChiTietKHMuaSam) AS soLuongMuaSam
                    FROM kehoachmuasam ms
                    JOIN nguoidung nd ON ms.maNguoiDung = nd.maNguoiDung
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    JOIN chitietkehoachmuasam ct ON ms.maKeHoachMuaSam = ct.maKeHoachMuaSam
                    GROUP BY ms.maKeHoachMuaSam";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01KeHoachMuaSam($maKeHoachMuaSam) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM kehoachmuasam ms
                    JOIN nguoidung nd ON ms.maNguoiDung = nd.maNguoiDung
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    WHERE maKeHoachMuaSam = $maKeHoachMuaSam";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchKeHoachMuaSam($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT ms.*, nd.hoTen, vt.tenVaiTro, bm.tenBoMon, COUNT(ct.maChiTietKHMuaSam) AS soLuongMuaSam
                    FROM kehoachmuasam ms
                    JOIN nguoidung nd ON ms.maNguoiDung = nd.maNguoiDung
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    JOIN bomon bm ON nd.maBoMon = bm.maBoMon
                    JOIN chitietkehoachmuasam ct ON ms.maKeHoachMuaSam = ct.maKeHoachMuaSam
                    WHERE hoTen LIKE N'%$keyword%'
                    GROUP BY ms.maKeHoachMuaSam";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertKeHoachMuaSam($maNguoiDung, $ngayLap, $tongChiPhi, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "INSERT INTO kehoachmuasam (maNguoiDung, ngayLap, tongChiPhi, trangThai, ghiChu)
                    VALUES ($maNguoiDung, '$ngayLap', $tongChiPhi, N'$trangThai', N'$ghiChu')";
        if(mysqli_query($con, $truyvan)) {
            $id = mysqli_insert_id($con); // lấy mã kế hoạch mua sắm vừa mới thêm để dùng chèn chi tiết kế hoạch mua sắm
            $p->dongketnoi($con);
            return $id;
        } else {
            $p->dongketnoi($con);
            return false;
        }
    }

    public function insertChiTietKHMuaSam($maKeHoachMuaSam, $chiTiet) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        foreach($chiTiet as $maThietBi => $ct) {
            $soLuong = $ct['soLuong'];
            $donGia = $ct['donGia'];
            $thanhTien = $ct['thanhTien'];

            $truyvan = "INSERT INTO chitietkehoachmuasam (maKeHoachMuaSam, maThietBi, soLuong, donGia, thanhTien)
                        VALUES ($maKeHoachMuaSam, $maThietBi, $soLuong, $donGia, $thanhTien)";
            mysqli_query($con, $truyvan);
        }

        $p->dongketnoi($con);
        return true;
    }

    public function selectAllChiTietKHMuaSam() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT * FROM chitietkehoachmuasam ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap = tb.maNhaCungCap";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ChiTietKHMuaSam($maKeHoachMuaSam) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, ct.soLuong FROM chitietkehoachmuasam ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN kehoachmuasam ms ON ct.maKeHoachMuaSam = ms.maKeHoachMuaSam
                    JOIN nguoidung nd ON ms.maNguoiDung = nd.maNguoiDung
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap = tb.maNhaCungCap
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    WHERE ct.maKeHoachMuaSam = $maKeHoachMuaSam";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>