<?php

// Class ini bertanggung jawab untuk semua halaman yang terkait dengan profil
class ProfilController {

    /**
     * Metode index akan dipanggil saat URL 'profil' diakses.
     * Tugas utamanya adalah memuat tampilan (view) untuk halaman profil utama.
     */
    public function index() {
        // Muat file header, konten profil, dan footer
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/profil.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }

    /**
     * Metode sejarah akan dipanggil saat URL 'sejarah' diakses.
     */
    public function sejarah() {
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/sejarah.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }

    /**
     * Metode visiMisi akan dipanggil saat URL 'visi-misi' diakses.
     */
    public function visiMisi() {
        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/visi-misi.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }

    /**
     * Metode tenagaPendidik akan dipanggil saat URL 'tenaga-pendidik' diakses.
     */
    public function tenagaPendidik() {
        global $conn;
        require_once ROOT_PATH . '/models/TenagaPendidikModel.php';
        $tenagaPendidikModel = new TenagaPendidikModel($conn);

        $data['tenaga_pendidik'] = $tenagaPendidikModel->getAllTenagaPendidik();

        require_once ROOT_PATH . '/views/layouts/header.php';
        require_once ROOT_PATH . '/views/tenaga-pendidik.php';
        require_once ROOT_PATH . '/views/layouts/footer.php';
    }
}
