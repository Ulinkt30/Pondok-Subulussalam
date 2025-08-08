<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `pimpinan` di database
class PimpinanModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua data pimpinan dari database.
     * @return array Mengembalikan array dari semua data pimpinan.
     */
    public function getAllPimpinan() {
        $sql = "SELECT * FROM pimpinan ORDER BY urutan ASC, id DESC";
        $result = $this->conn->query($sql);
        $pimpinan = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pimpinan[] = $row;
            }
        }
        return $pimpinan;
    }

    /**
     * Mengambil satu data pimpinan berdasarkan ID.
     * @param int $id ID pimpinan.
     * @return array|null Mengembalikan data pimpinan jika ditemukan, atau null jika tidak.
     */
    public function getPimpinanById($id) {
        $sql = "SELECT * FROM pimpinan WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Menambahkan data pimpinan baru ke database.
     * @param string $nama Nama pimpinan.
     * @param string $jabatan Jabatan pimpinan.
     * @param string|null $foto Nama file foto pimpinan.
     * @param string|null $deskripsi Deskripsi pimpinan.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addPimpinan($nama, $jabatan, $foto, $deskripsi) {
        $sql = "INSERT INTO pimpinan (nama, jabatan, foto, deskripsi) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nama, $jabatan, $foto, $deskripsi);
        return $stmt->execute();
    }

    /**
     * Mengupdate data pimpinan yang sudah ada.
     * @param int $id ID pimpinan.
     * @param string $nama Nama pimpinan.
     * @param string $jabatan Jabatan pimpinan.
     * @param string|null $foto Nama file foto pimpinan.
     * @param string|null $deskripsi Deskripsi pimpinan.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updatePimpinan($id, $nama, $jabatan, $foto, $deskripsi) {
        $sql = "UPDATE pimpinan SET nama = ?, jabatan = ?, foto = ?, deskripsi = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $nama, $jabatan, $foto, $deskripsi, $id);
        return $stmt->execute();
    }

    /**
     * Menghapus data pimpinan dari database.
     * @param int $id ID pimpinan.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function deletePimpinan($id) {
        $sql = "DELETE FROM pimpinan WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
