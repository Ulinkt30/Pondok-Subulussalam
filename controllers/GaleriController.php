<?php

// Class ini bertanggung jawab untuk halaman galeri
class GaleriController {

    /**
     * Metode index akan dipanggil saat URL 'galeri' diakses.
     * Tugas utamanya adalah memuat tampilan (view) untuk halaman galeri
     * dengan data yang diambil dari database.
     */
    public function index() {
        global $conn; // Mengakses variabel koneksi database global
        require_once ROOT_PATH . '/models/GaleriModel.php';
        $galeriModel = new GaleriModel($conn);

        // Ambil semua data galeri dari database
        $data['galeri'] = $galeriModel->getAllGaleri();
        
        // Muat file header, konten galeri, dan footer
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/galeri.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }
}
