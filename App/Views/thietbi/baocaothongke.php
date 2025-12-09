<!-- App/Views/hieutruong/dashboard/dashboard.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cBaoCaoThongKe.php');
$p = new controlDashboard();
$data = $p->getDashboardData();
?>

<div class="container my-4">
    <h3 class="text-center mb-4 fw-bold text-primary">Dashboard Tổng quan</h3>

    <!-- Cards tổng quan -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h5 class="card-title">Tổng thiết bị</h5>
                    <h1 class="card-text text-primary"><?= $data['totalThietBi'] ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h5 class="card-title">Khả dụng</h5>
                    <h1 class="card-text text-success"><?= $data['tinhTrang']['Khả dụng'] ?? 0 ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h5 class="card-title">Đang mượn</h5>
                    <h1 class="card-text text-warning"><?= $data['tinhTrang']['Đang mượn'] ?? 0 ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h5 class="card-title">Báo hỏng/Thanh lý</h5>
                    <h1 class="card-text text-danger"><?= ($data['tinhTrang']['Báo hỏng'] ?? 0) + ($data['tinhTrang']['Thanh lý'] ?? 0) ?></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="row mb-4">
        <!-- Biểu đồ tròn tình trạng thiết bị -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Tình trạng thiết bị</div>
                <div class="card-body">
                    <canvas id="tinhTrangChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Biểu đồ cột theo bộ môn -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">Thiết bị theo bộ môn</div>
                <div class="card-body">
                    <canvas id="boMonChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm vào sau 2 biểu đồ cũ, trong <div class="row mb-4"> -->

<!-- Biểu đồ thiết bị theo nhà cung cấp -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-indigo text-white">
            <i class="bi bi-building"></i> Thiết bị theo Nhà cung cấp
        </div>
        <div class="card-body">
            <canvas id="nhaCungCapChart"></canvas>
        </div>
    </div>
</div>

<!-- Biểu đồ thiết bị đang sửa chữa / bảo trì / bảo hành -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-orange text-white">
            <i class="bi bi-tools"></i> Thiết bị đang sửa chữa / bảo trì
        </div>
        <div class="card-body">
            <canvas id="suaChuaChart"></canvas>
        </div>
    </div>
