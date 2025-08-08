<?php

// Tangkap URL yang diminta oleh pengguna
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Sanitasi URL untuk keamanan
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = rtrim($url, '/');
$url = explode('/', $url);

// Router
// Arahkan permintaan URL ke controller dan method yang sesuai
switch ($url[0]) {
    case 'home':
        require_once ROOT_PATH . '/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    case 'profil':
        require_once ROOT_PATH . '/controllers/ProfilController.php';
        $controller = new ProfilController();
        $controller->index();
        break;
    case 'sejarah':
        require_once ROOT_PATH . '/controllers/ProfilController.php';
        $controller = new ProfilController();
        $controller->sejarah();
        break;
    case 'visi-misi':
        require_once ROOT_PATH . '/controllers/ProfilController.php';
        $controller = new ProfilController();
        $controller->visiMisi();
        break;
    case 'tenaga-pendidik':
        require_once ROOT_PATH . '/controllers/ProfilController.php';
        $controller = new ProfilController();
        $controller->tenagaPendidik();
        break;
    case 'fasilitas':
        require_once ROOT_PATH . '/controllers/FasilitasController.php'; // Kode ini diaktifkan
        $controller = new FasilitasController(); // Kode ini diaktifkan
        $controller->index(); // Kode ini diaktifkan
        break;
    case 'kontak':
        require_once ROOT_PATH . '/controllers/KontakController.php';
        $controller = new KontakController();
        $controller->index();
        break;
    case 'berita':
        require_once ROOT_PATH . '/controllers/BeritaController.php';
        $controller = new BeritaController();
        $controller->index();
        break;
    case 'galeri':
        require_once ROOT_PATH . '/controllers/GaleriController.php';
        $controller = new GaleriController();
        $controller->index();
        break;
    case 'admin':
        require_once ROOT_PATH . '/includes/auth_check.php';
        require_once ROOT_PATH . '/controllers/AdminController.php';
        $controller = new AdminController();
        // Arahkan ke sub-halaman admin
        $sub_page = $url[1] ?? 'dashboard';
        
        // Konversi dari snake_case atau kebab-case ke camelCase
        $method_name = lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $sub_page))));
        
        if (method_exists($controller, $method_name)) {
            $controller->$method_name();
        } else {
            // Jika sub-halaman tidak ada, kembali ke dashboard
            $controller->dashboard();
        }
        break;
    case 'login':
        require_once ROOT_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        require_once ROOT_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        // Halaman 404 atau arahkan ke home
        // require_once ROOT_PATH . '/controllers/HomeController.php';
        // $controller = new HomeController();
        // $controller->index();
        break;
}
