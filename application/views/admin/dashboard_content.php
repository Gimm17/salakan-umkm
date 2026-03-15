<?php
// Prepare monthly chart data for Chart.js
$chart_labels = [];
$chart_pendapatan = [];
$chart_orders = [];
if (!empty($monthly_chart)) {
    foreach ($monthly_chart as $row) {
        $chart_labels[] = $row['label'];
        $chart_pendapatan[] = (int) $row['pendapatan'];
        $chart_orders[] = (int) $row['jumlah_order'];
    }
}
?>

<!-- Modern Stats Cards with Theme Colors -->
<div class="row g-3 mb-4">
    <!-- Card Total Pengguna -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_pengguna'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-users fa-4x" style="color: var(--primary);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(226, 125, 96, 0.1);">
                            <i class="fas fa-users fs-5" style="color: var(--primary);"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total Pengguna</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $total_user; ?></h2>
                        <span class="badge" style="background-color: var(--primary); font-weight: 500;">Akun Terdaftar</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Total Toko -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_toko'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-store fa-4x" style="color: var(--secondary);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(133, 182, 111, 0.1);">
                            <i class="fas fa-store fs-5" style="color: var(--secondary);"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total UMKM</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $total_toko; ?></h2>
                        <span class="badge" style="background-color: var(--secondary); font-weight: 500;">Toko Aktif</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Toko Menunggu -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_toko?filter=menunggu'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-clock fa-4x" style="color: var(--accent);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(255, 209, 102, 0.2);">
                            <i class="fas fa-clock fs-5" style="color: #dba934;"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Persetujuan</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $toko_menunggu; ?></h2>
                        <span class="badge text-dark" style="background-color: var(--accent); font-weight: 500;">Menunggu Review</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- ===== ANALYTICS SECTION ===== -->
