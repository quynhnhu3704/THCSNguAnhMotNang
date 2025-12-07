<!-- App/Views/totruong/kehoachmuasam/xoakehoachmuasam.php -->
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
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachmuasam'</script>";
    exit();
}

$kq = $p->get01KeHoachMuaSam($maKeHoachMuaSam);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachmuasam'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if ($p->deleteKeHoachMuaSam($maKeHoachMuaSam)) {
        echo "<script>alert('Xóa kế hoạch thành công.'); window.location.href='index.php?page=dskehoachmuasam'</script>";
    } else {
        echo "<script>alert('Xóa kế hoạch thất bại. Vui lòng thử lại.'); window.history.back();</script>";
    }
}
?>