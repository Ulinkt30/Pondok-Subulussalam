<?php

/**
 * Class AdminModel
 * Mengelola interaksi database untuk data admin.
 */
class AdminModel {
    private $conn;

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

    /**
     * Mengambil semua data admin dari database.
     * @return array Daftar admin.
     */
    public function getAllUsers() {
        $users = [];
        $sql = "SELECT id, username, nama_lengkap FROM admin";
        $result = $this->conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    /**
     * Mengambil data admin berdasarkan ID.
     * @param int $id ID admin.
     * @return array|null Data admin atau null jika tidak ditemukan.
     */
    public function getUserById($id) {
        $sql = "SELECT id, username, nama_lengkap FROM admin WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    /**
     * Mengambil data admin berdasarkan username.
     * @param string $username Username admin.
     * @return array|null Data admin atau null jika tidak ditemukan.
     */
    public function findByUsername($username) {
        $sql = "SELECT id, username, password, nama_lengkap FROM admin WHERE username = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    /**
     * Menambahkan admin baru ke database.
     * @param string $username Username.
     * @param string $password Password.
     * @param string $nama_lengkap Nama lengkap admin.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function addUser($username, $password, $nama_lengkap) {
        // Periksa apakah username sudah ada
        $user = $this->findByUsername($username);
        if ($user) {
            return false; // Gagal karena username sudah ada
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $username, $hashed_password, $nama_lengkap);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Mengupdate data admin.
     * @param int $id ID admin.
     * @param string $username Username baru.
     * @param string|null $password Password baru (opsional).
     * @param string $nama_lengkap Nama lengkap baru.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function updateUser($id, $username, $password, $nama_lengkap) {
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET username = ?, password = ?, nama_lengkap = ? WHERE id = ?";
            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->bind_param("sssi", $username, $hashed_password, $nama_lengkap, $id);
                return $stmt->execute();
            }
        } else {
            $sql = "UPDATE admin SET username = ?, nama_lengkap = ? WHERE id = ?";
            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->bind_param("ssi", $username, $nama_lengkap, $id);
                return $stmt->execute();
            }
        }
        return false;
    }

    /**
     * Menghapus admin dari database.
     * @param int $id ID admin.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function deleteUser($id) {
        $sql = "DELETE FROM admin WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }
}
