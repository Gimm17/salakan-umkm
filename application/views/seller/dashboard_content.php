<!-- Custom Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    /* Admin Dashboard Specific Styles - to match public theme */
    :root {
        --primary: #E27D60;
        --secondary: #85B66F;
        --accent: #E8A87C;
        --text-dark: #3e2723;
        --bg-ivory: #FDFBF7;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-ivory);
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        background: #fff;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(62, 39, 35, 0.1);
    }

    .stat-card-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }

    .icon-primary { background: rgba(226, 125, 96, 0.1); color: var(--primary); }
    .icon-secondary { background: rgba(133, 182, 111, 0.1); color: var(--secondary); }
    .icon-accent { background: rgba(232, 168, 124, 0.1); color: var(--accent); }
    .icon-info { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }

    /* Info Alert */
    .alert-welcome {
        background-color: #fff;
        border-left: 4px solid var(--primary);
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
</style>

<!-- Judul Halaman -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark fw-bold mb-0">Dashboard Penjual</h3>
</div>

<!-- Welcome Message -->
<div class="alert alert-welcome d-flex align-items-center mb-4 p-3 border-0">
    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: rgba(226, 125, 96, 0.1); flex-shrink: 0;">
        <i class="fas fa-store" style="color: var(--primary);"></i>
    </div>
    <div>
        <h6 class="fw-bold mb-0 text-dark">Selamat Datang, <?php echo htmlspecialchars($this->session->userdata('nama')); ?>!</h6>
        <p class="mb-0 text-muted small">Ini adalah pusat kendali untuk toko Anda. Pantau penjualan, kelola produk, dan balas ulasan pelanggan.</p>
    </div>
</div>

<!-- Stat Cards Baru -->
<div class="row g-4 mb-4">
    <!-- Card Total Pendapatan -->
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="text-sm mb-1 text-muted fw-medium">Total Pendapatan</p>
                        <h4 class="fw-bold mb-0 text-dark">Rp <?php echo number_format($total_revenue ?? 0, 0, ',', '.'); ?></h4>
                    </div>
                    <div class="stat-card-icon icon-primary shadow-sm">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Pesanan -->
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="text-sm mb-1 text-muted fw-medium">Pesanan Selesai</p>
                        <h4 class="fw-bold mb-0 text-dark"><?php echo number_format($total_orders ?? 0, 0, ',', '.'); ?></h4>
                    </div>
                    <div class="stat-card-icon icon-secondary shadow-sm">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Produk -->
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="text-sm mb-1 text-muted fw-medium">Total Produk</p>
                        <h4 class="fw-bold mb-0 text-dark"><?php echo number_format($total_produk ?? 0, 0, ',', '.'); ?></h4>
                    </div>
                    <div class="stat-card-icon icon-accent shadow-sm">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>
                <a href="<?php echo site_url('seller/produk'); ?>" class="text-primary text-sm font-weight-bold text-decoration-none d-inline-flex align-items-center">
                    Kelola Produk <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Ulasan Produk -->
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <p class="text-sm mb-1 text-muted fw-medium">Ulasan Produk</p>
                        <h4 class="fw-bold mb-0 text-dark">
                            <?php echo number_format($total_ulasan_produk ?? 0, 0, ',', '.'); ?>
                        </h4>
                    </div>
                    <div class="stat-card-icon icon-info shadow-sm">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
                <a href="<?php echo site_url('seller/ulasan'); ?>" class="text-primary text-sm font-weight-bold text-decoration-none d-inline-flex align-items-center">
                    Lihat Ulasan <i class="fas fa-arrow-right text-xs ms-1"></i>
                    <?php if(isset($pending_count) && $pending_count > 0): ?>
                        <span class="badge bg-warning rounded-pill ms-2"><?php echo $pending_count; ?> baru</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart Column -->
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-header border-0 bg-white pt-4 px-4 pb-0 d-flex justify-content-between align-items-center" style="border-radius: 1rem 1rem 0 0;">
                <div>
                    <h6 class="fw-bold mb-0 pe-2" style="color: var(--text-dark);">
                        <i class="fas fa-chart-line me-2" style="color: var(--primary);"></i>Grafik Penjualan Toko Anda
                    </h6>
                    <small class="text-muted" id="chartSubtitle">6 Bulan Terakhir</small>
                </div>
                
                <style>
                    .range-btn {
                        border: 1px solid var(--medium-gray);
                        background: white;
                        color: var(--text-dark);
                        font-size: 0.8rem;
                        padding: 0.3rem 0.6rem;
                        border-radius: 0.5rem;
                        transition: all 0.2s;
                    }
                    .range-btn:hover {
                        background: var(--light-gray);
                        border-color: #ccc;
                    }
                    .range-btn.active {
                        background: var(--primary);
                        color: white;
                        border-color: var(--primary);
                    }
                    .custom-range-container { position: relative; }
                    .custom-range-dropdown {
                        position: absolute;
                        top: 100%;
                        right: 0;
                        margin-top: 0.5rem;
                        background: white;
                        border-radius: 0.5rem;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                        padding: 1rem;
                        z-index: 10;
                        min-width: 250px;
                        display: none;
                        border: 1px solid var(--medium-gray);
                    }
                    .custom-range-dropdown.show { display: block; }
                </style>

                <div class="d-flex gap-2 position-relative" id="chartOptions">
                    <button class="range-btn" data-range="7d">7H</button>
                    <button class="range-btn" data-range="30d">30H</button>
                    <button class="range-btn active" data-range="6m">6B</button>
                    <button class="range-btn" data-range="year">Thn Ini</button>
                    
                    <div class="custom-range-container">
                        <button class="range-btn px-2" id="btnCustom" title="Custom"><i class="fas fa-calendar-alt"></i></button>
                        
                        <div class="custom-range-dropdown" id="customDropdown">
                            <h6 class="fs-6 fw-bold mb-3 border-bottom pb-2">Pilih Range Waktu</h6>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted mb-1 d-block">Bulan Spesifik</label>
                                <div class="d-flex gap-2">
                                    <input type="month" class="form-control form-control-sm" id="customMonthInput" max="<?php echo date('Y-m'); ?>">
                                    <button class="btn btn-sm btn-primary" id="btnApplyMonth" style="background:var(--primary);border:none;"><i class="fas fa-check"></i></button>
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label small fw-semibold text-muted mb-1 d-block">Tahun Spesifik</label>
                                <div class="d-flex gap-2">
                                    <select class="form-select form-select-sm" id="customYearSelect">
                                        <?php 
                                        $y = (int)date('Y');
                                        for($i=0; $i<5; $i++){
                                            echo "<option value='".($y-$i)."'>".($y-$i)."</option>";
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-sm btn-primary" id="btnApplyYear" style="background:var(--primary);border:none;"><i class="fas fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4 position-relative">
                <div id="chartLoader" class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.8); z-index: 5; display: none !important;">
                    <div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                
                <div style="height: 300px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
            <div class="card-header border-0 bg-white pt-4 px-4 pb-0" style="border-radius: 1rem 1rem 0 0;">
                <h6 class="fw-bold mb-0" style="color: var(--text-dark);">
                    <i class="fas fa-history me-2" style="color: var(--secondary);"></i>Pesanan Terbaru
                </h6>
                <small class="text-muted">5 pesanan terakhir di toko Anda</small>
            </div>
            <div class="card-body p-4">
                <?php if (empty($recent_orders)): ?>
                    <div class="d-flex flex-column align-items-center justify-content-center py-4 text-muted text-center h-100">
                        <i class="fas fa-receipt fa-3x mb-3 opacity-25"></i>
                        <p class="mb-0">Belum ada pesanan yang masuk</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                <?php foreach ($recent_orders as $order): ?>
                                <tr>
                                    <td class="border-0 px-0 py-3">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-semibold text-dark" style="font-size: 0.9rem;"><?php echo htmlspecialchars($order['buyer_name'] ?? 'Guest'); ?></span>
                                                <span class="fw-bold" style="color: var(--primary); font-size: 0.9rem;">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <code class="bg-light px-2 py-1 rounded text-muted" style="font-size: 0.75rem;">
                                                    <?php echo substr(htmlspecialchars($order['order_id']), 0, 10); ?>...
                                                </code>
                                                <?php
                                                $status_map = [
                                                    'paid'     => ['bg' => 'rgba(133,182,111,0.15)', 'color' => '#5e8f4a', 'text' => 'Berhasil'],
                                                    'pending'  => ['bg' => 'rgba(255,209,102,0.2)',  'color' => '#dba934', 'text' => 'Menunggu'],
                                                    'failed'   => ['bg' => 'rgba(226,125,96,0.15)',  'color' => '#c75e3e', 'text' => 'Gagal'],
                                                    'canceled' => ['bg' => 'rgba(158,158,158,0.15)', 'color' => '#666',    'text' => 'Batal'],
                                                ];
                                                $s = $status_map[$order['status']] ?? ['bg' => '#eee', 'color' => '#555', 'text' => ucfirst($order['status'])];
                                                ?>
                                                <span class="px-2 py-1 rounded fw-semibold" style="font-size: 0.7rem; background: <?php echo $s['bg']; ?>; color: <?php echo $s['color']; ?>;">
                                                    <?php echo $s['text']; ?>
                                                </span>
                                            </div>
                                            <small class="text-muted mt-1" style="font-size: 0.75rem;"><?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?></small>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js & AJAX Toggle Logic -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
<?php if (!empty($monthly_chart)): ?>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    let chartInstance = null;

    // Inisialisasi Chart
    function initChart(labels, pendapatan, orders) {
        if (chartInstance) { chartInstance.destroy(); }
        
        chartInstance = new Chart(ctx, {
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
                        label: 'Jumlah Pesanan',
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
                        labels: { usePointStyle: true, pointStyle: 'circle', font: { family: 'Inter', size: 12 } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (context.dataset.yAxisID === 'y') {
                                    return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                                return ' ' + context.parsed.y + ' Pesanan';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 11 } }
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
    }

    // Load Data via AJAX
    function fetchChartData(params) {
        document.getElementById('chartLoader').style.setProperty('display', 'flex', 'important');
        
        let url = '<?php echo site_url('seller/chart_data'); ?>?' + new URLSearchParams(params).toString();
        
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => response.json())
        .then(data => {
            initChart(data.labels, data.pendapatan, data.orders);
            document.getElementById('chartSubtitle').innerText = data.label_title;
        })
        .catch(err => console.error('Error fetching chart data:', err))
        .finally(() => {
            document.getElementById('chartLoader').style.setProperty('display', 'none', 'important');
        });
    }

    // Event Listeners for Buttons
    const rangeBtns = document.querySelectorAll('.range-btn[data-range]');
    const customDropdown = document.getElementById('customDropdown');
    const btnCustom = document.getElementById('btnCustom');

    // Quick range buttons
    rangeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            rangeBtns.forEach(b => b.classList.remove('active'));
            btnCustom.classList.remove('active');
            customDropdown.classList.remove('show');
            this.classList.add('active');
            
            fetchChartData({ range: this.dataset.range });
        });
    });

    // Custom dropdown toggle
    btnCustom.addEventListener('click', function(e) {
        e.stopPropagation();
        customDropdown.classList.toggle('show');
    });

    // Close dropdown on outside click
    document.addEventListener('click', function(e) {
        if (!customDropdown.contains(e.target) && e.target !== btnCustom) {
            customDropdown.classList.remove('show');
        }
    });

    // Apply Custom Month
    document.getElementById('btnApplyMonth').addEventListener('click', function() {
        const val = document.getElementById('customMonthInput').value;
        if(val) {
            rangeBtns.forEach(b => b.classList.remove('active'));
            btnCustom.classList.add('active');
            customDropdown.classList.remove('show');
            fetchChartData({ range: 'custom_month', month: val });
        }
    });

    // Apply Custom Year
    document.getElementById('btnApplyYear').addEventListener('click', function() {
        const val = document.getElementById('customYearSelect').value;
        if(val) {
            rangeBtns.forEach(b => b.classList.remove('active'));
            btnCustom.classList.add('active');
            customDropdown.classList.remove('show');
            fetchChartData({ range: 'custom_year', year: val });
        }
    });

    // Inisialisasi awal (Default: 6m PHP data pass, atau trigger AJAX fetch jika lebih fleksibel)
    // Di sini kita trigger fetch awal untuk menyergankan dengan labelnya.
    fetchChartData({ range: '6m' });
});
<?php endif; ?>
</script>
