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
                    <a href="/pondok-subusalam/fasilitas" class="text-[#ba181b] hover:text-[#2b2d42] inline-flex items-center" aria-current="page">
                        <i class="fas fa-building mr-1"></i>Fasilitas
                    </a>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-4xl font-extrabold text-[#2b2d42] mb-4 text-center">Fasilitas Pondok Pesantren Subusalam</h1>
        <p class="text-lg text-gray-600 text-center mb-10">
            Berikut adalah fasilitas yang kami miliki untuk menunjang kegiatan santri.
        </p>

        <!-- Bagian untuk daftar fasilitas -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (isset($data['fasilitas']) && !empty($data['fasilitas'])): ?>
                <?php foreach ($data['fasilitas'] as $fasilitas): ?>
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105">
                        <img src="/pondok-subusalam/assets/uploads/fasilitas/<?= htmlspecialchars($fasilitas['foto']) ?>" alt="<?= htmlspecialchars($fasilitas['nama_fasilitas']) ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-[#2b2d42]"><?= htmlspecialchars($fasilitas['nama_fasilitas']) ?></h3>
                            <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($fasilitas['deskripsi']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-center text-gray-500">Tidak ada fasilitas yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
