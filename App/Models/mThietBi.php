<?php
include_once('mketnoi.php');

class modelThietBi{
    public function selectAllThietBi() {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, tb.moTa FROM thietbi tb
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap=tb.maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ThietBi($maThietBi) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, tb.moTa FROM thietbi tb
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap=ncc.maNhaCungCap
                    WHERE maThietBi=$maThietBi";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchThietBi($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM thietbi tb
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap=ncc.maNhaCungCap
                    WHERE tenThietBi LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllThietBiTheoBoMon($maBoMon) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM thietbi tb
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    WHERE tb.maBoMon=$maBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function checkName($tenThietBi) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM thietbi WHERE tenThietBi=N'$tenThietBi'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function getConnection() {
        $p = new clsKetNoi();
        return $p->moketnoi();
    }

    public function insertThietBi($tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa) {
        $p = new clsKetNoi();
        $truyvan = "INSERT INTO thietbi (tenThietBi, hinhAnh, donVi, soLuong, lop, maBoMon, maNhaCungCap, moTa) 
                    VALUES (N'$tenThietBi', N'$hinh', N'$donVi', $soLuong, N'$lop', $maBoMon, $maNhaCungCap, N'$moTa')";
        $con = $p->moketnoi();

        if(mysqli_query($con, $truyvan)) {
            $id = mysqli_insert_id($con); // Lấy mã thiết bị vừa thêm
            $p->dongketnoi($con);
            return $id;
        } else {
            $p->dongketnoi($con);
            return false;
        }
    }

    public function updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuongMoi, $lop, $maBoMon, $maNhaCungCap, $moTa) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // 1. Lấy số lượng hiện tại trong bảng thietbi
        $truyvan = "SELECT soLuong FROM thietbi WHERE maThietBi=$maThietBi";
        $kq = mysqli_query($con, $truyvan);
        $r = mysqli_fetch_assoc($kq);
        $soLuongCu = (int) $r['soLuong'];

        // 2. Cập nhật bảng thietbi
        $truyvan = "UPDATE thietbi SET
                    tenThietBi=N'$tenThietBi',
                    hinhAnh=N'$hinh',
                    donVi=N'$donVi',
                    soLuong=$soLuongMoi,
                    lop=N'$lop',
                    maBoMon=$maBoMon,
                    maNhaCungCap=$maNhaCungCap,
                    moTa=N'$moTa'
                    WHERE maThietBi=$maThietBi";

        $kq = mysqli_query($con, $truyvan);

        // 3. Xử lý thay đổi số lượng chi tiết
        if($soLuongMoi > $soLuongCu) {
            // Thêm bản ghi mới
            $them = $soLuongMoi - $soLuongCu;
            for($i=0; $i<$them; $i++) {
                mysqli_query($con, "INSERT INTO chitietthietbi (maThietBi, tinhTrang, ghiChu) VALUES ($maThietBi, 'Khả dụng', NULL)");
            }
        } else if($soLuongMoi < $soLuongCu) {
            // Xóa bản "Khả dụng" dư thừa
            $xoa = $soLuongCu - $soLuongMoi;

            // --- Check số lượng khả dụng ---
            $truyvan = "SELECT COUNT(*) AS soLuongKhaDung FROM chitietthietbi WHERE maThietBi=$maThietBi AND tinhTrang='Khả dụng'";
            $kq = mysqli_query($con, $truyvan);
            $soLuongKhaDung = (int) mysqli_fetch_assoc($kq)['soLuongKhaDung'];

            if($xoa > $soLuongKhaDung) {
                $p->dongketnoi($con);
                return false; // Không đủ khả dụng → báo lỗi
            }

            $truyvan = "DELETE FROM chitietthietbi
                        WHERE maChiTietTB IN (
                            SELECT maChiTietTB FROM (
                                SELECT maChiTietTB 
                                FROM chitietthietbi 
                                WHERE maThietBi=$maThietBi AND tinhTrang='Khả dụng'
                                LIMIT $xoa
                            ) AS tmp
                        )";
            $kq = mysqli_query($con, $truyvan);
        }

        $p->dongketnoi($con);
        return $kq;
    }

    public function deleteThietBi($maThietBi) {
        $p = new clsKetNoi();
        $truyvan = "DELETE FROM thietbi WHERE maThietBi=$maThietBi";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllChiTietTB() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi=tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON ncc.maNhaCungCap=tb.maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01ChiTietTB($maChiTietTB) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi=tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap=ncc.maNhaCungCap
                    WHERE maChiTietTB = $maChiTietTB";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchChiTietTB($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi=tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon=bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap=ncc.maNhaCungCap
                    WHERE tenThietBi LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateHong($maChiTietTB, $tinhTrang, $ghiChu) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE chitietthietbi SET tinhTrang=N'$tinhTrang', 
                    ghiChu=N'$ghiChu' 
                    WHERE maChiTietTB=$maChiTietTB";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>