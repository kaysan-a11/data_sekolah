<?php
$databaseError = false;
try { require_once __DIR__ . '/koneksi.php'; } catch (mysqli_sql_exception $e) { error_log($e->getMessage()); $databaseError = true; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Form Data Buku</title>
</head>
<body>
<div class="content">
  <aside>
    <div class="bungkus-logo"><div class="logo-brand">AM</div><div class="logo-text">Al-Mahir</div></div>
    <div class="sidebar-nav">
      <span>MENU UTAMA</span>
      <div><i class="fa fa-tachometer"></i><a href="index.php">Dashboard</a></div>
      <div><i class="fa fa-graduation-cap"></i><a href="data_santri.php">Data santri</a></div>
      <div><i class="fa fa-user-circle"></i><a href="data_ustad.php">Data ustadz</a></div>
      <div><i class="fa fa-clock-o"></i><a href="data_mapel.php">Mapel</a></div>
      <div><i class="fa fa-book"></i><a href="data_buku.php" class="menu-item active">Buku</a></div>
    </div>
    <hr>
    <div class="sidebar-footer">
      <div class="profile"><div class="user-avatar">KS</div><div class="user-info"><h5>Kesan</h5></div></div>
      <p>admin@ppqta.com</p>
      <a href="#" class="logout-btn">Logout</a>
    </div>
  </aside>
  <main class="form-register">
    <div class="form-header"><h1>Form Data Buku</h1><a href="data_buku.php" class="btn-back">Kembali</a></div>
    <?php if ($databaseError): ?><p role="alert">Koneksi database gagal. Periksa MySQL dan koneksi.php.</p><?php endif; ?>
    <form action="simpan_buku.php" method="post">
      <div class="form-grid">
        <div class="form-field full-width"><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn" maxlength="20" required></div>
        <div class="form-field full-width"><label for="judul_buku">Judul buku</label><input type="text" id="judul_buku" name="judul_buku" maxlength="100" required></div>
        <div class="form-field"><label for="pengarang">Pengarang</label><input type="text" id="pengarang" name="pengarang" maxlength="255" required></div>
        <div class="form-field"><label for="penerbit">Penerbit</label><input type="text" id="penerbit" name="penerbit" maxlength="100" required></div>
        <div class="form-field"><label for="kategori">Kategori</label><input type="text" id="kategori" name="kategori" maxlength="80" required></div>
        <div class="form-field"><label for="harga">Harga</label><input type="number" id="harga" name="harga" min="0" max="2147483647" required></div>
        <div class="form-field full-width"><label for="diskon">Diskon (%)</label><input type="number" id="diskon" name="diskon" min="0" max="100"></div>
        <button class="btn-submit full-width" type="submit">Simpan Data</button>
      </div>
    </form>
  </main>
</div>
</body>
</html>
