<?php

// Class ini bertanggung jawab untuk halaman utama (homepage)
class HomeController {

    /**
     * Metode index akan dipanggil saat URL root ('/') diakses.
     * Tugas utamanya adalah memuat tampilan (view) untuk halaman home.
     */
    public function index() {
        // Muat file header, konten home, dan footer
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/home.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }
}
