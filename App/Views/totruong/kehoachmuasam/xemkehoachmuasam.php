<!-- App/Views/totruong/kehoachmuasam/xemkehoachmuasam.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cKeHoachMuaSam.php');
$p = new controlKeHoachMuaSam();

$maKeHoachMuaSam = $_GET['maKeHoachMuaSam'];

if(!$maKeHoachMuaSam) {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachmuasam';</script>";
    exit();
}

$kq = $p->get01KeHoachMuaSam($maKeHoachMuaSam);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachmuasam';</script>";
    exit();
}
?>

<div class="d-flex justify-content-between align-items-center mx-4 my-4">
    <button type="button" class="btn btn-outline-primary" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>
    <button type="button" id="exportPDF" class="btn btn-outline-secondary"><i class="bi bi-printer me-2"></i>Xuất PDF</button>
</div>

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
            <h4 class="text-center fw-bold text-primary text-uppercase mb-4">Đơn đề nghị phê duyệt kế hoạch mua sắm thiết bị</h4>

            <!-- Thông tin người lập -->
            <p><strong>Họ tên:</strong> <?= $r['hoTen'] ?></p>
            <p><strong>Vai trò:</strong> <?= $r['tenVaiTro'] ?></p>
            <p><strong>Bộ môn:</strong> <?= !empty($r['tenBoMon']) ? $r['tenBoMon'] : 'Không có' ?></p>
            <p><strong>Ngày lập:</strong> <?= date("d/m/Y", strtotime($r['ngayLap'])) ?></p>

            <!-- Danh sách thiết bị -->
            <h5 class="fw-semibold text-secondary mt-4 mb-2">Danh sách thiết bị đề nghị mua sắm</h5>
            <div class="d-flex justify-content-center mb-3">
                <div class="table-responsive text-center" style="width: 100%;">
                    <table class="table table-striped table-borderless align-middle" style="font-size: 0.85em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thiết bị</th>
                                <th>Bộ môn</th>
                                <th>Nhà cung cấp</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $p->get01ChiTietKHMuaSam($maKeHoachMuaSam);
                            if($res && $res->num_rows > 0) {
                                $dem = 1;
                                while($row = $res->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td><strong>' . $dem++ . '</strong></td>';
                                    echo '<td title="'. $row['tenThietBi'] .'">' . $row['tenThietBi'] . '</td>';
                                    echo '<td>' . $row['tenBoMon'] . '</td>';
                                    echo '<td>' . $row['tenNhaCungCap'] . '</td>';
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
                Tổng chi phí: 
                <span class="text-danger"><?= number_format($r['tongChiPhi'], 0, ',', '.') ?> ₫</span>
            </p>
            
            <p><strong>Trạng thái:</strong>
            <?php
            switch ($r['trangThai']) {
                case "Chấp thuận": echo '<span class="badge bg-success">' . $r['trangThai'] . '</span>'; break;
                case "Chờ duyệt": echo '<span class="badge bg-warning text-dark">' . $r['trangThai'] . '</span>'; break;
                case "Từ chối": echo '<span class="badge bg-danger">' . $r['trangThai'] . '</span>'; break;
                default: echo '<span class="badge bg-light text-dark">Không có</span>';
            }
            ?>
            </p>

            <p><strong>Ghi chú:</strong> <?= $r['ghiChu'] ?></p>

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
                        <img src="../public/uploads/signature_nguoilap.png" alt="Chữ ký người lập" style="max-width:180px; max-height:70px; filter: brightness(0) saturate(100%) invert(12%) sepia(97%) saturate(7490%) hue-rotate(241deg) brightness(95%) contrast(106%);"">
                        <div style="font-family: 'Playwrite NO', cursive; font-size: 15px; color: blue"><?= $r['hoTen'] ?></div>
                    </div>
                </div>
                
                <!-- Hiệu trưởng + Con dấu -->
                <div class="col-6 text-center">
                    <div class="fw-semibold">Hiệu trưởng</div>
                    <div class="fst-italic" style="font-size:0.85rem;">(Ký, đóng dấu)</div>

                    <?php if(isset($r['trangThai']) && $r['trangThai'] != "Chờ duyệt"): ?>
                    <div style="margin-top:6px; display:flex; justify-content:center; gap:20px; align-items:center;">
                        <!-- Con dấu thật -->
                        <div style="width:120px; height:120px; display:flex; justify-content:center; align-items:center; position:relative;">
                            <img src="../public/uploads/stamp_hieutruong.png" alt="Con dấu" style="width:120px; height:120px; object-fit:contain;">
                        </div>

                        <!-- Chữ ký hiệu trưởng -->
                        <div style="text-align:left;">
                            <img src="../public/uploads/signature_hieutruong.png" alt="Chữ ký Hiệu trưởng" style="max-width:180px; max-height:70px; filter: brightness(0) saturate(100%) invert(12%) sepia(97%) saturate(7490%) hue-rotate(241deg) brightness(95%) contrast(106%);">
                            <div style="font-family: 'Playwrite NO', cursive; font-size: 15px; color: blue">TS. Nguyễn Văn Hiệu</div>
                            <div style="font-size:15px; margin-top:4px; font-weight:600;">(Hiệu trưởng)</div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>               
    </div>
</div>

<style>
    th, td {
        max-width: 12.5em;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>

<script>
// Export PDF
document.getElementById('exportPDF').onclick = function() {
    const card = document.querySelector('.card-na');

    html2canvas(card, { scale: 2 }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
        
        const imgWidth = 190;
        const imgHeight = canvas.height * imgWidth / canvas.width;

        pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        pdf.save("kehoach-mua-sam.pdf");
    });
}
</script>