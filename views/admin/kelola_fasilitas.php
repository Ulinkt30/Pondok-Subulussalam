<?php
// Meneruskan data dari controller ke view
$message = $_GET['message'] ?? '';
$action = $_GET['action'] ?? '';
$fasilitas_edit = $data['fasilitas_edit'] ?? null;
$fasilitas_list = $data['fasilitas_list'] ?? [];
?>

<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Fasilitas</h1>
        <button id="tambahFasilitasBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
        </button>
    </div>

    <!-- Kotak pesan -->
    <?php if ($message): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($message) ?></span>
    </div>
    <?php endif; ?>

    <!-- Form Tambah/Edit Fasilitas -->
    <div id="fasilitasForm" class="bg-white rounded-lg shadow-md p-6 mb-8 <?= ($action === 'tambah' || $action === 'edit') ? '' : 'hidden' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= $fasilitas_edit ? 'Edit Fasilitas' : 'Tambah Fasilitas Baru' ?></h2>
        <form action="/pondok-subusalam/admin/kelola_fasilitas" method="POST" enctype="multipart/form-data">
            <?php if ($fasilitas_edit): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($fasilitas_edit['id']) ?>">
                <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($fasilitas_edit['foto']) ?>">
            <?php endif; ?>
            <div class="mb-4">
                <label for="nama_fasilitas" class="block text-gray-700 font-bold mb-2">Nama Fasilitas</label>
                <input type="text" id="nama_fasilitas" name="nama_fasilitas" value="<?= htmlspecialchars($fasilitas_edit['nama_fasilitas'] ?? '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= htmlspecialchars($fasilitas_edit['deskripsi'] ?? '') ?></textarea>
            </div>
            <div class="mb-4">
                <label for="foto" class="block text-gray-700 font-bold mb-2">Foto</label>
                <input type="file" id="foto" name="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <?php if ($fasilitas_edit && $fasilitas_edit['foto']): ?>
                    <p class="text-sm text-gray-600 mt-2">Foto saat ini: <img src="/pondok-subusalam/assets/uploads/fasilitas/<?= htmlspecialchars($fasilitas_edit['foto']) ?>" alt="<?= htmlspecialchars($fasilitas_edit['nama_fasilitas']) ?>" class="h-20 w-20 object-cover rounded-md mt-2"></p>
                <?php endif; ?>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="/pondok-subusalam/admin/kelola_fasilitas" id="batalFasilitasBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Fasilitas -->
    <div id="fasilitasListTable" class="bg-white rounded-lg shadow-md p-6 <?= ($action === 'tambah' || $action === 'edit') ? 'hidden' : '' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Fasilitas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Foto</th>
                        <th class="py-3 px-6 text-left">Nama Fasilitas</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (!empty($fasilitas_list)): ?>
                        <?php foreach ($fasilitas_list as $fasilitas): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($fasilitas['id']) ?></td>
                                <td class="py-3 px-6 text-left">
                                    <img src="/pondok-subusalam/assets/uploads/fasilitas/<?= htmlspecialchars($fasilitas['foto']) ?>" alt="<?= htmlspecialchars($fasilitas['nama_fasilitas']) ?>" class="w-16 h-16 object-cover rounded-lg">
                                </td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($fasilitas['nama_fasilitas']) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars(substr($fasilitas['deskripsi'], 0, 50)) ?>...</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="/pondok-subusalam/admin/kelola_fasilitas?action=edit&id=<?= htmlspecialchars($fasilitas['id']) ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/pondok-subusalam/admin/kelola_fasilitas?action=hapus&id=<?= htmlspecialchars($fasilitas['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center text-gray-500">Tidak ada data fasilitas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('tambahFasilitasBtn').addEventListener('click', function() {
        document.getElementById('fasilitasForm').classList.remove('hidden');
        document.getElementById('fasilitasListTable').classList.add('hidden');
        this.classList.add('hidden');
    });

    document.getElementById('batalFasilitasBtn').addEventListener('click', function() {
        document.getElementById('fasilitasForm').classList.add('hidden');
        document.getElementById('fasilitasListTable').classList.remove('hidden');
        document.getElementById('tambahFasilitasBtn').classList.remove('hidden');
        // Redirect to clear URL parameters
        window.location.href = '/pondok-subusalam/admin/kelola_fasilitas';
    });

    // Tampilkan form edit jika ada parameter edit di URL
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('action') && (urlParams.get('action') === 'edit' || urlParams.get('action') === 'tambah')) {
            document.getElementById('fasilitasForm').classList.remove('hidden');
            document.getElementById('tambahFasilitasBtn').classList.add('hidden');
            document.getElementById('fasilitasListTable').classList.add('hidden');
        }
    };
</script>