<!-- Revenue Stats Row -->
<div class="row g-3 mb-4">
    <!-- Total Pendapatan -->
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background: linear-gradient(135deg, var(--primary) 0%, #c75e3e 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 fw-semibold opacity-75" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            <i class="fas fa-chart-line me-2"></i>Total Pendapatan Platform
                        </p>
                        <h2 class="fw-bolder mb-0" style="font-size: 2rem;">
                            Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?>
                        </h2>
                        <p class="mb-0 opacity-75 mt-1" style="font-size: 0.8rem;">Dari semua transaksi berhasil</p>
                    </div>
                    <div class="opacity-25">
                        <i class="fas fa-money-bill-wave" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Transaksi Sukses -->
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background: linear-gradient(135deg, var(--secondary) 0%, #5e8f4a 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 fw-semibold opacity-75" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            <i class="fas fa-check-circle me-2"></i>Total Transaksi Berhasil
                        </p>
                        <h2 class="fw-bolder mb-0" style="font-size: 2rem;">
                            <?php echo number_format($total_orders_paid, 0, ',', '.'); ?> Order
                        </h2>
                        <p class="mb-0 opacity-75 mt-1" style="font-size: 0.8rem;">Status pembayaran: paid</p>
                    </div>
                    <div class="opacity-25">
                        <i class="fas fa-receipt" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart & Top Toko Row -->
<div class="row g-3 mb-4">
    <!-- Monthly Revenue Chart -->
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-header border-0 bg-white pt-4 px-4 pb-0" style="border-radius: 1rem 1rem 0 0;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-bold mb-0" style="color: var(--text-dark);">
                            <i class="fas fa-chart-bar me-2" style="color: var(--primary);"></i>Pendapatan Bulanan
                        </h6>
                        <small class="text-muted">Transaksi berhasil 6 bulan terakhir</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <?php if (empty($monthly_chart)): ?>
                    <div class="d-flex flex-column align-items-center justify-content-center py-5 text-muted">
                        <i class="fas fa-chart-bar fa-3x mb-3 opacity-25"></i>
                        <p class="mb-0">Belum ada data transaksi berhasil</p>
                    </div>
                <?php else: ?>
                    <canvas id="revenueChart" height="280"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Top Toko -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-header border-0 bg-white pt-4 px-4 pb-0" style="border-radius: 1rem 1rem 0 0;">
                <h6 class="fw-bold mb-0" style="color: var(--text-dark);">
                    <i class="fas fa-trophy me-2" style="color: var(--accent);"></i>Top Toko
                </h6>
                <small class="text-muted">Berdasarkan total pendapatan</small>
            </div>
            <div class="card-body p-4">
                <?php if (empty($top_toko)): ?>
                    <div class="d-flex flex-column align-items-center justify-content-center py-4 text-muted text-center">
                        <i class="fas fa-store fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0 small">Belum ada data penjualan</p>
                    </div>
                <?php else: ?>
                    <?php 
                    $medals = ['🥇', '🥈', '🥉', '4️⃣', '5️⃣'];
                    $max_pendapatan = $top_toko[0]['total_pendapatan'] > 0 ? $top_toko[0]['total_pendapatan'] : 1;
                    foreach ($top_toko as $idx => $toko): 
                        $pct = round(($toko['total_pendapatan'] / $max_pendapatan) * 100);
                    ?>
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex align-items-center">
                                <span class="me-2" style="font-size: 1.1rem;"><?php echo $medals[$idx]; ?></span>
                                <span class="fw-semibold" style="font-size: 0.9rem; color: var(--text-dark);"><?php echo htmlspecialchars($toko['nama_toko']); ?></span>
                            </div>
                            <small class="text-muted"><?php echo $toko['jumlah_transaksi']; ?>x</small>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px; background: rgba(226,125,96,0.1);">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $pct; ?>%; background: var(--primary); border-radius: 3px;" aria-valuenow="<?php echo $pct; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted" style="font-size: 0.8rem;">Rp <?php echo number_format($toko['total_pendapatan'], 0, ',', '.'); ?></small>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 1rem;">
    <div class="card-header border-0 bg-white pt-4 px-4 pb-0" style="border-radius: 1rem 1rem 0 0;">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="fw-bold mb-0" style="color: var(--text-dark);">
                    <i class="fas fa-history me-2" style="color: var(--secondary);"></i>Transaksi Terbaru
                </h6>
                <small class="text-muted">5 transaksi terakhir dari semua toko</small>
            </div>
        </div>
    </div>
    <div class="card-body p-4">
        <?php if (empty($recent_orders)): ?>
            <div class="d-flex flex-column align-items-center justify-content-center py-4 text-muted text-center">
                <i class="fas fa-receipt fa-3x mb-3 opacity-25"></i>
                <p class="mb-0">Belum ada transaksi yang tercatat</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--medium-gray);">
                            <th class="border-0 fw-semibold pb-2">Order ID</th>
                            <th class="border-0 fw-semibold pb-2">Pembeli</th>
                            <th class="border-0 fw-semibold pb-2">Toko</th>
                            <th class="border-0 fw-semibold pb-2">Total</th>
                            <th class="border-0 fw-semibold pb-2">Status</th>
                            <th class="border-0 fw-semibold pb-2">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr style="font-size: 0.9rem;">
                            <td class="border-0">
                                <code class="bg-light px-2 py-1 rounded" style="font-size: 0.8rem; color: var(--primary);">
                                    <?php echo substr(htmlspecialchars($order['order_id']), 0, 12); ?>...
                                </code>
                            </td>
                            <td class="border-0 fw-semibold"><?php echo htmlspecialchars($order['buyer_name'] ?? 'Guest'); ?></td>
                            <td class="border-0 text-muted"><?php echo htmlspecialchars($order['nama_toko'] ?? '-'); ?></td>
                            <td class="border-0 fw-bold" style="color: var(--primary);">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                            <td class="border-0">
                                <?php
                                $status_map = [
                                    'paid'     => ['bg' => 'rgba(133,182,111,0.15)', 'color' => '#5e8f4a', 'text' => 'Berhasil'],
                                    'pending'  => ['bg' => 'rgba(255,209,102,0.2)',  'color' => '#dba934', 'text' => 'Menunggu'],
                                    'failed'   => ['bg' => 'rgba(226,125,96,0.15)',  'color' => '#c75e3e', 'text' => 'Gagal'],
                                    'canceled' => ['bg' => 'rgba(158,158,158,0.15)', 'color' => '#666',    'text' => 'Dibatalkan'],
                                    'expired'  => ['bg' => 'rgba(158,158,158,0.15)', 'color' => '#666',    'text' => 'Kadaluarsa'],
                                    'refunded' => ['bg' => 'rgba(79,172,254,0.15)',  'color' => '#2980b9', 'text' => 'Refund'],
                                ];
                                $s = $status_map[$order['status']] ?? ['bg' => '#eee', 'color' => '#555', 'text' => ucfirst($order['status'])];
                                ?>
                                <span class="px-2 py-1 rounded-pill fw-semibold" style="font-size: 0.78rem; background: <?php echo $s['bg']; ?>; color: <?php echo $s['color']; ?>;">
                                    <?php echo $s['text']; ?>
                                </span>
                            </td>
                            <td class="border-0 text-muted" style="font-size: 0.85rem;">
                                <?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Welcome Card -->
<div class="card border-0 shadow-sm" style="border-radius: 1rem;">
    <div class="card-body px-4 py-3 d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: rgba(226, 125, 96, 0.1);">
            <i class="fas fa-info-circle" style="color: var(--primary);"></i>
        </div>
        <div>
            <span class="fw-bold" style="color: var(--text-dark);">Selamat Datang, Admin!</span>
            <span class="text-muted ms-2 small">Kelola pengguna, setujui toko baru, dan pantau penjualan keseluruhan platform melalui menu navigasi.</span>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
<?php if (!empty($monthly_chart)): ?>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');

    const labels = <?php echo json_encode($chart_labels); ?>;
    const pendapatan = <?php echo json_encode($chart_pendapatan); ?>;
    const orders = <?php echo json_encode($chart_orders); ?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan (Rp)',
                    data: pendapatan,
                    backgroundColor: 'rgba(226, 125, 96, 0.8)',
                    borderColor: '#E27D60',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    yAxisID: 'y',
                },
                {
                    label: 'Jumlah Order',
                    data: orders,
                    type: 'line',
                    borderColor: '#85B66F',
                    backgroundColor: 'rgba(133, 182, 111, 0.15)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#85B66F',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { family: 'Inter', size: 12 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            if (context.dataset.yAxisID === 'y') {
                                return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                            return ' ' + context.parsed.y + ' Order';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 12 } }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: {
                        font: { family: 'Inter', size: 11 },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + 'jt';
                            if (value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + 'rb';
                            return 'Rp ' + value;
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: {
                        font: { family: 'Inter', size: 11 },
                        stepSize: 1
                    }
                }
            }
        }
    });
});
<?php endif; ?>
</script>

<style>
.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(62, 39, 35, 0.1) !important;
}
</style>
