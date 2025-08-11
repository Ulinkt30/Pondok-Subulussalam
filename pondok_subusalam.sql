-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2025 pada 20.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pondok_subusalam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `created_at`) VALUES
(1, 'ulin', '$2y$10$TMiEy2QXb.vHt7ewS9DgluRCGkmOum020iVQ6rfJU.R9PVrLNse6W', 'Ulin Admin', '2025-08-07 07:44:01'),
(3, 'admin', '$2y$10$.X8Zp4CCzTm05enc14PeIetDoOP0HVSW/NrzA/sEpDd9Q2QD3c5B.', 'admin', '2025-08-11 14:36:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_publish` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `konten`, `gambar`, `tanggal_publish`, `created_at`) VALUES
(2, 'wancara', 'Hari ini lagi tes wancara guru,buat perkembangan  evaluasi diri madrasah( edm)', '476460644_122192029304143597_2486775828024357930_n.jpg', '2025-08-07', '2025-08-07 17:47:20'),
(3, 'tamu dari bangko', 'Kunjungan tamu dari bangko telah ngantar buku ke MA/MTS Subulus salam,terimakasih orang baik.', '475890479_122191297544143597_7315910012868189466_n.jpg', '2025-08-07', '2025-08-07 17:47:46'),
(4, '7 bahaya judol', '7 bahaya judol', '474947879_122190021728143597_8553536415709023171_n.jpg', '2025-08-07', '2025-08-07 17:48:39'),
(5, 'ujian KSM ', 'Santri subulus salam ngikuti ujian KSM di kantor kemenag merangin 01-07-2024.', '474698687_122190021266143597_4893394003612718517_n.jpg', '2025-08-07', '2025-08-07 17:48:59'),
(6, 'upacara hari lahir nya pancasila', 'MA/MTs subulus salam mengadakan upacara hari lahir nya pancasila', '474444849_122189771426143597_7125364103106917818_n.jpg', '2025-08-07', '2025-08-07 17:49:30'),
(7, 'dokomen osis putri', 'Penyerahan dokomen osis putri, pengurus yg lama ,ke yg baru di lantik.', '474518060_122189394956143597_1460054002744865793_n.jpg', '2025-08-07', '2025-08-07 17:50:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `deskripsi`, `foto`, `urutan`) VALUES
(4, 'pos pelayanan tamu dan siswa mas subulussalam', '', '6894d86c6c996_WhatsApp Image 2024-05-15 at 13.23.29.jpeg1715754271.jpeg', 0),
(5, 'ruang perpustakaan mas subulussalam', 'ruang perpustakaan mas subulussalam', '6894d8beec21b_IMG-20230905-WA0013.jpg1715753929.jpg', 0),
(6, 'gedung sekolah mas subulussalam', 'gedung sekolah mas subulussalam', '6894d8d780732_UPLOAD_FOTO_LEMBAGA_Foto_Gedung_1144748672.jpg1715754072 (1).jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `gambar`, `tanggal_upload`) VALUES
(6, 'UPACARA BEDERA', '', 'WhatsApp Image 2024-05-15 at 14.09.47.jpeg1715757240.jpeg', '2025-08-07'),
(7, 'PASKIBRAKA', '', 'WhatsApp Image 2024-05-15 at 14.09.48.jpeg1715757178.jpeg', '2025-08-07'),
(12, 'Galeri Kegiatan', 'Galeri Kegiatan', 'besar_cover4.jpg', '2025-08-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `modul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `modul`, `keterangan`, `status`, `created_at`) VALUES
(1, 'admin', 'Berita', 'Berita \"asd\" berhasil ditambahkan.', 'berhasil', '2025-08-08 10:14:57'),
(2, 'admin', 'Berita', 'Berita \"asd\" berhasil dihapus.', 'berhasil', '2025-08-08 10:15:41'),
(3, 'admin', 'Galeri', 'Item galeri \"asd\" berhasil dihapus.', 'berhasil', '2025-08-08 10:18:21'),
(4, 'admin', 'Galeri', 'Item galeri \"asd\" berhasil dihapus.', 'berhasil', '2025-08-08 10:18:24'),
(5, 'admin', 'Galeri', 'Item galeri \"ad\" berhasil dihapus.', 'berhasil', '2025-08-08 10:18:26'),
(6, 'admin', 'Fasilitas', 'Fasilitas \"asdaasd\" berhasil dihapus.', 'berhasil', '2025-08-08 10:18:36'),
(7, 'admin', 'Fasilitas', 'Fasilitas \"ads\" berhasil dihapus.', 'berhasil', '2025-08-08 10:18:38'),
(8, 'admin', 'Kelola Pengguna', 'Pengguna \"udin\" berhasil ditambahkan.', 'berhasil', '2025-08-08 10:36:25'),
(9, 'admin', 'Kelola Pengguna', 'Pengguna \"udin\" berhasil diupdate.', 'berhasil', '2025-08-08 10:36:59'),
(10, 'admin', 'Kelola Pengguna', 'Gagal menambahkan pengguna \"admin\".', 'gagal', '2025-08-08 11:39:25'),
(11, 'admin', 'Kelola Pengguna', 'Pengguna \"udin\" berhasil ditambahkan.', 'berhasil', '2025-08-08 11:57:56'),
(12, 'admin', 'Kelola Pengguna', 'Pengguna \"udin\" berhasil dihapus.', 'berhasil', '2025-08-08 11:58:17'),
(13, 'admin', 'Galeri', 'Item galeri \"asd\" berhasil ditambahkan.', 'berhasil', '2025-08-08 12:13:18'),
(14, 'admin', 'Galeri', 'Item galeri \"asd\" berhasil dihapus.', 'berhasil', '2025-08-08 12:13:22'),
(15, 'admin', 'Galeri', 'Item galeri \"Galeri Kegiatan\" berhasil ditambahkan.', 'berhasil', '2025-08-08 12:13:32'),
(16, 'admin', 'Kelola Pengguna', 'Pengguna \"admin\" berhasil ditambahkan.', 'berhasil', '2025-08-11 14:36:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pimpinan`
--

CREATE TABLE `pimpinan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `halaman` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id`, `halaman`, `judul`, `konten`, `foto`, `updated_at`) VALUES
(1, 'sejarah', 'Judul Awal', 'Konten awal...', NULL, '2025-08-07 14:28:05'),
(2, 'visi-misi', 'Judul Awal', 'Konten awal...', NULL, '2025-08-07 14:42:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenaga_pendidik`
--

CREATE TABLE `tenaga_pendidik` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `halaman` (`halaman`);

--
-- Indeks untuk tabel `tenaga_pendidik`
--
ALTER TABLE `tenaga_pendidik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tenaga_pendidik`
--
ALTER TABLE `tenaga_pendidik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
