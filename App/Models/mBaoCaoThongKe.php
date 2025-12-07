<!-- App/Models/mDashboard.php -->
<?php
include_once('mketnoi.php');

class modelDashboard {
    public function getTotalThietBi() {
        $p = new clsKetNoi();
        $truyvan = "SELECT COUNT(DISTINCT maThietBi) AS total FROM thietbi";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq->fetch_assoc()['total'];
    }

    public function getThietBiByTinhTrang() {
        $p = new clsKetNoi();
        $truyvan = "SELECT tinhTrang, COUNT(*) AS count 
                    FROM chitietthietbi 
                    GROUP BY tinhTrang";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[$row['tinhTrang']] = $row['count'];
        }
        $p->dongketnoi($con);
        return $data;
    }

    public function getThietBiByBoMon() {
        $p = new clsKetNoi();
        $truyvan = "SELECT bm.tenBoMon, COUNT(ct.maChiTietTB) AS count 
                    FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    GROUP BY bm.tenBoMon";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = $row;
        }
        $p->dongketnoi($con);
        return $data;
    }

    // Thêm 2 hàm mới vào class modelDashboard
    public function getThietBiByNhaCungCap() {
        $p = new clsKetNoi();
        $truyvan = "SELECT ncc.tenNhaCungCap, COUNT(ct.maChiTietTB) AS count 
                    FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap
                    GROUP BY ncc.tenNhaCungCap
                    ORDER BY count DESC";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = $row;
        }
        $p->dongketnoi($con);
        return $data;
    }

    public function getThietBiDangSuaChua() {
        $p = new clsKetNoi();
        $truyvan = "SELECT y.loaiYeuCau, y.tienDo, COUNT(*) AS count
                    FROM yeucauscbtbh y
                    JOIN chitietthietbi ct ON y.maChiTietTB = ct.maChiTietTB
                    WHERE y.loaiYeuCau IN ('Sửa chữa', 'Bảo trì', 'Bảo hành')
                    AND y.tienDo NOT IN ('Đã sửa', 'Không thể sửa')
                    GROUP BY y.loaiYeuCau, y.tienDo";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $label = $row['loaiYeuCau'] . " - " . $row['tienDo'];
            $data[$label] = $row['count'];
        }
        $p->dongketnoi($con);
        return $data;
    }

    public function getKeHoachMuaSamStats() {
        $p = new clsKetNoi();
        $truyvan = "SELECT trangThai, COUNT(*) AS count, SUM(tongChiPhi) AS totalCost 
                    FROM kehoachmuasam 
                    GROUP BY trangThai";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[$row['trangThai']] = ['count' => $row['count'], 'totalCost' => $row['totalCost']];
        }
        $p->dongketnoi($con);
        return $data;
    }

    public function getThietBiHong() {
        $p = new clsKetNoi();
        $truyvan = "SELECT tb.tenThietBi, COUNT(ct.maChiTietTB) AS count 
                    FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    WHERE ct.tinhTrang IN ('Báo hỏng', 'Thanh lý')
                    GROUP BY tb.tenThietBi";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = $row;
        }
        $p->dongketnoi($con);
        return $data;
    }

    public function getDangMuon() {
        $p = new clsKetNoi();
        $truyvan = "SELECT nd.hoTen, COUNT(pm.maPhieuMuon) AS count 
                    FROM phieumuon pm
                    JOIN nguoidung nd ON pm.maNguoiDung = nd.maNguoiDung
                    WHERE pm.trangThai IN ('Chờ xử lý', 'Đang mượn', 'Đã xác nhận')
                    GROUP BY nd.hoTen";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = $row;
        }
        $p->dongketnoi($con);
        return $data;
    }
}
?>