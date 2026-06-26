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
                <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Batch Barang</h1>
                <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Silahkan akses folder sesuai tahun yang diinginkan</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center gap-3">
            <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>
            <a href="{{ route('profile_procurement') }}"> <img src="/gambar/profileup.png" alt="Profil" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" /></a>
            <div class="hidden md:block w-px h-10 bg-gray-200"></div>
            <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
        </div>
    </header>

    <!-- Search Bar & Add Folder Button -->
    <div class="flex items-center gap-4">
        <div class="flex-1 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search"
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 shadow-sm" />
        </div>
    </div>

    <!-- Folder Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($years as $year)
        <a href="{{ route('procurement-batch_barang', ['year' => $year]) }}" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" wire:navigate>
            <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
            </div>
            <div class="px-4 py-3 border-t border-gray-100">
                <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">{{ $year }}</span>
            </div>
        </a>
        @empty
        <div class="col-span-full flex flex-col items-center justify-center text-gray-500 py-10">
            <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-lg">Belum ada folder batch.</p>
            <p class="text-sm">Silahkan tambahkan folder baru.</p>
        </div>
        @endforelse
    </section>

    <!-- ========== MODAL: Tambah Folder ========== -->
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="animate-modal-slide-up bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-7 flex flex-col gap-5">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Tambah Folder</h2>
                <button wire:click="$set('showModal', false)"
                    class="w-9 h-9 rounded-lg bg-red-500 text-white flex items-center justify-center hover:bg-red-600 active:scale-90 transition-all duration-200 text-lg font-bold">
                    ✕
                </button>
            </div>
            <form wire:submit="addFolder" class="flex flex-col gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-semibold text-gray-700" for="folder-year">Nama Tahun</label>
                    <input type="number" id="folder-year" wire:model="newYear" placeholder="contoh: 2028" min="2000" max="2100"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" required />
                    @error('newYear') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-accent text-white font-bold text-sm hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg relative">
                    <span wire:loading.remove wire:target="addFolder">Simpan</span>
                    <span wire:loading wire:target="addFolder">Menyimpan...</span>
                </button>
            </form>
        </div>
    </div>
    @endif
</main>
