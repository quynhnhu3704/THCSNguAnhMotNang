<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }

    // if($_SESSION['login'] == 3) {
    //     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    //     exit();
    // }

    include_once('App/Controllers/cNhaCungCap.php');
    $p = new controlNhaCungCap();

    $maNhaCungCap = $_GET['maNhaCungCap'];

    if(!$maNhaCungCap) {
        echo "<script>alert('Không tìm thấy nhà cung cấp!'); window.location.href='index.php?page=dsnhacungcap'</script>";
        exit();
    }

    $kq = $p->get01NhaCungCap($maNhaCungCap);

    if($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy nhà cung cấp!'); window.location.href='index.php?page=dsnhacungcap'</script>";
        exit();
    }


    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        if ($p->deleteNhaCungCap($maNhaCungCap)) {
            echo "<script>alert('Xóa thành công!'); window.location.href='index.php?page=dsnhacungcap';</script>";
        } else {
            echo "<script>alert('Xóa thất bại!'); window.history.back();</script>";
        }
    }
?>