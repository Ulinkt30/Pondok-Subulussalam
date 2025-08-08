<?php

// Class ini bertanggung jawab untuk panel administrasi
class AdminController {

    private $beritaModel;
    private $fasilitasModel;
    private $galeriModel;
    private $pengurusModel;
    private $pimpinanModel;
    private $tenagaPendidikModel;
    private $logModel;
    private $adminModel;

    public function __construct() {
        global $conn;
        // Inisialisasi model
        require_once ROOT_PATH . '/models/BeritaModel.php';
        require_once ROOT_PATH . '/models/FasilitasModel.php';
        require_once ROOT_PATH . '/models/GaleriModel.php';
        require_once ROOT_PATH . '/models/PengurusModel.php';
        require_once ROOT_PATH . '/models/PimpinanModel.php';
        require_once ROOT_PATH . '/models/TenagaPendidikModel.php';
        require_once ROOT_PATH . '/models/LogModel.php';
        require_once ROOT_PATH . '/models/AdminModel.php';

        $this->beritaModel = new BeritaModel($conn);
        $this->fasilitasModel = new FasilitasModel($conn);
        $this->galeriModel = new GaleriModel($conn);
        $this->pengurusModel = new PengurusModel($conn);
        $this->pimpinanModel = new PimpinanModel($conn);
        $this->tenagaPendidikModel = new TenagaPendidikModel($conn);
        $this->logModel = new LogModel($conn);
        $this->adminModel = new AdminModel($conn);
    }
    
    /**
     * Metode utama untuk panel admin.
     * Tugasnya adalah mengarahkan ke sub-halaman admin yang berbeda.
     */
    public function index() {
        // Secara default, arahkan ke dashboard
        $this->dashboard();
    }

    /**
     * Menampilkan halaman dashboard admin.
     */
    public function dashboard() {
        // Ambil data log terbaru dari LogModel
        $data['aktivitas_terakhir'] = $this->logModel->getLatestLogs(5);

        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/dashboard.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }

