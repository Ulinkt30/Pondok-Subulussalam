<main class="w-full min-h-screen">
    <section class="max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="py-4 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/pondok-subusalam/home" class="text-[#ba181b] hover:text-indigo-800 inline-flex items-center">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="flex items-center">
                    <a href="/pondok-subusalam/profil" class="text-[#ba181b] hover:text-indigo-800 inline-flex items-center">
                        <i class="fas fa-user-circle mr-1"></i>Profil
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                </li>
                <li class="flex items-center">
                    <a href="/pondok-subusalam/tenaga-pendidik" class="text-[#ba181b] hover:text-indigo-800 inline-flex items-center" aria-current="page">
                        <i class="fas fa-user-friends mr-1"></i>Tenaga Pendidik
                    </a>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl md:text-4xl font-extrabold text-[#2b2d42] mb-4 text-center">
            <span class="md:hidden">Tenaga Pendidik</span>
            <span class="hidden md:block">SUSUNAN PENGURUS DAN TENAGA PENDIDIK</span>
        </h1>
        <p class="text-lg text-gray-600 text-center mb-10">
            Berikut adalah daftar pengurus dan tenaga pendidik di Pondok Pesantren Subusalam.
        </p>

        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8 space-x-4">
            <button id="tab-pengurus" class="px-6 py-2 rounded-full font-semibold text-white bg-[#ba181b] hover:bg-[#e5383b] transition-colors duration-300">Pengurus</button>
            <button id="tab-pendidik" class="px-6 py-2 rounded-full font-semibold text-gray-800 bg-gray-200 hover:bg-gray-300 transition-colors duration-300">Tenaga Pendidik</button>
        </div>

        <!-- Tab Content -->
        <div id="content-pengurus" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Data Pengurus -->
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ust. M. Haizir Kamja, S.Pd.I</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Ketua Yayasan dan Guru</p>
                        <p><strong>Alumni</strong>: Musthafawiayah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ust. Mohd Nizom Hm, S.Pd.I</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Pimpinan Pontren dan Guru</p>
                        <p><strong>Alumni</strong>: Musthafawiayah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ustz. Susilawati, S.Pd.I</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Bendahara Yayasan dan Guru</p>
                        <p><strong>Alumni</strong>: Alumni Durian Lecah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ustz. Fitriani, S.Pd.I</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Sekretaris Yayasan dan Guru</p>
                        <p><strong>Alumni</strong>: Alumni Nizhomisyar`iyah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ustz. Misbahul Hidayah</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Bendahara Pontren</p>
                        <p><strong>Alumni</strong>: Alumni Subulussalam</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-pendidik" class="tab-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Data Tenaga Pendidik -->
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ust. Abdul Muas, S.Sy</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni Musthafawiayah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ust. M. Sukur, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni Musthafawiayah</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ustz. Nini Karlina, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni Ponpes Subulussalam</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Ustz. Ima Suryana, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni Subulussalam</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Dadang Ariansyah, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni STKIP Bangko</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Hermini, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni STKIP Bangko</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Elpi Wahyuni, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni UIN Jambi</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Nurlina, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru Mapel</p>
                        <p><strong>Alumni</strong>: Alumni UIN Jambi</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Zelvi, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru</p>
                        <p><strong>Alumni</strong>: Alumni STAI SMQ Bangko</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Asri Marila, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru</p>
                        <p><strong>Alumni</strong>: Alumni STAI SMQ Bangko</p>
                    </div>
                </div>
                <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                    <div class="font-bold text-lg text-[#2b2d42]">Febriawati, S.Pd</div>
                    <div class="text-gray-800 mt-2">
                        <p><strong>Jabatan</strong>: Guru</p>
                        <p><strong>Alumni</strong>: Alumni STAI SMQ Bangko</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabPengurus = document.getElementById('tab-pengurus');
        const tabPendidik = document.getElementById('tab-pendidik');
        const contentPengurus = document.getElementById('content-pengurus');
        const contentPendidik = document.getElementById('content-pendidik');

        function setActiveTab(activeButton, inactiveButton, activeContent, inactiveContent) {
            activeButton.classList.remove('bg-gray-200', 'text-gray-800');
            activeButton.classList.add('bg-[#ba181b]', 'text-white');
            inactiveButton.classList.remove('bg-[#ba181b]', 'text-white');
            inactiveButton.classList.add('bg-gray-200', 'text-gray-800');
            activeContent.classList.remove('hidden');
            inactiveContent.classList.add('hidden');
        }

        tabPengurus.addEventListener('click', () => {
            setActiveTab(tabPengurus, tabPendidik, contentPengurus, contentPendidik);
        });

        tabPendidik.addEventListener('click', () => {
            setActiveTab(tabPendidik, tabPengurus, contentPendidik, contentPengurus);
        });
    });
</script>
