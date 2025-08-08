<?php
// Meneruskan data dari controller ke view
$galeri_list = $data['galeri_list'] ?? [];
$galeri_edit = $data['galeri_edit'] ?? null;
$message = $_GET['message'] ?? '';
?>

<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Galeri</h1>
        <button id="tambahGaleriBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Galeri
        </button>
    </div>

    <!-- Kotak pesan -->
    <?php if ($message): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($message) ?></span>
    </div>
    <?php endif; ?>

    <!-- Form Tambah/Edit Galeri -->
    <div id="galeriForm" class="bg-white rounded-lg shadow-md p-6 mb-8 <?= $galeri_edit ? '' : 'hidden' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= $galeri_edit ? 'Edit Galeri' : 'Tambah Galeri Baru' ?></h2>
        <form action="/pondok-subusalam/admin/kelola_galeri" method="POST" enctype="multipart/form-data">
            <?php if ($galeri_edit): ?>
                <input type="hidden" name="id_galeri" value="<?= htmlspecialchars($galeri_edit['id']) ?>">
                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($galeri_edit['gambar']) ?>">
            <?php endif; ?>
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-bold mb-2">Judul</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($galeri_edit['judul'] ?? '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= htmlspecialchars($galeri_edit['deskripsi'] ?? '') ?></textarea>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-bold mb-2">Gambar</label>
                <input type="file" id="gambar" name="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php if ($galeri_edit && $galeri_edit['gambar']): ?>
                    <p class="text-sm text-gray-600 mt-2">Gambar saat ini: <a href="/pondok-subusalam/assets/uploads/galeri/<?= htmlspecialchars($galeri_edit['gambar']) ?>" target="_blank" class="text-blue-500 hover:underline"><?= htmlspecialchars($galeri_edit['gambar']) ?></a></p>
                <?php endif; ?>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <button type="button" id="batalGaleriBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    Batal
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Galeri -->
    <div id="galeriListTable" class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Galeri</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Gambar</th>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (!empty($galeri_list)): ?>
                        <?php foreach ($galeri_list as $galeri): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($galeri['id']) ?></td>
                                <td class="py-3 px-6 text-left">
                                    <img src="/pondok-subusalam/assets/uploads/galeri/<?= htmlspecialchars($galeri['gambar']) ?>" alt="<?= htmlspecialchars($galeri['judul']) ?>" class="w-16 h-16 object-cover rounded-lg">
                                </td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($galeri['judul']) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars(substr($galeri['deskripsi'], 0, 50)) ?>...</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="/pondok-subusalam/admin/kelola_galeri?action=edit&id=<?= htmlspecialchars($galeri['id']) ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/pondok-subusalam/admin/kelola_galeri?action=hapus&id=<?= htmlspecialchars($galeri['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">Tidak ada data galeri.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('tambahGaleriBtn').addEventListener('click', function() {
        document.getElementById('galeriForm').classList.remove('hidden');
        document.getElementById('galeriListTable').classList.add('hidden'); // Menambahkan ini untuk menyembunyikan daftar galeri
        this.classList.add('hidden');
    });

    document.getElementById('batalGaleriBtn').addEventListener('click', function() {
        document.getElementById('galeriForm').classList.add('hidden');
        document.getElementById('galeriListTable').classList.remove('hidden'); // Menambahkan ini untuk menampilkan kembali daftar galeri
        document.getElementById('tambahGaleriBtn').classList.remove('hidden');
        // Reset form
        document.getElementById('galeriForm').querySelector('form').reset();
        document.querySelector('h2').innerText = 'Tambah Galeri Baru';
        document.querySelector('input[name="id_galeri"]').value = '';
        document.querySelector('input[name="gambar_lama"]').value = '';
    });

    // Tampilkan form edit jika ada parameter edit di URL
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('action') && urlParams.get('action') === 'edit') {
            document.getElementById('galeriForm').classList.remove('hidden');
            document.getElementById('tambahGaleriBtn').classList.add('hidden');
            document.getElementById('galeriListTable').classList.add('hidden'); // Menambahkan ini untuk menyembunyikan daftar saat mode edit
        }
    };
</script>
