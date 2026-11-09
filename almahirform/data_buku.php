<?php
$rowsPerPage = 5;
$pageInput = $_GET['page'] ?? 1;
$requestedPage = is_scalar($pageInput) ? filter_var((string) $pageInput, FILTER_VALIDATE_INT) : false;
$currentPage = $requestedPage !== false && $requestedPage > 0 ? $requestedPage : 1;
$databaseError = false;
$bukuResult = false;
$totalRows = 0;
$totalPages = 1;
try {
  require_once __DIR__ . '/koneksi.php';
  $countResult = $conn->query('SELECT COUNT(*) AS total FROM tb_buku');
  $totalRows = (int) $countResult->fetch_assoc()['total'];
  $totalPages = max(1, (int) ceil($totalRows / $rowsPerPage));
  $currentPage = min($currentPage, $totalPages);
  $offset = ($currentPage - 1) * $rowsPerPage;
  $statement = $conn->prepare('SELECT isbn, judul_buku, pengarang, penerbit, kategori, harga, diskon FROM tb_buku ORDER BY judul_buku ASC LIMIT ? OFFSET ?');
  $statement->bind_param('ii', $rowsPerPage, $offset);
  $statement->execute();
  $bukuResult = $statement->get_result();
} catch (mysqli_sql_exception $e) { error_log('Gagal mengambil data buku: ' . $e->getMessage()); $databaseError = true; }
if ($bukuResult === false) $databaseError = true;
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="stylesheet" href="style.css"><title>Data Buku</title></head>
<body><div class="content">
<aside>
  <div class="bungkus-logo"><div class="logo-brand">AM</div><div class="logo-text">Al-Mahir</div></div>
  <div class="sidebar-nav"><span>MENU UTAMA</span>
    <div><i class="fa fa-tachometer"></i><a href="index.php">Dashboard</a></div>
    <div><i class="fa fa-graduation-cap"></i><a href="data_santri.php">Data santri</a></div>
    <div><i class="fa fa-user-circle"></i><a href="data_ustad.php">Data ustadz</a></div>
    <div><i class="fa fa-clock-o"></i><a href="data_mapel.php">Mapel</a></div>
    <div><i class="fa fa-book"></i><a href="data_buku.php" class="menu-item active">Buku</a></div>
  </div><hr>
  <div class="sidebar-footer">
    <div class="profile"><div class="user-avatar">KS</div><div class="user-info"><h5>Kesan</h5></div></div>
    <p>admin@ppqta.com</p>
    <a href="#" class="logout-btn">Logout</a>
  </div>
</aside>
<main class="main-content"><h1>Data Buku</h1><p>Daftar koleksi buku Al-Mahir.</p>
<section class="section">
<?php if ($databaseError): ?><p class="database-error" role="alert">Data buku gagal dimuat. Periksa koneksi dan tabel tb_buku.</p>
<?php else: ?>
<table class="tabel"><thead class="sub"><tr><th>ISBN</th><th>Judul Buku</th><th>Pengarang</th><th>Penerbit</th><th>Kategori</th><th>Harga</th><th>Diskon</th></tr></thead><tbody>
<?php if (!$bukuResult->num_rows): ?><tr><td colspan="7">Belum ada data buku.</td></tr>
<?php else: while ($buku = $bukuResult->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars((string) $buku['isbn'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($buku['judul_buku'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($buku['pengarang'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($buku['penerbit'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($buku['kategori'], ENT_QUOTES, 'UTF-8') ?></td>
<td>Rp <?= number_format((int) $buku['harga'], 0, ',', '.') ?></td>
<td><?= $buku['diskon'] === null ? '-' : (int) $buku['diskon'] . '%' ?></td>
</tr>
<?php endwhile; endif; ?>
</tbody></table>
<?php if ($totalRows > 0): ?><nav class="pagination" aria-label="Navigasi halaman data buku">
<span class="pagination-summary">Menampilkan <?= $offset + 1 ?>–<?= min($offset + $rowsPerPage, $totalRows) ?> dari <?= $totalRows ?> data</span>
<div class="pagination-controls">
<?php if ($currentPage > 1): ?><a href="?page=<?= $currentPage - 1 ?>">Sebelumnya</a><?php else: ?><span class="disabled">Sebelumnya</span><?php endif; ?>
<span class="pagination-current">Halaman <?= $currentPage ?> dari <?= $totalPages ?></span>
<?php if ($currentPage < $totalPages): ?><a href="?page=<?= $currentPage + 1 ?>">Berikutnya</a><?php else: ?><span class="disabled">Berikutnya</span><?php endif; ?>
</div></nav><?php endif; ?>
<?php endif; ?></section><a href="input_buku.php" class="btn-add">Add Data</a>
</main></div></body></html>
