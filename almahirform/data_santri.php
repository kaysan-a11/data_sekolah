<?php 
    //buat nampilin data

$rowsPerPage = 5;
$pageInput = $_GET['page'] ?? 1;
$requestedPage = is_scalar($pageInput)
    ? filter_var((string) $pageInput, FILTER_VALIDATE_INT)
    : false;
$currentPage = $requestedPage !== false && $requestedPage > 0 ? $requestedPage : 1;
$databaseError = false;
$santriResult = false;
$totalRows = 0;
$totalPages = 1;

try {
    require_once __DIR__ . '/koneksi.php';
    $countResult = $conn->query('SELECT COUNT(*) AS total FROM tb_santri');
    $totalRows = (int) $countResult->fetch_assoc()['total'];
    $totalPages = max(1, (int) ceil($totalRows / $rowsPerPage));
    $currentPage = min($currentPage, $totalPages);
    $offset = ($currentPage - 1) * $rowsPerPage;

    $statement = $conn->prepare(
        'SELECT no_induk, nama_santri, tmpt_lahir, tgl_lahir, alamat
         FROM tb_santri
         ORDER BY no_induk ASC
         LIMIT ? OFFSET ?'
    );
    $statement->bind_param('ii', $rowsPerPage, $offset);
    $statement->execute();
    $santriResult = $statement->get_result();
} catch (mysqli_sql_exception $exception) {
    error_log('Gagal mengambil data tb_santri: ' . $exception->getMessage());
    $databaseError = true;
}

if ($santriResult === false) {
    if (!$databaseError && isset($conn)) {
        error_log('Gagal mengambil data tb_santri: ' . $conn->error);
    }
    $databaseError = true;
}

function formatTanggalIndonesia(string $tanggal): string
{
    $timestamp = strtotime($tanggal);
    if ($timestamp === false) {
        return $tanggal;
    }

    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    return date('j', $timestamp) . ' ' . $namaBulan[(int) date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Santri</title>

</head>
<body>
    <div class="content">
    <aside>
        <div class="bungkus-logo">
            <div class="logo-brand">AM</div>
            <div class="logo-text">Al-Mahir</div>
        </div>

        <div class="sidebar-nav">
            <span>MENU UTAMA</span>
                <div><i class="fa fa-tachometer" aria-hidden="true"></i> <a href="index.php">Dashboard</a></div>
            <div><i class="fa fa-graduation-cap" aria-hidden="true"></i><a href="data_santri.php" class="menu-item active">Data santri</a></div>
            <div><i class="fa fa-user-circle" aria-hidden="true"></i><a href="data_ustad.php">Data ustadz</a></div>
            <div><i class="fa fa-clock-o" aria-hidden="true"></i><a href="data_mapel.php">Mapel</a></div>
            <div><i class="fa fa-book" aria-hidden="true"></i><a href="data_buku.php">Buku</a></div>
        </div>
        <hr>
        <div class="sidebar-footer">
            <div class="profile">
                <div class="user-avatar">KS</div>
                <div class="user-info"><h5>Kesan</h5></div>
            </div>
            <p>admin@ppqta.com</p>
            <a href="#" class="logout-btn">Logout</a>
        </div>
    </aside>

    <!-- Isi Halaman santri -->
    <main class="main-content">
        <h1>Data santri</h1>
        <p>Konten dashboard tampil di sini.</p>
        <section class="section">
            <?php if ($databaseError): ?>
                <p class="database-error" role="alert">Data santri gagal dimuat. Periksa koneksi database dan tabel tb_santri.</p>
            <?php else: ?>
            <table class="tabel">
                <thead class="sub">
                    <tr>
                        <th>No. Induk</th>
                        <th>Nama Santri</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!$santriResult->num_rows): ?>
                        <tr>
                            <td colspan="5">Belum ada data santri.</td>
                        </tr>
                    <?php else: ?>
                        <?php while ($santri = $santriResult->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) $santri['no_induk'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($santri['nama_santri'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <?= htmlspecialchars($santri['tmpt_lahir'], ENT_QUOTES, 'UTF-8') ?>,
                                    <?= htmlspecialchars(formatTanggalIndonesia($santri['tgl_lahir']), ENT_QUOTES, 'UTF-8') ?>
                                </td>
                                <td><?= htmlspecialchars($santri['alamat'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit_santri.php?no_induk=<?= urlencode((string) $santri['no_induk']) ?>" class="btn-edit">Edit</a>
                                        <a href="hapus_all.php?no_induk=<?= urlencode((string) $santri['no_induk']) ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data santri ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if ($totalRows > 0): ?>
                <nav class="pagination" aria-label="Navigasi halaman data santri">
                    <span class="pagination-summary">
                        Menampilkan <?= $offset + 1 ?>–<?= min($offset + $rowsPerPage, $totalRows) ?>
                        dari <?= $totalRows ?> data
                    </span>
                    <div class="pagination-controls">
                        <?php if ($currentPage > 1): ?>
                            <a href="?page=<?= $currentPage - 1 ?>" aria-label="Halaman sebelumnya">Sebelumnya</a>
                        <?php else: ?>
                            <span class="disabled" aria-disabled="true">Sebelumnya</span>
                        <?php endif; ?>

                        <span class="pagination-current">Halaman <?= $currentPage ?> dari <?= $totalPages ?></span>

                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?page=<?= $currentPage + 1 ?>" aria-label="Halaman berikutnya">Berikutnya</a>
                        <?php else: ?>
                            <span class="disabled" aria-disabled="true">Berikutnya</span>
                        <?php endif; ?>
                    </div>
                </nav>
            <?php endif; ?>
            <?php endif; ?>
        </section>

        <a href="input_santri.php" class="btn-add">Add Data</a>
    </main>
    </div>
</body>
</html>