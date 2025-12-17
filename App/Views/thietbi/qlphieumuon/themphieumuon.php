<!-- App/Views/thietbi/qlphieumuon/themphieumuon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsphieumuon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm phiếu mượn</h3>

            <form action="#" method="post" spellcheck="false">
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
                
                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò <span class="text-danger">*</span></label>
                    <input type="text" id="vaiTro" name="maVaiTro" class="form-control" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <input type="text" id="boMon" name="maBoMon" class="form-control" disabled>
                </div>

                <!-- Ngày mượn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày mượn <span class="text-danger">*</span></label>
                    <input type="date" id="ngayMuon" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
                </div>

                <!-- Ngày trả -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày trả <span class="text-danger">*</span></label>
                    <input type="date" name="ngayTra" id="ngayTra" class="form-control" min="<?= date('Y-m-d') ?>" required>
                    <span class="error" id="ngayTraError"></span>
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
                                            <?php foreach($res as $r): 
                                            // lấy số lượng khả dụng cho mỗi thiết bị (1 query mỗi thiết bị)
                                            $soLuongKhaDung = 0;
                                            if (isset($r['maThietBi'])) {
                                                // dùng controller để lấy count
                                                $tmp = $p->countSoLuongKhaDung($r['maThietBi']);
                                                $soLuongKhaDung = $tmp ? (int)($tmp->fetch_assoc()['soLuongKhaDung'] ?? 0) : 0;
                                            }
                                            ?>
                                            <?php if ($soLuongKhaDung > 0): ?>
                                                <option value="<?= $r["maThietBi"] ?>" data-bomon="<?= $r["tenBoMon"] ?>" data-max="<?= $soLuongKhaDung ?>"><?= $r["tenThietBi"] ?> (Khả dụng: <?= $soLuongKhaDung ?>)</option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="number" min="1" class="form-control text-center soLuongInput"></td>
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
                    <textarea name="ghiChu" class="form-control" rows="3" placeholder="Yêu cầu hoặc lưu ý đặc biệt..." style="resize:none;"></textarea>
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
    $ngayTra = $_POST['ngayTra'];
    $ghiChu = trim($_POST['ghiChu']);

    $chiTiet = []; // mảng chi tiết thiết bị để truyền vào insertChiTietPM
    if(!empty($_POST['maThietBi']) && is_array($_POST['maThietBi'])) {
        foreach($_POST['maThietBi'] as $index => $maThietBi) {
            $maThietBi = trim($maThietBi);
            if($maThietBi === '') continue;
            // server-side sẽ tìm $_POST['soLuong'][$maThietBi], do đó gửi đúng cặp key/value là cần thiết
            $soLuong = 0;
            if(isset($_POST['soLuong'][$maThietBi])) $soLuong = (int)$_POST['soLuong'][$maThietBi];
            if($soLuong <= 0) {
                echo "<script>alert('Bạn phải nhập số lượng > 0 cho tất cả thiết bị đã chọn'); window.location.href='index.php?page=themphieumuon';</script>";
                exit();
            }
            $chiTiet[$maThietBi] = $soLuong;
        }
    }

    // Kiểm tra có chọn thiết bị không
    if(empty($chiTiet)){
        echo "<script>alert('Vui lòng chọn ít nhất 1 thiết bị'); window.location.href='index.php?page=themphieumuon';</script>";
        exit();
    }

    $maPhieuMuon = $p->insertPhieuMuon($maNguoiDung, date('Y-m-d'), $ngayTra, "Đã xác nhận", $ghiChu);

    if($maPhieuMuon) {
        $kq = $p->insertChiTietPM($maPhieuMuon, $chiTiet);

        if($kq) {
            echo "<script>alert('Phiếu mượn đã được tạo thành công.'); window.location.href='index.php?page=dsphieumuon'</script>";
        } else {
            $p->deletePhieuMuon($maPhieuMuon);  // rollback phiếu mượn
            echo "<script>alert('Không thể tạo phiếu mượn do thiết bị khả dụng không đủ. Vui lòng kiểm tra lại.'); window.location.href='index.php?page=themphieumuon';</script>";
        }
    } else {
        echo "<script>alert('Tạo phiếu mượn thất bại. Vui lòng thử lại.'); window.location.href='index.php?page=themphieumuon';</script>";
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

// Ràng buộc số lượng max = chitietthietbi có tinhTrang = "Khả dụng"
document.querySelectorAll('.thietBiSelect').forEach(select => {
    select.addEventListener('change', function () {
        const opt = this.selectedOptions[0];
        const max = parseInt(opt?.dataset.max || 0);

        const input = this.closest('tr').querySelector('.soLuongInput');
        input.disabled = max <= 0;
        input.max = max > 0 ? max : 0;
        input.value = "";
    });
});
</script>

<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
// Ràng buộc JQuery ngày trả phải sau ngày mượn
$(document).ready(function () {
    $('#ngayMuon, #ngayTra').change(checkNgayTra);

    $('form').submit(function(e) {
        if(!checkNgayTra()) e.preventDefault();
    });

    function checkNgayTra() {
        const ngayMuon = $('#ngayMuon').val();
        const ngayTra = $('#ngayTra').val();

        if(!ngayMuon || !ngayTra) return true; // chưa nhập đủ

        if(new Date(ngayTra) <= new Date(ngayMuon)) {
            showError('#ngayTraError', 'Ngày trả phải sau ngày mượn!');
            return false;
        } else {
            clearError('#ngayTraError');
            return true;
        }
    }

    function showError(elem, msg) {
        $(elem).text(msg);
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }
});
</script>