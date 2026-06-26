<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat batch </title>
    <!-- Using Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4039c9',
                        accent: '#002eff',
                        brand: {
                            bg: '#f1f5fa',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-brand-bg flex h-screen overflow-hidden font-sans text-gray-800 antialiased">

    <!-- Sidebar -->
    <!-- ===== SIDEBAR ===== -->
    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden" onclick="toggleSidebar()"></div>
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 flex min-h-screen w-[280px] flex-shrink-0 -translate-x-full transform flex-col bg-white shadow-md transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
        <!-- Logo -->
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 pb-6 pt-8">
            <img src="/gambar/logo.png" alt="Logo Equogreen" class="h-14 w-14 rounded-full object-cover" />
            <span class="text-2xl font-bold text-gray-800">Equogreen</span>
        </div>

        <!-- Nav Menu -->
        <nav class="flex flex-1 flex-col gap-1 px-4 py-6">

            <!-- Dashboard -->
            <a href="{{ route('procurement-dashboard') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Periksa Barang (ACTIVE) -->
            <a href="{{ route('procurement-batch_barang') }}"
                class="text-primary hover:bg-primary group flex items-center gap-3 rounded-xl bg-[#eef3ff] px-4 py-3 text-[17px] font-bold text-gray-700 transition-all duration-200 hover:text-white">
                <img src="/gambar/search-database.png" alt="Periksa Barang"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Batch Barang
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Daftar Vendor -->
            <a href="{{ route('procurement-notifikasi') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Daftar Vendor
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Validasi Vendor -->
            <a href="{{ route('procurement-validasi-vendor') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/validasi.png" alt="Validasi Vendor"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Validasi Vendor
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Pengaturan -->


        </nav>

        <!-- Logout -->
        <div class="border-t border-gray-100 px-4 pb-8 pt-4">
            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-red-500 transition-all duration-200 hover:bg-red-50">
                <img src="/gambar/logout.png" alt="Logout" class="h-7 w-7 object-contain" />
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex h-screen w-full flex-1 flex-col overflow-y-auto">

        <!-- Main Workspace Padding Wrapper -->
        <main class="relative flex min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-6 lg:p-8">

            <!-- Top Header -->
            <header class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div class="flex w-full items-center justify-between gap-4 md:w-auto md:justify-start">
                    <div class="flex items-center gap-3 md:gap-6">
                        <div class="flex items-center gap-2 md:gap-4">
                            <!-- Mobile Hamburger -->
                            <button onclick="toggleSidebar()"
                                class="hover:bg-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 lg:hidden">
                                <img src="/gambar/garis3.png" alt="Menu"
                                    class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
                            </button>
                            <!-- Back Button -->
                            <a href="{{ route('procurement-batch_barang') }}"
                                class="hover:bg-primary flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white">
                                <img src="/gambar/back-arrow.png" alt="Back"
                                    class="h-6 w-6 object-contain brightness-0" />
                            </a>
                            <h1 class="text-2xl font-bold leading-none text-[#111827] md:text-[36px]">
                                {{ $year }}</h1>
                        </div>

                        <!-- Tabs Section (Desktop) -->
                        <div class="ml-2 hidden items-center gap-8 md:flex">
                            <a href="{{ route('procurement-batch_barang', ['year' => $year]) }}"
                                class="border-primary whitespace-nowrap border-b-[3px] pb-1 text-[17px] font-bold text-black">
                                Buat Batch
                            </a>
                            <a href="{{ route('procurement-periksa_barang') }}"
                                class="hover:text-primary whitespace-nowrap pb-1 text-[17px] font-medium text-gray-400 transition-colors">
                                Periksa Barang
                            </a>
                        </div>
                    </div>

                    <!-- Right: Profile Section (Mobile Only) -->
                    <div class="flex items-center gap-3 md:hidden">
                        <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>
                        <img src="/gambar/profileup.png" alt="Profil"
                            class="h-10 w-10 rounded-full border border-gray-200 object-cover" />
                    </div>
                </div>

                <!-- Tabs Section (Mobile Only) -->
                <div class="flex items-center gap-6 px-1 md:hidden">
                    <a href="{{ route('procurement-batch_barang', ['year' => $year]) }}"
                        class="border-primary whitespace-nowrap border-b-2 pb-1 text-[15px] font-bold text-black">
                        Buat Batch
                    </a>
                    <a href="{{ route('procurement-periksa_barang') }}"
                        class="hover:text-primary whitespace-nowrap pb-1 text-[15px] font-medium text-gray-400 transition-colors">
                        Periksa Barang
                    </a>
                </div>

                <!-- Right: Profile Section (Desktop Only) -->
                <div class="hidden items-center gap-3 md:flex">
                    <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>
                    <img src="/gambar/profileup.png" alt="Profil"
                        class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
                    <div class="h-10 w-px bg-gray-200"></div>
                    <span class="text-[17px] font-medium text-gray-700">Procurement</span>
                </div>
            </header>

            <!-- Form Workspace / Grid Card -->
            <div class="w-full">

                <div class="w-full rounded-xl border border-gray-400 bg-white p-6 shadow-sm md:p-8">

                    <!-- Toolbar (Search and Add) -->
                    <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                        <input type="text" placeholder="Search"
                            class="w-full rounded-md border border-gray-400 px-4 py-2 text-[15px] outline-none transition focus:border-black sm:w-[60%] lg:w-[40%] xl:w-[70%]">

                        <button onclick="openModal()"
                            class="hover:bg-blue-5 00 flex w-full items-center justify-center gap-2 rounded-md bg-[#1e40ff] px-6 py-2 font-bold text-white transition sm:w-auto">
                            <i class="fa-solid fa-plus text-sm"></i> Tambah Batch
                        </button>
                    </div>

                    <!-- Batch Grid -->
                    <!-- Tabel Batch -->
                    <!-- Title -->
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-black">Daftar Batch</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full overflow-hidden rounded-lg border border-gray-300">
                            <thead class="bg-blue-600">
                                <tr>
                                    <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">No</th>
                                    <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Waktu Mulai
                                    </th>
                                    <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Waktu Selesai
                                    </th>
                                    <th class="border-b px-6 py-3 text-center text-sm font-bold text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="batchTable">
                                @forelse($batches as $index => $batch)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="whitespace-nowrap px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            {{ \Carbon\Carbon::parse($batch->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            {{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('d F Y, H:i') }}
                                        </td>
                                        <td class="flex items-center justify-center gap-4 px-6 py-3 text-center">
                                            <a href="{{ route('procurement-tambah_barang') }}"
                                                class="flex items-center gap-1.5 rounded-md bg-blue-600 px-4 py-2 text-[13px] font-bold text-white shadow-sm transition hover:bg-blue-700">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-[12px]"></i>
                                                Buka
                                            </a>
                                            <!-- Delete Form -->
                                            <form action="{{ route('batch.destroy', $batch->id_batch) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Hapus batch ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 transition-transform hover:scale-110 hover:text-red-800">
                                                    <i class="fa-regular fa-trash-can text-[22px]"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                            Belum ada batch pada tahun {{ $year }}.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- Modal Tambah Batch -->
    <div id="tambahBatchModal"
        class="pointer-events-none fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-0 p-4 opacity-0 transition-all duration-300">
        <div id="modalBox"
            class="bg-brand-bg w-full max-w-[600px] scale-95 transform overflow-hidden rounded-lg border border-gray-400 opacity-0 shadow-xl transition-all duration-300">
            <!-- Modal Header -->
            <div class="flex items-start justify-between bg-white px-6 py-4">
                <div>
                    <h2 class="text-[17px] font-bold leading-tight text-black">Batch Deadline</h2>
                    <p class="mt-1 text-[13px] text-gray-700">Atur tenggat waktu batch pada halaman ini</p>
                </div>
                <button onclick="closeModal()"
                    class="mt-0.5 flex h-8 w-8 items-center justify-center rounded bg-[#ff4a4a] text-white shadow-sm transition hover:bg-red-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('batch.store') }}" method="POST" class="border-t border-gray-400 p-6 pb-8">
                @csrf
                <!-- Badge -->
                <div class="mb-5">
                    <span
                        class="inline-block rounded border border-black bg-white px-4 py-1.5 text-[15px] font-bold leading-none text-black">
                        Batch {{ $year }}
                    </span>
                </div>

                <!-- Time Input Card 2 (Dates) -->
                <div
                    class="mb-4 flex w-full flex-col rounded border border-[#4142cf] bg-[#4142cf] shadow-sm md:flex-row">
                    <!-- Icon Side -->
                    <div
                        class="relative flex h-full min-h-[80px] w-[80px] flex-shrink-0 items-center justify-center border-r border-[#696ce6]">
                        <i class="fa-regular fa-calendar text-[32px] font-light text-white"></i>
                        <i
                            class="fa-solid fa-clock absolute bottom-[22px] right-[20px] rounded-full border border-[#4142cf] bg-[#4142cf] text-[12px] text-white"></i>
                    </div>
                    <!-- Input Side -->
                    <div class="flex-1 p-4 px-5">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1">
                                <label class="mb-1.5 block text-[13px] text-white">Start Date</label>
                                <input type="date" name="start_date" required
                                    class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-[13px] text-black shadow-sm outline-none">
                            </div>
                            <div class="flex-1">
                                <label class="mb-1.5 block text-[13px] text-white">End Date</label>
                                <input type="date" name="end_date" required
                                    class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-[13px] text-black shadow-sm outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Time Input Card 1 (Times) -->
                <div
                    class="mb-6 flex w-full flex-col rounded border border-[#4142cf] bg-[#4142cf] shadow-sm md:flex-row">
                    <!-- Icon Side -->
                    <div
                        class="relative flex h-full min-h-[80px] w-[80px] flex-shrink-0 items-center justify-center border-r border-[#696ce6]">
                        <i class="fa-regular fa-clock text-[32px] font-light text-white"></i>
                        <i
                            class="fa-solid fa-clock absolute bottom-[22px] right-[20px] rounded-full border border-[#4142cf] bg-[#4142cf] text-[12px] text-white"></i>
                    </div>
                    <!-- Input Side -->
                    <div class="flex-1 p-4 px-5">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <div class="flex-1">
                                <label class="mb-1.5 block text-[13px] text-white">Start Time</label>
                                <input type="time" name="start_time" required
                                    class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-black shadow-sm outline-none">
                            </div>
                            <div class="flex-1">
                                <label class="mb-1.5 block text-[13px] text-white">End Time</label>
                                <input type="time" name="end_time" required
                                    class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-black shadow-sm outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full rounded bg-[#1e40ff] py-2.5 text-[15px] font-normal text-white shadow transition hover:bg-blue-700">
                    Simpan
                </button>

            </form>
        </div>
    </div>


    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Fitur Pencarian (Search)
        const searchInput = document.querySelector('input[placeholder="Search"]');
        const batchCards = document.querySelectorAll('.grid.grid-cols-1 > div');

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                batchCards.forEach(card => {
                    const titleElement = card.querySelector('h2');
                    if (titleElement) {
                        const title = titleElement.textContent.toLowerCase();
                        if (title.includes(term)) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        }

        // 2. Interaktivitas Tombol Edit & Delete
        batchCards.forEach(card => {
            const titleElement = card.querySelector('h2');
            if (!titleElement) return;
            const title = titleElement.textContent;

            const editBtn = card.querySelector('.fa-pen-to-square')?.parentElement;
            const deleteBtn = card.querySelector('.fa-trash-can')?.parentElement;

            if (editBtn) {
                editBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                    openModal(title);
                });
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();

                    Swal.fire({
                        heightAuto: false,
                        scrollbarPadding: false,
                        title: 'Hapus ' + title + '?',
                        text: "Data ini akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#4b5563',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        customClass: {
                            title: 'text-black font-bold',
                            popup: 'rounded-xl border border-gray-200 shadow-xl pb-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            card.style.transition = 'all 0.3s ease';
                            card.style.transform = 'scale(0.8)';
                            card.style.opacity = '0';
                            setTimeout(() => {
                                card.remove();
                                Swal.fire({
                                    heightAuto: false,
                                    scrollbarPadding: false,
                                    title: 'Terhapus!',
                                    text: title + ' berhasil dihapus.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    customClass: {
                                        popup: 'rounded-xl border border-gray-200 shadow-xl'
                                    }
                                });
                            }, 300);
                        }
                    });
                });
            }
        });
    });

    function openModal(batchName) {
        const modal = document.getElementById('tambahBatchModal');
        const box = document.getElementById('modalBox');

        // Dynamic Title Update based on Edit/Tambah
        const modalTitle = document.querySelector('#modalBox h2');
        const badgeTitle = document.querySelector('#modalBox span.inline-block');

        if (typeof batchName !== 'string') {
            batchName = 'Batch Baru';
        }

        if (modalTitle && badgeTitle) {
            if (batchName === 'Batch Baru') {
                modalTitle.textContent = 'Batch Deadline';
                badgeTitle.textContent = 'Batch 10';
            } else {
                modalTitle.textContent = 'Edit ' + batchName;
                badgeTitle.textContent = batchName;
            }
        }

        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('opacity-100', 'bg-opacity-40');

        box.classList.remove('scale-95', 'opacity-0');
        box.classList.add('scale-100', 'opacity-100');
    }

    function closeModal() {
        const modal = document.getElementById('tambahBatchModal');
        const box = document.getElementById('modalBox');

        modal.classList.remove('opacity-100', 'bg-opacity-40');
        modal.classList.add('opacity-0');

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('pointer-events-none');
        }, 300);
    }

    function simpanBatch() {
        closeModal();
        setTimeout(() => {
            Swal.fire({
                heightAuto: false,
                scrollbarPadding: false,
                title: 'Tersimpan!',
                text: 'Data batch berhasil disimpan.',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'rounded-xl border border-gray-200 shadow-xl'
                }
            });
        }, 300);
    }
    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('#batchTable tr');

        rows.forEach((row, index) => {
            const viewBtn = row.querySelector('.view-btn');
            const editBtn = row.querySelector('.edit-btn');
            const deleteBtn = row.querySelector('.delete-btn');

            const no = index + 1;

            if (viewBtn) {
                viewBtn.addEventListener('click', () => {
                    Swal.fire({
                        title: 'Detail Batch ' + no,
                        text: 'Menampilkan detail batch.',
                        icon: 'info'
                    });
                });
            }

            if (editBtn) {
                editBtn.addEventListener('click', () => {
                    openModal('Batch ' + no);
                });
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', () => {
                    Swal.fire({
                        title: 'Hapus Batch ' + no + '?',
                        text: 'Data akan dihapus!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        confirmButtonText: 'Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            row.remove();
                        }
                    });
                });
            }
        });
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }
</script>

</body>

</html>
