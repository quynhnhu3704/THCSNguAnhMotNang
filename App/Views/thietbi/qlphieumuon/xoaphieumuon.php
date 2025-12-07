<!-- App/Views/thietbi/qlphieumuon/xoaphieumuon.php -->
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
    echo "<script>alert('Không tìm thấy phiếu mượn.'); window.location.href='index.php?page=dsphieumuon'</script>";
    exit();
}

$kq = $p->get01PhieuMuon($maPhieuMuon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy phiếu mượn.'); window.location.href='index.php?page=dsphieumuon'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // 1. Trả tất cả thiết bị về Khả dụng
    $p->restoreThietBi($maPhieuMuon);

    // 2. Xóa phiếu mượn
    if ($p->deletePhieuMuon($maPhieuMuon)) {
        echo "<script>alert('Phiếu mượn đã được xóa thành công. Thiết bị đã trở về trạng thái khả dụng.'); window.location.href='index.php?page=dsphieumuon'</script>";
    } else {
        echo "<script>alert('Xóa phiếu mượn thất bại. Vui lòng thử lại.'); window.history.back();</script>";
    }
}
?>