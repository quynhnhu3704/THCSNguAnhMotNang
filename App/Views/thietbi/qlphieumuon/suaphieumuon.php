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

include_once('App/Controllers/cPhieuMuon.php');
include_once('App/Controllers/cNguoiDung.php');
include_once('App/Controllers/cThietBi.php');

$pPM = new controlPhieuMuon();
$pND = new controlNguoiDung();
$pTB = new controlThietBi();

$maPhieuMuon = $_GET['maPhieuMuon'];

$pm = $pPM->get01PhieuMuon($maPhieuMuon)->fetch_assoc();
$ct = $pPM->get01ChiTietPM($maPhieuMuon);
$dsCT = [];

while($ct && $r = $ct->fetch_assoc()) {
    $dsCT[] = $r;   // maThietBi, tenThietBi, soLuong, maCTTB...
}

$dsNguoi = $pND->getNguoiDungTheoVaiTro([2,3])->fetch_all(MYSQLI_ASSOC);
$dsTB = $pTB->getAllThietBi()->fetch_all(MYSQLI_ASSOC);
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsphieumuon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Sửa phiếu mượn</h3>

            <form action="#" method="post">
                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <select id="nguoiDungSelect" name="maNguoiDung" class="form-select" required>
                        <option value="">-- Chọn người dùng --</option>
                        <?php foreach($dsNguoi as $u): ?>
                            <option value="<?= $u['maNguoiDung'] ?>" data-bomon="<?= $u['tenBoMon'] ?>" data-vaitro="<?= $u['tenVaiTro'] ?>"<?= $u['maNguoiDung']==$pm['maNguoiDung']?'selected':'' ?>><?= $u['hoTen'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò</label>
                    <input type="text" id="vaiTro" class="form-control" value="<?= $pm['tenVaiTro'] ?>" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" id="boMon" class="form-control" value="<?= $pm['tenBoMon'] ?>" disabled>
                </div>

                <!-- Ngày mượn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày mượn</label>
                    <input type="date" name="ngayMuon" class="form-control" value="<?= $pm['ngayMuon'] ?>" required>
                </div>

                <!-- Ngày trả -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Ngày trả</label>
                    <input type="date" name="ngayTra" class="form-control" value="<?= $pm['ngayTra'] ?>" required>
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
                                for($i=0; $i<3; $i++):
                                    $old = $dsCT[$i] ?? null;
                                ?>
                                <tr>
                                    <td><b><?= $i+1 ?></b></td>
                                    <td>
                                        <select name="maThietBi[]" class="form-select thietBiSelect">
                                            <option value="">-- Chọn thiết bị --</option>
                                            <?php foreach($dsTB as $tb): ?>
                                                <option 
                                                    value="<?= $tb['maThietBi'] ?>"
                                                    data-bomon="<?= $tb['tenBoMon'] ?>"
                                                    <?= $old && $tb['maThietBi']==$old['maThietBi']?'selected':'' ?>
                                                ><?= $tb['tenThietBi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="1" class="form-control text-center soLuongInput"
                                            name="soLuong[<?= $old['maThietBi'] ?>]"
                                            value="<?= $old ? $old['soLuong']:"" ?>">
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Trạng thái</label>
                    <select name="trangThai" class="form-select" required>
                        <?php 
                        $st = ["Chờ xử lý","Đã xác nhận","Đang mượn","Đã trả"];
                        foreach($st as $t): ?>
                            <option value="<?= $t ?>" <?= $pm['trangThai']==$t?'selected':'' ?>>
                                <?= $t ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" rows="3" class="form-control" style="resize:none;"><?= $pm['ghiChu'] ?></textarea>
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
if(isset($_POST['btnluu'])){
    $maNguoiDung = $_POST['maNguoiDung'];
    $ngayMuon    = $_POST['ngayMuon'];
    $ngayTra     = $_POST['ngayTra'];
    $ghiChu      = trim($_POST['ghiChu']);
    $trangThai   = $_POST['trangThai'];

    if($ngayTra < $ngayMuon){
        echo "<script>alert('Ngày trả phải sau ngày mượn'); window.location.href='index.php?page=suaphieumuon';</script>";
        exit();
    }

    // Chuẩn bị chi tiết thiết bị
    $chiTiet = [];
    if(!empty($_POST['maThietBi'])){
        foreach($_POST['maThietBi'] as $maTB){
            if($maTB==='') continue;
            if(isset($_POST['soLuong'][$maTB])){
                $sl = (int)$_POST['soLuong'][$maTB];
                if($sl<=0){
                    echo "<script>alert('Số lượng phải > 0'); window.location.href='index.php?page=suaphieumuon';</script>";
                    exit();
                }
                $chiTiet[$maTB] = $sl;
            }
        }
    }

    if(empty($chiTiet)){
        echo "<script>alert('Phải chọn ít nhất 1 thiết bị'); window.location.href='index.php?page=suaphieumuon';</script>";
        exit();
    }

    // Update phiếu mượn
    $pPM->updatePhieuMuon($maPhieuMuon,$maNguoiDung,$ngayMuon,$ngayTra,$trangThai,$ghiChu);

    // Xóa chi tiết cũ + trả thiết bị cũ về khả dụng
    $pPM->restoreThietBi($maPhieuMuon);
    $pPM->deleteChiTietPM($maPhieuMuon);

    // Thêm chi tiết mới
    $ok = $pPM->insertChiTietPM($maPhieuMuon,$chiTiet);

    if($ok){
        echo "<script>alert('Cập nhật thành công'); window.location.href='index.php?page=dsphieumuon';</script>";
    }else{
        echo "<script>alert('Cập nhật thất bại'); window.location.href='index.php?page=suaphieumuon';</script>";
    }
}
?>


<script>
function qs(s,ctx=document){return ctx.querySelector(s);}
function qsa(s,ctx=document){return [...ctx.querySelectorAll(s)];}

const nguoiDungSelect = qs('#nguoiDungSelect');

nguoiDungSelect.addEventListener('change', ()=>{
    const opt = nguoiDungSelect.selectedOptions[0];
    qs('#boMon').value = opt.getAttribute('data-bomon');
    qs('#vaiTro').value = opt.getAttribute('data-vaitro');
    updateOptionVisibility();
});

function updateOptionVisibility(){
    const selectedBoMon = nguoiDungSelect.selectedOptions[0].getAttribute('data-bomon');
    const selects = qsa('.thietBiSelect');
    const used = selects.map(s=>s.value).filter(v=>v!=='');

    selects.forEach(s=>{
        [...s.options].forEach(o=>{
            if(o.value==='') { o.style.display=''; return; }

            if(o.getAttribute('data-bomon')!==selectedBoMon){
                o.style.display='none';
            } else if(used.includes(o.value) && s.value!==o.value){
                o.style.display='none';
            } else {
                o.style.display='';
            }
        });

        syncInputName(s);
    });
}

function syncInputName(select){
    const tr = select.closest('tr');
    const input = qs('.soLuongInput',tr);
    input.removeAttribute('name');

    if(select.value!==''){
        input.setAttribute('name',`soLuong[${select.value}]`);
    }
}

qsa('.thietBiSelect').forEach(s=>{
    s.addEventListener('change', ()=>{
        syncInputName(s);
        updateOptionVisibility();
    });
});

document.addEventListener('DOMContentLoaded', updateOptionVisibility);
</script>


<style>
    th, td {
        border: 1px solid #ddd;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>