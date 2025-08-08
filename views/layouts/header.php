<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pondok Subulussalam</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: "Inter", sans-serif;
            padding-top: 70px;
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header-gradient {
            background-image: linear-gradient(to right, #facc15, #fef08a);
        }
        .nav-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }
    </style>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-50 shadow-md bg-[#ba181b]">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo dan Nama Pesantren -->
            <div class="flex items-center space-x-2">
                <!-- Nama -->
                <span class="text-xl font-bold text-[#ffffff]">Pondok Subulussalam</span>
            </div>

            <!-- Navigasi Desktop -->
            <nav class="hidden md:flex space-x-6">
                <a href="/pondok-subusalam/home" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Beranda</a>
                <a href="/pondok-subusalam/profil" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Profil</a>
                <a href="/pondok-subusalam/berita" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Berita</a>
                <a href="/pondok-subusalam/galeri" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Galeri</a>
                <a href="/pondok-subusalam/fasilitas" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Fasilitas</a>
                <a href="/pondok-subusalam/kontak" class="nav-link text-[#f5c2c2] hover:text-[#e5383b] font-semibold transition duration-300">Kontak</a>
            </nav>

            <!-- Tombol Login/Logout dan Menu Mobile -->
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/pondok-subusalam/admin/dashboard" class="hidden md:block bg-[#fada7a] text-[#3674b5] px-4 py-2 rounded-full font-semibold hover:bg-[#f5f0cd] transition duration-300">Dashboard</a>
                    <a href="/pondok-subusalam/logout" class="hidden md:block text-[#fada7a] hover:text-[#f5f0cd] font-semibold">Logout</a>
                <?php else: ?>
                    <a href="/pondok-subusalam/login" class="hidden md:flex items-center space-x-2 bg-[#dee2e6] text-[#3674b5] px-4 py-2 rounded-full font-semibold hover:bg-[#cfcfcf] transition duration-300">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
                
                <!-- Tombol hamburger untuk mobile -->
                <button id="mobile-menu-button" class="md:hidden text-[#ffffff] focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Menu Mobile (Tersembunyi secara default) -->
        <nav id="mobile-menu" class="hidden md:hidden shadow-lg py-2 bg-[#ba181b]">
            <a href="/pondok-subusalam/home" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Beranda</a>
            <a href="/pondok-subusalam/profil" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Profil</a>
            <a href="/pondok-subusalam/berita" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Berita</a>
            <a href="/pondok-subusalam/galeri" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Galeri</a>
            <a href="/pondok-subusalam/fasilitas" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Fasilitas</a>
            <a href="/pondok-subusalam/kontak" class="block px-4 py-2 text-[#f5c2c2] hover:bg-[#e5383b]">Kontak</a>
            <hr class="my-2 border-[#e5383b]">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/pondok-subusalam/admin/dashboard" class="block px-4 py-2 text-[#ffffff] hover:bg-[#e5383b]">Dashboard</a>
                <a href="/pondok-subusalam/logout" class="block px-4 py-2 text-[#ffffff] hover:bg-[#e5383b]">Logout</a>
            <?php else: ?>
                <a href="/pondok-subusalam/login" class="flex items-center space-x-2 block px-4 py-2 text-[#ffffff] hover:bg-[#e5383b]">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="flex-grow">
    <!-- Konten utama akan dimuat di sini -->
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
