<!-- App/Views/thietbi/qlphieumuon/themphieumuon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsphieumuon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm phiếu mượn</h3>

            <form action="#" method="post">
                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <select id="nguoiDungSelect" name="maNguoiDung" class="form-select" required>
                        <option value="" disabled selected>-- Chọn người dùng --</option>
                        <?php
                        include_once('App/Controllers/cNguoiDung.php');
                        $p = new controlNguoiDung();

                        // Vai trò: 2 = giáo viên bộ môn, 3 = tổ trưởng chuyên môn
                        $dsMaVaiTro = [2, 3];
                        $kq = $p->getNguoiDungTheoVaiTro($dsMaVaiTro);

                        while ($r = $kq->fetch_assoc()) {
                            echo "<option value='{$r['maNguoiDung']}' data-bomon='{$r['tenBoMon']}' data-vaitro='{$r['tenVaiTro']}'>{$r['hoTen']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò <span class="text-danger">*</span></label>
                    <input type="text" id="vaiTro" name="maVaiTro" class="form-control" disabled>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <input type="text"  id="boMon" name="maBoMon" class="form-control" disabled>
                </div>

                <!-- Ngày mượn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày mượn <span class="text-danger">*</span></label>
                    <input type="date" name="ngayMuon" class="form-control" min="<?= date('Y-m-d') ?>" required>
                </div>

                <!-- Ngày trả -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày trả <span class="text-danger">*</span></label>
                    <input type="date" name="ngayTra" class="form-control" min="<?= date('Y-m-d') ?>" required>
                </div>
                
                <h5 class="my-2 fw-semibold text-secondary text-center">Danh sách thiết bị</h5>
                <div class="d-flex justify-content-center mb-3">
                    <div class="table-responsive text-center" style="width: 100%;">
                        <table class="table table-striped table-borderless align-middle" style="font-size: 0.85em;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thiết bị</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=1; $i<=3; $i++): ?>
                                <tr>
                                    <td><strong><?= $i ?></strong></td>
                                    <td>
                                        <select name="maThietBi[]" class="form-select thietBiSelect">
                                            <option value="" disabled selected>-- Chọn thiết bị --</option>
                                            <?php
                                            include_once('App/Controllers/cThietBi.php');
                                            $p = new controlThietBi();

                                            // lấy thiết bị theo bộ môn đã chọn ở trên nguoiDungSelect với data-bomon, ko dùng $maBoMon = 1
                                            $kq = $p->getAllThietBi();
                                            while ($r = $kq->fetch_assoc()) {
                                                echo "<option value='{$r['maThietBi']}' data-bomon='{$r['tenBoMon']}'>{$r['tenThietBi']}</option>";
                                            }  
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="soLuong[]" value="" min="1" class="form-control text-center">
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                    <input type="text" value="Đã xác nhận" class="form-control" disabled>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" class="form-control" rows="3" style="resize:none;"></textarea>
                </div>

                <!-- Nút submit/reset -->
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="submit" name="btnluu" class="btn btn-primary w-100">Lưu</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button type="reset" class="btn btn-outline-secondary w-100">Đặt lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once('App/Controllers/cPhieuMuon.php');
$p = new controlPhieuMuon();

if(isset($_POST['btnluu'])) {
    $maNguoiDung = $_POST['maNguoiDung'];
    $ngayMuon = $_POST['ngayMuon'];
    $ngayTra = $_POST['ngayTra'];
    $ghiChu = trim($_POST['ghiChu']);

    // Ngày trả phải sau ngày mượn
    // if($ngayTra < $ngayMuon) {
    //     echo "<script>alert('Ngày trả phải sau ngày mượn'); window.history.back();</script>";
    //     exit();
    // }

    // $chiTiet = []; // mảng chi tiết thiết bị để truyền vào insertChiTietPM
    // foreach($_POST['maThietBi'] as $maThietBi){
    //     if(!empty($maThietBi)){
    //         $soLuong = (int)$_POST['soLuong'][$maThietBi]; // lấy số lượng tương ứng
    //         if($soLuong > 0){
    //             $chiTiet[$maThietBi] = $soLuong; // thêm vào mảng chi tiết
    //         }
    //     }
    // }

    $chiTiet = [];
foreach($_POST['maThietBi'] as $maThietBi){
    if(!empty($maThietBi)){
        if(empty($_POST['soLuong'][$maThietBi]) || (int)$_POST['soLuong'][$maThietBi] <= 0){
            echo "<script>alert('Bạn phải nhập số lượng cho tất cả thiết bị đã chọn!'); window.history.back();</script>";
            exit();
        }
        $soLuong = (int)$_POST['soLuong'][$maThietBi];
        $chiTiet[$maThietBi] = $soLuong;
    }
}

if(empty($chiTiet)){
    echo "<script>alert('Vui lòng chọn ít nhất 1 thiết bị'); window.history.back();</script>";
    exit();
}


    // Kiểm tra có chọn thiết bị không
    if(empty($chiTiet)){
        echo "<script>alert('Vui lòng chọn ít nhất 1 thiết bị'); window.history.back();</script>";
        exit();
    }

    $maPhieuMuon = $p->insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, "Đã xác nhận", $ghiChu);

    if($maPhieuMuon) {
        $kq = $p->insertChiTietPM($maPhieuMuon, $chiTiet);

        if($kq) {
            echo "<script>alert('Thêm phiếu mượn thành công'); window.location.href='index.php?page=dsphieumuon'</script>";
        } else {
            $p->deletePhieuMuon($maPhieuMuon);  // rollback phiếu mượn
            echo "<script>alert('Thêm phiếu mượn thất bại do không đủ thiết bị khả dụng.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Thêm phiếu mượn thất bại!'); window.history.back();</script>";
        exit();
    }
}
?>

<script>
// Hàm tự động điền bộ môn và vai trò khi chọn người dùng
document.getElementById('nguoiDungSelect').addEventListener('change', function () {
    let option = this.options[this.selectedIndex];
    document.getElementById('boMon').value = option.getAttribute('data-bomon') || '';
    document.getElementById('vaiTro').value = option.getAttribute('data-vaitro') || '';

    filterThietBi(); // lọc thiết bị theo bộ môn
});

// Hàm lọc thiết bị theo bộ môn khi chọn người dùng
// document.getElementById('nguoiDungSelect').addEventListener('change', function () {
//     let selectedBoMon = this.options[this.selectedIndex].getAttribute('data-bomon');
//     let selects = document.querySelectorAll('.thietBiSelect'); // lấy tất cả select

//     selects.forEach(select => {
//         Array.from(select.options).forEach(option => {
//             option.style.display = (option.getAttribute('data-bomon') === selectedBoMon || option.value === '') ? '' : 'none'; // ẩn những option không cùng bộ môn
//         });
//         select.value = ''; // reset chọn thiết bị
//     });
// });

// Hàm lọc thiết bị theo bộ môn và loại những thiết bị đã chọn
function filterThietBi() {
    let selectedBoMon = document.getElementById('nguoiDungSelect').selectedOptions[0].getAttribute('data-bomon');
    let selects = document.querySelectorAll('.thietBiSelect');

    // Lấy danh sách thiết bị đã chọn
    let daChon = Array.from(selects).map(s => s.value).filter(v => v !== '');

    selects.forEach(select => {
        Array.from(select.options).forEach(option => {
            if(option.value === '') {
                option.style.display = ''; // luôn hiển thị option rỗng
            } else if(option.getAttribute('data-bomon') !== selectedBoMon) {
                option.style.display = 'none'; // khác bộ môn => ẩn
            } else if(daChon.includes(option.value) && select.value !== option.value) {
                option.style.display = 'none'; // đã chọn ở select khác => ẩn
            } else {
                option.style.display = ''; // hiển thị
            }
        });
    });
}

// Event mỗi khi thay đổi select thiết bị => update filter
document.querySelectorAll('.thietBiSelect').forEach(select => {
    select.addEventListener('change', filterThietBi); // 
});

// Kiểm tra khi submit form
document.querySelector('form').addEventListener('submit', function(e){
    let selects = document.querySelectorAll('.thietBiSelect');
    let valid = true;

    selects.forEach(select => {
        let maThietBi = select.value;
        if(maThietBi !== '') {
            let soLuongInput = document.querySelector(`input[name="soLuong[]"]`);
            if(!soLuongInput || soLuongInput.value === '' || parseInt(soLuongInput.value) <= 0) {
                alert('Bạn phải nhập số lượng cho tất cả thiết bị đã chọn!');
                valid = false;
                soLuongInput.focus();
                return false;
            }
        }
    });

    if(!valid) e.preventDefault();
});
</script>