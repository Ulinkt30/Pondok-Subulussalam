<?php

// Class ini bertanggung jawab untuk halaman berita
class BeritaController {

    /**
     * Metode index akan dipanggil saat URL 'berita' diakses.
     * Tugas utamanya adalah memuat tampilan (view) untuk halaman berita.
     */
    public function index() {
        global $conn;
        require_once ROOT_PATH . '/models/BeritaModel.php';
        $beritaModel = new BeritaModel($conn);

        // Ambil ID dari URL
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Jika ada ID, tampilkan detail berita
            $data['berita'] = $beritaModel->getBeritaById($id);
            require_once ROOT_PATH . '/views/layouts/header.php';
            require_once ROOT_PATH . '/views/berita_detail.php';
            require_once ROOT_PATH . '/views/layouts/footer.php';
        } else {
            // Jika tidak ada ID, tampilkan daftar semua berita
            $data['berita'] = $beritaModel->getAllBerita();
            require_once ROOT_PATH . '/views/layouts/header.php';
            require_once ROOT_PATH . '/views/berita.php';
            require_once ROOT_PATH . '/views/layouts/footer.php';
        }
    }
}
