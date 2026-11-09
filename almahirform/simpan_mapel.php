<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Metode tidak diizinkan.'); }
$noInput = trim($_POST['no_mapel'] ?? '');
$nama = trim($_POST['nama_mapel'] ?? '');
$jpInput = trim($_POST['jp_mapel'] ?? '');
$kategori = trim($_POST['kategori_mapel'] ?? '');
if ($noInput === '' || $nama === '' || $jpInput === '' || $kategori === '') { http_response_code(400); exit('Semua kolom wajib diisi.'); }
$no = filter_var($noInput, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]]);
$jp = filter_var($jpInput, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]]);
if ($no === false || $jp === false) { http_response_code(400); exit('Nomor mapel dan jam pelajaran harus berupa angka.'); }
try {
 require __DIR__ . '/koneksi.php';
 $statement = $conn->prepare('INSERT INTO tb_mapel (no_mapel, nama_mapel, jp_mapel, kategori_mapel) VALUES (?, ?, ?, ?)');
 $statement->bind_param('isis', $no, $nama, $jp, $kategori);
 $statement->execute();
 header('Location: data_mapel.php', true, 303); exit;
} catch (mysqli_sql_exception $e) {
 error_log($e->getMessage()); http_response_code(500);
 $message = $e->getCode() === 1062 ? 'Nomor mapel sudah terdaftar.' : 'Data mapel gagal disimpan.';
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="style.css"><title>Status Mapel</title></head><body><main class="save-result"><p class="save-result-message error" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><a class="btn-back" href="data_mapel.php">Kembali ke data mapel</a></main></body></html>
