<?php

// Class ini bertanggung jawab untuk interaksi dengan tabel `profil` di database
class ProfilModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Mengambil semua profil dari database.
     * @return array Mengembalikan array dari semua profil.
     */
    public function getAllProfil() {
        $sql = "SELECT * FROM profil";
        $result = $this->conn->query($sql);
        $profil = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profil[] = $row;
            }
        }
        return $profil;
    }

    /**
     * Mengambil satu profil berdasarkan nama halaman.
     * @param string $halaman Nama halaman profil.
     * @return array|null Mengembalikan data profil jika ditemukan, atau null jika tidak.
     */
    public function getProfilByHalaman($halaman) {
        $sql = "SELECT * FROM profil WHERE halaman = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $halaman);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mengupdate profil yang sudah ada.
     * @param string $halaman Nama halaman profil.
     * @param string $judul Judul profil.
     * @param string $konten Konten profil.
     * @param string|null $foto Nama file foto profil.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function updateProfil($halaman, $judul, $konten, $foto) {
        $sql = "UPDATE profil SET judul = ?, konten = ?, foto = ? WHERE halaman = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $judul, $konten, $foto, $halaman);
        return $stmt->execute();
    }

    /**
     * Menambahkan profil baru ke database.
     * @param string $halaman Nama halaman profil.
     * @param string $judul Judul profil.
     * @param string $konten Konten profil.
     * @param string|null $foto Nama file foto profil.
     * @return bool Mengembalikan true jika berhasil, false jika gagal.
     */
    public function addProfil($halaman, $judul, $konten, $foto) {
        $sql = "INSERT INTO profil (halaman, judul, konten, foto) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $halaman, $judul, $konten, $foto);
        return $stmt->execute();
    }
}
