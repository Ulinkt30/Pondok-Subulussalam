<?php

class FasilitasModel {
    private $conn;
    private $table_name = "fasilitas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllFasilitas() {
        // Menggunakan nama kolom asli agar sesuai dengan view
        $query = "SELECT id, nama_fasilitas, deskripsi, foto, urutan FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->execute();
            // Menggunakan get_result() dan fetch_all() untuk mysqli
            $result = $stmt->get_result();
            $allFasilitas = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $allFasilitas;
        } else {
            // Tampilkan error jika prepare() gagal
            echo "Error dalam mempersiapkan query: " . $this->conn->error;
            return false;
        }
    }
    
    /**
     * Menambah fasilitas baru ke database.
     * @param string $nama_fasilitas Nama fasilitas.
     * @param string $deskripsi Deskripsi fasilitas.
     * @param string $foto Nama file foto.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function addFasilitas($nama_fasilitas, $deskripsi, $foto) {
        $query = "INSERT INTO " . $this->table_name . " (nama_fasilitas, deskripsi, foto) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);

        // Periksa apakah prepare() berhasil
        if ($stmt === false) {
            // Ini akan memberikan informasi error dari database
            echo "Error dalam mempersiapkan query: " . $this->conn->error;
            return false;
        }
        
        // Sanitasi data
        $nama_fasilitas = htmlspecialchars(strip_tags($nama_fasilitas));
        $deskripsi = htmlspecialchars(strip_tags($deskripsi));
        $foto = htmlspecialchars(strip_tags($foto));
        
        // Bind parameter
        // Menggunakan bind_param() untuk mysqli
        $stmt->bind_param("sss", $nama_fasilitas, $deskripsi, $foto);
        
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        
        // Tampilkan error jika execute() gagal
        echo "Error saat mengeksekusi query: " . $stmt->error;
        $stmt->close();
        
        return false;
    }

    /**
     * Mengambil data fasilitas berdasarkan ID.
     * @param int $id ID fasilitas.
     * @return array|false Data fasilitas jika ditemukan, false jika tidak.
     */
    public function getFasilitasById($id) {
        // Menggunakan nama kolom asli agar sesuai dengan view
        $query = "SELECT id, nama_fasilitas, deskripsi, foto, urutan FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $fasilitas = $result->fetch_assoc();
            $stmt->close();
            return $fasilitas;
        } else {
            echo "Error dalam mempersiapkan query: " . $this->conn->error;
            return false;
        }
    }
    
    /**
     * Menghapus fasilitas dari database.
     * @param int $id ID fasilitas.
     * @return bool True jika berhasil, false jika gagal.
     */
    public function deleteFasilitas($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Error saat mengeksekusi query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error dalam mempersiapkan query: " . $this->conn->error;
        }
        return false;
    }
}
