<!-- App/Views/thietbi/qlbomon/xoabomon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cBoMon.php');
$p = new controlBoMon();

$maBoMon = $_GET['maBoMon'];

if(!$maBoMon) {
    echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=dsbomon'</script>";
    exit();
}

$kq = $p->get01BoMon($maBoMon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=dsbomon'</script>";
    exit();
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if ($p->deleteBoMon($maBoMon)) {
        echo "<script>alert('Xóa bộ môn thành công!'); window.location.href='index.php?page=dsbomon';</script>";
    } else {
        echo "<script>alert('Xóa bộ môn thất bại!'); window.history.back();</script>";
    }
}
?>