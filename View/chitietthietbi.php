<?php
    include_once('Controller/cThietBi.php');
    $p = new controlThietBi();

    if (isset($_GET['maThietBi'])) {
        $maThietBi = $_GET['maThietBi'];
        $kq = $p->get01ThietBi($maThietBi);
    } else {
        echo "<h2>Không tìm thấy thiết bị, vui lòng quay lại.</h2>";
        exit();
    }

    if ($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<h2>Dữ liệu thiết bị không tồn tại.</h2>";
        exit();
    }
?>

<div class="container my-5">
    <a href="index.php" class="btn btn-outline-primary mb-4"><i class="bi bi-arrow-left"></i> Quay lại</a>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card-na p-3 position-sticky" style="top: 1rem;">
                <img src="image/<?php echo $r['hinhAnh']; ?>" alt="<?php echo $r['tenThietBi']; ?>" class="w-100 rounded-4 shadow-sm">

                <?php if($r['tenBoMon']): ?>
                    <span class="position-absolute top-0 start-0 badge badge-na rounded-pill m-4"><?php echo $r['tenBoMon']; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card-na p-4 h-100 d-flex flex-column fs-5">
                <h1 class="mb-3 fw-semibold text-primary"><?php echo $r['tenThietBi']; ?></h1>
                
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Đơn vị:</strong> <?php echo $r['donVi']; ?></li>
                    <li class="list-group-item"><strong>Số lượng:</strong> <?php echo $r['soLuong']; ?></li>
                    <li class="list-group-item"><strong>Lớp sử dụng:</strong> <?php echo $r['lop']; ?></li>
                    <li class="list-group-item"><strong>Bộ môn:</strong> <?php echo $r['tenBoMon']; ?></li>
                    <li class="list-group-item"><strong>Nhà cung cấp:</strong> <?php echo $r['tenNhaCungCap']; ?></li>
                    <li class="list-group-item"><strong>Tình trạng:</strong> 
                        <span class="badge 
                            <?php echo ($r['tinhTrang'] == 'Khả dụng') ? 'bg-success' : 'bg-danger'; ?>">
                            <?php echo $r['tinhTrang']; ?>
                        </span>
                    </li>
                </ul>


                <div class="grid grid-cols-2 gap-3 text-sm">
    <div class="p-3 bg-light rounded">
        <strong>Đơn vị:</strong> <?php echo $r['donVi']; ?>
    </div>
    <div class="p-3 bg-light rounded">
        <strong>Số lượng:</strong> <?php echo $r['soLuong']; ?>
    </div>
    <div class="p-3 bg-light rounded">
        <strong>Lớp sử dụng:</strong> <?php echo $r['lop']; ?>
    </div>
    <div class="p-3 bg-light rounded">
        <strong>Bộ môn:</strong> <?php echo $r['tenBoMon']; ?>
    </div>
    <div class="p-3 bg-light rounded">
        <strong>Nhà cung cấp:</strong> <?php echo $r['tenNhaCungCap']; ?>
    </div>
    <div class="p-3 bg-light rounded">
        <strong>Tình trạng:</strong> 
        <span class="badge <?php echo ($r['tinhTrang'] == 'Khả dụng') ? 'bg-success' : 'bg-danger'; ?>">
            <?php echo $r['tinhTrang']; ?>
        </span>
    </div>
</div>


                <p class="mb-4"><strong>Ghi chú:</strong><br><?php echo nl2br($r['ghiChu']); ?></p>

                <a href="booking.php?maThietBi=<?php echo $r['maThietBi']; ?>" class="btn btn-primary btn-lg mt-auto align-self-start">
                    <i class="bi bi-cart-plus me-2"></i> Thêm vào phiếu mượn
                </a>
            </div>
        </div>        
    </div>
</div>