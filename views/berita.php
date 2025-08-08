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
                    <a href="/pondok-subusalam/berita" class="text-[#ba181b] hover:text-[#2b2d42] inline-flex items-center" aria-current="page">
                        <i class="fas fa-newspaper mr-1"></i>Berita
                    </a>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-4xl font-extrabold text-[#2b2d42] mb-4 text-center">Berita Pondok Pesantren Subusalam</h1>
        <p class="text-lg text-gray-600 text-center mb-10">
            Temukan berita dan kegiatan terbaru dari pondok pesantren kami.
        </p>

        <!-- Bagian untuk daftar berita -->
         <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (isset($data['berita']) && !empty($data['berita'])): ?>
                    <?php foreach ($data['berita'] as $berita): ?>
                        <div class="bg-gray-100 rounded-lg p-6">
                            <img src="/pondok-subusalam/assets/uploads/berita/<?= htmlspecialchars($berita['gambar']) ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="w-full h-48 object-cover rounded-md mb-4">
                            <h3 class="text-xl font-bold text-[#2b2d42]"><?= htmlspecialchars($berita['judul']) ?></h3>
                            <p class="text-sm text-gray-500 mt-1">Tanggal: <?= date('d F Y', strtotime($berita['tanggal_publish'])) ?></p>
                            <p class="mt-4 text-gray-700"><?= substr(htmlspecialchars($berita['konten']), 0, 150) ?>...</p>
                            <a href="/pondok-subusalam/berita?id=<?= $berita['id'] ?>" class="mt-4 inline-block text-indigo-500 hover:underline">Baca Selengkapnya &rarr;</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-span-full text-center text-gray-500">Tidak ada berita yang ditemukan.</p>
                <?php endif; ?>
            </div>
    </section>
</main>
