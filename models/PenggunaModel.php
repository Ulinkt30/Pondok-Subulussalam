<?php

/**
 * Class PenggunaModel
 * Mengelola interaksi database untuk data pengguna.
 */
class PenggunaModel {
    private $conn;

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

    /**
     * Mengambil semua data pengguna dari database.
     * @return array Daftar pengguna.
     */
    public function getAllUsers() {
        $users = [];
        $sql = "SELECT id, username, role FROM users";
        $result = $this->conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    /**
     * Mengambil data pengguna berdasarkan ID.
     * @param int $id ID pengguna.
     * @return array|null Data pengguna atau null jika tidak ditemukan.
     */
    public function getUserById($id) {
        $sql = "SELECT id, username, role FROM users WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    /**
     * Mengambil data pengguna berdasarkan username.
     * @param string $username Username pengguna.
     * @return array|null Data pengguna atau null jika tidak ditemukan.
     */
    public function getUserByUsername($username) {
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    /**
     * Menambahkan pengguna baru ke database.
     * @param string $username Username.
     * @param string $password Password.
     * @param string $role Role pengguna.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function addUser($username, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $username, $hashed_password, $role);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Mengupdate data pengguna.
     * @param int $id ID pengguna.
     * @param string $username Username baru.
     * @param string|null $password Password baru (opsional).
     * @param string $role Role baru.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function updateUser($id, $username, $password, $role) {
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?";
            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->bind_param("sssi", $username, $hashed_password, $role, $id);
                return $stmt->execute();
            }
        } else {
            $sql = "UPDATE users SET username = ?, role = ? WHERE id = ?";
            if ($stmt = $this->conn->prepare($sql)) {
                $stmt->bind_param("ssi", $username, $role, $id);
                return $stmt->execute();
            }
        }
        return false;
    }

    /**
     * Menghapus pengguna dari database.
     * @param int $id ID pengguna.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }
}
