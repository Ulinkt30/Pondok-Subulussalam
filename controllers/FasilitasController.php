<?php
// Aktifkan pelaporan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memastikan model dan konfigurasi database dimuat
require_once ROOT_PATH . '/config/db.php';
require_once ROOT_PATH . '/models/FasilitasModel.php';

class FasilitasController {
    private $fasilitasModel;

    public function __construct() {
        global $conn;
        // Pastikan koneksi database ada sebelum menginisialisasi model
        if (!$conn) {
            die("Koneksi database gagal.");
        }
        // Inisialisasi model dengan koneksi database
        $this->fasilitasModel = new FasilitasModel($conn);
    }

    public function index() {
        try {
            // Ambil semua data fasilitas dari model
            $data['fasilitas'] = $this->fasilitasModel->getAllFasilitas();

            // Muat view untuk menampilkan data fasilitas
            require_once ROOT_PATH . '/views/layouts/header.php';
            require_once ROOT_PATH . '/views/fasilitas.php';
            require_once ROOT_PATH . '/views/layouts/footer.php';
        } catch (Exception $e) {
            // Tangani error dan tampilkan pesan
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
