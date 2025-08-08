<?php
// Meneruskan data dari controller ke view
$message = $_GET['message'] ?? '';
$action = $_GET['action'] ?? '';
$user_edit = $data['user_edit'] ?? null;
$user_list = $data['user_list'] ?? [];
?>

<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Pengguna</h1>
        <button id="tambahUserBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Pengguna
        </button>
    </div>

    <!-- Kotak pesan -->
    <?php if ($message): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($message) ?></span>
    </div>
    <?php endif; ?>

    <!-- Form Tambah/Edit Pengguna -->
    <div id="userForm" class="bg-white rounded-lg shadow-md p-6 mb-8 <?= ($action === 'tambah' || $action === 'edit') ? '' : 'hidden' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= $user_edit ? 'Edit Pengguna' : 'Tambah Pengguna Baru' ?></h2>
        <form action="/pondok-subusalam/admin/kelola_pengguna" method="POST">
            <?php if ($user_edit): ?>
                <input type="hidden" name="id_user" value="<?= htmlspecialchars($user_edit['id']) ?>">
            <?php endif; ?>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user_edit['username'] ?? '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" <?= $user_edit ? '' : 'required' ?>>
                <?php if ($user_edit): ?>
                    <p class="text-sm text-gray-600 mt-2">Biarkan kosong jika tidak ingin mengubah password.</p>
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($user_edit['nama_lengkap'] ?? '') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="/pondok-subusalam/admin/kelola_pengguna" id="batalUserBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Pengguna -->
    <div id="userListTable" class="bg-white rounded-lg shadow-md p-6 <?= ($action === 'tambah' || $action === 'edit') ? 'hidden' : '' ?>">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Pengguna</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Nama Lengkap</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (!empty($user_list)): ?>
                        <?php foreach ($user_list as $user): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="py-3 px-6 text-left"><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="/pondok-subusalam/admin/kelola_pengguna?action=edit&id=<?= htmlspecialchars($user['id']) ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/pondok-subusalam/admin/kelola_pengguna?action=hapus&id=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center text-gray-500">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('tambahUserBtn').addEventListener('click', function() {
        document.getElementById('userForm').classList.remove('hidden');
        document.getElementById('userListTable').classList.add('hidden');
        this.classList.add('hidden');
    });

    document.getElementById('batalUserBtn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('userForm').classList.add('hidden');
        document.getElementById('userListTable').classList.remove('hidden');
        document.getElementById('tambahUserBtn').classList.remove('hidden');
        // Redirect to clear URL parameters
        window.location.href = '/pondok-subusalam/admin/kelola_pengguna';
    });

    // Tampilkan form edit jika ada parameter edit di URL
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('action') && (urlParams.get('action') === 'edit' || urlParams.get('action') === 'tambah')) {
            document.getElementById('userForm').classList.remove('hidden');
            document.getElementById('tambahUserBtn').classList.add('hidden');
            document.getElementById('userListTable').classList.add('hidden');
        }
    };
</script>
