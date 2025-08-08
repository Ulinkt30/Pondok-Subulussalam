<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `pengurus` di database
class PengurusModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua data pengurus dari database.
     * @return array Mengembalikan array dari semua data pengurus.
     */
    public function getAllPengurus() {
        $sql = "SELECT * FROM pengurus ORDER BY urutan ASC, id DESC";
        $result = $this->conn->query($sql);
        $pengurus = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pengurus[] = $row;
            }
        }
        return $pengurus;
    }

    /**
     * Mengambil satu data pengurus berdasarkan ID.
     * @param int $id ID pengurus.
     * @return array|null Mengembalikan data pengurus jika ditemukan, atau null jika tidak.
     */
    public function getPengurusById($id) {
        $sql = "SELECT * FROM pengurus WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Menambahkan data pengurus baru ke database.
     * @param string $nama Nama pengurus.
     * @param string $jabatan Jabatan pengurus.
     * @param string|null $foto Nama file foto pengurus.
     * @param string|null $deskripsi Deskripsi pengurus.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addPengurus($nama, $jabatan, $foto, $deskripsi) {
        $sql = "INSERT INTO pengurus (nama, jabatan, foto, deskripsi) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nama, $jabatan, $foto, $deskripsi);
        return $stmt->execute();
    }

    /**
     * Mengupdate data pengurus yang sudah ada.
     * @param int $id ID pengurus.
     * @param string $nama Nama pengurus.
     * @param string $jabatan Jabatan pengurus.
     * @param string|null $foto Nama file foto pengurus.
     * @param string|null $deskripsi Deskripsi pengurus.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updatePengurus($id, $nama, $jabatan, $foto, $deskripsi) {
        $sql = "UPDATE pengurus SET nama = ?, jabatan = ?, foto = ?, deskripsi = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $nama, $jabatan, $foto, $deskripsi, $id);
        return $stmt->execute();
    }

    /**
     * Menghapus data pengurus dari database.
     * @param int $id ID pengurus.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function deletePengurus($id) {
        $sql = "DELETE FROM pengurus WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
