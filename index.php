<!doctype html>
<html lang="vi">
<?php
    session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Ngũ Anh Một Nàng Hotel – Đặt phòng trực tuyến</title>
    <meta name="description" content="Website đặt phòng khách sạn NguAnhMotNang – sang trọng, thân thiện, đặt phòng nhanh trong 60 giây."/>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
        include_once('View/menu.php');

        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
        
        // Chỉ hiển thị header khi không có ?page nào, tức là index.php
        if ($page == '') {
            include_once('View/header.php');
        }
    ?>

    <!-- switch case -->
    <?php
        switch($page) {
            case 'dangnhap':
                include_once('View/dangnhap.php');
                break;
            case 'dangxuat':
                include_once('View/dangxuat.php');
                break;
            case 'quanly':
            case 'quanlynguoidung':
            case 'quanlythietbi':
                include_once('View/quanly.php');
                break;
            case 'chitietthietbi':
                include_once('View/chitietthietbi.php');
                break;
            default:
                include_once('View/thietbi.php');
                break;
        }
    ?>

    <?php         
        include_once('View/footer.php');
    ?>
</body>
</html>