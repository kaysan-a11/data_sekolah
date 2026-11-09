-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2026 pada 07.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_almahir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_santri`
--

CREATE TABLE `data_santri` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_induk` varchar(50) NOT NULL,
  `nama_santri` varchar(150) NOT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nama_wali` varchar(150) DEFAULT NULL,
  `telp_santri` varchar(30) DEFAULT NULL,
  `telp_wali` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `isbn` varchar(20) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `kategori` varchar(80) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`isbn`, `judul_buku`, `pengarang`, `penerbit`, `kategori`, `harga`, `diskon`) VALUES
('978-602-03-1234-1', 'Pemrograman Web dengan PHP & MySQL', 'Ahmad Fauzi', 'Elex Media Komputindo', 'IT', 75000, NULL),
('978-602-03-1234-10', 'Pemrograman Berorientasi Objek dengan Java', 'Yogi Arifiawan', 'Elex Media Komputindo', 'IT', 95000, NULL),
('978-602-03-1234-11', 'Tafsir Jalalain Juz Amma', 'Imam Jalaluddin Al-Mahalli', 'Sinar Baru Algensindo', 'Diniyah', 45000, NULL),
('978-602-03-1234-12', 'Kimia Organik Dasar', 'Fessenden & Fessenden', 'Erlangga', 'Umum', 130000, NULL),
('978-602-03-1234-13', 'Sistem Basis Data (Database Systems)', 'Rosa A.S.', 'Modula', 'IT', 85000, NULL),
('978-602-03-1234-14', 'Akhlak Tasawuf', 'Abuddin Nata', 'Rajawali Pers', 'Diniyah', 65000, NULL),
('978-602-03-1234-15', 'Bahasa Indonesia untuk Perguruan Tinggi', 'E. Zaenal Arifin', 'Grasindo', 'Umum', 55000, NULL),
('978-602-03-1234-16', 'Kecerdasan Buatan (Artificial Intelligence)', 'Sri Kusumadewi', 'Graha Ilmu', 'IT', 110000, NULL),
('978-602-03-1234-17', 'Ilmu Hadits Pengantar', 'Mahmud At-Tahhan', 'Ummul Qura', 'Diniyah', 80000, NULL),
('978-602-03-1234-18', 'Statistika untuk Penelitian', 'Sugiyono', 'Alfabeta', 'Umum', 85000, NULL),
('978-602-03-1234-19', 'Keamanan Jaringan Komputer', 'Onno W. Purbo', 'Andi Publisher', 'IT', 95000, NULL),
('978-602-03-1234-2', 'Dasar-Dasar Fiqih Muamalah', 'Ustadz H. Abdullah', 'Pustaka Al-Kautsar', 'Diniyah', 60000, NULL),
('978-602-03-1234-20', 'Fiqih Sunnah', 'Sayyid Sabiq', 'Tazkia', 'Diniyah', 175000, NULL),
('978-602-03-1234-3', 'Matematika Diskrit untuk Ilmu Komputer', 'Rinaldi Munir', 'Informatika', 'Umum', 95000, NULL),
('978-602-03-1234-4', 'Belajar Desain Grafis CorelDraw & Photoshop', 'Budi Raharjo', 'Informatika', 'IT', 85000, NULL),
('978-602-03-1234-5', 'Terjemahan Kitab Bulughul Maram', 'Ibnu Hajar Al-Asqalani', 'Gema Insani', 'Diniyah', 120000, NULL),
('978-602-03-1234-6', 'Fisika Dasar untuk Perguruan Tinggi', 'Halliday Resnick', 'Erlangga', 'Umum', 150000, NULL),
('978-602-03-1234-7', 'Jaringan Komputer Berbasis Mikrotik', 'Janner Simarmata', 'Andi Publisher', 'IT', 90000, NULL),
('978-602-03-1234-8', 'Sejarah Peradaban Islam', 'Badri Yatim', 'RajaGrafindo Persada', 'Diniyah', 70000, NULL),
('978-602-03-1234-9', 'Kalkulus Diferensial dan Integral', 'Varberg Purcell', 'Erlangga', 'Umum', 140000, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `no_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `jp_mapel` int(11) NOT NULL,
  `kategori_mapel` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mapel`
--

INSERT INTO `tb_mapel` (`no_mapel`, `nama_mapel`, `jp_mapel`, `kategori_mapel`) VALUES
(101, 'Fiqih', 4, 'Diniyah'),
(102, 'Aqidah Akhlak', 3, 'Diniyah'),
(103, 'Al-Quran Hadits', 4, 'Diniyah'),
(104, 'Sejarah Kebudayaan Islam (SKI)', 2, 'Diniyah'),
(105, 'Bahasa Arab', 4, 'Diniyah'),
(201, 'Matematika', 4, 'Umum'),
(202, 'Bahasa Indonesia', 4, 'Umum'),
(203, 'Ilmu Pengetahuan Alam (IPA)', 4, 'Umum'),
(204, 'Ilmu Pengetahuan Sosial (IPS)', 3, 'Umum'),
(205, 'Bahasa Inggris', 4, 'Umum'),
(301, 'Pemrograman Dasar', 4, 'IT'),
(302, 'Desain Grafis', 3, 'IT'),
(303, 'Jaringan Komputer', 4, 'IT'),
(304, 'Pengembangan Web', 4, 'IT'),
(305, 'Animasi & Multimedia', 3, 'IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_santri`
--

