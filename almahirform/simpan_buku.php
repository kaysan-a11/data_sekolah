<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Metode tidak diizinkan.'); }
$isbn = trim($_POST['isbn'] ?? '');
$judul = trim($_POST['judul_buku'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$penerbit = trim($_POST['penerbit'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$hargaInput = trim($_POST['harga'] ?? '');
$diskonInput = trim($_POST['diskon'] ?? '');
if ($isbn === '' || $judul === '' || $pengarang === '' || $penerbit === '' || $kategori === '' || $hargaInput === '') { http_response_code(400); exit('Semua data wajib kecuali diskon harus diisi.'); }
$harga = filter_var($hargaInput, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 2147483647]]);
$diskon = $diskonInput === '' ? null : filter_var($diskonInput, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 100]]);
if ($harga === false || ($diskonInput !== '' && $diskon === false)) { http_response_code(400); exit('Harga atau diskon tidak valid.'); }
try {
  require __DIR__ . '/koneksi.php';
  $sql = 'INSERT INTO tb_buku (isbn, judul_buku, pengarang, penerbit, kategori, harga, diskon) VALUES (?, ?, ?, ?, ?, ?, ?)';
  $statement = $conn->prepare($sql);
  $statement->bind_param('sssssii', $isbn, $judul, $pengarang, $penerbit, $kategori, $harga, $diskon);
  $statement->execute();
  header('Location: data_buku.php', true, 303);
  exit;
} catch (mysqli_sql_exception $e) {
  error_log($e->getMessage());
  http_response_code(500);
  $message = $e->getCode() === 1062 ? 'ISBN sudah terdaftar.' : 'Data buku gagal disimpan.';
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="style.css"><title>Status Buku</title></head>
<body><main class="save-result"><p class="save-result-message error" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><a class="btn-back" href="data_buku.php">Kembali ke data buku</a></main></body></html>