    /**
     * Mengelola semua operasi terkait berita (tambah, edit, hapus).
     */
    public function kelolaBerita() {
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;
        $message = '';
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $konten = $_POST['konten'] ?? '';
            $tanggal_publish = $_POST['tanggal_publish'] ?? '';
            $gambar_lama = $_POST['gambar_lama'] ?? '';
            $id_berita = $_POST['id_berita'] ?? null;

            $gambar = $gambar_lama;
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = ROOT_PATH . '/assets/uploads/berita/';
                $gambar = basename($_FILES['gambar']['name']);
                $target_file = $upload_dir . $gambar;
                move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists($upload_dir . $gambar_lama)) {
                    unlink($upload_dir . $gambar_lama);
                }
            }

            if ($id_berita) {
                if ($this->beritaModel->updateBerita($id_berita, $judul, $konten, $gambar, $tanggal_publish)) {
                    $message = "Berita berhasil diupdate.";
                    $this->logModel->addLog('admin', 'Berita', "Berita \"$judul\" berhasil diupdate.");
                } else {
                    $message = "Gagal mengupdate berita.";
                    $this->logModel->addLog('admin', 'Berita', "Gagal mengupdate berita \"$judul\".", 'gagal');
                }
            } else {
                if ($this->beritaModel->addBerita($judul, $konten, $gambar, $tanggal_publish)) {
                    $message = "Berita berhasil ditambahkan.";
                    $this->logModel->addLog('admin', 'Berita', "Berita \"$judul\" berhasil ditambahkan.");
                } else {
                    $message = "Gagal menambahkan berita.";
                    $this->logModel->addLog('admin', 'Berita', "Gagal menambahkan berita \"$judul\".", 'gagal');
                }
            }
            header("Location: /pondok-subusalam/admin/kelola_berita?message=" . urlencode($message));
            exit();
        }

        // Ambil data yang dibutuhkan untuk tampilan
        if ($action === 'edit' && $id) {
            $data['berita_edit'] = $this->beritaModel->getBeritaById($id);
        } elseif ($action === 'hapus' && $id) {
            $berita = $this->beritaModel->getBeritaById($id);
            if ($berita) {
                if (file_exists(ROOT_PATH . '/assets/uploads/berita/' . $berita['gambar'])) {
                    unlink(ROOT_PATH . '/assets/uploads/berita/' . $berita['gambar']);
                }
                $this->beritaModel->deleteBerita($id);
                $message = "Berita berhasil dihapus.";
                $this->logModel->addLog('admin', 'Berita', "Berita \"{$berita['judul']}\" berhasil dihapus.");
            } else {
                $message = "Berita tidak ditemukan.";
                $this->logModel->addLog('admin', 'Berita', "Gagal menghapus berita.", 'gagal');
            }
            header("Location: /pondok-subusalam/admin/kelola_berita?message=" . urlencode($message));
            exit();
        }
        
        $data['berita_list'] = $this->beritaModel->getAllBerita();
        
        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/kelola_berita.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }

    /**
     * Mengelola semua operasi terkait galeri (tambah, edit, hapus).
     */
    public function kelolaGaleri() {
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;
        $message = '';
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $tanggal_upload = $_POST['tanggal_upload'] ?? date('Y-m-d');
            $gambar_lama = $_POST['gambar_lama'] ?? '';
            $id_galeri = $_POST['id_galeri'] ?? null;

            $gambar = $gambar_lama;
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = ROOT_PATH . '/assets/uploads/galeri/';
                $gambar = basename($_FILES['gambar']['name']);
                $target_file = $upload_dir . $gambar;
                move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists($upload_dir . $gambar_lama)) {
                    unlink($upload_dir . $gambar_lama);
                }
            }

            if ($id_galeri) {
                if ($this->galeriModel->updateGaleri($id_galeri, $judul, $deskripsi, $gambar, $tanggal_upload)) {
                    $message = "Item galeri berhasil diupdate.";
                    $this->logModel->addLog('admin', 'Galeri', "Item galeri \"$judul\" berhasil diupdate.");
                } else {
                    $message = "Gagal mengupdate item galeri.";
                    $this->logModel->addLog('admin', 'Galeri', "Gagal mengupdate item galeri \"$judul\".", 'gagal');
                }
            } else {
                if ($this->galeriModel->addGaleri($judul, $deskripsi, $gambar, $tanggal_upload)) {
                    $message = "Item galeri berhasil ditambahkan.";
                    $this->logModel->addLog('admin', 'Galeri', "Item galeri \"$judul\" berhasil ditambahkan.");
                } else {
                    $message = "Gagal menambahkan item galeri.";
                    $this->logModel->addLog('admin', 'Galeri', "Gagal menambahkan item galeri \"$judul\".", 'gagal');
                }
            }
            header("Location: /pondok-subusalam/admin/kelola_galeri?message=" . urlencode($message));
            exit();
        }
        
        // Ambil data yang dibutuhkan untuk tampilan
        if ($action === 'edit' && $id) {
            $data['galeri_edit'] = $this->galeriModel->getGaleriById($id);
        } elseif ($action === 'hapus' && $id) {
            $galeri = $this->galeriModel->getGaleriById($id);
            if ($galeri) {
                if (file_exists(ROOT_PATH . '/assets/uploads/galeri/' . $galeri['gambar'])) {
                    unlink(ROOT_PATH . '/assets/uploads/galeri/' . $galeri['gambar']);
                }
                $this->galeriModel->deleteGaleri($id);
                $message = "Item galeri berhasil dihapus.";
                $this->logModel->addLog('admin', 'Galeri', "Item galeri \"{$galeri['judul']}\" berhasil dihapus.");
            } else {
                $message = "Item galeri tidak ditemukan.";
                $this->logModel->addLog('admin', 'Galeri', "Gagal menghapus item galeri.", 'gagal');
            }
            header("Location: /pondok-subusalam/admin/kelola_galeri?message=" . urlencode($message));
            exit();
        }

        $data['galeri_list'] = $this->galeriModel->getAllGaleri();
        
        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/kelola_galeri.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }

    /**
     * Mengelola semua operasi terkait fasilitas (tambah, edit, hapus).
     */
    public function kelolaFasilitas() {
        // Logika untuk menampilkan dan mengelola fasilitas
        $data['fasilitas'] = $this->fasilitasModel->getAllFasilitas();

        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;
        $message = '';

        // Cek apakah ada data POST untuk menambah/mengedit fasilitas
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_fasilitas = $_POST['nama_fasilitas'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $foto_lama = $_POST['foto_lama'] ?? '';
            $id_fasilitas = $_POST['id'] ?? null;

            $foto = $foto_lama;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                // Proses upload gambar dengan validasi
                $target_dir = ROOT_PATH . "/assets/uploads/fasilitas/";
                $file_name = uniqid() . '_' . basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $file_name;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Cek apakah file adalah gambar
                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                if ($check === false) {
                    $message = "File bukan gambar.";
                    $uploadOk = 0;
                }

                // Cek ukuran file
                if ($_FILES["foto"]["size"] > 500000) {
                    $message = "Ukuran file terlalu besar.";
                    $uploadOk = 0;
                }

                // Hanya izinkan format file tertentu
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $message = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        $foto = $file_name;
                        // Hapus foto lama jika ada
                        if ($foto_lama && file_exists($upload_dir . $foto_lama)) {
                            unlink($upload_dir . $foto_lama);
                        }
                    } else {
                        $message = "Maaf, terjadi error saat mengunggah file Anda.";
                        $uploadOk = 0;
                    }
                } else {
                    $foto = $foto_lama; // Gunakan foto lama jika upload gagal
                }
            }

            if ($id_fasilitas) {
                if ($this->fasilitasModel->updateFasilitas($id_fasilitas, $nama_fasilitas, $deskripsi, $foto)) {
                    $message = "Data fasilitas berhasil diupdate.";
                    $this->logModel->addLog('admin', 'Fasilitas', "Fasilitas \"$nama_fasilitas\" berhasil diupdate.");
                } else {
                    $message = "Gagal mengupdate data fasilitas.";
                    $this->logModel->addLog('admin', 'Fasilitas', "Gagal mengupdate fasilitas \"$nama_fasilitas\".", 'gagal');
                }
            } else {
                if ($this->fasilitasModel->addFasilitas($nama_fasilitas, $deskripsi, $foto)) {
                    $message = "Data fasilitas berhasil ditambahkan.";
                    $this->logModel->addLog('admin', 'Fasilitas', "Fasilitas \"$nama_fasilitas\" berhasil ditambahkan.");
                } else {
                    $message = "Gagal menambahkan data fasilitas.";
                    $this->logModel->addLog('admin', 'Fasilitas', "Gagal menambahkan fasilitas \"$nama_fasilitas\".", 'gagal');
                }
            }
            header("Location: /pondok-subusalam/admin/kelola_fasilitas?message=" . urlencode($message));
            exit();
        }

        if ($action === 'edit' && $id) {
            $data['fasilitas_edit'] = $this->fasilitasModel->getFasilitasById($id);
        } elseif ($action === 'hapus' && $id) {
            $fasilitas = $this->fasilitasModel->getFasilitasById($id);
            if ($fasilitas) {
                if (file_exists(ROOT_PATH . '/assets/uploads/fasilitas/' . $fasilitas['foto'])) {
                    unlink(ROOT_PATH . '/assets/uploads/fasilitas/' . $fasilitas['foto']);
                }
                $this->fasilitasModel->deleteFasilitas($id);
                $message = "Data fasilitas berhasil dihapus.";
                $this->logModel->addLog('admin', 'Fasilitas', "Fasilitas \"{$fasilitas['nama_fasilitas']}\" berhasil dihapus.");
            } else {
                $message = "Data fasilitas tidak ditemukan.";
                $this->logModel->addLog('admin', 'Fasilitas', "Gagal menghapus fasilitas.", 'gagal');
            }
            header("Location: /pondok-subusalam/admin/kelola_fasilitas?message=" . urlencode($message));
            exit();
        }

        $data['fasilitas_list'] = $this->fasilitasModel->getAllFasilitas();

        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/kelola_fasilitas.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }

    /**
     * Metode untuk mengelola pengguna (tambah, edit, hapus).
     * Menggunakan tabel 'admin' yang sudah ada.
     */
    public function kelolaPengguna() {
        $action = $_GET['action'] ?? '';
        $id = $_GET['id'] ?? null;
        $message = '';
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $nama_lengkap = $_POST['nama_lengkap'] ?? '';
            $id_user = $_POST['id_user'] ?? null;

            if ($id_user) {
                if ($this->adminModel->updateUser($id_user, $username, $password, $nama_lengkap)) {
                    $message = "Pengguna berhasil diupdate.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"$username\" berhasil diupdate.");
                } else {
                    $message = "Gagal mengupdate pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal mengupdate pengguna \"$username\".", 'gagal');
                }
            } else {
                if ($this->adminModel->addUser($username, $password, $nama_lengkap)) {
                    $message = "Pengguna berhasil ditambahkan.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"$username\" berhasil ditambahkan.");
                } else {
                    $message = "Gagal menambahkan pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menambahkan pengguna \"$username\".", 'gagal');
                }
            }
            header("Location: /pondok-subusalam/admin/kelola_pengguna?message=" . urlencode($message));
            exit();
        }

        if ($action === 'edit' && $id) {
            $data['user_edit'] = $this->adminModel->getUserById($id);
        } elseif ($action === 'hapus' && $id) {
            $user = $this->adminModel->getUserById($id);
            if ($user) {
                if ($this->adminModel->deleteUser($id)) {
                    $message = "Pengguna berhasil dihapus.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Pengguna \"{$user['username']}\" berhasil dihapus.");
                } else {
                    $message = "Gagal menghapus pengguna.";
                    $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menghapus pengguna \"{$user['username']}\".", 'gagal');
                }
            } else {
                $message = "Pengguna tidak ditemukan.";
                $this->logModel->addLog('admin', 'Kelola Pengguna', "Gagal menghapus pengguna.", 'gagal');
            }
            header("Location: /pondok-subusalam/admin/kelola_pengguna?message=" . urlencode($message));
            exit();
        }

        $data['user_list'] = $this->adminModel->getAllUsers();
        
        require_once ROOT_PATH . '/views/layouts/admin_header.php';
        require_once ROOT_PATH . '/views/layouts/admin_sidebar.php';
        require_once ROOT_PATH . '/views/admin/kelola_pengguna.php';
        require_once ROOT_PATH . '/views/layouts/admin_footer.php';
    }
}
