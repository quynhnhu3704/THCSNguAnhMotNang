<!-- App/Views/thietbi/qlphieumuon/themphieumuon.php -->
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
    echo "<script>alert('Không tìm thấy phiếu mượn!'); window.location.href='index.php?page=dsphieumuon';</script>";
    exit();
}

$kq = $p->get01PhieuMuon($maPhieuMuon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy phiếu mượn!'); window.location.href='index.php?page=dsphieumuon';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsphieumuon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Sửa phiếu mượn</h3>

            <form action="#" method="post">
                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên</label>
                    <input type="text" class="form-control" value="<?= $r['hoTen'] ?>" disabled>
                </div>
                
                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò</label>
                    <input type="text" class="form-control" value="<?= $r['tenVaiTro'] ?>" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" class="form-control" value="<?= $r['tenBoMon'] ?>" disabled>
                </div>

                <!-- Ngày mượn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày mượn</label>
                    <input type="date" class="form-control" value="<?= $r['ngayMuon'] ?>" disabled>
                </div>

                <!-- Ngày trả -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày trả</label>
                    <input type="date" class="form-control" value="<?= $r['ngayTra'] ?>" disabled>
                </div>
                
                <h5 class="my-2 fw-semibold text-secondary text-center">Danh sách thiết bị</h5>
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
                                            echo '<td title="'. $row['tenThietBi'] .'" class="text-start">' . $row['tenThietBi'] . '</td>';
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
        
                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                    <select name="trangThai" class="form-select" required>
                        <option value="" disabled>-- Chọn trạng thái --</option>
                        <option value="Chờ xử lý" <?= ($r["trangThai"] == 'Chờ xử lý') ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="Đã xác nhận" <?= ($r["trangThai"] == 'Đã xác nhận') ? 'selected' : '' ?>>Đã xác nhận</option>
                        <option value="Đang mượn" <?= ($r["trangThai"] == 'Đang mượn') ? 'selected' : '' ?>>Đang mượn</option>
                        <option value="Đã trả" <?= ($r["trangThai"] == 'Đã trả') ? 'selected' : '' ?>>Đã trả</option>
                    </select>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" rows="3" class="form-control" placeholder="Yêu cầu hoặc lưu ý đặc biệt..." style="resize:none;"><?= $r['ghiChu'] ?></textarea>
                </div>

                <!-- Nút submit/reset -->
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="submit" name="btnluu" class="btn btn-primary w-100">Lưu</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button type="reset" name="btnreset" class="btn btn-outline-secondary w-100">Đặt lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['btnluu'])){
    $trangThai = trim($_POST["trangThai"]);
    $ghiChu = trim($_POST['ghiChu']);

    if($p->updatePhieuMuon($maPhieuMuon, $trangThai,$ghiChu)) {
        echo "<script>alert('Cập nhật phiếu mượn thành công'); window.location.href='index.php?page=dsphieumuon';</script>";
    }else{
        echo "<script>alert('Cập nhật phiếu mượn thất bại'); window.location.href='index.php?page=suaphieumuon';</script>";
    }
}
?>

<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>