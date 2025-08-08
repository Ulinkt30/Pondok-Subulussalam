<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `berita` di database
class BeritaModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua berita dari database.
     * @return array Mengembalikan array dari semua berita.
     */
    public function getAllBerita() {
        $sql = "SELECT * FROM berita ORDER BY tanggal_publish DESC, created_at DESC";
        $result = $this->conn->query($sql);
        $berita = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $berita[] = $row;
            }
        }
        return $berita;
    }

    /**
     * Mengambil satu berita berdasarkan ID.
     * @param int $id ID berita.
     * @return array|null Mengembalikan data berita jika ditemukan, atau null jika tidak.
     */
    public function getBeritaById($id) {
        $sql = "SELECT * FROM berita WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Menambahkan berita baru ke database.
     * @param string $judul Judul berita.
     * @param string $konten Konten berita.
     * @param string $gambar Nama file gambar berita.
     * @param string $tanggal_publish Tanggal publikasi.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addBerita($judul, $konten, $gambar, $tanggal_publish) {
        $sql = "INSERT INTO berita (judul, konten, gambar, tanggal_publish) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $judul, $konten, $gambar, $tanggal_publish);
        return $stmt->execute();
    }

    /**
     * Mengupdate berita yang sudah ada.
     * @param int $id ID berita.
     * @param string $judul Judul berita.
     * @param string $konten Konten berita.
     * @param string $gambar Nama file gambar berita.
     * @param string $tanggal_publish Tanggal publikasi.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updateBerita($id, $judul, $konten, $gambar, $tanggal_publish) {
        $sql = "UPDATE berita SET judul = ?, konten = ?, gambar = ?, tanggal_publish = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $judul, $konten, $gambar, $tanggal_publish, $id);
        return $stmt->execute();
    }

    /**
     * Menghapus berita dari database.
     * @param int $id ID berita.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function deleteBerita($id) {
        $sql = "DELETE FROM berita WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
