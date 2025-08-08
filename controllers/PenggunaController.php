<?php

/**
 * Class PenggunaController
 * Mengelola semua operasi terkait pengguna di panel admin.
 */
class PenggunaController {

    private $penggunaModel;
    private $logModel;

    public function __construct() {
        global $conn;
        require_once ROOT_PATH . '/models/PenggunaModel.php';
        require_once ROOT_PATH . '/models/LogModel.php';

        $this->penggunaModel = new PenggunaModel($conn);
        $this->logModel = new LogModel($conn);
    }
    
    /**
     * Metode utama untuk halaman kelola pengguna.
     * Mengelola permintaan POST untuk tambah/edit/hapus dan menampilkan daftar pengguna.
     */
    public function index() {
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;
        $message = '';
        $data = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'editor';
            $id_user = $_POST['id_user'] ?? null;

            if ($id_user) {
                if ($this->penggunaModel->updateUser($id_user, $username, $password, $role)) {
                    $message = "Pengguna berhasil diupdate.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"$username\" berhasil diupdate.");
                } else {
                    $message = "Gagal mengupdate pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal mengupdate pengguna \"$username\".", 'gagal');
                }
            } else {
                if ($this->penggunaModel->addUser($username, $password, $role)) {
                    $message = "Pengguna berhasil ditambahkan.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"$username\" berhasil ditambahkan.");
                } else {
                    $message = "Gagal menambahkan pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menambahkan pengguna \"$username\".", 'gagal');
                }
            }
            header("Location: /pondok-subusalam/admin/kelola_pengguna?message=" . urlencode($message));
            exit();
        }

        // Ambil data untuk tampilan
        if ($action === 'edit' && $id) {
            $data['user_edit'] = $this->penggunaModel->getUserById($id);
        } elseif ($action === 'hapus' && $id) {
            $user = $this->penggunaModel->getUserById($id);
            if ($user) {
                if ($this->penggunaModel->deleteUser($id)) {
                    $message = "Pengguna berhasil dihapus.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"{$user['username']}\" berhasil dihapus.");
                } else {
                    $message = "Gagal menghapus pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menghapus pengguna \"{$user['username']}\".", 'gagal');
                }
            } else {
                $message = "Pengguna tidak ditemukan.";
                $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menghapus pengguna.", 'gagal');
            }
            header("Location: /pondok-subusalam/admin/kelola_pengguna?message=" . urlencode($message));
            exit();
        }

        $data['user_list'] = $this->penggunaModel->getAllUsers();
        
        // Memuat view
        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/kelola_pengguna.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }
}
