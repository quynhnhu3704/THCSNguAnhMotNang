<!-- App/Controllers/cBaoCaoThongKe.php -->
<?php
include_once('App/Models/mBaoCaoThongKe.php');

class controlBaoCaoThongKe {
    private $model;

    public function __construct() {
        $this->model = new modelBaoCaoThongKe();
    }

    /**
     * Lấy toàn bộ dữ liệu thống kê cho trang Báo cáo - Thống kê tổng hợp
     */
    public function getAllThongKe() {
        $data = [];

        // 1. Tổng thiết bị + theo tình trạng
        $data['tongThietBi'] = $this->model->getTotalThietBi();

        $tinhTrang = $this->model->getThietBiByTinhTrang();
        $data['tinhTrang'] = [
            'Khả dụng'  => $tinhTrang['Khả dụng'] ?? 0,
            'Đang mượn' => $tinhTrang['Đang mượn'] ?? 0,
            'Báo hỏng'  => $tinhTrang['Báo hỏng'] ?? 0,
            'Thanh lý'  => $tinhTrang['Thanh lý'] ?? 0,
            // Các trạng thái khác nếu có (ví dụ: Đang sửa chữa, Bảo trì, v.v.)
        ];
        // Bổ sung các trạng thái khác nếu có trong DB nhưng chưa có trong mảng trên
        foreach ($tinhTrang as $tt => $count) {
            if (!isset($data['tinhTrang'][$tt])) {
                $data['tinhTrang'][$tt] = $count;
            }
        }

        // 2. Thiết bị theo bộ môn
        $data['byBoMon'] = $this->model->getThietBiByBoMon();
        // Nếu không có dữ liệu thì trả mảng rỗng tránh lỗi
        if (empty($data['byBoMon'])) {
            $data['byBoMon'] = [];
        }

        // 3. Thiết bị theo nhà cung cấp
        $data['byNhaCungCap'] = $this->model->getThietBiByNhaCungCap();
        if (empty($data['byNhaCungCap'])) {
            $data['byNhaCungCap'] = [];
        }

        // 4. Thiết bị đang sửa chữa / bảo trì / bảo hành (chỉ lấy 3 loại chính)
        $dangSC = $this->model->getThietBiDangSuaChua();
        $data['dangSuaChua'] = [
            'Sửa chữa' => 0,
            'Bảo trì'  => 0,
            'Bảo hành' => 0
        ];
        foreach ($dangSC as $label => $count) {
            if (strpos($label, 'Sửa chữa') !== false) {
                $data['dangSuaChua']['Sửa chữa'] += $count;
            } elseif (strpos($label, 'Bảo trì') !== false) {
                $data['dangSuaChua']['Bảo trì'] += $count;
            } elseif (strpos($label, 'Bảo hành') !== false) {
                $data['dangSuaChua']['Bảo hành'] += $count;
            }
        }

        // 5. Kế hoạch mua sắm – bảng + biểu đồ
        $keHoachMS = $this->model->getKeHoachMuaSamStats();
        $data['keHoachMuaSam'] = [];
        $states = ['Chờ duyệt', 'Chấp thuận', 'Từ chối'];
        foreach ($states as $st) {
            $data['keHoachMuaSam'][] = [
                'trangThai'   => $st,
                'soKeHoach'   => $keHoachMS[$st]['soKeHoach'] ?? 0,
                'tongChiPhi'  => $keHoachMS[$st]['tongChiPhi'] ?? 0
            ];
        }

        // Dữ liệu cho biểu đồ cột kép (số lượng + chi phí)
        $data['chartMuaSamSo'] = array_column($data['keHoachMuaSam'], 'soKeHoach');
        $data['chartMuaSamChiPhi'] = array_map(function($v) { return round($v / 1000000, 1); }, array_column($data['keHoachMuaSam'], 'tongChiPhi')); // đơn vị triệu

        // 6. Kế hoạch thanh lý
        $data['keHoachThanhLy'] = $this->getKeHoachThanhLyStats(); // hàm phụ bên dưới

        // 7. Bonus: Top 10 thiết bị được mượn nhiều nhất
        $data['topMuon'] = $this->getTop10ThietBiMuon();

        return $data;
    }

    // Kế hoạch thanh lý (nếu bạn đã có bảng kehoachthanhly)
    private function getKeHoachThanhLyStats() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT trangThai, COUNT(*) AS count, SUM(tongThuNhap) AS totalValue 
                    FROM kehoachthanhly 
                    GROUP BY trangThai";
        $kq = mysqli_query($con, $truyvan);
        $raw = [];
        while ($row = mysqli_fetch_assoc($kq)) {
            $raw[$row['trangThai']] = ['count' => $row['count'], 'totalValue' => $row['totalValue'] ?? 0];
        }
        $p->dongketnoi($con);

        $states = ['Chờ duyệt', 'Chấp thuận', 'Từ chối'];
        $result = [];
        foreach ($states as $st) {
            $result[] = [
                'trangThai'   => $st,
                'soKeHoach'   => $raw[$st]['count'] ?? 0,
                'tongGiaTri'  => $raw[$st]['totalValue'] ?? 0
            ];
        }

        return $result;
    }

    // Bonus: Top 10 thiết bị được mượn nhiều nhất
    private function getTop10ThietBiMuon() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT tb.tenThietBi, COUNT(ctpm.maChiTietPM) AS soLanMuon
                    FROM chitietphieumuon ctpm
                    JOIN chitietthietbi ct ON ctpm.maChiTietTB = ct.maChiTietTB
                    JOIN thietbi tb ON ct.maThietBi = tb.maThietBi
                    JOIN phieumuon pm ON ctpm.maPhieuMuon = pm.maPhieuMuon
                    WHERE pm.trangThai IN ('Chờ xử lý', 'Đang mượn', 'Đã xác nhận', 'Đã trả')
                    GROUP BY tb.maThietBi
                    ORDER BY soLanMuon DESC
                    LIMIT 10";
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