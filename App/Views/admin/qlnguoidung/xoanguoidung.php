<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_GET['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dsnguoidung'</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dsnguoidung'</script>";
    exit();
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if ($p->deleteNguoiDung($maNguoiDung)) {
        echo "<script>alert('Xóa thành công!'); window.location.href='index.php?page=dsnguoidung';</script>";
    } else {
        echo "<script>alert('Xóa thất bại!'); window.history.back();</script>";
    }
}
?>