<?php
// Di sini, kita hanya perlu menggunakan objek LogModel yang sudah diinisialisasi
// di AdminController.php. Kita tidak perlu mendeklarasikan ulang kelas di sini.

// Ambil data log terbaru dari variabel $data yang dikirim dari controller
$aktivitas_terakhir = $data['aktivitas_terakhir'] ?? [];

// Fungsi pembantu untuk menentukan ikon dan warna
function get_log_icon($action) {
    if (strpos($action, 'berhasil') !== false || strpos($action, 'ditambahkan') !== false || strpos(strtolower($action), 'diperbarui') !== false || strpos($action, 'diunggah') !== false) {
        return '<i class="fas fa-check-circle text-green-500 mr-2"></i>';
    } elseif (strpos($action, 'gagal') !== false) {
        return '<i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>';
    } else {
        return '<i class="fas fa-info-circle text-blue-500 mr-2"></i>';
    }
}

// Fungsi pembantu untuk mengonversi timestamp menjadi format "waktu yang lalu"
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}
?>

<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
            <i class="fas fa-newspaper text-4xl text-blue-500 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800">Kelola Berita</h2>
            <p class="text-sm text-gray-600 mt-2">Tambah, edit, atau hapus berita dan artikel.</p>
            <a href="/pondok-subusalam/admin/kelola_berita" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition duration-300">
                Lihat Berita
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
            <i class="fas fa-building text-4xl text-green-500 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800">Kelola Fasilitas</h2>
            <p class="text-sm text-gray-600 mt-2">Kelola informasi fasilitas pondok pesantren.</p>
            <a href="/pondok-subusalam/admin/kelola_fasilitas" class="mt-4 px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-300">
                Lihat Fasilitas
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
            <i class="fas fa-images text-4xl text-yellow-500 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800">Kelola Galeri</h2>
            <p class="text-sm text-gray-600 mt-2">Atur foto dan video di halaman galeri.</p>
            <a href="/pondok-subusalam/admin/kelola_galeri" class="mt-4 px-4 py-2 bg-yellow-500 text-gray-800 rounded-full hover:bg-yellow-600 transition duration-300">
                Lihat Galeri
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
            <i class="fas fa-user-friends text-4xl text-red-500 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800">Kelola Pengguna</h2>
            <p class="text-sm text-gray-600 mt-2">Atur data pengguna dan hak akses.</p>
            <a href="/pondok-subusalam/admin/kelola_pengguna" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition duration-300">
                Lihat Pengguna
            </a>
        </div>
    </div>
    
    <!-- Bagian Aktivitas Terakhir (Dinamis) -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Aktivitas Terakhir</h2>
        <ul class="divide-y divide-gray-200">
            <?php if (!empty($aktivitas_terakhir)): ?>
                <?php foreach ($aktivitas_terakhir as $log): ?>
                    <li class="py-3 text-gray-600" data-timestamp="<?= htmlspecialchars($log['created_at']) ?>">
                        <?= get_log_icon($log['keterangan']) ?>
                        <span class="font-semibold"><?= htmlspecialchars($log['modul']) ?>:</span> <?= htmlspecialchars($log['keterangan']) ?>
                        <span class="text-xs text-gray-400 float-right log-time"><?= htmlspecialchars(time_elapsed_string($log['created_at'])) ?></span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="py-3 text-gray-500 text-center">Tidak ada aktivitas terbaru.</li>
            <?php endif; ?>
        </ul>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        /**
         * Mengonversi timestamp menjadi format "waktu yang lalu".
         * @param {string} datetime Tanggal dalam format string.
         * @returns {string} String waktu yang berlalu.
         */
        function formatTimeAgo(datetime) {
            const now = new Date();
            const ago = new Date(datetime);
            const seconds = Math.floor((now - ago) / 1000);

            let interval = seconds / 31536000;
            if (interval > 1) {
                return Math.floor(interval) + ' tahun yang lalu';
            }
            interval = seconds / 2592000;
            if (interval > 1) {
                return Math.floor(interval) + ' bulan yang lalu';
            }
            interval = seconds / 604800;
            if (interval > 1) {
                return Math.floor(interval) + ' minggu yang lalu';
            }
            interval = seconds / 86400;
            if (interval > 1) {
                return Math.floor(interval) + ' hari yang lalu';
            }
            interval = seconds / 3600;
            if (interval > 1) {
                return Math.floor(interval) + ' jam yang lalu';
            }
            interval = seconds / 60;
            if (interval > 1) {
                return Math.floor(interval) + ' menit yang lalu';
            }
            return Math.floor(seconds) + ' detik yang lalu';
        }

        /**
         * Memperbarui tampilan waktu di semua log aktivitas.
         */
        function updateLogTimes() {
            const logItems = document.querySelectorAll('li[data-timestamp]');
            logItems.forEach(item => {
                const timestamp = item.dataset.timestamp;
                const timeSpan = item.querySelector('.log-time');
                if (timestamp && timeSpan) {
                    timeSpan.textContent = formatTimeAgo(timestamp);
                }
            });
        }

        // Jalankan saat halaman pertama kali dimuat
        updateLogTimes();

        // Perbarui setiap 30 detik
        setInterval(updateLogTimes, 30000);
    });
</script>
