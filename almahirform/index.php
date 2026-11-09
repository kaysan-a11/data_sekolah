<?php
$counts = ['santri' => 0, 'ustadz' => 0, 'mapel' => 0, 'buku' => 0];
try {
  require_once __DIR__ . '/koneksi.php';
  foreach (['santri' => 'tb_santri', 'ustadz' => 'tb_ustadz', 'mapel' => 'tb_mapel', 'buku' => 'tb_buku'] as $key => $table) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM $table");
    if ($result) {
      $counts[$key] = (int) $result->fetch_assoc()['total'];
    }
  }
} catch (mysqli_sql_exception $e) {
  error_log('Gagal mengambil jumlah data dashboard: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Dashboard | Al-Mahir</title>
</head>
<body>
  <div class="content">
    <aside>
      <div class="bungkus-logo"><div class="logo-brand">AM</div><div class="logo-text">Al-Mahir</div></div>
      <div class="sidebar-nav">
        <span>MENU UTAMA</span>
        <div><i class="fa fa-tachometer"></i><a href="index.php" class="menu-item active">Dashboard</a></div>
        <div><i class="fa fa-graduation-cap"></i><a href="data_santri.php">Data Santri</a></div>
        <div><i class="fa fa-user-circle"></i><a href="data_ustad.php">Data Ustadz</a></div>
        <div><i class="fa fa-clock-o"></i><a href="data_mapel.php">Mata Pelajaran</a></div>
        <div><i class="fa fa-book"></i><a href="data_buku.php">Perpustakaan</a></div>
      </div>
      <hr>
      <div class="sidebar-footer">
        <div class="profile"><div class="user-avatar">KS</div><div class="user-info"><h5>Kesan</h5></div></div>
        <p>admin@ppqta.com</p>
        <a href="#" class="logout-btn">Logout</a>
      </div>
    </aside>

    <main class="main-content">
      <section class="dashboard-hero">
        <div class="dashboard-hero-copy">
          <span class="dashboard-kicker">PUSAT ADMINISTRASI PESANTREN</span>
          <h1>Selamat datang di Al-Mahir</h1>
          <p>Kelola data santri, ustadz, mata pelajaran, dan koleksi buku dalam satu ruang kerja yang rapi.</p>
        </div>
      </section>

      <h1>Ringkasan Data</h1>
      <p>Jumlah seluruh data yang tersimpan di Al-Mahir.</p>
      <section class="stats-grid" aria-label="Jumlah data">
        <a class="stat-card" href="data_santri.php"><div class="stat-icon"><i class="fa fa-graduation-cap"></i></div><div><strong><?= number_format($counts['santri']) ?></strong><span>Jumlah Santri</span></div></a>
        <a class="stat-card" href="data_ustad.php"><div class="stat-icon"><i class="fa fa-user-circle"></i></div><div><strong><?= number_format($counts['ustadz']) ?></strong><span>Jumlah Ustadz</span></div></a>
        <a class="stat-card" href="data_mapel.php"><div class="stat-icon"><i class="fa fa-clock-o"></i></div><div><strong><?= number_format($counts['mapel']) ?></strong><span>Jumlah Mata Pelajaran</span></div></a>
        <a class="stat-card" href="data_buku.php"><div class="stat-icon"><i class="fa fa-book"></i></div><div><strong><?= number_format($counts['buku']) ?></strong><span>Jumlah Buku</span></div></a>
      </section>
    </main>
  </div>
</body>
</html>