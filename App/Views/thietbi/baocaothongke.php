<?php
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cBaoCaoThongKe.php');
$p = new controlBaoCaoThongKe();
$kq = $p->getAllThongKe();

$trangThaiKeHoach = ['Chờ duyệt', 'Chấp thuận', 'Từ chối'];
$trangThaiThanhLy = ['Chờ duyệt', 'Chấp thuận', 'Từ chối'];

// 1. Kế hoạch Mua sắm
$chartMuaSamSo = [];
$chartMuaSamChiPhi = []; // Đơn vị: Triệu VNĐ
$tongChiPhiMuaSam = 0;

foreach ($trangThaiKeHoach as $tt) {
    $found = false;
    foreach ($kq['keHoachMuaSam'] as $row) {
        if ($row['trangThai'] == $tt) {
            $chartMuaSamSo[] = $row['soKeHoach'];
            // Chia cho 1,000,000 để hiển thị đơn vị triệu đồng
            $chartMuaSamChiPhi[] = round($row['tongChiPhi'] / 1000000, 2);
            $tongChiPhiMuaSam += $row['tongChiPhi'];
            $found = true;
            break;
        }
    }
    // Nếu trạng thái không có, thêm 0
    if (!$found) {
        $chartMuaSamSo[] = 0;
        $chartMuaSamChiPhi[] = 0;
    }
}
// Nếu $kq['keHoachMuaSam'] không có trạng thái Hủy, ta giả định luôn có 3 trạng thái
// (Chờ duyệt, Đã duyệt, Hủy) cho biểu đồ, cần đảm bảo mảng $kq['keHoachMuaSam'] đầy đủ từ Controller

// 2. Kế hoạch Thanh lý
$chartThanhLySo = [];
$chartThanhLyGiaTri = []; // Đơn vị: Triệu VNĐ
$tongGiaTriThanhLy = 0;

foreach ($trangThaiKeHoach as $tt) {
    $found = false;
    foreach ($kq['keHoachThanhLy'] as $row) {
        if ($row['trangThai'] == $tt) {
            $chartThanhLySo[] = $row['soKeHoach'];
            // Chia cho 1,000,000 để hiển thị đơn vị triệu đồng
            $chartThanhLyGiaTri[] = round($row['tongGiaTri'] / 1000000, 2);
            $tongGiaTriThanhLy += $row['tongGiaTri'];
            $found = true;
            break;
        }
    }
    // Nếu trạng thái không có, thêm 0
    if (!$found) {
        $chartThanhLySo[] = 0;
        $chartThanhLyGiaTri[] = 0;
    }
}
// Giả định nếu trạng thái Hủy có thể xảy ra, bạn cần thêm nó vào $trangThaiKeHoach
// và đảm bảo nó được xử lý trong logic vòng lặp trên (hiện tại chỉ có 2 trạng thái).

?>

