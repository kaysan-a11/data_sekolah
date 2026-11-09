<?php
$databaseError = false;

try {
		require_once __DIR__ . '/koneksi.php';
} catch (mysqli_sql_exception $exception) {
		error_log($exception->getMessage());
		$databaseError = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Form Data Ustadz</title>
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
				<div><i class="fa fa-tachometer" aria-hidden="true"></i><a href="index.php">Dashboard</a></div>
				<div><i class="fa fa-graduation-cap" aria-hidden="true"></i><a href="data_santri.php">Data santri</a></div>
				<div><i class="fa fa-user-circle" aria-hidden="true"></i><a href="data_ustad.php" class="menu-item active">Data ustadz</a></div>
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

		<main class="form-register">
			<div class="form-header">
				<h1>Form Data Ustadz</h1>
				<a href="data_ustad.php" class="btn-back">Kembali</a>
			</div>
			<?php if ($databaseError): ?>
				<p role="alert">Koneksi database gagal. Periksa MySQL dan konfigurasi di koneksi.php.</p>
			<?php endif; ?>

			<form action="simpan_ustadz.php" method="post">
				<div class="form-grid">
					<div class="form-field">
						<label for="nip">NIP</label>
						<input type="text" id="nip" name="nip" maxlength="50" required>
					</div>
					<div class="form-field">
						<label for="nama_ustadz">Nama ustadz</label>
						<input type="text" id="nama_ustadz" name="nama_ustadz" maxlength="50" required>
					</div>
					<div class="form-field">
						<label for="tmpt_lahir">Tempat lahir</label>
						<input type="text" id="tmpt_lahir" name="tmpt_lahir" maxlength="100" required>
					</div>
					<div class="form-field">
						<label for="tgl_lahir">Tanggal lahir</label>
						<input type="date" id="tgl_lahir" name="tgl_lahir" required>
					</div>
					<div class="form-field">
						<label for="tlp_ustadz">Telepon</label>
						<input type="tel" id="tlp_ustadz" name="tlp_ustadz" maxlength="20">
					</div>
					<div class="form-field">
						<label for="jabatan">Jabatan</label>
						<input type="text" id="jabatan" name="jabatan" maxlength="20" required>
					</div>
					<div class="form-field full-width">
						<label for="bidang">Bidang</label>
						<input type="text" id="bidang" name="bidang" maxlength="50" required>
					</div>
					<button class="btn-submit full-width" type="submit">Simpan data ustadz</button>
				</div>
			</form>
		</main>
	</div>
</body>
</html>
