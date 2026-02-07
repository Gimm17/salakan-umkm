<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Penjualan</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container p-3">
<h3 class="mb-3">Laporan Penjualan per Bulan</h3>
<canvas id="salesChart"></canvas>
<script>
fetch("<?php echo site_url('report/sales_json'); ?>")
  .then(r=>r.json())
  .then(d=>{
    new Chart(document.getElementById('salesChart'), {
      type: 'bar',
      data: { labels: d.labels, datasets: [{ label: 'Total (Rp)', data: d.values }] },
      options: { scales: { y: { beginAtZero: true } } }
    });
  });
</script>
</body>
</html>
