<?php

class KontakController {
    public function index() {
        // Logika untuk halaman kontak, jika ada
        
        // Memuat file view
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/kontak.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }

    public function kirimPesan() {
        // Logika untuk menangani pengiriman formulir
        // ...
        // Setelah selesai, bisa mengarahkan pengguna kembali atau menampilkan pesan sukses
        header('Location: /pondok-subusalam/kontak?status=success');
        exit;
    }
}
