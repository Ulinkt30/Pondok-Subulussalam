<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `galeri` di database
class GaleriModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua item galeri dari database.
     * @return array Mengembalikan array dari semua item galeri.
     */
    public function getAllGaleri() {
        $sql = "SELECT * FROM galeri ORDER BY tanggal_upload DESC, id DESC";
        $result = $this->conn->query($sql);
        $galeri = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $galeri[] = $row;
            }
        }
        return $galeri;
    }

    /**
     * Mengambil satu item galeri berdasarkan ID.
     * @param int $id ID item galeri.
     * @return array|null Mengembalikan data item galeri jika ditemukan, atau null jika tidak.
     */
    public function getGaleriById($id) {
        $sql = "SELECT * FROM galeri WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Menambahkan item galeri baru ke database.
     * @param string $judul Judul item galeri.
     * @param string $deskripsi Deskripsi item galeri.
     * @param string $gambar Nama file gambar item galeri.
     * @param string $tanggal_upload Tanggal upload.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addGaleri($judul, $deskripsi, $gambar, $tanggal_upload) {
        $sql = "INSERT INTO galeri (judul, deskripsi, gambar, tanggal_upload) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $judul, $deskripsi, $gambar, $tanggal_upload);
        return $stmt->execute();
    }

    /**
     * Mengupdate item galeri yang sudah ada.
     * @param int $id ID item galeri.
     * @param string $judul Judul item galeri.
     * @param string $deskripsi Deskripsi item galeri.
     * @param string $gambar Nama file gambar item galeri.
     * @param string $tanggal_upload Tanggal upload.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updateGaleri($id, $judul, $deskripsi, $gambar, $tanggal_upload) {
        $sql = "UPDATE galeri SET judul = ?, deskripsi = ?, gambar = ?, tanggal_upload = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $judul, $deskripsi, $gambar, $tanggal_upload, $id);
        return $stmt->execute();
    }

    /**
     * Menghapus item galeri dari database.
     * @param int $id ID item galeri.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function deleteGaleri($id) {
        $sql = "DELETE FROM galeri WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
