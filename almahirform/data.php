

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Santri</title>
</head>
<body>
    <main class="legacy-data-page">
        <h1>Data Santri</h1>
        <div class="legacy-table-wrap">
            <table class="legacy-table">
                <thead>
                    <tr>
                        <th>No Induk</th>
                        <th>Nama Santri</th>
                        <th>Alamat</th>
                        <th>Tanggal lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
<?php
$databaseError = false;
$result = false;

try {
    require_once __DIR__ . '/koneksi.php';
    $result = $conn->query('SELECT * FROM tb_santri ORDER BY nama_santri ASC');
} catch (mysqli_sql_exception $exception) {
    error_log('Gagal mengambil data santri: ' . $exception->getMessage());
    $databaseError = true;
}
?>
<?php if ($databaseError): ?>
                    <tr>
                        <td colspan="5">
                            <p class="database-error" role="alert">
                                Database tidak dapat diakses. Pastikan MySQL aktif di XAMPP dan database db_almahir tersedia.
                            </p>
                        </td>
                    </tr>
<?php else: ?>
<?php while ($data = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $data['no_induk']; ?></td>
                        <td><?php echo $data['nama_santri']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['tgl_lahir']; ?></td>
                        <td class="legacy-actions">
                            <a href="edit_santri.php?no_induk=<?php echo $data['no_induk']; ?>">Edit</a>
                            <a href="hapus_santri.php?no_induk=<?php echo $data['no_induk']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
<?php endwhile; ?>
<?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
        