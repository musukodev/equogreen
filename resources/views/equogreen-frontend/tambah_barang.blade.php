<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch 1 - Equogreen</title>
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
</head>

<body class="flex h-screen overflow-hidden antialiased text-gray-800 bg-brand-bg font-sans">

    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 w-[280px] min-h-screen bg-white flex-shrink-0 flex flex-col shadow-md">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 pt-8 pb-6 border-b border-gray-100">
            <img src="gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover" />
            <span class="text-2xl font-bold text-gray-800">Equogreen</span>
        </div>

        <!-- Nav Menu -->
        <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

            <!-- Dashboard -->
            <a href="{{ route('procurement-dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/dashboard layout.png" alt="Dashboard"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Periksa Barang (ACTIVE) -->
            <a href="{{ route('procurement-batch-list') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/search database.png" alt="Periksa Barang"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Batch Barang
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Kelola Notifikasi -->
            <a href="{{ route('procurement-notifikasi') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/Add Reminder.png" alt="Kelola Notifikasi"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Kelola Notifikasi
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Validasi Vendor -->
            <a href="{{ route('procurement-validasi-vendor') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/validasi.png" alt="Validasi Vendor"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Validasi Vendor
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Pengaturan -->
            

        </nav>

        <!-- Logout -->
        <div class="px-4 pb-8 border-t border-gray-100 pt-4">
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
                <img src="gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">

        <!-- Main Workspace Padding Wrapper -->
        <main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto relative">

            <!-- Top Header -->
            <header class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button onclick="toggleSidebar()"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                        <img src="gambar/garis3.png" alt="Menu"
                            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <!-- Back Button -->
                    <a href="{{ route('procurement-batch_barang') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm">
                        <img src="gambar/Back Arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                    </a>
                    <div>
                        <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Batch 1</h1>
                    </div>
                </div>

                <!-- Right: Profile Section -->
                <div class="flex items-center gap-3">
                    <button
                        class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                        <img src="gambar/bell-black.png" alt="Notifikasi"
                            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <img src="gambar/Profileup.png" alt="Profil"
                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                    <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                    <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
                </div>
            </header>

            <!-- Form Workspace -->
            <div class="w-full">

                <!-- Form Card -->
                <div
                    class="bg-white rounded-xl border border-gray-400 p-6 md:p-8 shadow-sm flex flex-col relative w-full">

                    <!-- Top Dropdown Area -->
                    <div class="mb-8">
                        <div class="relative w-72">
                            <select id="vendor-category"
                                class="w-full appearance-none px-4 py-3 pr-10 rounded-xl border border-gray-800 bg-white text-gray-800 font-medium text-base outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 cursor-pointer">
                                <option value="atk">ATK</option>
                                <option value="elektronik">Elektronik</option>
                                <option value="furniture">Furniture</option>
                                <option value="cleaning">Cleaning Supply</option>
                            </select>
                            <!-- Dropdown arrow -->
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div id="vendor-checkboxes" class="grid grid-cols-2 sm:grid-cols-4 gap-x-6 gap-y-4">
                        <!-- Akan diisi otomatis oleh JavaScript -->
                    </div>

                    <!-- Description Topic -->
                    <div class="flex items-center gap-4 mt-6 mb-3"> <i
                            class="fa-solid fa-box text-[32px] text-black"></i>
                        <div>
                            <h3 class="text-[16px] font-bold text-black leading-tight">Spesifikasi Barang</h3>
                            <p class="text-[14px] text-gray-400 font-medium mt-0.5">Deskripsikan spesifikasi barang yang
                                dibutuhkan</p>
                        </div>
                    </div>

                    <!-- Table Wrapper with Add Button Container -->
                    <div class="flex items-end gap-3 mb-8 w-full">
                        <!-- Data Table -->
                        <div class="w-full overflow-x-auto flex-1">
                            <table class="w-full border-collapse border border-gray-400 min-w-[600px]">
                                <thead>
                                    <tr class="bg-[#3a3fe0] text-white">
                                        <th
                                            class="border border-gray-400 py-3 text-[14px] font-normal w-1/3 text-center">
                                            Nama Barang</th>
                                        <th
                                            class="border border-gray-400 py-3 text-[14px] font-normal w-1/3 text-center">
                                            Spesifikasi detail</th>
                                        <th
                                            class="border border-gray-400 py-3 text-[14px] font-normal w-1/3 text-center">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td class="border border-gray-400 p-0">
                                            <input type="text" placeholder="Nama Barang"
                                                class="w-full h-[45px] px-2 outline-none border-none">
                                        </td>
                                        <td class="border border-gray-400 p-0">
                                            <input type="text" placeholder="Spesifikasi detail"
                                                class="w-full h-[45px] px-2 outline-none border-none">
                                        </td>
                                        <td class="border border-gray-400 p-0">
                                            <input type="number" placeholder="Jumlah"
                                                class="w-full h-[45px] px-2 outline-none border-none">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Floating Plus Button (to the right of the table's bottom corner) -->
                        <div class="flex-shrink-0 flex items-center justify-center mb-1">
                            <button onclick="tambahBaris()"
                                class="w-8 h-8 rounded-full bg-black text-white hover:bg-gray-800 transition flex items-center justify-center">
                                <i class="fa-solid fa-plus text-[14px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons Menu -->
                    <div class="flex flex-col sm:flex-row justify-end items-center gap-3">
                        <button type="button"
                            class="w-full sm:w-auto px-8 py-2.5 border border-black rounded-lg bg-white text-black font-bold hover:bg-gray-300 transition flex items-center justify-center gap-2">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </button>
                        <button type="button"
                            class="w-full sm:w-auto px-8 py-2.5 bg-black rounded-lg text-white font-bold hover:bg-red-500 transition flex items-center justify-center gap-2">
                            <i class="fa-regular fa-trash-can"></i> Hapus
                        </button>
                        <button type="button"
                            class="w-full sm:w-[150px] py-2.5 bg-[#1e40ff] text-white font-bold rounded-lg hover:bg-blue-500 transition">
                            Kirim
                        </button>
                    </div>

                </div>

            </div>

        </main>
    </div>
    <script>
        function tambahBaris() {
            const table = document.getElementById('tableBody');

            const row = document.createElement('tr');

            row.innerHTML = `
        <td class="border border-gray-400 p-0">
            <input type="text" placeholder="Nama Barang"
                class="w-full h-[45px] px-2 outline-none border-none focus:bg-blue-50">
        </td>
        <td class="border border-gray-400 p-0">
            <input type="text" placeholder="Spesifikasi detail"
                class="w-full h-[45px] px-2 outline-none border-none focus:bg-blue-50">
        </td>
        <td class="border border-gray-400 p-0">
            <input type="number" placeholder="Jumlah"
                class="w-full h-[45px] px-2 outline-none border-none focus:bg-blue-50">
        </td>
    `;

            table.appendChild(row);
        }

        const DATA = {
            atk: {
                vendors: {
                    'ATKKita': [],
                    'AT&K': [],
                    'Abadi Jaya': [],
                    'Jaya ATK': [],
                    'PT Bias': [],
                    'TulisTangan': [],
                    'Nusa ATK': [],
                    'Office.co': [],
                    'ABCORP': [],
                    'PT Kertas': [],
                    'Indorim': [],
                    'Mahajaya': []
                }
            },
            elektronik: {
                vendors: {
                    'TokoTech': [],
                    'ElektroMart': [],
                    'GadgetPro': [],
                    'DigiSupply': [],
                    'PowerPlus': [],
                    'NetConnect': []
                }
            },
            furniture: {
                vendors: {
                    'MebelKita': [],
                    'FurniPro': [],
                    'WoodCraft': [],
                    'KantorBaru': []
                }
            },
            cleaning: {
                vendors: {
                    'BersihMart': [],
                    'CleanPro': [],
                    'HygienePlus': [],
                    'SparkleClean': []
                }
            }
        };

        // ---- Elements ----
        const categorySelect = document.getElementById('vendor-category');
        const vendorContainer = document.getElementById('vendor-checkboxes');
        const tableBody = document.getElementById('table-body');
        const btnAddRow = document.getElementById('btn-add-row');
        const btnEdit = document.getElementById('btn-edit');
        const btnHapus = document.getElementById('btn-hapus');
        const btnKirim = document.getElementById('btn-kirim');
        let isEditing = false;

        // =============================================
        // RENDER VENDOR CHECKBOXES based on category
        // =============================================
        function renderVendors(category) {
            const vendorData = DATA[category];
            if (!vendorData) return;

            vendorContainer.innerHTML = '';
            const vendorNames = Object.keys(vendorData.vendors);

            vendorNames.forEach(name => {
                const label = document.createElement('label');
                label.className = 'flex items-center gap-3 cursor-pointer group';
                label.innerHTML = `
          <input type="checkbox" class="vendor-checkbox" name="vendor" value="${name}"/>
          <span class="text-base text-gray-800 group-hover:text-primary transition-colors">${name}</span>
        `;
                // Event listener updateTable dihapus agar checkbox tidak mempengaruhi tabel
                vendorContainer.appendChild(label);
            });
        }

        // ---- Category Dropdown Change ----
        categorySelect.addEventListener('change', () => {
            renderVendors(categorySelect.value);
        });

        // ---- Init: render default category ----
        renderVendors(categorySelect.value);

        // ---- Add Row ----
        btnAddRow.addEventListener('click', () => {
            const emptyRow = document.getElementById('empty-row');
            if (emptyRow) emptyRow.remove();

            const newRow = document.createElement('tr');
            newRow.className = 'border-b border-gray-200 hover:bg-gray-50 transition-colors';
            newRow.innerHTML = `
        <td class="px-5 py-3 border-r border-gray-200">
          <input type="text" class="w-full outline-none text-sm text-gray-700 bg-transparent placeholder:text-gray-300" placeholder="Nama barang..." ${isEditing ? '' : 'disabled'}/>
        </td>
        <td class="px-5 py-3 border-r border-gray-200">
          <input type="text" class="w-full outline-none text-sm text-gray-700 bg-transparent placeholder:text-gray-300" placeholder="Detail spesifikasi..." ${isEditing ? '' : 'disabled'}/>
        </td>
        <td class="px-5 py-3">
          <input type="number" class="w-full outline-none text-sm text-gray-700 bg-transparent placeholder:text-gray-300" placeholder="0" min="0" ${isEditing ? '' : 'disabled'}/>
        </td>
      `;
            newRow.style.opacity = '0';
            newRow.style.transform = 'translateY(-8px)';
            tableBody.appendChild(newRow);
            requestAnimationFrame(() => {
                newRow.style.transition = 'opacity 0.25s, transform 0.25s';
                newRow.style.opacity = '1';
                newRow.style.transform = 'translateY(0)';
            });
            showToast('Baris baru ditambahkan!');
        });

        // ---- Edit / Simpan Toggle ----
        btnEdit.addEventListener('click', () => {
            const allInputs = tableBody.querySelectorAll('input');
            if (allInputs.length === 0 || document.getElementById('empty-row')) {
                showToast('Belum ada data di tabel!', true);
                return;
            }
            if (isEditing) {
                allInputs.forEach(input => input.disabled = true);
                btnEdit.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
                btnEdit.classList.remove('border-primary', 'text-primary');
                isEditing = false;
                showToast('Data berhasil disimpan!');
            } else {
                allInputs.forEach(input => input.disabled = false);
                const firstEmpty = Array.from(allInputs).find(i => !i.value.trim());
                if (firstEmpty) firstEmpty.focus();
                btnEdit.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Simpan`;
                btnEdit.classList.add('border-primary', 'text-primary');
                isEditing = true;
            }
        });

        // ---- Hapus ----
        btnHapus.addEventListener('click', () => {
            const allInputs = tableBody.querySelectorAll('input');
            if (allInputs.length === 0) {
                showToast('Tidak ada data untuk dihapus.', true);
                return;
            }
            tableBody.innerHTML = `
        <tr id="empty-row">
          <td colspan="3" class="px-5 py-8 text-center text-gray-300 text-sm italic">Klik tombol + untuk menambah barang</td>
        </tr>
      `;
            isEditing = false;
            btnEdit.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
            btnEdit.classList.remove('border-primary', 'text-primary');
            showToast('Data berhasil dihapus!');
        });

        // ---- Kirim ----
        btnKirim.addEventListener('click', () => {
            // Logic pengiriman tetap ada, tapi tidak bergantung pada auto-fill
            showToast('Batch berhasil dikirim!');
        });

        // ---- Toast Helper ----
        function showToast(msg, isError = false) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-msg');
            const toastIcon = document.getElementById('toast-icon');
            toastMsg.textContent = msg;
            toast.style.background = isError ? '#e53e3e' : '#4039c9';
            toastIcon.textContent = isError ? '!' : '✓';
            toast.style.opacity = '1';
            toast.style.pointerEvents = 'auto';
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.pointerEvents = 'none';
            }, 2800);
        }

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