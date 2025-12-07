<!-- App/Views/hieutruong/kehoachmuasam/duyetkehoachmuasam.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cKeHoachThanhLy.php');
$p = new controlKeHoachThanhLy();

$maKeHoachThanhLy = $_GET['maKeHoachThanhLy'];

if(!$maKeHoachThanhLy) {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dsthanhly';</script>";
    exit();
}

$kq = $p->get01KeHoachThanhLy($maKeHoachThanhLy);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dsthanhly';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 56rem; width: 100%;">
        <div class="card-body p-5">
            <div class="row d-flex justify-content-between align-items-center mb-3">
                <div class="col-6 text-center">
                    <h6 class="fw-bold text-uppercase">Trường THCS Ngũ Anh Một Nàng</h6>
                    <h6 class="fw-semibold text-uppercase">Phòng Quản lý thiết bị</h6>
                    <div class="d-flex justify-content-center my-3">
                        <div style="width: 10em; border-bottom: 1px solid gray;"></div>
                    </div>
                </div>
                <!-- Quốc hiệu - Tiêu ngữ -->
                <div class="col-6 text-center">
                    <h6 class="fw-bold text-uppercase">Cộng hòa xã hội chủ nghĩa Việt Nam</h6>
                    <h6 class="fw-semibold">Độc lập - Tự do - Hạnh phúc</h6>
                    <div class="d-flex justify-content-center my-3">
                        <div style="width: 10em; border-bottom: 1px solid gray;"></div>
                    </div>
                </div>
            </div>

            <!-- Ngày tháng -->
            <p class="text-end mb-4">
                <?php 
                    $ngay = date("d", strtotime($r['ngayLap']));
                    $thang = date("m", strtotime($r['ngayLap']));
                    $nam = date("Y", strtotime($r['ngayLap']));
                    echo "<i>TP. Hồ Chí Minh, ngày $ngay tháng $thang năm $nam</i>";
                ?>
            </p>

            <!-- Tiêu đề đơn -->
            <h4 class="text-center fw-bold text-primary text-uppercase mb-4">Đơn đề nghị phê duyệt kế hoạch thanh lý thiết bị</h4>

            <!-- Thông tin người lập -->
            <p><strong>Họ tên:</strong> <?= $r['hoTen'] ?></p>
            <p><strong>Vai trò:</strong> <?= $r['tenVaiTro'] ?></p>
            <p><strong>Bộ môn:</strong>  <?= !empty($r['tenBoMon']) ? $r['tenBoMon'] : 'Không có' ?></p>
            <p><strong>Ngày lập:</strong> <?= date("d/m/Y", strtotime($r['ngayLap'])) ?></p>

            <!-- Danh sách thiết bị -->
            <h5 class="fw-semibold text-secondary mt-4 mb-2">Danh sách thiết bị đề nghị thanh lý</h5>
            <div class="d-flex justify-content-center mb-3">
                <div class="table-responsive text-center" style="width: 100%;">
                    <table class="table table-striped table-borderless align-middle" style="font-size: 0.85em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thiết bị</th>
                                <th>Bộ môn</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $p->get01ChiTietKHThanhLy($maKeHoachThanhLy);
                            if($res && $res->num_rows > 0) {
                                $dem = 1;
                                while($row = $res->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td><strong>' . $dem++ . '</strong></td>';
                                    echo '<td title="'. $row['tenThietBi'] .'">' . $row['tenThietBi'] . '</td>';
                                    echo '<td>' . $row['tenBoMon'] . '</td>';
                                    echo '<td>' . $row['soLuong'] . '</td>';
                                    echo '<td>' . number_format($row['donGia'], 0, ',', '.') . ' ₫</td>';
                                    echo '<td>' . number_format($row['thanhTien'], 0, ',', '.') . ' ₫</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center text-muted">Chưa có thiết bị nào trong kế hoạch này.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Tổng chi phí -->
            <p class="fw-bold mb-4" style="font-size: 1.25rem; border-left: 4px solid crimson; padding-left: 1em;">
                Tổng thu nhập: 
                <span class="text-danger"><?= number_format($r['tongThuNhap'], 0, ',', '.') ?> ₫</span>
            </p>

            <!-- Phê duyệt -->
            <form action="#" method="post">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
                    <select name="trangThai" class="form-select" required>
                        <option value="" disabled>-- Chọn trạng thái --</option>
                        <option value="Chờ duyệt" <?= ($r["trangThai"] == 'Chờ duyệt') ? 'selected' : '' ?>>Chờ duyệt</option>
                        <option value="Chấp thuận" <?= ($r["trangThai"] == 'Chấp thuận') ? 'selected' : '' ?>>Chấp thuận</option>
                        <option value="Từ chối" <?= ($r["trangThai"] == 'Từ chối') ? 'selected' : '' ?>>Từ chối</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Ghi chú</label>
                    <textarea class="form-control" name="ghiChu" rows="3" style="resize: none;" placeholder="Nhập ý kiến nhận xét..."></textarea>
                </div>

                <div class="text-end mb-2">
                    <button type="submit" name="btnluu" class="btn btn-success px-4">Xác nhận</button>
                </div>
            </form>

            <br><br>

            <!-- Chữ ký và con dấu -->
            <div class="row">
                <!-- Người lập -->
                <div class="col-6 text-center">
                    <div class="fw-semibold">Người lập kế hoạch</div>
                    <div class="fst-italic" style="font-size:0.85rem;">(Ký, ghi rõ họ tên)</div>

                    <!-- Fake digital signature (SVG) -->
                    <div style="margin-top:18px;">
                        <!-- simple stylized "signature" -->
                        <svg width="220" height="70" viewBox="0 0 220 70" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 45 C30 10, 80 70, 110 50 C140 30, 170 60, 210 20" stroke="#1a237e" stroke-width="2" fill="none" stroke-linecap="round"/>
                            <text x="12" y="62" font-size="12.5" fill="#1a237e" font-family="Momo Signature, cursive"><?= htmlspecialchars($r['hoTen']) ?></text>
                        </svg>
                    </div>
                </div>

                <!-- Hiệu trưởng + Con dấu giả -->
                <div class="col-6 text-center">
                    <div class="fw-semibold">Hiệu trưởng</div>
                    <div class="fst-italic" style="font-size:0.85rem;">(Ký, đóng dấu)</div>
                    
                    <?php if(isset($trangThai) && $trangThai != "Chờ duyệt"): ?>
                    <div style="margin-top:6px; display:flex; justify-content:center; gap:20px; align-items:center;">
                        <!-- Fake round red seal made with CSS + SVG text -->
                        <div style="width:120px; height:120px; border-radius:50%; border:6px solid #d32f2f; display:flex; justify-content:center; align-items:center; position:relative;">
                            <div style="text-align:center; transform:rotate(-12deg);">
                                <div style="font-weight:700; color:#d32f2f; font-size:10px; letter-spacing:1px;">TRƯỜNG THCS</div>
                                <div style="font-weight:900; color:#d32f2f; font-size:14px; margin-top:4px;">NGŨ ANH</div>
                                <div style="font-weight:900; color:#d32f2f; font-size:14px;">MỘT NÀNG</div>
                                <div style="font-size:9px; color:#d32f2f; margin-top:6px;">Số: <?= date("Y") ?>-QĐ</div>
                            </div>
                        </div>

                        <!-- Signature under seal -->
                        <div style="text-align:left;">
                            <svg width="180" height="70" viewBox="0 0 180 70" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 50 C35 10, 90 65, 140 45" stroke="#0b6623" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                                <text x="8" y="64" font-size="12.5" fill="#0b6623" font-family="Momo Signature, cursive">TS. Nguyễn Văn Hiệu</text>
                            </svg>
                            <div style="font-size:12px; margin-top:4px; font-weight:600;">(Hiệu trưởng)</div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>               
    </div>
</div>

<?php
if(isset($_POST['btnluu'])) {
    $trangThai = trim($_POST['trangThai']);
    $ghiChu = trim($_POST['ghiChu']) !== '' ? trim($_POST['ghiChu']) : $r['ghiChu']; // Không nhập ghi chú mới thì giữ nguyên ghi chú cũ từ db
    
    if($p->updateKeHoachThanhLy($maKeHoachThanhLy, $trangThai, $ghiChu)) {
        echo '<script>alert("Duyệt kế hoạch thành công!"); window.location.href="index.php?page=dsthanhly";</script>';
    } else {
        echo '<script>alert("Duyệt kế hoạch thất bại!"); window.history.back();</script>';
    }
}
?>

<style>
    th, td {
        max-width: 12.5em;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>