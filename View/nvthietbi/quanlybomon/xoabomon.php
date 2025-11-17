<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }

    // if($_SESSION['login'] == 3) {
    //     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    //     exit();
    // }

    include_once('Controller/cBoMon.php');
    $p = new controlBoMon();

    $maBoMon = $_GET['maBoMon'];

    if(!$maBoMon) {
        echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=quanlybomon'</script>";
        exit();
    }

    $kq = $p->get01BoMon($maBoMon);

    if($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=quanlybomon'</script>";
        exit();
    }


    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        if ($p->deleteBoMon($maBoMon)) {
            echo "<script>alert('Xóa thành công!'); window.location.href='index.php?page=quanlybomon';</script>";
        } else {
            echo "<script>alert('Xóa thất bại!'); window.history.back();</script>";
        }
    }
?>