<div class="container my-5">

    <h2 class="text-center mb-5 fw-bolder text-primary">📊 BÁO CÁO - THỐNG KÊ TỔNG HỢP</h2>

    <div class="row mb-5 g-4">
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #a8edea; --text-color: #0d6efd;">
                <div class="card-body py-4">
                    <i class="bi bi-box-seam fs-3 mb-2 d-block text-primary"></i>
                    <h5 class="card-title mb-3 fw-bold">Tổng thiết bị</h5>
                    <h2 class="fw-bolder mb-0"><?= number_format($kq['tongThietBi']) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #d299c2; --text-color: #198754;">
                <div class="card-body py-4">
                    <i class="bi bi-check-circle-fill fs-3 mb-2 d-block text-success"></i>
                    <h5 class="card-title mb-3 fw-bold">Khả dụng</h5>
                    <h2 class="fw-bolder mb-0"><?= number_format($kq['tinhTrang']['Khả dụng'] ?? 0) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #89f7fe; --text-color: #ffc107;">
                <div class="card-body py-4">
                    <i class="bi bi-clock-history fs-3 mb-2 d-block text-warning"></i>
                    <h5 class="card-title mb-3 fw-bold">Đang mượn</h5>
                    <h2 class="fw-bolder mb-0"><?= number_format($kq['tinhTrang']['Đang mượn'] ?? 0) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #ff9a9e; --text-color: #dc3545;">
                <div class="card-body py-4">
                    <i class="bi bi-tools fs-3 mb-2 d-block text-danger"></i>
                    <h5 class="card-title mb-3 fw-bold">Báo hỏng</h5>
                    <h2 class="fw-bolder mb-0"><?= number_format($kq['tinhTrang']['Báo hỏng'] ?? 0) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #a18cd1; --text-color: #6c757d;">
                <div class="card-body py-4">
                    <i class="bi bi-archive-fill fs-3 mb-2 d-block text-secondary"></i>
                    <h5 class="card-title mb-3 fw-bold">Thanh lý</h5>
                    <h2 class="fw-bolder mb-0"><?= number_format($kq['tinhTrang']['Thanh lý'] ?? 0) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card card-dashboard h-100 shadow-lg text-center" style="--card-color: #fef9d7; --text-color: #0dcaf0;">
                <div class="card-body py-4">
                    <i class="bi bi-currency-dollar fs-3 mb-2 d-block text-info"></i>
                    <h5 class="card-title mb-3 fw-bold">Tổng Chi Phí</h5>
                    <h6 class="fw-bolder mb-0 text-truncate"><?= number_format($kq['tongGiaTriTaiSan'] ?? 0) ?> VNĐ</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <a href="#thietbi-bomon" class="btn btn-outline-primary mx-2 mb-2"><i class="bi bi-grid-fill"></i> Bộ môn</a>
        <a href="#suachua" class="btn btn-outline-warning mx-2 mb-2"><i class="bi bi-wrench"></i> Sửa chữa</a>
        <a href="#nhacungcap" class="btn btn-outline-info mx-2 mb-2"><i class="bi bi-truck"></i> NCC</a>
        <a href="#kehoachmuasam" class="btn btn-outline-success mx-2 mb-2"><i class="bi bi-cart-fill"></i> Mua sắm</a>
        <a href="#kehoachthanhly" class="btn btn-outline-danger mx-2 mb-2"><i class="bi bi-trash-fill"></i> Thanh lý</a>
    </div>

    <hr class="my-5">

    <section id="thietbi-bomon" class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-primary"><i class="bi bi-bar-chart-fill"></i> THIẾT BỊ THEO BỘ MÔN</h3>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Bộ môn</th>
                                        <th>Số lượng</th>
                                        <th>Tỷ lệ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tongBoMon = array_sum(array_column($kq['byBoMon'], 'count'));
                                    foreach ($kq['byBoMon'] as $row) :
                                        $tyle = $tongBoMon > 0 ? round($row['count'] / $tongBoMon * 100, 1) : 0;
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="text-start"><strong><?= htmlspecialchars($row['tenBoMon']) ?></strong></td>
                                            <td><?= number_format($row['count']) ?></td>
                                            <td><span class="badge bg-info fs-6"><?= $tyle ?>%</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-secondary fw-bold">
                                        <td colspan="2">Tổng cộng</td>
                                        <td><?= number_format($tongBoMon) ?></td>
                                        <td>100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <canvas id="chartBoMon"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section id="suachua" class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-warning"><i class="bi bi-gear-fill"></i> ĐANG SỬA CHỮA / BẢO TRÌ / BẢO HÀNH</h3>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center mb-0">
                                <thead class="table-warning">
                                    <tr>
                                        <th>#</th>
                                        <th>Loại yêu cầu</th>
                                        <th>Số lượng</th>
                                        <th>Tỷ lệ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tongSC = array_sum($kq['dangSuaChua']);
                                    $labelsSC = ['Sửa chữa', 'Bảo trì', 'Bảo hành'];
                                    foreach ($labelsSC as $lbl) :
                                        $sl = $kq['dangSuaChua'][$lbl] ?? 0;
                                        $tyle = $tongSC > 0 ? round($sl / $tongSC * 100, 1) : 0;
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="text-start"><?= $lbl ?></td>
                                            <td><?= number_format($sl) ?></td>
                                            <td><span class="badge bg-warning text-dark fs-6"><?= $tyle ?>%</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-dark text-white fw-bold">
                                        <td colspan="2">Tổng</td>
                                        <td><?= number_format($tongSC) ?></td>
                                        <td>100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <canvas id="chartSuaChua"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section id="nhacungcap" class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-info"><i class="bi bi-building"></i> THIẾT BỊ THEO NHÀ CUNG CẤP</h3>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-center mb-0">
                                <thead class="table-info">
                                    <tr>
                                        <th>#</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Số lượng</th>
                                        <th>Tỷ lệ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tongNCC = array_sum(array_column($kq['byNhaCungCap'], 'count'));
                                    foreach ($kq['byNhaCungCap'] as $ncc) :
                                        $tyle = $tongNCC > 0 ? round($ncc['count'] / $tongNCC * 100, 1) : 0;
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="text-start"><?= htmlspecialchars($ncc['tenNhaCungCap']) ?></td>
                                            <td><?= number_format($ncc['count']) ?></td>
                                            <td><span class="badge bg-info fs-6"><?= $tyle ?>%</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-secondary fw-bold">
                                        <td colspan="2">Tổng cộng</td>
                                        <td><?= number_format($tongNCC) ?></td>
                                        <td>100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <canvas id="chartNhaCungCap"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section id="kehoachmuasam" class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-success"><i class="bi bi-bag-plus-fill"></i> TỔNG HỢP KẾ HOẠCH MUA SẮM</h3>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 border-success">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-success table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <th>Số kế hoạch</th>
                                        <th>Tổng chi phí (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tongSoKH = 0;
                                    foreach ($kq['keHoachMuaSam'] as $row) :
                                        $tongSoKH += $row['soKeHoach'];
                                    ?>
                                        <tr>
                                            <td><span class="badge bg-<?= $row['trangThai'] == 'Đã duyệt' ? 'success' : ($row['trangThai'] == 'Chờ duyệt' ? 'warning' : 'secondary') ?>"><?= $row['trangThai'] ?></span></td>
                                            <td><?= number_format($row['soKeHoach']) ?></td>
                                            <td class="text-end fw-bold"><?= number_format($row['tongChiPhi']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-dark text-white fw-bold">
                                        <td>TỔNG</td>
                                        <td><?= number_format($tongSoKH) ?></td>
                                        <td class="text-end"><?= number_format($tongChiPhiMuaSam) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <canvas id="chartKeHoachMuaSam"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section id="kehoachthanhly" class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-danger"><i class="bi bi-trash-fill"></i> TỔNG HỢP KẾ HOẠCH THANH LÝ</h3>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 border-danger">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-danger table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <th>Số kế hoạch</th>
                                        <th>Tổng giá trị thanh lý (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tongSoKHThanhLy = 0;
                                    foreach ($kq['keHoachThanhLy'] as $row) :
                                        $tongSoKHThanhLy += $row['soKeHoach'];
                                    ?>
                                        <tr>
                                            <td><span class="badge bg-<?= $row['trangThai'] == 'Đã duyệt' ? 'success' : 'warning' ?>"><?= $row['trangThai'] ?></span></td>
                                            <td><?= number_format($row['soKeHoach']) ?></td>
                                            <td class="text-end fw-bold"><?= number_format($row['tongGiaTri']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-dark text-white fw-bold">
                                        <td>TỔNG</td>
                                        <td><?= number_format($tongSoKHThanhLy) ?></td>
                                        <td class="text-end"><?= number_format($tongGiaTriThanhLy) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <canvas id="chartKeHoachThanhLy"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section class="mb-5 p-4 border rounded shadow-sm bg-light">
        <h3 class="text-center mb-4 fw-bolder text-secondary"><i class="bi bi-award-fill"></i> TOP 10 THIẾT BỊ ĐƯỢC MƯỢN NHIỀU NHẤT</h3>
        <div class="card shadow-lg">
            <div class="card-body">
                <canvas id="chartTopMuon"></canvas>
            </div>
        </div>
    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
    // Đăng ký plugin datalabels toàn cục (nên làm ở đây để dùng cho mọi biểu đồ)
    Chart.register(ChartDataLabels);

    // Màu pastel đẹp lung linh
    const pastelColors = [
        '#FF9AA2', '#FFB7B2', '#FFDAC1', '#E2F0CB', '#B5EAD7',
        '#C7CEEA', '#D4A5F1', '#FF9FF3', '#A0E7E5', '#BFFCC6',
        '#FFD3B6', '#FFAAA5', '#D5AAFF', '#A8E6CF', '#FF8B94'
    ];
    // Màu cho biểu đồ kết hợp
    const colors = {
        'primary': '#0d6efd',
        'success': '#198754',
        'warning': '#ffc107',
        'danger': '#dc3545',
        'info': '#0dcaf0'
    };


    // 1. Biểu đồ tròn - Thiết bị theo bộ môn
    new Chart(document.getElementById('chartBoMon'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($kq['byBoMon'], 'tenBoMon')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($kq['byBoMon'], 'count')) ?>,
                backgroundColor: pastelColors,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1, // Đảm bảo biểu đồ tròn
            plugins: {
                title: { display: true, text: 'Tỷ lệ Thiết bị theo Bộ môn' },
                legend: { position: 'bottom' },
                tooltip: { callbacks: { label: ctx => `${ctx.label}: ${ctx.raw} thiết bị` } },
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = Math.round((value * 100) / sum) + '%';
                        return percentage;
                    },
                    color: '#fff',
                    textShadowBlur: 4,
                    textShadowColor: 'rgba(0, 0, 0, 0.5)',
                    font: { weight: 'bold' }
                }
            }
        }
    });

    // 2. Donut - Sửa chữa / Bảo trì / Bảo hành
    new Chart(document.getElementById('chartSuaChua'), {
        type: 'doughnut',
        data: {
            labels: ['Sửa chữa', 'Bảo trì', 'Bảo hành'],
            datasets: [{
                data: <?= json_encode(array_values($kq['dangSuaChua'])) ?>,
                backgroundColor: [colors.danger, colors.warning, colors.info],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1,
            plugins: {
                title: { display: true, text: 'Tình trạng Sửa chữa/Bảo trì' },
                legend: { position: 'bottom' },
                tooltip: { callbacks: { label: ctx => `${ctx.label}: ${ctx.raw} thiết bị` } },
                datalabels: {
                    formatter: (value, ctx) => value > 0 ? value : '',
                    color: '#000',
                    font: { weight: 'bold' }
                }
            }
        }
    });

    // 3. Cột ngang - Nhà cung cấp
    new Chart(document.getElementById('chartNhaCungCap'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($kq['byNhaCungCap'], 'tenNhaCungCap')) ?>,
            datasets: [{
                label: 'Số lượng',
                data: <?= json_encode(array_column($kq['byNhaCungCap'], 'count')) ?>,
                backgroundColor: colors.info,
                borderColor: colors.info,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                title: { display: true, text: 'Thiết bị theo Nhà cung cấp' },
                legend: { display: false },
                datalabels: {
                    anchor: 'end',
                    align: 'right',
                    color: '#000',
                    font: { weight: 'bold' }
                },
                tooltip: { callbacks: { label: ctx => `${ctx.dataset.label}: ${ctx.raw} thiết bị` } }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true, grid: { display: false } }
            }
        }
    });

    // 4 & 5. Kế hoạch mua sắm & thanh lý - dùng bar kết hợp số lượng + chi phí
    function createCombinedChart(id, labels, labelSoLuong, dataSoLuong, labelChiPhi, dataChiPhi) {
        new Chart(document.getElementById(id), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: labelSoLuong,
                        data: dataSoLuong,
                        backgroundColor: colors.primary,
                        yAxisID: 'y-sl'
                    },
                    {
                        label: labelChiPhi,
                        data: dataChiPhi,
                        backgroundColor: colors.success, // Đổi màu để dễ phân biệt
                        yAxisID: 'y-cp'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: id === 'chartKeHoachMuaSam' ? 'Tổng hợp Kế hoạch Mua sắm' : 'Tổng hợp Kế hoạch Thanh lý' },
                    tooltip: {
                        callbacks: {
                            label: ctx => {
                                if (ctx.dataset.yAxisID === 'y-cp') {
                                    return `${ctx.dataset.label}: ${ctx.raw} Triệu VNĐ`;
                                }
                                return `${ctx.dataset.label}: ${ctx.raw}`;
                            }
                        }
                    },
                    datalabels: { display: false } // Tắt DataLabels trên biểu đồ này vì có 2 trục
                },
                scales: {
                    x: { stacked: true },
                    'y-sl': {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: { display: true, text: labelSoLuong }
                    },
                    'y-cp': {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        grid: { drawOnChartArea: false }, // Chỉ vẽ lưới cho trục bên trái
                        title: { display: true, text: labelChiPhi }
                    }
                }
            }
        });
    }

    // Dữ liệu giả định đã được chuẩn bị trong PHP (phần trên cùng)
    // 4. Mua sắm
    createCombinedChart(
        'chartKeHoachMuaSam',
        <?= json_encode($trangThaiKeHoach) ?>,
        'Số kế hoạch',
        <?= json_encode($chartMuaSamSo) ?>,
        'Tổng chi phí (Triệu VNĐ)',
        <?= json_encode($chartMuaSamChiPhi) ?>
    );

    // 5. Thanh lý
    createCombinedChart(
        'chartKeHoachThanhLy',
        <?= json_encode($trangThaiKeHoach) ?>,
        'Số kế hoạch',
        <?= json_encode($chartThanhLySo) ?>,
        'Giá trị (Triệu VNĐ)',
        <?= json_encode($chartThanhLyGiaTri) ?>
    );


    // Bonus: Top 10 mượn nhiều
    new Chart(document.getElementById('chartTopMuon'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($kq['topMuon'], 'tenThietBi')) ?>,
            datasets: [{
                label: 'Số lần mượn',
                data: <?= json_encode(array_column($kq['topMuon'], 'soLanMuon')) ?>,
                backgroundColor: pastelColors[11]
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                title: { display: true, text: 'Top 10 Thiết bị được mượn nhiều nhất' },
                legend: { display: false },
                datalabels: {
                    anchor: 'end',
                    align: 'right',
                    color: '#000',
                    font: { weight: 'bold' }
                }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true, grid: { display: false } }
            }
        }
    });
</script>

<style>
    /* Thêm Bootstrap Icons nếu chưa được thêm */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

    /* Hiệu ứng đẹp hơn cho card tổng quan */
    .card-dashboard {
        /* Sử dụng biến CSS để tạo gradient động */
        background: linear-gradient(135deg, var(--card-color), var(--card-color) 70%, #ffffff 100%);
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        border-left: 5px solid var(--text-color); /* Thêm viền màu nổi bật */
    }

    .card-dashboard:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .card-dashboard .card-title {
        color: #333;
        font-size: 0.9rem;
    }

    /* Đảm bảo các section nhảy đúng khi click anchor link */
    section {
        scroll-margin-top: 100px; /* để anchor #id nhảy đúng chỗ */
    }

    /* Màu sắc cá nhân hóa cho văn bản */
    .text-purple { color: #9b59b6; }
    .fw-bolder { font-weight: 800; }
</style>