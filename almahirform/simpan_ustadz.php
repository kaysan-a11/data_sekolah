<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Metode tidak diizinkan.');
}

$nip = trim($_POST['nip'] ?? '');
$namaUstadz = trim($_POST['nama_ustadz'] ?? '');
$tempatLahir = trim($_POST['tmpt_lahir'] ?? '');
$tanggalLahir = trim($_POST['tgl_lahir'] ?? '');
$telepon = trim($_POST['tlp_ustadz'] ?? '');
$jabatan = trim($_POST['jabatan'] ?? '');
$bidang = trim($_POST['bidang'] ?? '');

if ($nip === '' || $namaUstadz === '' || $tempatLahir === '' || $tanggalLahir === '' || $jabatan === '' || $bidang === '') {
    http_response_code(400);
    exit('NIP, nama, tempat lahir, tanggal lahir, jabatan, dan bidang wajib diisi.');
}

try {
    require __DIR__ . '/koneksi.php';

    $statement = $conn->prepare(
        'INSERT INTO tb_ustadz
            (nip, nama_ustadz, tmpt_lahir, tgl_lahir, tlp_ustadz, jabatan, bidang)
         VALUES
            (?, ?, ?, ?, ?, ?, ?)'
    );
    $telepon = $telepon !== '' ? $telepon : null;
    $statement->bind_param(
        'sssssss',
        $nip,
        $namaUstadz,
        $tempatLahir,
        $tanggalLahir,
        $telepon,
        $jabatan,
        $bidang
    );
    $statement->execute();

    header('Location: data_ustad.php', true, 303);
    exit;
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    $message = $exception->getCode() === 1062
        ? 'NIP tersebut sudah terdaftar.'
        : 'Data gagal disimpan. Periksa koneksi database dan isian form.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Status Penyimpanan Ustadz</title>
</head>
<body>
  <main>
    <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    <a href="ustad.php">Kembali ke form ustadz</a>
  </main>
</body>
</html>