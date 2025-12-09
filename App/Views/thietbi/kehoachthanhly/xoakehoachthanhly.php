<!-- App/Views/totruong/kehoachthanhly/xoakehoachthanhly.php -->
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
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachthanhly'</script>";
    exit();
}

$kq = $p->get01KeHoachThanhLy($maKeHoachThanhLy);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy kế hoạch.'); window.location.href='index.php?page=dskehoachthanhly'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // Chặn xóa nếu đã duyệt
    $trangThai = $r['trangThai'];
    if ($trangThai == 'Chấp thuận' || $trangThai == 'Từ chối') {
        echo "<script>alert('Kế hoạch đã được hiệu trưởng duyệt. Không thể xóa.'); window.location.href='index.php?page=dskehoachthanhly'</script>"; 
        exit();
    }

    // Cho xóa nếu vẫn còn Chờ duyệt
    if ($p->deleteKeHoachThanhLy($maKeHoachThanhLy)) {
        echo "<script>alert('Xóa kế hoạch thành công.'); window.location.href='index.php?page=dskehoachthanhly'</script>";
    } else {
        echo "<script>alert('Xóa kế hoạch thất bại. Vui lòng thử lại.'); window.history.back();</script>";
    }
}
?>