</div>

    <!-- Kế hoạch mua sắm -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">Thống kê kế hoạch mua sắm</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Trạng thái</th>
                                <th>Số kế hoạch</th>
                                <th>Tổng chi phí</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['muaSamStats'] as $trangThai => $stats): ?>
                            <tr>
                                <td><?= $trangThai ?></td>
                                <td><?= $stats['count'] ?></td>
                                <td><?= number_format($stats['totalCost'], 0, ',', '.') ?> ₫</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Thiết bị hỏng -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">Thiết bị hỏng/Thanh lý</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($data['thietBiHong'] as $item): ?>
                        <li class="list-group-item"><?= $item['tenThietBi'] ?> (<?= $item['count'] ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Đang mượn -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">Thiết bị đang mượn</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($data['dangMuon'] as $item): ?>
                        <li class="list-group-item"><?= $item['hoTen'] ?> (<?= $item['count'] ?> phiếu)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Biểu đồ tròn tình trạng
const tinhTrangCtx = document.getElementById('tinhTrangChart').getContext('2d');
new Chart(tinhTrangCtx, {
    type: 'pie',
    data: {
        labels: <?= json_encode(array_keys($data['tinhTrang'])) ?>,
        datasets: [{
            data: <?= json_encode(array_values($data['tinhTrang'])) ?>,
            backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#6c757d']
        }]
    },
    options: { responsive: true }
});

// Biểu đồ cột theo bộ môn
const boMonCtx = document.getElementById('boMonChart').getContext('2d');
new Chart(boMonCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($data['byBoMon'], 'tenBoMon')) ?>,
        datasets: [{
            label: 'Số lượng',
            data: <?= json_encode(array_column($data['byBoMon'], 'count')) ?>,
            backgroundColor: '#17a2b8'
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});
</script>







<style>
    .bg-indigo { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .bg-orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
</style>

<script>
// Biểu đồ theo Nhà cung cấp (cột ngang)
const nccCtx = document.getElementById('nhaCungCapChart').getContext('2d');
new Chart(nccCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($data['byNhaCungCap'], 'tenNhaCungCap')) ?>,
        datasets: [{
            label: 'Số lượng thiết bị',
            data: <?= json_encode(array_column($data['byNhaCungCap'], 'count')) ?>,
            backgroundColor: 'rgba(102, 126, 234, 0.8)',
            borderColor: '#667eea',
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

// Biểu đồ thiết bị đang sửa chữa
const scCtx = document.getElementById('suaChuaChart').getContext('2d');
new Chart(scCtx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode(array_keys($data['dangSuaChua'])) ?>,
        datasets: [{
            data: <?= json_encode(array_values($data['dangSuaChua'])) ?>,
            backgroundColor: [
                '#ff6b6b', '#feca57', '#48dbfb', '#ff9ff3', '#54a0ff'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: { callbacks: { label: ctx => `${ctx.label}: ${ctx.raw} thiết bị` } }
        }
    }
});
</script>


















<!-- App/Views/thietbi/qlthietbi/baocaothietbi.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cThietBi.php');
$p = new controlThietBi();

// Lấy danh sách thiết bị từ DB
$thietBiList = $p->getAllThietBi();

// Tính tổng theo bộ môn
$thongKeBoMon = [];
$tongSoLuong = 0;

if($thietBiList && $thietBiList->num_rows > 0) {
    while($tb = $thietBiList->fetch_assoc()) {
        $boMon = $tb['tenBoMon'] ?? 'Chưa phân loại';
        $soLuong = (int)$tb['soLuong'];
        $tongSoLuong += $soLuong;
        if(isset($thongKeBoMon[$boMon])) {
            $thongKeBoMon[$boMon] += $soLuong;
        } else {
            $thongKeBoMon[$boMon] = $soLuong;
        }
    }
}
?>

<div class="container mt-4">
    <h3 class="text-center mb-4 fw-bold text-primary">Báo cáo thống kê thiết bị theo bộ môn</h3>

    <div class="row mb-4">
        <!-- Bảng thống kê -->
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Bộ môn</th>
                            <th>Số lượng thiết bị</th>
                            <th>Tỷ lệ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($thongKeBoMon)) {
                            $i = 1;
                            foreach($thongKeBoMon as $bm => $qty) {
                                $tyLe = $tongSoLuong > 0 ? round($qty / $tongSoLuong * 100, 1) : 0;
                                echo '<tr>';
                                echo '<td><strong>'.$i++.'</strong></td>';
                                echo '<td>'.$bm.'</td>';
                                echo '<td>'.$qty.'</td>';
                                echo '<td><span class="badge bg-info">'.$tyLe.'%</span></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-muted">Chưa có dữ liệu</td></tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary fw-bold">
                            <td colspan="2">Tổng</td>
                            <td><?= $tongSoLuong ?></td>
                            <td>100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Biểu đồ -->
        <div class="col-md-6">
            <canvas id="chartBoMon" style="max-height:400px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartBoMon').getContext('2d');
const chartBoMon = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?= json_encode(array_keys($thongKeBoMon)) ?>,
        datasets: [{
            label: 'Số lượng thiết bị',
            data: <?= json_encode(array_values($thongKeBoMon)) ?>,
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        let value = context.parsed || 0;
                        let total = context.chart._metasets[context.datasetIndex].total;
                        let percent = total > 0 ? (value / total * 100).toFixed(1) : 0;
                        return label + ': ' + value + ' (' + percent + '%)';
                    }
                }
            }
        }
    }
});
</script>

<style>
    table th, table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
