<!-- App/Views/common/chitietthietbi.php -->
<?php
include_once('App/Controllers/cThietBi.php');
$p = new controlThietBi();

if (isset($_GET['maThietBi'])) {
    $maThietBi = $_GET['maThietBi'];
    $kq = $p->get01ThietBi($maThietBi);
} else {
    echo "<h2>Không tìm thấy thiết bị, vui lòng thử lại sau.</h2>";
    exit();
}

if ($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<h2>Dữ liệu thiết bị không tồn tại hoặc đã bị xóa.</h2>";
    exit();
}
?>

<div class="container my-5">
    <button type="button" class="btn btn-outline-primary mb-4" onclick="window.history.back()"><i class="bi bi-arrow-left"></i> Quay lại</button>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card-na p-3 position-sticky" style="top: 4em;">
                <img src="public/uploads/<?php echo $r['hinhAnh']; ?>" alt="<?php echo $r['tenThietBi']; ?>" class="w-100 rounded-4 shadow-sm">

                <?php if($r['tenBoMon']): ?>
                    <span class="position-absolute top-0 start-0 badge badge-na rounded-pill m-4"><?php echo $r['tenBoMon']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card-na p-4 h-100 d-flex flex-column fs-5">
                <h2 class="mb-3 fw-bold text-primary"><?php echo $r['tenThietBi']; ?></h2>

                <div class="grid grid-cols-2 gap-3 text-sm bg-light rounded-4 mb-4">
                    <div class="p-3">
                        <strong>Đơn vị:</strong> <?php echo $r['donVi']; ?>
                    </div>

                    <?php
                    // Lấy số lượng khả dụng
                    $soLuongKhaDung = 0;
                    if (isset($r['maThietBi'])) {
                        $tmp = $p->countSoLuongKhaDung($r['maThietBi']);
                        $soLuongKhaDung = $tmp ? (int)($tmp->fetch_assoc()['soLuongKhaDung'] ?? 0) : 0;
                    }
                    ?>
                    <div class="p-3">
                        <strong>Số lượng khả dụng:</strong> <?php echo $soLuongKhaDung ?>
                    </div>
                    <div class="p-3">
                        <strong>Lớp:</strong> <?php echo $r['lop']; ?>
                    </div>
                    <div class="p-3">
                        <strong>Bộ môn:</strong> <?php echo $r['tenBoMon']; ?>
                    </div>
                    <div class="p-3">
                        <strong>Nhà cung cấp:</strong> <?php echo $r['tenNhaCungCap']; ?>
                    </div>
                    <div class="p-3">
                        <strong>Mô tả:</strong> <?php echo nl2br($r['moTa']); ?>
                    </div>
                </div>
                
                <form action="#" method="post">
                    <button type="submit" name="btnmuon" class="btn btn-primary btn-lg mt-auto align-self-start fw-semibold">
                        <i class="bi bi-clipboard-check me-2 fw-semibold"></i>Thêm vào phiếu mượn
                    </button>
                </form>
            </div>
        </div>        
    </div>
</div>

<?php
// Xử lý thêm thiết bị vào session lưu bộ nhớ tạm khi nhấn nút
if(isset($_POST['btnmuon'])) {
    // Nếu chưa đăng nhập thì chuyển đến trang đăng nhập
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Vui lòng đăng nhập để mượn thiết bị!'); window.location.href='index.php?page=dangnhap';</script>";
        exit();
    }

    $maThietBi = $r['maThietBi'];
    $soLuongMuon = 1; // mặc định thêm vào phiếu mượn 1 thiết bị

    // Lấy số lượng khả dụng
    $soLuongKhaDung = 0;
    $tmp = $p->countSoLuongKhaDung($maThietBi);
    $soLuongKhaDung = $tmp ? (int)($tmp->fetch_assoc()['soLuongKhaDung'] ?? 0) : 0;
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check quyền mượn
    $maVaiTro = $_SESSION['maVaiTro'] ?? null;
    if($maVaiTro != 2 && $maVaiTro != 3) {
        echo "<script>alert('Bạn không có quyền đăng ký mượn thiết bị.'); window.history.back();</script>";
        exit();
    }

    // Kiểm tra bộ môn thiết bị
    $maBoMon = $_SESSION['maBoMon'] ?? null;
    if ($r['maBoMon'] != $maBoMon) {
        echo "<script>alert('Bạn không được mượn thiết bị này vì không thuộc bộ môn của bạn.'); window.history.back();</script>";
        exit();
    }

    // Nếu đã có thiết bị trong giỏ, cộng số lượng
    if(isset($_SESSION['cart'][$maThietBi])) {
        $tongMuon = $_SESSION['cart'][$maThietBi] + $soLuongMuon;
    } else {
        $tongMuon = $soLuongMuon;
    }

    if($tongMuon > $soLuongKhaDung) {
        echo "<script>alert('Không đủ số lượng khả dụng! Bạn chỉ có thể mượn tối đa $soLuongKhaDung thiết bị.'); window.history.back();</script>";
        exit();
    }

    // Nếu đủ -> thêm vào session
    $_SESSION['cart'][$maThietBi] = $tongMuon;

    // Giới hạn số lượng tối đa 3 loại thiết bị
    if(count($_SESSION['cart']) > 3) {
        unset($_SESSION['cart'][$maThietBi]); // remove item vừa thêm
        echo "<script>alert('Chỉ được mượn tối đa 3 thiết bị!'); window.history.back();</script>";
        exit();
    }

    echo "<script>alert('Đã thêm thiết bị vào phiếu mượn.'); window.history.back();</script>";
}
?>
