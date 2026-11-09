<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode tidak diizinkan.');
}

$noIndukInput = trim($_POST['no_induk'] ?? '');
$namaSantri = trim($_POST['nama_santri'] ?? '');
$tempatLahir = trim($_POST['tmpt_lahir'] ?? '');
$tanggalLahir = trim($_POST['tgl_lahir'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$namaWali = trim($_POST['nama_wali'] ?? '');
$telpSantri = trim($_POST['telp_santri'] ?? '');
$telpWali = trim($_POST['telp_wali'] ?? '');

if ($noIndukInput === '' || $namaSantri === '' || $tempatLahir === '' || $tanggalLahir === '' || $alamat === '') {
    http_response_code(400);
    exit('No induk, nama santri, tempat lahir, tanggal lahir, dan alamat wajib diisi.');
}

$noInduk = filter_var($noIndukInput, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 2147483647],
]);

if ($noInduk === false) {
    http_response_code(400);
    exit('No induk harus berupa angka bulat positif.');
}

try {
    require __DIR__ . '/koneksi.php';

    $statement = $conn->prepare(
        'INSERT INTO tb_santri
            (no_induk, nama_santri, tmpt_lahir, tgl_lahir, alamat, nama_wali, telp_santri, telp_wali)
         VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $namaWali = $namaWali !== '' ? $namaWali : null;
    $telpSantri = $telpSantri !== '' ? $telpSantri : null;
    $telpWali = $telpWali !== '' ? $telpWali : null;
    $statement->bind_param(
        'isssssss',
        $noInduk,
        $namaSantri,
        $tempatLahir,
        $tanggalLahir,
        $alamat,
        $namaWali,
        $telpSantri,
        $telpWali
    );
    $statement->execute();

    header('Location: data_santri.php', true, 303);
    exit;
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    $message = $exception->getCode() === 1062
        ? 'No induk sudah terdaftar. Gunakan nomor induk yang berbeda.'
        : 'Data gagal disimpan. Periksa koneksi database dan pastikan semua data wajib sesuai.';
    $statusClass = 'error';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Status Penyimpanan</title>
</head>
<body>
  <main class="save-result">
    <p class="save-result-message <?= htmlspecialchars($statusClass, ENT_QUOTES, 'UTF-8') ?>" role="status">
      <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </p>
    <a class="btn-add" href="data_santri.php">Kembali ke data santri</a>
    <a class="btn-back" href="input_santri.php">Tambah data lagi</a>
  </main>
</body>
</html>