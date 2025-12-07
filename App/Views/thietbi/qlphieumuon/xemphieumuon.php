<!-- App/Views/thietbi/qlphieumuon/xemphieumuon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cPhieuMuon.php');
$p = new controlPhieuMuon();

$maPhieuMuon = $_GET['maPhieuMuon'];

if(!$maPhieuMuon) {
    echo "<script>alert('Không tìm thấy phiếu mượn!'); window.location.href='index.php?page=dskehoachthanhly';</script>";
    exit();
}

$kq = $p->get01PhieuMuon($maPhieuMuon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy phiếu mượn!'); window.location.href='index.php?page=dskehoachthanhly';</script>";
    exit();
}
?>

<div class="d-flex justify-content-between align-items-center mx-4 my-4">
    <button type="button" class="btn btn-outline-primary" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>
    <button type="button" id="exportPDF" class="btn btn-dark"><i class="bi bi-download"></i> Xuất PDF</button>
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
                    $ngay = date("d", strtotime($r['ngayMuon']));
                    $thang = date("m", strtotime($r['ngayMuon']));
                    $nam = date("Y", strtotime($r['ngayMuon']));
                    echo "<i>TP. Hồ Chí Minh, ngày $ngay tháng $thang năm $nam</i>";
                ?>
            </p>

            <!-- Tiêu đề đơn -->
            <h4 class="text-center fw-bold text-primary text-uppercase mb-4">Đơn đề nghị mượn thiết bị</h4>

            <!-- Thông tin người mượn -->
            <p><strong>Họ tên:</strong> <?= $r['hoTen'] ?></p>
            <p><strong>Vai trò:</strong> <?= $r['tenVaiTro'] ?></p>
            <p><strong>Bộ môn:</strong> <?= $r['tenBoMon'] ?></p>
            <p><strong>Ngày lập:</strong> <?= date("d/m/Y", strtotime($r['ngayMuon'])) ?></p>

            <!-- Danh sách thiết bị -->
            <h5 class="fw-semibold text-secondary mt-4 mb-2">Danh sách thiết bị mượn</h5>
            <div class="d-flex justify-content-center mb-3">
                <div class="table-responsive text-center" style="width: 100%;">
                    <table class="table table-striped table-borderless align-middle" style="font-size: 0.85em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thiết bị</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $p->get01ChiTietPM($maPhieuMuon);
                            if($res && $res->num_rows > 0) {
                                $dem = 1;
                                while($row = $res->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td><strong>' . $dem++ . '</strong></td>';
                                    echo '<td title="'. $row['tenThietBi'] .'">' . $row['tenThietBi'] . '</td>';
                                    echo '<td>' . $row['soLuong'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center text-muted">Chưa có thiết bị nào trong phiếu mượn này.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <p><strong>Trạng thái:</strong>
            <?php
            switch ($r['trangThai']) {
                case "Chờ xử lý": echo '<span class="badge bg-secondary">' . $r['trangThai'] . '</span>'; break;
                case "Đã xác nhận": echo '<span class="badge bg-info text-dark">' . $r['trangThai'] . '</span>'; break;
                case "Đang mượn": echo '<span class="badge bg-warning text-dark">' . $r['trangThai'] . '</span>'; break;
                case "Đã trả": echo '<span class="badge bg-success">' . $r['trangThai'] . '</span>'; break;
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
                    <div class="fw-semibold">Người mượn</div>
                    <div class="fst-italic" style="font-size:0.85rem;">(Ký, ghi rõ họ tên)</div>

                    <!-- Fake digital signature (SVG) -->
                    <div style="margin-top:18px;">
                        <!-- simple stylized "signature" -->
                        <img src="../public/uploads/signature_nguoilap.png" alt="Chữ ký người lập" style="max-width:180px; max-height:70px; filter: brightness(0) saturate(100%) invert(12%) sepia(97%) saturate(7490%) hue-rotate(241deg) brightness(95%) contrast(106%);"">
                        <div style="font-family: 'Playwrite NO', cursive; font-size: 15px; color: blue"><?= $r['hoTen'] ?></div>
                    </div>
                </div>
                
                <!-- Quản lý thiết bị + Con dấu -->
                <div class="col-6 text-center">
                    <div class="fw-semibold">Phòng Quản lý Thiết bị</div>
                    <div class="fst-italic" style="font-size:0.85rem;">(Ký, đóng dấu)</div>

                    <?php if(isset($r['trangThai']) && $r['trangThai'] != "Chờ xử lý"): ?>
                    <div style="margin-top:6px; display:flex; justify-content:center; gap:20px; align-items:center;">
                        <!-- Con dấu thật -->
                        <div style="width:120px; height:120px; display:flex; justify-content:center; align-items:center; position:relative;">
                            <img src="../public/uploads/stamp_thietbi.png" alt="Con dấu" style="width:120px; height:120px; object-fit:contain;">
                        </div>

                        <!-- Chữ ký nhân viên quản lý thiết bị -->
                        <div style="text-align:left;">
                            <div style="font-family: 'Playwrite NO', cursive; font-size: 15px; color: blue">Xác nhận phiếu mượn</div>
                            <div style="font-size:15px; margin-top:4px; font-weight:600;">(Nhân viên quản lý thiết bị)</div>
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
        pdf.save("phieu-muon.pdf");
    });
}
</script>