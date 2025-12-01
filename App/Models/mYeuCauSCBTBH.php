<!-- App/Models/mYeuCauSCBTBH.php -->
<?php
include_once('mketnoi.php');

class modelYeuCauSCBTBH{
    public function searchYeuCauSCBTBH($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, yc.ghiChu FROM yeucauscbtbh yc
                    JOIN chitietthietbi ct ON yc.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap 
                    WHERE tb.tenThietBi LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllYeuCauSCBTBH() {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, yc.ghiChu FROM yeucauscbtbh yc
                    JOIN chitietthietbi ct ON yc.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01YeuCauSCBTBH($maYeuCau) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, yc.ghiChu FROM yeucauscbtbh yc
                    JOIN chitietthietbi ct ON yc.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap
                    WHERE maYeuCau = $maYeuCau";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateYeuCauSCBTBH($maYeuCau, $loaiYeuCau, $tienDo, $ghiChu) {
        $p = new clsKetNoi();
        $truyvan = "UPDATE yeucauscbtbh SET
                    loaiYeuCau = N'$loaiYeuCau',
                    tienDo = N'$tienDo',
                    ghiChu = N'$ghiChu'
                    WHERE maYeuCau = $maYeuCau";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
    
    public function selectAllYeuCauSCCBTBHDaGui() {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, yc.ghiChu FROM yeucauscbtbh yc
                    JOIN chitietthietbi ct ON yc.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap
                    WHERE yc.loaiYeuCau IS NOT NULL";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchYeuCauSCBTBHDaGui($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT *, yc.ghiChu FROM yeucauscbtbh yc
                    JOIN chitietthietbi ct ON yc.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap 
                    WHERE tb.tenThietBi LIKE N'%$keyword%' AND yc.loaiYeuCau IS NOT NULL";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function updateTienDo($maYeuCau, $maChiTietTB, $tienDo, $ghiChu) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();

        // 1. Update tiến độ + ghi chú trong yeucauscbtbh
        $truyvan = "UPDATE yeucauscbtbh SET
                    tienDo = N'$tienDo',
                    ghiChu = N'$ghiChu'
                    WHERE maYeuCau = $maYeuCau";
        $kq = mysqli_query($con, $truyvan);

        // 2. Xác định tình trạng mới trong chitietthietbi
        if ($tienDo == "Đã sửa") {
            $tinhTrang = "Khả dụng";
        } elseif ($tienDo == "Không thể sửa") {
            $tinhTrang = "Thanh lý";
        } else {
            $tinhTrang = null; // các tiến độ khác không cập nhật tình trạng
        }

        // 3. Update tình trạng nếu có thay đổi trong chitietthietbi
        if ($tinhTrang !== null) {
            $truyvan = "UPDATE chitietthietbi SET tinhTrang = N'$tinhTrang' WHERE maChiTietTB = $maChiTietTB";
            mysqli_query($con, $truyvan);
        }

        $p->dongketnoi($con);
        return $kq;
    }
}
?>