<?php

/**
 * Class LogModel
 * Bertanggung jawab untuk mencatat dan mengambil aktivitas admin dari database.
 */
class LogModel {
    private $conn;

    /**
     * Konstruktor untuk LogModel.
     * @param mysqli $db Objek koneksi database MySQLi.
     */
    public function __construct(mysqli $db) {
        $this->conn = $db;
    }
    
    /**
     * Mencatat aktivitas admin baru ke database.
     * @param string $userId ID pengguna yang melakukan aktivitas.
     * @param string $modul Modul yang terpengaruh (misalnya, 'Berita', 'Fasilitas').
     * @param string $keterangan Deskripsi aktivitas.
     * @param string $status Status aktivitas (misalnya, 'berhasil', 'gagal').
     */
    public function addLog($userId, $modul, $keterangan, $status = 'berhasil') {
        // Menggunakan prepared statement dengan mysqli
        $sql = "INSERT INTO logs (user_id, modul, keterangan, status, created_at) VALUES (?, ?, ?, ?, NOW())";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ssss", $userId, $modul, $keterangan, $status);
            $stmt->execute();
            $stmt->close();
        } else {
            // Dalam lingkungan produksi, Anda bisa mencatat error ini ke file log
            error_log("Error menambahkan log: " . $this->conn->error);
        }
    }
    
    /**
     * Mengambil daftar aktivitas terbaru dari database.
     * @param int $limit Jumlah log yang ingin diambil.
     * @return array Daftar log.
     */
    public function getLatestLogs($limit = 5) {
        $logs = [];
        // Menggunakan prepared statement dengan mysqli
        $sql = "SELECT * FROM logs ORDER BY created_at DESC LIMIT ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $limit);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $logs[] = $row;
            }
            $stmt->close();
        } else {
            error_log("Error mengambil log: " . $this->conn->error);
        }
        return $logs;
    }
}
