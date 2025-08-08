<?php
// Meneruskan data dari controller ke view
$message = $_GET['message'] ?? '';
$action = $_GET['action'] ?? '';
$berita_edit = $data['berita_edit'] ?? null;
$berita_list = $data['berita_list'] ?? [];
?>

<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Berita</h1>
        <button id="tambahBeritaBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Berita
        </button>
    </div>

    <!-- Kotak pesan -->
    <?php if ($message): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($message) ?></span>
    </div>
    <?php endif; ?>

    <!-- Form Tambah/Edit Berita -->
    <div id="beritaForm" class="bg-white rounded-lg shadow-md p-6 mb-8 <?= ($action === 'tambah' || $action === 'edit') ? '' : 'hidden' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= $berita_edit ? 'Edit Berita' : 'Tambah Berita Baru' ?></h2>
        <form action="/pondok-subusalam/admin/kelola_berita" method="POST" enctype="multipart/form-data">
            <?php if ($berita_edit): ?>
                <input type="hidden" name="id_berita" value="<?= htmlspecialchars($berita_edit['id']) ?>">
                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($berita_edit['gambar']) ?>">
            <?php endif; ?>
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Berita</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($berita_edit['judul'] ?? '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="konten" class="block text-gray-700 font-bold mb-2">Isi Berita</label>
                <textarea id="konten" name="konten" rows="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= htmlspecialchars($berita_edit['konten'] ?? '') ?></textarea>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" id="gambar" name="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php if ($berita_edit && $berita_edit['gambar']): ?>
                    <p class="mt-2 text-sm text-gray-500">Gambar saat ini: <img src="/pondok-subusalam/assets/uploads/berita/<?= htmlspecialchars($berita_edit['gambar']) ?>" alt="Gambar Berita" class="h-20 w-20 object-cover rounded-md mt-2"></p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="tanggal_publish" class="block text-sm font-medium text-gray-700">Tanggal Publikasi</label>
                <input type="date" id="tanggal_publish" name="tanggal_publish" value="<?= htmlspecialchars($berita_edit['tanggal_publish'] ?? date('Y-m-d')) ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="/pondok-subusalam/admin/kelola_berita" id="batalBeritaBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Berita -->
    <div id="beritaListTable" class="bg-white rounded-lg shadow-md p-6 <?= ($action === 'tambah' || $action === 'edit') ? 'hidden' : '' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Berita</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Gambar</th>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Tanggal</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (!empty($berita_list)): ?>
                        <?php foreach ($berita_list as $berita): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($berita['id']) ?></td>
                                <td class="py-3 px-6 text-left">
                                    <img src="/pondok-subusalam/assets/uploads/berita/<?= htmlspecialchars($berita['gambar']) ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="w-16 h-16 object-cover rounded-lg">
                                </td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($berita['judul']) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($berita['tanggal_publish']) ?></td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="/pondok-subusalam/admin/kelola_berita?action=edit&id=<?= htmlspecialchars($berita['id']) ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/pondok-subusalam/admin/kelola_berita?action=hapus&id=<?= htmlspecialchars($berita['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">Tidak ada data berita.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('tambahBeritaBtn').addEventListener('click', function() {
        document.getElementById('beritaForm').classList.remove('hidden');
        document.getElementById('beritaListTable').classList.add('hidden');
        this.classList.add('hidden');
    });

    document.getElementById('batalBeritaBtn').addEventListener('click', function() {
        document.getElementById('beritaForm').classList.add('hidden');
        document.getElementById('beritaListTable').classList.remove('hidden');
        document.getElementById('tambahBeritaBtn').classList.remove('hidden');
        // Redirect to clear URL parameters
        window.location.href = '/pondok-subusalam/admin/kelola_berita';
    });

    // Tampilkan form edit jika ada parameter edit di URL
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('action') && (urlParams.get('action') === 'edit' || urlParams.get('action') === 'tambah')) {
            document.getElementById('beritaForm').classList.remove('hidden');
            document.getElementById('tambahBeritaBtn').classList.add('hidden');
            document.getElementById('beritaListTable').classList.add('hidden');
        }
    };
</script>
