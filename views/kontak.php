<?php
    // File ini akan di-include di antara header.php dan footer.php
    // Tidak perlu tag <html>, <head>, atau <body>
?>

 <main class="w-full min-h-screen">
    <section class="max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
      <nav class="py-4 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/pondok-subusalam/home" class="text-[#ba181b] hover:text-[#2b2d42] inline-flex items-center">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="flex items-center">
                    <a href="/pondok-subusalam/kontak" class="text-[#ba181b] hover:text-[#2b2d42] inline-flex items-center" aria-current="page">
                        <i class="fas fa-envelope mr-1"></i>Kontak
                    </a>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-4xl font-extrabold mb-4 text-center text-[#2b2d42]">Hubungi Kami</h1>
        <p class="text-lg text-center text-gray-600 mb-10">
            Kami siap membantu Anda. Silakan hubungi kami melalui informasi di bawah ini.
        </p>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Informasi Kontak -->
            <div class="bg-gray-100 rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-[#2b2d42] mb-4">Informasi Kontak</h3>
                <div class="space-y-4 text-gray-800">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-[#2b2d42] mr-3 text-xl"></i>
                        <span>Jalan Pondok Subulussalam, Desa Pulau Raman, Kabupaten Merangin, Jambi</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone-alt text-[#2b2d42] mr-3 text-xl"></i>
                        <span>+62 812-345-6789</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-[#2b2d42] mr-3 text-xl"></i>
                        <span>info@subulussalam.id</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-globe text-[#2b2d42] mr-3 text-xl"></i>
                        <span>www.pondoksubulussalam.id</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Formulir Kontak -->
            <div class="bg-gray-100 rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-[#2b2d42] mb-4">Kirim Pesan</h3>
                <form action="/pondok-subusalam/kirim-pesan" method="POST" class="space-y-4">
                    <div>
                        <label for="nama" class="block text-[#2b2d42] font-semibold">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="w-full mt-1 p-2 rounded-md border border-gray-300 focus:ring-[#578fca] focus:border-[#578fca]">
                    </div>
                    <div>
                        <label for="email" class="block text-[#2b2d42] font-semibold">Email</label>
                        <input type="email" id="email" name="email" class="w-full mt-1 p-2 rounded-md border border-gray-300 focus:ring-[#578fca] focus:border-[#578fca]">
                    </div>
                    <div>
                        <label for="pesan" class="block text-[#2b2d42] font-semibold">Pesan Anda</label>
                        <textarea id="pesan" name="pesan" rows="4" class="w-full mt-1 p-2 rounded-md border border-gray-300 focus:ring-[#578fca] focus:border-[#578fca]"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-[#660708] text-white py-2 rounded-full font-semibold hover:bg-[#578fca] transition duration-300">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
