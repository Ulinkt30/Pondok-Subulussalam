<?php

// Tampilkan semua error untuk keperluan debugging (matikan di lingkungan produksi)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tentukan direktori root proyek untuk mempermudah pemanggilan file
define('ROOT_PATH', __DIR__);

// Muat file konfigurasi database
require_once ROOT_PATH . '/config/db.php';

// Muat file yang berisi fungsi-fungsi umum
// require_once ROOT_PATH . '/includes/functions.php';

// Muat file routes untuk menangani URL
require_once ROOT_PATH . '/routes.php';

// Catatan: Baris-baris kode di atas akan kita aktifkan atau isi
// seiring dengan berjalannya proses pembuatan web ini.
// Saat ini, kita hanya akan memuat routes.php
