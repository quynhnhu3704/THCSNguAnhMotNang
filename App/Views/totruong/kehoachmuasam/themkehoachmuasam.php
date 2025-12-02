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

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_SESSION['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dskehoachmuasam';</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dskehoachmuasam';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dskehoachmuasam'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 46rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Lập kế hoạch mua sắm</h3>

            <form action="#" method="post">
                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" value="<?= $r['hoTen'] ?>" class="form-control" disabled>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò <span class="text-danger">*</span></label>
                    <input type="text" name="maVaiTro" class="form-control" value="<?php echo $r['tenVaiTro']; ?>" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" name="maBoMon" class="form-control" value="<?php echo $r['tenBoMon']; ?>" disabled>
                </div>

                <!-- Ngày lập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày lập <span class="text-danger">*</span></label>
                    <input type="date" name="ngayLap" class="form-control" min="<?= date('Y-m-d') ?>" required>
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
                                <?php 
                                include_once('App/Controllers/cThietBi.php');
                                $p = new controlThietBi();
                                $kq = $p->getAllThietBi();
                                // Lấy toàn bộ thiết bị 1 lần để tránh lỗi fetch_assoc bị cạn
                                $res = $kq ? $kq->fetch_all(MYSQLI_ASSOC) : [];

                                // Hiển thị 3 dòng nhập thiết bị
                                for ($i=1; $i<=3; $i++): 
                                ?>
                                <tr>
                                    <td><strong><?= $i ?></strong></td>
                                    <td>
                                        <select name="maThietBi[]" class="form-select thietBiSelect">
                                            <option value="" selected>-- Chọn thiết bị --</option>
                                            <?php foreach($res as $r): ?>
                                                <option value="<?= $r["maThietBi"] ?>" data-bomon="<?= $r["tenBoMon"] ?>"><?= $r["tenThietBi"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="number" name="" value="" min="1" class="form-control text-center soLuongInput"></td>
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
                        <button type="reset" name="btnreset" class="btn btn-outline-secondary w-100">Đặt lại</button>
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
    if($ngayTra < $ngayMuon) {
        echo "<script>alert('Ngày trả phải sau ngày mượn'); window.history.back();</script>";
        exit();
    }

    $chiTiet = []; // mảng chi tiết thiết bị để truyền vào insertChiTietPM
    if(!empty($_POST['maThietBi']) && is_array($_POST['maThietBi'])) {
        foreach($_POST['maThietBi'] as $index => $maThietBi) {
            $maThietBi = trim($maThietBi);
            if($maThietBi === '') continue;
            // server-side sẽ tìm $_POST['soLuong'][$maThietBi], do đó gửi đúng cặp key/value là cần thiết
            $soLuong = 0;
            if(isset($_POST['soLuong'][$maThietBi])) $soLuong = (int)$_POST['soLuong'][$maThietBi];
            if($soLuong <= 0) {
                echo "<script>alert('Bạn phải nhập số lượng > 0 cho tất cả thiết bị đã chọn'); window.location.href='index.php?page=themkehoachmuasam';</script>";
                exit();
            }
            $chiTiet[$maThietBi] = $soLuong;
        }
    }

    // Kiểm tra có chọn thiết bị không
    if(empty($chiTiet)){
        echo "<script>alert('Vui lòng chọn ít nhất 1 thiết bị'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        exit();
    }

    $maPhieuMuon = $p->insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, "Đã xác nhận", $ghiChu);

    if($maPhieuMuon) {
        $kq = $p->insertChiTietPM($maPhieuMuon, $chiTiet);

        if($kq) {
            echo "<script>alert('Thêm kế hoạch thành công'); window.location.href='index.php?page=dskehoachmuasam'</script>";
        } else {
            $p->deletePhieuMuon($maPhieuMuon);  // rollback kế hoạch
            echo "<script>alert('Thêm kế hoạch thất bại do không đủ thiết bị khả dụng.'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        }
    } else {
        echo "<script>alert('Thêm kế hoạch thất bại!'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        exit();
    }
}
?>

<script>
// Helpers
function qs(sel, ctx=document) { return ctx.querySelector(sel); }
function qsa(sel, ctx=document) { return Array.from(ctx.querySelectorAll(sel)); }

// Tham số DOM
const nguoiDungSelect = qs('#nguoiDungSelect');
const selects = () => qsa('.thietBiSelect');
const soLuongInputs = () => qsa('.soLuongInput');
const form = qs('#frmThemPhieuMuon');
const btnReset = qs('#btnreset');

// Khi chọn người dùng: điền bộ môn/vai trò và lọc thiết bị theo bộ môn
nguoiDungSelect && nguoiDungSelect.addEventListener('change', function(){
    const opt = this.selectedOptions[0];
    const boMon = opt ? opt.getAttribute('data-bomon') : '';
    const vaiTro = opt ? opt.getAttribute('data-vaitro') : '';
    qs('#boMon').value = boMon || '';
    qs('#vaiTro').value = vaiTro || '';
    updateAllOptionVisibility();
});

// Hàm cập nhật tên attribute cho input số lượng tương ứng với select đã chọn
function syncInputNameForRow(selectEl) {
    const tr = selectEl.closest('tr');
    const input = qs('input.soLuongInput', tr);
    // xóa tên cũ (nếu có)
    input.removeAttribute('name');

    const val = selectEl.value;
    if(val && val !== '') {
        // đặt tên theo server mong đợi: soLuong[<maThietBi>]
        input.setAttribute('name', `soLuong[${val}]`);
    } else {
        // nếu chọn rỗng => giữ trống để server không thấy trường đó
        input.removeAttribute('name');
    }
}

// Cập nhật visibility option theo bộ môn đã chọn và loại thiết bị đã chọn trên các select khác
function updateAllOptionVisibility() {
    const selectedBoMon = nguoiDungSelect.selectedOptions[0] ? nguoiDungSelect.selectedOptions[0].getAttribute('data-bomon') : null;
    const currentValues = selects().map(s => s.value).filter(v => v !== '');

    selects().forEach(select => {
        Array.from(select.options).forEach(opt => {
            if(opt.value === '') {
                opt.style.display = ''; // luôn hiển thị option rỗng
                return;
            }
            // ẩn nếu khác bộ môn (nếu đã chọn bộ môn), hoặc ẩn nếu đã được chọn trên select khác
            if(selectedBoMon && opt.getAttribute('data-bomon') !== selectedBoMon) {
                opt.style.display = 'none';
            } else if(currentValues.includes(opt.value) && select.value !== opt.value) {
                opt.style.display = 'none';
            } else {
                opt.style.display = '';
            }
        });
        // đảm bảo mỗi select sync lại tên input tương ứng
        syncInputNameForRow(select);
    });
}

// Gắn event change cho từng select (để sync tên input & update filter)
selects().forEach(select => {
    select.addEventListener('change', function(){
        // khi thay đổi select: cập nhật tên input ở hàng đó
        syncInputNameForRow(this);
        // cập nhật ẩn/hiện option cho các select còn lại
        updateAllOptionVisibility();
    });
});

// Reset form: xóa name input số lượng và hiển thị lại toàn bộ options
btnReset && btnReset.addEventListener('click', function(){
    // timeout để reset sau khi form thực sự được reset bởi browser
    setTimeout(() => {
        soLuongInputs().forEach(inp => inp.removeAttribute('name'));
        qsa('.thietBiSelect').forEach(s => s.value = '');
        qs('#boMon').value = '';
        qs('#vaiTro').value = '';
        updateAllOptionVisibility();
    }, 10);
});

// Trước submit: kiểm tra mỗi select có giá trị thì input cùng hàng có name và >0
form && form.addEventListener('submit', function(e){
    const selected = selects().filter(s => s.value !== '');
    for(let s of selected){
        const tr = s.closest('tr');
        const inp = qs('input.soLuongInput', tr);
        const val = inp ? inp.value.trim() : '';
        if(!inp || val === '' || parseInt(val) <= 0) {
            alert('Bạn phải nhập số lượng cho tất cả thiết bị đã chọn!');
            inp && inp.focus();
            e.preventDefault();
            return;
        }
    }
    // nếu pass -> trước submit đảm bảo mỗi input đã có name đúng (đã sync trong updateAllOptionVisibility)
});

// Khởi tạo ban đầu: đảm bảo input names trống và filter đúng (tránh trường hợp user reload)
document.addEventListener('DOMContentLoaded', function(){
    soLuongInputs().forEach(inp => inp.removeAttribute('name'));
    updateAllOptionVisibility();
});
</script>

<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>