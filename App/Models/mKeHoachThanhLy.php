<!-- App/Models/mKeHoachThanhLy.php -->
<?php
include_once('mketnoi.php');

class modelKeHoachThanhLy {
    public function selectAllKeHoachThanhLy() {
        $p = new clsKetNoi();
        $truyvan = "SELECT tl.*, nd.hoTen, vt.tenVaiTro, SUM(ct.soLuong) AS soLuongThanhLy
                    FROM kehoachthanhly tl
                    LEFT JOIN nguoidung nd ON tl.maNguoiDung = nd.maNguoiDung
                    LEFT JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    LEFT JOIN chitietkehoachthanhly ct ON tl.maKeHoachThanhLy = ct.maKeHoachThanhLy
                    GROUP BY tl.maKeHoachThanhLy";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01KeHoachThanhLy($maKeHoachThanhLy) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM kehoachthanhly tl
                    JOIN nguoidung nd ON tl.maNguoiDung = nd.maNguoiDung
                    JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    WHERE maKeHoachThanhLy = $maKeHoachThanhLy";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchKeHoachThanhLy($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT tl.*, nd.hoTen, vt.tenVaiTro, SUM(ct.soLuong) AS soLuongThanhLy
                    FROM kehoachthanhly tl
                    LEFT JOIN nguoidung nd ON tl.maNguoiDung = nd.maNguoiDung
                    LEFT JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    LEFT JOIN chitietkehoachthanhly ct ON tl.maKeHoachThanhLy = ct.maKeHoachThanhLy
                    WHERE hoTen LIKE N'%$keyword%'
                    GROUP BY tl.maKeHoachThanhLy";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function insertKeHoachThanhLy($maNguoiDung, $ngayLap, $tongThuNhap, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "INSERT INTO kehoachthanhly (maNguoiDung, ngayLap, tongThuNhap, trangThai, ghiChu)
                    VALUES ($maNguoiDung, '$ngayLap', $tongThuNhap, N'$trangThai', N'$ghiChu')";
        if(mysqli_query($con, $truyvan)) {
            $id = mysqli_insert_id($con); // lấy mã kế hoạch thanh lý vừa mới thêm để dùng chèn chi tiết kế hoạch thanh lý
            $p->dongketnoi($con);
            return $id;
        } else {
            $p->dongketnoi($con);
            return false;
        }
    }

    public function insertChiTietKHThanhLy($maKeHoachThanhLy, $chiTiet) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        foreach($chiTiet as $maThietBi => $ct) {
            $soLuong = $ct['soLuong'];
            $donGia = $ct['donGia'];
            $thanhTien = $ct['thanhTien'];

            $truyvan = "INSERT INTO chitietkehoachthanhly (maKeHoachThanhLy, maThietBi, soLuong, donGia, thanhTien)
                        VALUES ($maKeHoachThanhLy, $maThietBi, $soLuong, $donGia, $thanhTien)";
            mysqli_query($con, $truyvan);
        }

        $p->dongketnoi($con);
        return true;
    }

    public function selectAllChiTietKHThanhLy() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT * FROM chitietkehoachthanhly ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ChiTietKHThanhLy($maKeHoachThanhLy) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, ct.soLuong FROM chitietkehoachthanhly ct
                    LEFT JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    LEFT JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    LEFT JOIN kehoachthanhly tl ON ct.maKeHoachThanhLy = tl.maKeHoachThanhLy
                    LEFT JOIN nguoidung nd ON tl.maNguoiDung = nd.maNguoiDung
                    LEFT JOIN vaitro vt ON nd.maVaiTro = vt.maVaiTro
                    WHERE ct.maKeHoachThanhLy = $maKeHoachThanhLy";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteKeHoachThanhLy($maKeHoachThanhLy) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // Xóa chi tiết kế hoạch thanh lý trước
        mysqli_query($con,  "DELETE FROM chitietkehoachthanhly WHERE maKeHoachThanhLy = $maKeHoachThanhLy");

        // Xóa kế hoạch thanh lý
        $kq = mysqli_query($con, "DELETE FROM kehoachthanhly WHERE maKeHoachThanhLy = $maKeHoachThanhLy");

        $p->dongketnoi($con);
        return $kq;
    }

    public function updateKeHoachThanhLy($maKeHoachThanhLy, $trangThai, $ghiChu) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE kehoachthanhly SET 
                    trangThai = N'$trangThai',
                    ghiChu = N'$ghiChu'
                    WHERE maKeHoachThanhLy = $maKeHoachThanhLy";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>