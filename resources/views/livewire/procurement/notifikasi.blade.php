<div>
  <!-- ===== MAIN CONTENT ===== -->
  <div class="flex flex-col gap-6 p-6 lg:p-8">

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-400 bg-green-100 p-4 text-sm font-semibold text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Bar: Kategori Dropdown + Search -->
    <div class="flex flex-col items-center gap-4 md:flex-row">
        <!-- Kategori Dropdown -->
        <div class="relative w-full md:w-48">
            <select id="filter-kategori"
                class="focus:border-primary focus:ring-primary/20 w-full cursor-pointer appearance-none rounded-xl border border-gray-800 bg-white px-4 py-3 pr-10 text-sm font-medium text-gray-800 outline-none transition-all duration-200 focus:ring-2">
                <option value="semua">Kategori</option>
                <option value="atk">ATK</option>
                <option value="elektronik">Elektronik</option>
                <option value="furniture">Furniture</option>
                <option value="cleaning">Cleaning Supply</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        <!-- Search Input -->
        <div class="relative w-full md:flex-1">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input id="search-input" type="text" placeholder="Cari..."
                class="focus:border-primary focus:ring-primary/20 w-full rounded-xl border border-gray-800 bg-white py-3 pl-12 pr-4 text-sm text-gray-700 outline-none transition-all duration-200 focus:ring-2" />
        </div>
    </div>

    <!-- Vendor Notification Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full border-collapse" id="notif-table">
            <thead>
                <tr class="border-b border-gray-200 bg-[#3a3fe0] text-white">
                    <th class="px-5 py-3.5 text-left text-sm font-semibold w-[50%]">Nama Vendor</th>
                    <th class="px-5 py-3.5 text-left text-sm font-semibold w-[30%]">Kategori</th>
                    <th class="px-5 py-3.5 text-center text-sm font-semibold w-[20%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-5 py-3.5 text-sm text-gray-700">{{ $vendor->nama_perusahaan }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-700">{{ $vendor->kategori_vendor }}</td>
                        <td class="px-5 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    class="btn-profile flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 transition"
                                    data-nama="{{ $vendor->nama_perusahaan }}"
                                    data-kategori="{{ $vendor->kategori_vendor }}"
                                    data-email="{{ $vendor->email_perusahaan }}" data-phone="{{ $vendor->no_hp }}"
                                    data-alamat="{{ $vendor->alamat }}">
                                    <i class="ph-bold ph-user text-base"></i>
                                </button>
                                <button type="button"
                                    wire:click="deleteVendor({{ $vendor->id_vendor }})"
                                    wire:confirm="Apakah Anda yakin ingin menghapus akun vendor ({{ $vendor->nama_perusahaan }}) ini secara permanen dari sistem?"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-700 transition"
                                    title="Hapus Vendor">
                                    <i class="ph-bold ph-trash text-base"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ========== MODAL: Profile Vendor ========== -->
    <div id="profile-modal"
        class="animate-fade-in fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div
            class="animate-modal-slide-up mx-4 flex w-full max-w-md flex-col gap-4 rounded-2xl bg-white p-7 shadow-2xl">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Profil Vendor</h2>
                <button id="close-profile-modal"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-500 text-lg font-bold text-white transition-all duration-200 hover:bg-red-600 active:scale-90">
                    ✕
                </button>
            </div>
            <hr class="border-gray-100" />
            <!-- Vendor Info -->
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-4">
                    <div class="bg-primary/10 text-primary flex h-14 w-14 items-center justify-center rounded-full text-xl font-bold"
                        id="modal-avatar">E</div>
                    <div>
                        <p class="text-lg font-bold text-gray-800" id="modal-vendor-name">—</p>
                        <span
                            class="bg-primary/10 text-primary mt-1 inline-block rounded-full px-3 py-0.5 text-xs font-semibold"
                            id="modal-vendor-kategori">—</span>
                    </div>
                </div>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    <div class="rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Email</p>
                        <p class="break-all text-sm font-semibold text-gray-700" id="modal-vendor-email"></p>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Telepon</p>
                        <p class="text-sm font-semibold text-gray-700" id="modal-vendor-phone"></p>
                    </div>
                    <div class="col-span-2 rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Alamat</p>
                        <p class="text-sm font-semibold text-gray-700" id="modal-vendor-alamat"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== TOAST ========== -->
    <div id="toast"
        class="bg-primary pointer-events-none fixed bottom-6 right-6 z-[60] flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold text-white opacity-0 shadow-lg transition-all duration-300">
        <span id="toast-icon">✓</span>
        <span id="toast-msg">Berhasil!</span>
    </div>
    <script>
        const profileModal = document.getElementById('profile-modal');
        const emailModal = document.getElementById('email-modal');

        // Logic Modal Profile
        document.querySelectorAll('.btn-profile').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('modal-avatar').textContent = this.dataset.nama ? this.dataset.nama
                    .charAt(0) : 'V';
                document.getElementById('modal-vendor-name').textContent = this.dataset.nama || '-';
                document.getElementById('modal-vendor-kategori').textContent = this.dataset.kategori || '-';
                document.getElementById('modal-vendor-email').textContent = this.dataset.email || '-';
                document.getElementById('modal-vendor-phone').textContent = this.dataset.phone || '-';
                document.getElementById('modal-vendor-alamat').textContent = this.dataset.alamat || '-';

                profileModal.classList.remove('hidden');
                profileModal.classList.add('flex');
            });
        });

        document.getElementById('close-profile-modal').addEventListener('click', function() {
            profileModal.classList.add('hidden');
            profileModal.classList.remove('flex');
        });

        // Close Modals when clicking outside
        window.addEventListener('click', function(e) {
            if (e.target === profileModal) {
                profileModal.classList.add('hidden');
                profileModal.classList.remove('flex');
            }
        });
    </script>
</div>
