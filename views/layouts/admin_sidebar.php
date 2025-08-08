<?php
// Mendapatkan URI saat ini dari server, dan membersihkannya dari query string
$current_uri = strtok($_SERVER['REQUEST_URI'], '?');

// Fungsi untuk memeriksa apakah tautan aktif
function is_active($url) {
    global $current_uri;
    // Periksa apakah URI saat ini dimulai dengan URI tautan
    return $current_uri === '/pondok-subusalam' . $url;
}

// Logika khusus untuk Dashboard karena URL-nya lebih pendek
function is_dashboard_active() {
    global $current_uri;
    // Cek apakah URI saat ini adalah /pondok-subusalam/admin atau hanya /pondok-subusalam
    // Ini menangani kasus di mana beranda admin mungkin tidak memiliki path tambahan
    return $current_uri === '/pondok-subusalam/admin' || $current_uri === '/pondok-subusalam';
}
?>

<!-- Sidebar -->
<aside class="w-64 bg-[#ba181b] text-white flex flex-col">
    <div class="p-4 text-center text-xl font-bold border-b border-gray-700">
        Panel Admin
    </div>
    <nav class="flex-grow p-4">
        <!-- Tautan Dashboard -->
        <a href="/pondok-subusalam/admin" class="flex items-center p-3 rounded-lg transition duration-300
            <?php if (is_dashboard_active()) { echo 'bg-[#8d1818] text-white font-bold border-l-4 border-blue-500'; } else { echo 'text-gray-300 hover:bg-[#8d1818] hover:text-white'; } ?>
            ">
            <i class="fas fa-home w-5 h-5 mr-3"></i>
            <span>Dashboard</span>
        </a>
        <!-- Tautan Kelola Berita -->
        <a href="/pondok-subusalam/admin/kelola_berita" class="flex items-center p-3 rounded-lg transition duration-300 mt-2
            <?php if (is_active('/admin/kelola_berita')) { echo 'bg-[#8d1818] text-white font-bold border-l-4 border-blue-500'; } else { echo 'text-gray-300 hover:bg-[#8d1818] hover:text-white'; } ?>
            ">
            <i class="fas fa-newspaper w-5 h-5 mr-3"></i>
            <span>Kelola Berita</span>
        </a>
        <!-- Tautan Kelola Galeri -->
        <a href="/pondok-subusalam/admin/kelola_galeri" class="flex items-center p-3 rounded-lg transition duration-300 mt-2
            <?php if (is_active('/admin/kelola_galeri')) { echo 'bg-[#8d1818] text-white font-bold border-l-4 border-blue-500'; } else { echo 'text-gray-300 hover:bg-[#8d1818] hover:text-white'; } ?>
            ">
            <i class="fas fa-images w-5 h-5 mr-3"></i>
            <span>Kelola Galeri</span>
        </a>
        <!-- Tautan Kelola Fasilitas -->
        <a href="/pondok-subusalam/admin/kelola_fasilitas" class="flex items-center p-3 rounded-lg transition duration-300 mt-2
            <?php if (is_active('/admin/kelola_fasilitas')) { echo 'bg-[#8d1818] text-white font-bold border-l-4 border-blue-500'; } else { echo 'text-gray-300 hover:bg-[#8d1818] hover:text-white'; } ?>
            ">
            <i class="fas fa-building w-5 h-5 mr-3"></i>
            <span>Kelola Fasilitas</span>
        </a>
        <!-- Tautan Kelola Pengguna -->
        <a href="/pondok-subusalam/admin/kelola_pengguna" class="flex items-center p-3 rounded-lg transition duration-300 mt-2
            <?php if (is_active('/admin/kelola_pengguna')) { echo 'bg-[#8d1818] text-white font-bold border-l-4 border-blue-500'; } else { echo 'text-gray-300 hover:bg-[#8d1818] hover:text-white'; } ?>
            ">
            <i class="fas fa-users w-5 h-5 mr-3"></i>
            <span>Kelola Pengguna</span>
        </a>
        <!-- Tautan Logout -->
        <a href="/pondok-subusalam/logout" class="flex items-center p-3 rounded-lg transition duration-300 mt-2
            <?php if (is_active('/logout')) { echo 'bg-[#d82a2a] text-white font-bold border-l-4 border-red-700'; } else { echo 'text-gray-300 hover:bg-red-700 hover:text-white'; } ?>
            ">
            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
            <span>Logout</span>
        </a>
    </nav>
</aside>

<!-- Main content area -->
<div class="flex-1 p-8 overflow-y-auto">

