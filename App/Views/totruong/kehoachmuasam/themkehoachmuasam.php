<!-- App/Views/totruong/kehoachmuasam/themkehoachmuasam.php -->
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
    $userBoMon = $r['tenBoMon']; // Lưu bộ môn người dùng
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dskehoachmuasam';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dskehoachmuasam'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 66rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Lập kế hoạch mua sắm</h3>

            <form action="#" method="post" id="frmThemKeHoach">
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
                                    <th>Bộ môn</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include_once('App/Controllers/cThietBi.php');
                                $pTB = new controlThietBi();
                                $kq = $pTB->getAllThietBi();
                                // Lấy toàn bộ thiết bị 1 lần để tránh lỗi fetch_assoc bị cạn
                                $res = $kq ? $kq->fetch_all(MYSQLI_ASSOC) : [];

                                // Lọc thiết bị theo bộ môn nếu có, nếu không thì hiển thị toàn bộ (VD: NV thiết bị với Tổ trường chuyên môn)
                                if (!empty($userBoMon)) {
                                    $res = array_filter($res, function($r) use ($userBoMon) {
                                        return $r['tenBoMon'] === $userBoMon;
                                    });
                                }

                                for ($i=1; $i<=3; $i++): 
                                ?>
                                <tr>
                                    <td><strong><?= $i ?></strong></td>
                                    <td>
                                        <select name="maThietBi[]" class="form-select thietBiSelect">
                                            <option value="" selected>-- Chọn thiết bị --</option>
                                            <?php foreach($res as $r): ?>
                                                <option value="<?= $r["maThietBi"] ?>" data-bomon="<?= $r["tenBoMon"] ?>" data-nhacungcap="<?= $r["tenNhaCungCap"] ?>"><?= $r["tenThietBi"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" disabled></td>
                                    <td><input type="text" class="form-control" disabled></td>
                                    <td><input type="number" min="1" class="form-control text-center soLuongInput"></td>
                                    <td><input type="number" min="1" class="form-control donGiaInput"></td>
                                    <td><input type="number" class="form-control text-end thanhTienInput" readonly></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tổng chi phí -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tổng chi phí <span class="text-danger">*</span></label>
                    <input type="number" id="tongChiPhi" name="tongChiPhi" class="form-control" readonly>
                </div>
        
                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                    <input type="text" value="Chờ duyệt" class="form-control" disabled>
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
include_once('App/Controllers/cKeHoachMuaSam.php');
$p = new controlKeHoachMuaSam();

if(isset($_POST['btnluu'])) {
    $ngayLap = $_POST['ngayLap'];
    $tongChiPhi = $_POST['tongChiPhi'];
    $ghiChu = trim($_POST['ghiChu']);

    $chiTiet = []; // mảng chi tiết thiết bị để truyền vào insertChiTietKHMuaSam
    if(!empty($_POST['maThietBi']) && is_array($_POST['maThietBi'])) {
        foreach($_POST['maThietBi'] as $i => $maThietBi) {
            $maThietBi = trim($maThietBi);
            if($maThietBi === '') continue;

            $soLuong = isset($_POST['soLuong'][$maThietBi]) ? (int)$_POST['soLuong'][$maThietBi] : 0;
            $donGia = isset($_POST['donGia'][$maThietBi]) ? $_POST['donGia'][$maThietBi] : 0;
            $thanhTien = isset($_POST['thanhTien'][$maThietBi]) ? $_POST['thanhTien'][$maThietBi] : 0;

            if($soLuong <= 0) {
                echo "<script>alert('Bạn phải nhập số lượng > 0 cho tất cả thiết bị đã chọn'); window.location.href='index.php?page=themkehoachmuasam';</script>";
                exit();
            }

            if($donGia <= 0) {
                echo "<script>alert('Bạn phải nhập đơn giá > 0 cho tất cả thiết bị đã chọn'); window.location.href='index.php?page=themkehoachmuasam';</script>";
                exit();
            }

            $chiTiet[$maThietBi] = [
                'soLuong'   => $soLuong,
                'donGia'    => $donGia,
                'thanhTien' => $thanhTien
            ];
        }
    }

    if(empty($chiTiet)){
        echo "<script>alert('Vui lòng chọn ít nhất 1 thiết bị'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        exit();
    }

    $maKeHoachMuaSam = $p->insertKeHoachMuaSam($maNguoiDung, $ngayLap, $tongChiPhi, "Chờ duyệt", $ghiChu);

    if($maKeHoachMuaSam) {
        $kq = $p->insertChiTietKHMuaSam($maKeHoachMuaSam, $chiTiet);

        if($kq) {
            echo "<script>alert('Thêm kế hoạch thành công'); window.location.href='index.php?page=dskehoachmuasam'</script>";
        } else {
            $p->deleteKeHoachMuaSam($maKeHoachMuaSam); // rollback: xóa kế hoạch nếu thêm chi tiết thất bại
            echo "<script>alert('Thêm kế hoạch thất bại.'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        }
    } else {
        echo "<script>alert('Thêm kế hoạch thất bại!'); window.location.href='index.php?page=themkehoachmuasam';</script>";
        exit();
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Helpers
    function qs(sel, ctx=document) { return ctx.querySelector(sel); }
    function qsa(sel, ctx=document) { return Array.from(ctx.querySelectorAll(sel)); }
    
    // Tham số DOM
    const selects = () => qsa('.thietBiSelect');
    const soLuongInputs = () => qsa('.soLuongInput');
    const form = qs('#frmThemKeHoach');
    const btnReset = qs('button[type="reset"]');
    const rows = document.querySelectorAll("table tbody tr");
    const tongChiPhiInput = document.getElementById('tongChiPhi');

    function formatNumber(n) { return isNaN(n) ? 0 : Number(n); }

    // Hàm cập nhật tên attribute cho input số lượng, đơn giá, thành tiền tương ứng với select đã chọn
    function syncInputNameForRow(selectEl) {
        const tr = selectEl.closest('tr');
        const inputSL = qs('input.soLuongInput', tr);
        const inputDG = qs('input.donGiaInput', tr);
        const inputTT = qs('input.thanhTienInput', tr);
        const val = selectEl.value;

        if(val && val !== '') {
            inputSL.setAttribute('name', `soLuong[${val}]`);
            inputDG.setAttribute('name', `donGia[${val}]`);
            inputTT.setAttribute('name', `thanhTien[${val}]`);
        } else {
            // nếu chọn rỗng => giữ trống để server không thấy trường đó
            inputSL.removeAttribute('name');
            inputDG.removeAttribute('name');
            inputTT.removeAttribute('name');
        }
    }

    // Cập nhật visibility option theo bộ môn đã chọn và loại thiết bị đã chọn trên các select khác
    function updateAllOptionVisibility() {
        const currentValues = selects().map(s => s.value).filter(v => v !== '');
        selects().forEach(select => {
            Array.from(select.options).forEach(opt => {
                if(opt.value === '') { opt.style.display = ''; return; }
                // ẩn nếu đã được chọn trên select khác
                if(currentValues.includes(opt.value) && select.value !== opt.value) opt.style.display = 'none';
                else opt.style.display = '';
            });
            syncInputNameForRow(select); // đảm bảo mỗi select sync lại tên input tương ứng
        });
    }

    function tinhTongChiPhi() {
        let tong = 0;
        rows.forEach(tr => {
            const thanhTien = tr.querySelector(".thanhTien");
            if (thanhTien && thanhTien.value !== "") {
                tong += formatNumber(thanhTien.value);
            }
        });
        if (tongChiPhiInput) tongChiPhiInput.value = tong;
    }

    rows.forEach(tr => {
        const selectTB = tr.querySelector(".thietBiSelect");
        const inputBoMon = tr.cells[2].querySelector("input");
        const inputNCC = tr.cells[3].querySelector("input");
        const inputSL = tr.cells[4].querySelector("input");
        const inputDonGia = tr.cells[5].querySelector("input");
        const inputThanhTien = tr.cells[6].querySelector("input");

        if (inputThanhTien) inputThanhTien.classList.add("thanhTien");

        // Khi chọn thiết bị → tự động fill bộ môn + nhà cung cấp
        if (selectTB) {
            selectTB.addEventListener("change", function () {
                const opt = this.selectedOptions[0];
                inputBoMon.value = opt ? (opt.getAttribute("data-bomon") || "") : "";
                inputNCC.value = opt ? (opt.getAttribute("data-nhacungcap") || "") : "";
            });
        }

        // Tính thành tiền theo dòng
        function tinhThanhTien() {
            const sl = formatNumber(inputSL.value);
            const dg = formatNumber(inputDonGia.value);
            const tt = sl * dg;
            if (inputThanhTien) inputThanhTien.value = tt > 0 ? tt : "";
            tinhTongChiPhi();
        }

        inputSL && inputSL.addEventListener("input", tinhThanhTien);
        inputDonGia && inputDonGia.addEventListener("input", tinhThanhTien);
    });

    // Gắn event change cho từng select (để sync tên input & update filter)
    selects().forEach(select => {
        select.addEventListener('change', function(){
            syncInputNameForRow(this); // khi thay đổi select: cập nhật tên input ở hàng đó
            updateAllOptionVisibility(); // cập nhật ẩn/hiện option cho các select còn lại
        });
    });

    // Reset form: xóa name input số lượng và hiển thị lại toàn bộ options
    btnReset && btnReset.addEventListener('click', function(){
        // timeout để reset sau khi form thực sự được reset bởi browser
        setTimeout(() => {
            soLuongInputs().forEach(inp => inp.removeAttribute('name'));
            qsa('.thietBiSelect').forEach(s => s.value = '');
            updateAllOptionVisibility();
        }, 10);
    });

    // Trước submit: kiểm tra mỗi select có giá trị thì input cùng hàng có name và >0
    form && form.addEventListener('submit', function(e){
        const selected = selects().filter(s => s.value !== '');
        for(let s of selected){
            const tr = s.closest('tr');
            const inpSL = qs('input.soLuongInput', tr);
            const inpDG = qs('input.donGiaInput', tr);

            if(!inpSL || inpSL.value.trim() === '' || parseInt(inpSL.value) <= 0) {
                alert('Bạn phải nhập số lượng > 0 cho tất cả thiết bị đã chọn!');
                inpSL && inpSL.focus();
                e.preventDefault();
                return;
            }

            if(!inpDG || inpDG.value.trim() === '' || parseInt(inpDG.value) <= 0) {
                alert('Bạn phải nhập đơn giá > 0 cho tất cả thiết bị đã chọn!');
                inpDG && inpDG.focus();
                e.preventDefault();
                return;
            }
        }
    });

    soLuongInputs().forEach(inp => inp.removeAttribute('name'));
    updateAllOptionVisibility();
    tinhTongChiPhi();
});
</script>

<style>
    th, td { 
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
    }

    input[readonly] {
        background-color: #e9ecef !important;
        color: #495057 !important;
        cursor: not-allowed;
    }

    input[readonly]:focus,
    input[readonly]:hover {
        background-color: #e9ecef !important;
        box-shadow: none !important;
        border-color: #ced4da !important;
    }
</style>