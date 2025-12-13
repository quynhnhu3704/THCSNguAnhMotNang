<!-- App/Views/hieutruong/baocaothongke.php -->
<?php
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cBaoCaoThongKe.php');
$p = new controlBaoCaoThongKe();
$kq = $p->getAllThongKe();

$trangThaiKeHoach = ['Chờ duyệt', 'Chấp thuận', 'Từ chối'];
$chartMuaSamSo = [];
$chartMuaSamChiPhi = []; 
$tongChiPhiMuaSam = 0;

// Tính tổng chi phí mua sắm
$sumChiPhi = 0;
foreach ($kq['keHoachMuaSam'] as $row) {
    $sumChiPhi += (float)$row['tongChiPhi'];
}

// Tính tổng thu nhập từ thanh lý
$sumGiaTri = 0;
foreach ($kq['keHoachThanhLy'] as $row) {
    $sumGiaTri += (float)$row['tongGiaTri'];
}

// Tổng giá trị = chi phí - thu nhập
$kq['tongChiPhi'] = $sumChiPhi;
$kq['tongThuNhap'] = $sumGiaTri;
$kq['tongGiaTri'] = $sumChiPhi - $sumGiaTri;


foreach ($trangThaiKeHoach as $tt) {
    $found = false;
    foreach ($kq['keHoachMuaSam'] as $r) {
        if ($r['trangThai'] == $tt) {
            $chartMuaSamSo[] = $r['soKeHoach'];
            $chartMuaSamChiPhi[] = round($r['tongChiPhi'] / 1000000, 2);
            $tongChiPhiMuaSam += $r['tongChiPhi'];
            $found = true; break;
        }
    }
    if (!$found) { $chartMuaSamSo[] = 0; $chartMuaSamChiPhi[] = 0; }
}

$chartThanhLySo = []; $chartThanhLyGiaTri = []; $tongGiaTriThanhLy = 0;
foreach ($trangThaiKeHoach as $tt) {
    $found = false;
    foreach ($kq['keHoachThanhLy'] as $r) {
        if ($r['trangThai'] == $tt) {
            $chartThanhLySo[] = $r['soKeHoach'];
            $chartThanhLyGiaTri[] = round($r['tongGiaTri'] / 1000000, 2);
            $tongGiaTriThanhLy += $r['tongGiaTri'];
            $found = true; break;
        }
    }
    if (!$found) { $chartThanhLySo[] = 0; $chartThanhLyGiaTri[] = 0; }
}
?>

