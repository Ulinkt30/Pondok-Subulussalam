<?php

// Konfigurasi koneksi database
// Mohon ganti nilai di bawah ini dengan kredensial database Anda yang sebenarnya.
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Ganti dengan username database Anda
define('DB_PASS', '');     // Ganti dengan password database Anda
define('DB_NAME', 'pondok_subusalam'); // Ganti dengan nama database yang Anda inginkan

// Buat koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set karakter encoding
$conn->set_charset("utf8mb4");

// Catatan: Variabel $conn sekarang dapat digunakan di seluruh aplikasi
// untuk menjalankan query ke database.
