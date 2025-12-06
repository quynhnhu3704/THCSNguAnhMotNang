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