<div class="dashboard-container my-4">
    <div class="container-fluid px-4">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-dark mb-0">Báo Cáo Thống Kê</h2>
                <p class="text-muted mb-0">Tổng hợp dữ liệu quản lý thiết bị</p>
            </div>
            <div class="d-flex gap-2">
                 <button class="btn btn-outline-secondary" onclick="window.print()"><i class="bi bi-printer"></i> In báo cáo</button>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle text-primary">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <span class="badge bg-light text-muted">Tổng</span>
                        </div>
                        <h3 class="fw-bold mb-1"><?= number_format($kq['tongThietBi']) ?></h3>
                        <p class="text-muted small mb-0">Thiết bị</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-success-subtle text-success">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success">Tốt</span>
                        </div>
                        <h3 class="fw-bold mb-1"><?= number_format($kq['tinhTrang']['Khả dụng'] ?? 0) ?></h3>
                        <p class="text-muted small mb-0">Khả dụng</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-warning-subtle text-warning">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1"><?= number_format($kq['tinhTrang']['Đang mượn'] ?? 0) ?></h3>
                        <p class="text-muted small mb-0">Đang mượn</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-danger-subtle text-danger">
                                <i class="bi bi-tools"></i>
                            </div>
                            <span class="badge bg-danger-subtle text-danger">Cần xử lý</span>
                        </div>
                        <h3 class="fw-bold mb-1"><?= number_format($kq['tinhTrang']['Báo hỏng'] ?? 0) ?></h3>
                        <p class="text-muted small mb-0">Báo hỏng</p>
                    </div>
                </div>
            </div>

             <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-secondary-subtle text-secondary">
                                <i class="bi bi-archive"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1"><?= number_format($kq['tinhTrang']['Thanh lý'] ?? 0) ?></h3>
                        <p class="text-muted small mb-0">Thanh lý</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card stat-card h-100 border-0 shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="icon-box bg-white text-primary">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-1 text-truncate" title="<?= number_format($kq['tongGiaTri']) ?>">
                            <?= number_format($kq['tongGiaTri']) ?> Tr
                        </h5>
                        <p class="text-white-50 small mb-0">Tổng giá trị</p>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills nav-fill bg-white shadow-sm p-2 rounded-pill mb-5" id="reportNav">
            <li class="nav-item"><a class="nav-link rounded-pill" href="#bomon">Bộ môn</a></li>
            <li class="nav-item"><a class="nav-link rounded-pill" href="#suachua">Sửa chữa</a></li>
            <li class="nav-item"><a class="nav-link rounded-pill" href="#nhacungcap">Nhà cung cấp</a></li>
            <li class="nav-item"><a class="nav-link rounded-pill" href="#kehoachmuasam">Mua sắm</a></li>
            <li class="nav-item"><a class="nav-link rounded-pill" href="#kehoachthanhly">Thanh lý</a></li>
        </ul>

        <div class="row g-4 mb-5">
            <div class="col-lg-6" id="bomon">
                <div class="card border-0 shadow-sm h-100 section-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between">
                        <h5 class="fw-bold text-dark">Thiết bị theo Bộ môn</h5>
                        <i class="bi bi-grid-fill text-muted"></i>
                    </div>
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="chart-container" style="position: relative; height:200px; width:100%">
                                    <canvas id="chartBoMon"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive mt-3 mt-md-0" style="max-height: 250px; overflow-y: auto;">
                                    <table class="table table-borderless table-hover align-middle small">
                                        <thead class="text-muted border-bottom">
                                            <tr><th>Bộ môn</th><th class="text-end">SL</th><th class="text-end">%</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $tongBoMon = array_sum(array_column($kq['byBoMon'], 'count'));
                                            foreach($kq['byBoMon'] as $r): 
                                                $tyle = $tongBoMon > 0 ? round($r['count']/$tongBoMon*100, 1) : 0;
                                            ?>
                                            <tr>
                                                <td><span class="d-inline-block rounded-circle me-2" style="width:8px;height:8px;background-color:#4361ee"></span><?= $r['tenBoMon'] ?></td>
                                                <td class="text-end fw-bold"><?= number_format($r['count']) ?></td>
                                                <td class="text-end text-muted"><?= $tyle ?>%</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" id="suachua">
                <div class="card border-0 shadow-sm h-100 section-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between">
                        <h5 class="fw-bold text-dark">Tình trạng sửa chữa/bảo trì/bảo hành</h5>
                        <i class="bi bi-wrench text-muted"></i>
                    </div>
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="chart-container" style="position: relative; height:200px; width:100%">
                                    <canvas id="chartSuaChua"></canvas>
                                </div>
                            </div>
                            <div class="col-md-7">
                                 <div class="table-responsive mt-3 mt-md-0">
                                    <table class="table table-borderless table-hover align-middle small">
                                        <thead class="text-muted border-bottom">
                                            <tr><th>Loại</th><th class="text-end">SL</th><th class="text-end">Trạng thái</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $colorsStatus = ['Sửa chữa'=>'danger', 'Bảo trì'=>'warning', 'Bảo hành'=>'info'];
                                            foreach (['Sửa chữa', 'Bảo trì', 'Bảo hành'] as $lbl): 
                                                $sl = $kq['dangSuaChua'][$lbl] ?? 0;
                                                $cl = $colorsStatus[$lbl];
                                            ?>
                                            <tr>
                                                <td class="fw-medium"><?= $lbl ?></td>
                                                <td class="text-end fw-bold"><?= number_format($sl) ?></td>
                                                <td class="text-end"><span class="badge bg-<?= $cl ?>-subtle text-<?= $cl ?> rounded-pill">Đang xử lý</span></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5 section-card" id="nhacungcap">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark">Top Nhà Cung Cấp</h5>
            </div>
            <div class="card-body px-4">
                <div style="height: 300px;">
                    <canvas id="chartNhaCungCap"></canvas>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6" id="kehoachmuasam">
                <div class="card border-0 shadow-sm h-100 section-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold text-success"><i class="bi bi-cart-plus me-2"></i>Kế hoạch Mua sắm</h5>
                    </div>
                    <div class="card-body px-4">
                        <div style="height: 250px;">
                            <canvas id="chartKeHoachMuaSam"></canvas>
                        </div>
                        <div class="mt-3 d-flex justify-content-between border-top pt-3">
                            <span class="text-muted">Tổng chi phí dự kiến:</span>
                            <span class="fw-bold text-success fs-5"><?= number_format($tongChiPhiMuaSam) ?> VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" id="kehoachthanhly">
                <div class="card border-0 shadow-sm h-100 section-card">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold text-danger"><i class="bi bi-recycle me-2"></i>Kế hoạch Thanh lý</h5>
                    </div>
                    <div class="card-body px-4">
                        <div style="height: 250px;">
                            <canvas id="chartKeHoachThanhLy"></canvas>
                        </div>
                        <div class="mt-3 d-flex justify-content-between border-top pt-3">
                            <span class="text-muted">Tổng giá trị thu hồi:</span>
                            <span class="fw-bold text-danger fs-5"><?= number_format($tongGiaTriThanhLy) ?> VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mb-5 section-card bg-dark text-white" style="background: linear-gradient(45deg, #1e1e2f, #2a2a40);">
            <div class="card-body px-4 py-5 text-center">
                 <h4 class="fw-bold mb-4">🏆 Top 10 Thiết Bị Được Mượn Nhiều Nhất</h4>
                 <div style="height: 300px;">
                    <canvas id="chartTopMuon"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    body {
        background-color: #f3f4f6; /* Nền xám nhạt hiện đại */
        color: #344767;
    }
    
    .stat-card {
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .section-card {
        border-radius: 16px;
        background: #fff;
    }

    .nav-pills .nav-link {
        color: #6c7a89;
        font-weight: 500;
    }
    
    .nav-pills .nav-link.active, .nav-pills .nav-link:hover {
        color: white !important;
        background-color: var(--na-primary) !important;
    }

    .table-responsive::-webkit-scrollbar {
        width: 6px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #ccc; 
        border-radius: 4px;
    }
</style>

<script>
    Chart.register(ChartDataLabels);

    // Bảng màu chuẩn "Modern Dashboard" (Không Pastel, độ tương phản cao)
    const themeColors = {
        primary: '#4361ee',   // Royal Blue
        secondary: '#3f37c9', // Darker Blue
        success: '#2ec4b6',   // Teal/Emerald
        info: '#4cc9f0',      // Sky Blue
        warning: '#f72585',   // Pinkish Red (Nổi bật) - hoặc dùng #ff9f1c (Orange)
        danger: '#e63946',    // Standard Red
        dark: '#2b2d42',
        light: '#f8f9fa',
        // Mảng màu phối hợp cho biểu đồ tròn
        palette: [
            '#4361ee', '#3a0ca3', '#7209b7', '#f72585', '#4cc9f0', 
            '#2ec4b6', '#ffd166', '#ef476f', '#118ab2', '#06d6a0'
        ]
    };

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }, // Tắt legend mặc định cho gọn, dùng HTML custom nếu cần
            datalabels: { display: false } // Tắt mặc định, bật cho chart cụ thể
        }
    };

    // Set font toàn cục cho Chart.js
    Chart.defaults.font.family = "'Quicksand', Arial, sans-serif";
    Chart.defaults.color = themeColors.text;

    // 1. Chart Bộ Môn (Doughnut - Clean)
    new Chart(document.getElementById('chartBoMon'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($kq['byBoMon'], 'tenBoMon')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($kq['byBoMon'], 'count')) ?>,
                backgroundColor: themeColors.palette,
                borderWidth: 0,
            }]
        },
        options: {
            ...commonOptions,
            cutout: '60%', // Vòng tròn mỏng hơn
            // plugins: {
            //     datalabels: { display: false }
            // }
        }
    });

    // 2. Chart Sửa Chữa (Pie/Donut)
    new Chart(document.getElementById('chartSuaChua'), {
        type: 'doughnut',
        data: {
            labels: ['Sửa chữa', 'Bảo trì', 'Bảo hành'],
            datasets: [{
                data: <?= json_encode(array_values($kq['dangSuaChua'])) ?>,
                backgroundColor: [themeColors.danger, themeColors.warning, themeColors.info], // Đỏ, Hồng, Xanh
                borderWidth: 0
            }]
        },
        options: {
            ...commonOptions,
            cutout: '60%',
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold' },
                    formatter: (val) => val > 0 ? val : ''
                }
            }
        }
    });

    // 3. Chart Nhà Cung Cấp (Bar Horizontal)
    new Chart(document.getElementById('chartNhaCungCap'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($kq['byNhaCungCap'], 'tenNhaCungCap')) ?>,
            datasets: [{
                label: 'Số lượng',
                data: <?= json_encode(array_column($kq['byNhaCungCap'], 'count')) ?>,
                backgroundColor: themeColors.success,
                borderRadius: 4,
                barPercentage: 0.6
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, datalabels: { display: false } },
            scales: {
                y: { grid: { display: false } }
            }
        }
    });

    // 4 & 5. Chart Kế hoạch (Dual Axis)
    function createDualAxisChart(id, labels, data1, data2) {
        new Chart(document.getElementById(id), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Số lượng',
                        data: data1,
                        backgroundColor: themeColors.secondary,
                        borderRadius: 4,
                        order: 2,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Chi phí (Triệu)',
                        data: data2,
                        type: 'line', // Đường line chạy ngang cột
                        borderColor: themeColors.warning,
                        backgroundColor: themeColors.warning,
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: 0.4, // Đường cong mềm
                        order: 1,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: true, position: 'top'},
                    tooltip: { mode: 'index', intersect: false },
                    datalabels: { display: false } // Tắt data labels
                },
                scales: {
                    y: { beginAtZero: true, display: false }, // Ẩn trục Y số lượng cho đẹp
                    y1: { beginAtZero: true, position: 'right', grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    createDualAxisChart('chartKeHoachMuaSam', <?= json_encode($trangThaiKeHoach) ?>, <?= json_encode($chartMuaSamSo) ?>, <?= json_encode($chartMuaSamChiPhi) ?>);
    createDualAxisChart('chartKeHoachThanhLy', <?= json_encode($trangThaiKeHoach) ?>, <?= json_encode($chartThanhLySo) ?>, <?= json_encode($chartThanhLyGiaTri) ?>);

    // 6. Top 10 (White bars on Dark bg)
    new Chart(document.getElementById('chartTopMuon'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($kq['topMuon'], 'tenThietBi')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($kq['topMuon'], 'soLanMuon')) ?>,
                backgroundColor: '#ffffff', // Màu trắng nổi trên nền tối
                borderRadius: 4,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: { legend: { display: false }, datalabels: { display: false } },
            scales: {
                x: { ticks: { color: '#ccc' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                y: { ticks: { color: '#fff', font: {size: 11} }, grid: { display: false } }
            }
        }
    });
</script>