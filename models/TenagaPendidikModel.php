<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `tenaga_pendidik` di database
class TenagaPendidikModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua data tenaga pendidik dari database.
     * @return array Mengembalikan array dari semua data tenaga pendidik.
     */
    public function getAllTenagaPendidik() {
        $sql = "SELECT * FROM tenaga_pendidik ORDER BY urutan ASC, id DESC";
        $result = $this->conn->query($sql);
        $tenaga_pendidik = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tenaga_pendidik[] = $row;
            }
        }
        return $tenaga_pendidik;
    }

    /**
     * Mengambil satu data tenaga pendidik berdasarkan ID.
     * @param int $id ID tenaga pendidik.
     * @return array|null Mengembalikan data tenaga pendidik jika ditemukan, atau null jika tidak.
     */
    public function getTenagaPendidikById($id) {
        $sql = "SELECT * FROM tenaga_pendidik WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Menambahkan data tenaga pendidik baru ke database.
     * @param string $nama Nama tenaga pendidik.
     * @param string $jabatan Jabatan tenaga pendidik.
     * @param string|null $foto Nama file foto tenaga pendidik.
     * @param string|null $pendidikan_terakhir Pendidikan terakhir tenaga pendidik.
     * @param string|null $deskripsi Deskripsi tenaga pendidik.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addTenagaPendidik($nama, $jabatan, $foto, $pendidikan_terakhir, $deskripsi) {
        $sql = "INSERT INTO tenaga_pendidik (nama, jabatan, foto, pendidikan_terakhir, deskripsi) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nama, $jabatan, $foto, $pendidikan_terakhir, $deskripsi);
        return $stmt->execute();
    }

    /**
     * Mengupdate data tenaga pendidik yang sudah ada.
     * @param int $id ID tenaga pendidik.
     * @param string $nama Nama tenaga pendidik.
     * @param string $jabatan Jabatan tenaga pendidik.
     * @param string|null $foto Nama file foto tenaga pendidik.
     * @param string|null $pendidikan_terakhir Pendidikan terakhir tenaga pendidik.
     * @param string|null $deskripsi Deskripsi tenaga pendidik.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updateTenagaPendidik($id, $nama, $jabatan, $foto, $pendidikan_terakhir, $deskripsi) {
        $sql = "UPDATE tenaga_pendidik SET nama = ?, jabatan = ?, foto = ?, pendidikan_terakhir = ?, deskripsi = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $nama, $jabatan, $foto, $pendidikan_terakhir, $deskripsi, $id);
        return $stmt->execute();
    }

    /**
     * Menghapus data tenaga pendidik dari database.
     * @param int $id ID tenaga pendidik.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function deleteTenagaPendidik($id) {
        $sql = "DELETE FROM tenaga_pendidik WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