CREATE TABLE `tb_santri` (
  `no_induk` int(11) NOT NULL,
  `nama_santri` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `nama_wali` varchar(50) DEFAULT NULL,
  `telp_santri` varchar(20) DEFAULT NULL,
  `telp_wali` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_santri`
--

INSERT INTO `tb_santri` (`no_induk`, `nama_santri`, `tmpt_lahir`, `tgl_lahir`, `alamat`, `nama_wali`, `telp_santri`, `telp_wali`) VALUES
(2026001, 'sobary', 'Surakarta', '2010-05-12', 'Jl. Slamet Riyadi No. 10, Surakarta', 'Budi Santoso', '081234567801', '081234567891'),
(2026002, 'Siti Aisyah', 'Karanganyar', '2011-03-22', 'Jl. Lawu No. 45, Karanganyar', 'Ahmad Dahlan', '081234567802', '081234567892'),
(2026003, 'Muhammad Rizki', 'Boyolali', '2010-07-15', 'Jl. Pandanaran No. 12, Boyolali', 'Hasan Basri', '081234567803', '081234567893'),
(2026005, 'Abdullah Rasyid', 'Sragen', '2010-09-18', 'Jl. Sukowati No. 21, Sragen', 'Zainal Abidin', '081234567805', '081234567895'),
(2026006, 'Zainab Nurul', 'Wonogiri', '2011-11-30', 'Jl. Diponegoro No. 5, Wonogiri', 'Ibrahimovic', '081234567806', '081234567896'),
(2026007, 'Umar Al-Faruq', 'Klaten', '2010-04-25', 'Jl. Pemuda No. 77, Klaten', 'Usman bin Affan', '081234567807', '081234567897'),
(2026008, 'Khadijah Amalia', 'Surakarta', '2011-06-14', 'Jl. Veteran No. 15, Surakarta', 'Ali bin Abi Thalib', '081234567808', '081234567898'),
(2026009, 'Yusuf Al-Ayyubi', 'Karanganyar', '2010-12-01', 'Jl. Solo-Tawangmangu Km. 5', 'Hamzah', '081234567809', '081234567899'),
(2026010, 'Maryam Qonita', 'Boyolali', '2011-08-19', 'Jl. Merapi No. 3, Boyolali', 'Luqman Hakim', '081234567810', '081234567800'),
(2026012, 'Aisyah Humaira', 'Sragen', '2011-10-08', 'Jl. Raden Saleh No. 14, Sragen', 'Zubair', '081234567812', '081234567811'),
(2026013, 'Bilal bin Rabah', 'Wonogiri', '2010-06-20', 'Jl. Gajah Mada No. 22, Wonogiri', 'Sa\'ad', '081234567813', '081234567812'),
(2026014, 'Safiyah binti Huyay', 'Klaten', '2011-05-17', 'Jl. Kartini No. 6, Klaten', 'Abdurrahman', '081234567814', '081234567813'),
(2026015, 'Hamzah Assad', 'Surakarta', '2010-08-04', 'Jl. Yos Sudarso No. 50, Surakarta', 'Muawiyah', '081234567815', '081234567814'),
(2026016, 'Ruqayyah Al-Wustha', 'Karanganyar', '2011-12-25', 'Jl. Solo-Sragen Km. 7', 'Abu Bakar', '081234567816', '081234567815'),
(2026017, 'Thariq bin Ziyad', 'Boyolali', '2010-01-14', 'Jl. Boyolali-Semarang Km. 2', 'Khalid', '081234567817', '081234567816'),
(2026019, 'Ali Murtadha', 'Sragen', '2010-10-28', 'Jl. Veteran No. 33, Sragen', 'Hasan', '081234567819', '081234567818'),
(2026020, 'Hafshah Umar', 'Wonogiri', '2011-07-03', 'Jl. Pattimura No. 11, Wonogiri', 'Husain', '081234567820', '081234567819');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ustadz`
--

CREATE TABLE `tb_ustadz` (
  `nip` varchar(50) NOT NULL,
  `nama_ustadz` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tlp_ustadz` varchar(20) DEFAULT NULL,
  `jabatan` varchar(20) NOT NULL,
  `bidang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_ustadz`
--

INSERT INTO `tb_ustadz` (`nip`, `nama_ustadz`, `tmpt_lahir`, `tgl_lahir`, `tlp_ustadz`, `jabatan`, `bidang`) VALUES
('198501012010011001', 'Ustadz Ahmad Fauzi, M.Pd.', 'Surakarta', '1985-04-12', '081234567801', 'Kepala Sekolah', 'Manajemen Pendidikan'),
('198709142011011005', 'Ustadz Abdullah Rasyid, M.Ud.', 'Sragen', '1987-09-14', '081234567805', 'Pembina Asrama', 'Aqidah Akhlak'),
('198805152012022002', 'Ustadzah Siti Aminah, S.Ag.', 'Karanganyar', '1988-05-15', '081234567802', 'Wakakurikulum', 'Al-Quran & Hadits'),
('198902282014051007', 'Ustadz Umar Al-Faruq, S.Th.I.', 'Klaten', '1989-02-28', '081234567807', 'Wakakeesiswaan', 'Sejarah Peradaban Islam'),
('199003202015031003', 'Ustadz Muhammad Rizki, Lc.', 'Boyolali', '1990-03-20', '081234567803', 'Guru Pengajar', 'Bahasa Arab'),
('199008032015092010', 'Ustadzah Maryam Qonita, S.Psi.', 'Boyolali', '1990-08-03', '081234567810', 'Konselor / BK', 'Bimbingan Konseling'),
('199106182017072008', 'Ustadzah Khadijah Amalia, M.Pd.', 'Surakarta', '1991-06-18', '081234567808', 'Guru Pengajar', 'Bahasa Inggris'),
('199207102016042004', 'Ustadzah Fatimah Zahra, S.Pd.', 'Sukoharjo', '1992-07-10', '081234567804', 'Guru Pengajar', 'Fiqih & Ushul Fiqih'),
('199312052018122006', 'Ustadzah Zainab Nurul, S.Pd.', 'Wonogiri', '1993-12-05', '081234567806', 'Guru Pengajar', 'Tahfidzul Quran'),
('199411222019081009', 'Ustadz Yusuf Al-Ayyubi, S.Kom.', 'Karanganyar', '1994-11-22', '081234567809', 'Staff IT & Pengajar', 'Teknologi Informasi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_santri`
--
ALTER TABLE `data_santri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`isbn`);

--
-- Indeks untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`no_mapel`);

--
-- Indeks untuk tabel `tb_santri`
--
ALTER TABLE `tb_santri`
  ADD PRIMARY KEY (`no_induk`);

--
-- Indeks untuk tabel `tb_ustadz`
--
ALTER TABLE `tb_ustadz`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_santri`
--
ALTER TABLE `data_santri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
