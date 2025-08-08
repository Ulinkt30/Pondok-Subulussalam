<?php

// Pastikan session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Class ini bertanggung jawab untuk otentikasi pengguna, seperti login dan logout
class AuthController {

    /**
     * Metode login akan dipanggil saat URL 'login' diakses.
     * Tugas utamanya adalah menampilkan form login dan memprosesnya.
     */
    public function login() {
        global $conn; // Mengakses variabel koneksi database global
        require_once ROOT_PATH . '/models/AdminModel.php';
        $adminModel = new AdminModel($conn);
        $error_message = '';

        // Jika data dikirimkan melalui POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Cari pengguna berdasarkan username menggunakan AdminModel
            $user = $adminModel->findByUsername($username);

            // Periksa apakah user ditemukan dan password cocok
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

                // Arahkan ke halaman admin
                header('Location: /pondok-subusalam/admin');
                exit();
            } else {
                // Kredensial tidak valid, kembali ke halaman login dengan pesan error
                $error_message = "Username atau password salah.";
            }
        }

        // Muat hanya tampilan login tanpa header dan footer
        require_once ROOT_PATH . '/views/auth/login.php';
    }

    /**
     * Metode logout akan dipanggil untuk mengakhiri sesi pengguna.
     */
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /pondok-subusalam/login'); // Perbaikan: diarahkan ke halaman login
        exit();
    }
}
