    <main class="container mx-auto p-4 mt-8">
        <section class="bg-white rounded-xl shadow-lg p-10">
            <?php if (isset($data['berita'])): ?>
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <!-- Kolom Kiri untuk Gambar -->
                    <div class="w-full md:w-1/2">
                        <img src="/pondok-subusalam/assets/uploads/berita/<?= htmlspecialchars($data['berita']['gambar']) ?>" alt="<?= htmlspecialchars($data['berita']['judul']) ?>" class="w-full max-h-96 object-cover rounded-md">
                    </div>
                    <!-- Kolom Kanan untuk Teks -->
                    <div class="w-full md:w-1/2">
                        <h1 class="text-4xl font-extrabold text-indigo-800 mb-2"><?= htmlspecialchars($data['berita']['judul']) ?></h1>
                        <p class="text-sm text-gray-500 mb-6">Tanggal: <?= date('d F Y', strtotime($data['berita']['tanggal_publish'])) ?></p>
                        <div class="prose max-w-none text-gray-700">
                            <p><?= nl2br(htmlspecialchars($data['berita']['konten'])) ?></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h1 class="text-3xl font-extrabold text-red-600 text-center">Berita tidak ditemukan.</h1>
            <?php endif; ?>
            <div class="mt-8 text-center">
                <a href="/pondok-subusalam/berita" class="text-indigo-600 hover:text-indigo-800 font-medium">&larr; Kembali ke Berita</a>
            </div>
        </section>
    </main>
