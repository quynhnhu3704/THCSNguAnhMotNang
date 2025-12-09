<!-- App/Models/mBaoCaoThongKe.php -->
<?php
include_once('mketnoi.php');

class modelBaoCaoThongKe {

    private $db;

    public function __construct() {
        $this->db = new clsKetNoi();
    }

    // 1. Tổng số thiết bị (đếm theo maChiTietTB)
    public function getTotalThietBi() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT COUNT(*) AS total FROM chitietthietbi";
        $kq = mysqli_query($con, $truyvan);
        $row = mysqli_fetch_assoc($kq);
        $this->db->dongketnoi($con);
        return (int)$row['total'];
    }

    // 2. Thống kê thiết bị theo tình trạng
    public function getThietBiByTinhTrang() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT tinhTrang, COUNT(*) AS count 
                    FROM chitietthietbi 
                    GROUP BY tinhTrang";
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[$row['tinhTrang']] = (int)$row['count'];
        }
        $this->db->dongketnoi($con);
        return $data;
    }

    // 3. Thiết bị theo bộ môn
    public function getThietBiByBoMon() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT bm.tenBoMon, COUNT(ct.maChiTietTB) AS count 
                    FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN bomon bm ON tb.maBoMon = bm.maBoMon
                    GROUP BY bm.maBoMon, bm.tenBoMon
                    ORDER BY count DESC";
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = [
                'tenBoMon' => $row['tenBoMon'] ?? 'Chưa phân loại',
                'count'    => (int)$row['count']
            ];
        }
        $this->db->dongketnoi($con);
        return $data;
    }

    // 4. Thiết bị theo nhà cung cấp
    public function getThietBiByNhaCungCap() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT ncc.tenNhaCungCap, COUNT(ct.maChiTietTB) AS count 
                    FROM chitietthietbi ct
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    LEFT JOIN nhacungcap ncc ON tb.maNhaCungCap = ncc.maNhaCungCap
                    GROUP BY ncc.maNhaCungCap, ncc.tenNhaCungCap
                    ORDER BY count DESC";
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = [
                'tenNhaCungCap' => $row['tenNhaCungCap'] ?? 'Không rõ',
                'count'         => (int)$row['count']
            ];
        }
        $this->db->dongketnoi($con);
        return $data;
    }

    // 5. Thiết bị đang sửa chữa / bảo trì / bảo hành (chỉ lấy những cái đang xử lý)
    public function getThietBiDangSuaChua() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT y.loaiYeuCau, COUNT(*) AS count
                    FROM yeucauscbtbh y
                    WHERE y.loaiYeuCau IN ('Sửa chữa', 'Bảo trì', 'Bảo hành')
                      AND y.tienDo NOT IN ('Đã sửa', 'Không thể sửa', 'Hoàn thành')
                    GROUP BY y.loaiYeuCau";
        $kq = mysqli_query($con, $truyvan);
        $data = [
            'Sửa chữa' => 0,
            'Bảo trì'  => 0,
            'Bảo hành' => 0
        ];
        while ($row = mysqli_fetch_assoc($kq)) {
            if (isset($data[$row['loaiYeuCau']])) {
                $data[$row['loaiYeuCau']] = (int)$row['count'];
            }
        }
        $this->db->dongketnoi($con);
        return $data;
    }

    // 6. Thống kê kế hoạch mua sắm theo trạng thái
    public function getKeHoachMuaSamStats() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT trangThai, 
                           COUNT(*) AS soKeHoach,
                           COALESCE(SUM(tongChiPhi), 0) AS tongChiPhi
                    FROM kehoachmuasam 
                    GROUP BY trangThai";
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[$row['trangThai']] = [
                'soKeHoach'  => (int)$row['soKeHoach'],
                'tongChiPhi' => (float)$row['tongChiPhi']
            ];
        }
        $this->db->dongketnoi($con);
        return $data;
    }

    // 7. Bonus: Top 10 thiết bị được mượn nhiều nhất (tất cả thời gian)
    public function getTop10ThietBiMuon() {
        $con = $this->db->moketnoi();
        $truyvan = "SELECT tb.tenThietBi, COUNT(ctpm.maChiTietPhieuMuon) AS soLanMuon
                    FROM ct_phieumuon ctpm
                    JOIN chitietthietbi ct ON ctpm.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN phieumuon pm ON ctpm.maPhieuMuon = pm.maPhieuMuon
                    WHERE pm.trangThai IN ('Đang mượn', 'Đã xác nhận', 'Đã trả')
                    GROUP BY tb.maThietBi
                    ORDER BY soLanMuon DESC
                    LIMIT 10";
        $kq = mysqli_query($con, $truyvan);
        $data = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $data[] = [
                'tenThietBi' => $row['tenThietBi'],
                'soLanMuon'  => (int)$row['soLanMuon']
            ];
        }
        $this->db->dongketnoi($con);
        return $data;
    }
}
?>