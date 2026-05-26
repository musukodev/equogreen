<main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 h-full overflow-y-auto">

    <!-- Top Header -->
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- Mobile Hamburger -->
            <button onclick="toggleSidebar()"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                <img src="/gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <div>
                <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Dashboard</h1>
                <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Halo, ATK Corner! Selamat datang di website Equogreen</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center gap-3">
            <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                <img src="/gambar/bell-black.png" alt="Notifikasi" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>

            <img src="/gambar/profileup.png" alt="Profil" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
            <div class="hidden md:block w-px h-10 bg-gray-200"></div>
            <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
        </div>
    </header>

    @if(session('success'))
        <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Announcement Banner -->
    <section wire:click="$set('showPengumumanModal', true)"
        class="bg-[#4039c9] rounded-2xl border border-black px-6 py-5 md:px-8 md:py-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-md cursor-pointer hover:shadow-lg hover:scale-[1.01] active:scale-[0.995] transition-all duration-200">
        <div class="flex-1">
            <p class="text-white/70 text-sm font-bold tracking-widest uppercase mb-1">PENGUMUMAN</p>
            <h2 class="text-white text-xl lg:text-2xl font-bold mb-2">Buat pengumuman untuk vendor</h2>
            <p class="text-white/80 text-sm lg:text-base">Pastikan spesifikasi barang dan tenggat waktu sudah sesuai</p>
        </div>
        <!-- Decorative icon area -->
        <div class="w-16 h-16 md:w-20 md:h-20 bg-[#2d4ddd]/65 rounded-full flex items-center justify-center flex-shrink-0">
            <img src="/gambar/pengumuman.png" alt="banner icon" class="w-10 h-10 md:w-12 md:h-12 object-cover rounded-full" />
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Kategori</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
            @php
            $categories = [
                'ATK', 'Perangkat Lunak', 'APD', 'Generator Set',
                'Elektronik', 'Pantry', 'Kemasan', 'Plumbing Set',
                'Furniture', 'Alat Komunikasi', 'Peralatan Lab', 'Papan Informasi',
                'Kesehatan', 'Suku Cadang', 'Keamanan Fisik', 'Kendaraan Logistik',
                'Mesin Produksi', 'Bahan Penolong', 'Pemadam Api', 'K. Operasional',
                'Perangkat IT', 'Bahan Baku Utama', 'Perangkat Listrik', 'Seragam Karyawan'
            ];
            @endphp

            @foreach($categories as $category)
            <button type="button" wire:click="toggleCategory('{{ $category }}')"
                class="flex items-center px-5 py-3 rounded-xl border {{ in_array($category, $selectedCategories) ? 'bg-primary text-white border-primary selected' : 'bg-white text-gray-700 border-gray-300' }} font-medium text-[15px] transition-all duration-200 hover:border-primary hover:shadow-sm text-left group">
                <span class="truncate">{{ $category }}</span>
            </button>
            @endforeach
        </div>
    </section>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4">
        <button wire:click="$set('showWaktuModal', true)"
            class="flex-1 bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg relative">
            Pengaturan Waktu
        </button>
        <button wire:click="kirim"
            class="flex-1 bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg relative">
            <span wire:loading.remove wire:target="kirim">Kirim</span>
            <span wire:loading wire:target="kirim">Mengirim...</span>
        </button>
    </div>

    <!-- ========== MODAL: Pengumuman ========== -->
    @if($showPengumumanModal)
    <div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="animate-modal-slide-up bg-[#eef0f5] rounded-2xl shadow-2xl w-full max-w-lg mx-auto p-5 md:p-7 flex flex-col gap-5">
            <!-- Header -->
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-900">Pengumuman</h2>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button wire:click="deletePengumuman"
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#1f2937] text-white hover:bg-gray-800 transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <button wire:click="$set('showPengumumanModal', false)"
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#ef4444] text-white hover:bg-red-600 active:scale-90 transition-all duration-200 shadow-sm text-xl font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form wire:submit="savePengumuman" class="flex flex-col gap-4">
                <textarea wire:model="pengumuman" rows="10"
                    class="w-full rounded-xl border border-gray-200 bg-white p-5 text-sm text-gray-700 resize-none outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                    placeholder="Buatlah pengumuman untuk vendor" required></textarea>

                <button type="submit"
                    class="w-full bg-primary text-white font-bold text-sm md:text-base rounded-xl py-3.5 hover:bg-blue-700 active:scale-95 transition-all duration-200 shadow-lg relative">
                    <span wire:loading.remove wire:target="savePengumuman">Simpan Pengumuman</span>
                    <span wire:loading wire:target="savePengumuman">Menyimpan...</span>
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- ========== MODAL: Pengaturan Waktu ========== -->
    @if($showWaktuModal)
    <div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="animate-modal-slide-up bg-[#f0f5ff] rounded-[32px] shadow-2xl w-full max-w-xl mx-auto overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="bg-white px-8 py-6 flex items-center justify-between border-b border-gray-100">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pengaturan Waktu</h2>
                    <p class="text-gray-500 text-base font-medium mt-0.5">Atur tenggat waktu pengumumuman</p>
                </div>
                <button wire:click="$set('showWaktuModal', false)" class="w-12 h-12 flex items-center justify-center bg-[#ff4d4d] rounded-xl hover:bg-red-600 active:scale-90 transition-all duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <form wire:submit="saveWaktu" class="p-8 flex flex-col gap-5">
                <!-- Row 1: Time -->
                <div class="bg-primary rounded-2xl p-5 flex items-center gap-6 shadow-sm border border-primary">
                    <div class="flex-shrink-0 flex items-center justify-center border-r border-white/20 pr-6">
                        <i class="fa-regular fa-clock text-white text-[32px] font-light"></i>
                    </div>
                    <div class="flex-1 grid grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-white text-sm font-bold ml-1">Start Time</label>
                            <input wire:model="start_time" type="time" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-white text-sm font-bold ml-1">End Time</label>
                            <input wire:model="end_time" type="time" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner focus:ring-2 focus:ring-blue-400" required>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Date -->
                <div class="bg-primary rounded-2xl p-5 flex items-center gap-6 shadow-sm border border-primary">
                    <div class="flex-shrink-0 flex items-center justify-center border-r border-white/20 pr-6">
                        <i class="fa-regular fa-calendar text-white text-[32px] font-light"></i>
                    </div>
                    <div class="flex-1 grid grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-white text-sm font-bold ml-1">Start Date</label>
                            <input wire:model="start_date" type="date" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-white text-sm font-bold ml-1">End Date</label>
                            <input wire:model="end_date" type="date" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner focus:ring-2 focus:ring-blue-400" required>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-accent text-white font-bold text-lg py-4 rounded-xl hover:bg-[#0023cc] transition-all duration-200 mt-2 shadow-lg active:scale-[0.98] relative">
                    <span wire:loading.remove wire:target="saveWaktu">Simpan Pengaturan Waktu</span>
                    <span wire:loading wire:target="saveWaktu">Menyimpan...</span>
                </button>
            </form>
        </div>
    </div>
    @endif
</main>
