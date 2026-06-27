<div class="flex h-full min-w-0 flex-1 flex-col gap-6 p-6 lg:p-8">

    @if (session('success'))
        <div class="rounded-lg border border-green-400 bg-green-100 p-4 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-400 bg-red-100 p-4 text-red-700 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Summary Stats Cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Approved Vendors Card -->
        <div class="flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
            <div class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-transform group-hover:rotate-3">
                <i class="ph ph-users-three text-2xl font-bold"></i>
            </div>
            <div>
                <h3 class="text-2xl font-extrabold text-gray-900 leading-none mb-1.5">{{ $totalVendorApproved }}</h3>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Vendor Aktif</p>
            </div>
        </div>

        <!-- Pending Registrations Card -->
        <div class="flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
            <div class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-xl {{ $totalVendorPending > 0 ? 'bg-red-50 text-red-600 animate-pulse' : 'bg-gray-50 text-gray-500' }} transition-transform group-hover:rotate-3">
                <i class="ph ph-user-circle-plus text-2xl font-bold"></i>
            </div>
            <div>
                <h3 class="text-2xl font-extrabold text-gray-900 leading-none mb-1.5">{{ $totalVendorPending }}</h3>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Validasi Vendor</p>
            </div>
        </div>

        <!-- Active Batches Card -->
        <div class="flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
            <div class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-xl bg-green-50 text-green-600 transition-transform group-hover:rotate-3">
                <i class="ph ph-folder text-2xl font-bold"></i>
            </div>
            <div>
                <h3 class="text-2xl font-extrabold text-gray-900 leading-none mb-1.5">{{ $totalBatchAktif }}</h3>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Batch Berjalan</p>
            </div>
        </div>

        <!-- Total PO Value Card -->
        <div class="flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
            <div class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-transform group-hover:rotate-3">
                <i class="ph ph-currency-circle-dollar text-2xl font-bold"></i>
            </div>
            <div>
                <h3 class="text-lg font-extrabold text-gray-900 leading-none mb-1.5" title="Rp {{ number_format($totalNilaiPO, 2, ',', '.') }}">
                    Rp {{ $totalNilaiPO >= 1000000000 ? number_format($totalNilaiPO / 1000000000, 1, ',', '.') . ' M' : ($totalNilaiPO >= 1000000 ? number_format($totalNilaiPO / 1000000, 1, ',', '.') . ' Jt' : number_format($totalNilaiPO, 0, ',', '.')) }}
                </h3>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Transaksi</p>
            </div>
        </div>
    </div>

    <!-- Announcement Banner -->
    <section
        class="flex flex-col items-start justify-between gap-4 rounded-2xl border border-black bg-[#4039c9] px-6 py-5 shadow-md md:flex-row md:items-center md:px-8 md:py-6">
        <div class="flex-1">
            <p class="mb-1 text-sm font-bold uppercase tracking-widest text-white/70">PENGUMUMAN</p>
            <h2 class="mb-2 text-xl font-bold text-white lg:text-2xl">Buat pengumuman untuk vendor</h2>
            <p class="text-sm text-white/80 lg:text-base">Pastikan spesifikasi barang dan tenggat waktu sudah sesuai</p>
        </div>
        <!-- Decorative icon area -->
        <div
            class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#2d4ddd]/65 md:h-20 md:w-20">
            <img src="/gambar/pengumuman.png" alt="banner icon"
                class="h-10 w-10 rounded-full object-cover md:h-12 md:w-12" />
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="flex flex-col gap-6 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pengumuman</h2>
            <textarea wire:model="pengumuman" rows="6"
                class="w-full rounded-xl border border-gray-300 bg-white p-5 text-sm text-gray-700 resize-none outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                placeholder="Tulis pengumuman untuk vendor di sini..." required></textarea>
            @error('pengumuman') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pilih Kategori</h2>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 md:gap-4 lg:grid-cols-4">
                @foreach ($categories as $category)
                    <button type="button" wire:click="toggleCategory('{{ $category }}')"
                        class="{{ in_array($category, $selectedCategories) ? 'bg-primary text-white border-primary selected' : 'bg-white text-gray-700 border-gray-300' }} hover:border-primary group flex items-center rounded-xl border px-5 py-3 text-left text-[15px] font-medium transition-all duration-200 hover:shadow-sm">
                        <span class="truncate">{{ $category }}</span>
                    </button>
                @endforeach
            </div>
            @error('selectedCategories') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end border-t border-gray-100 pt-4">
            <button wire:click="kirim"
                class="bg-accent relative rounded-xl px-8 py-3 text-sm font-bold text-white shadow transition-all duration-200 hover:bg-[#0023cc] hover:shadow-lg active:scale-95 md:text-base">
                <span wire:loading.remove wire:target="kirim">Kirim</span>
                <span wire:loading wire:target="kirim">Mengirim...</span>
            </button>
        </div>
    </section>

    <!-- ========== MODAL: Pengaturan Waktu ========== -->
    @if ($showWaktuModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div
                class="animate-modal-slide-up mx-auto w-full max-w-xl overflow-hidden rounded-[32px] border border-gray-200 bg-[#f0f5ff] shadow-2xl">
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-100 bg-white px-8 py-6">
                    <div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Pengaturan Waktu</h2>
                        <p class="mt-0.5 text-base font-medium text-gray-500">Atur tenggat waktu pengumumuman</p>
                    </div>
                    <button wire:click="$set('showWaktuModal', false)"
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#ff4d4d] shadow-sm transition-all duration-200 hover:bg-red-600 active:scale-90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form wire:submit="saveWaktu" class="flex flex-col gap-5 p-8">
                    <!-- Row 1: Time -->
                    <div class="bg-primary border-primary flex items-center gap-6 rounded-2xl border p-5 shadow-sm">
                        <div class="flex flex-shrink-0 items-center justify-center border-r border-white/20 pr-6">
                            <i class="fa-regular fa-clock text-[32px] font-light text-white"></i>
                        </div>
                        <div class="grid flex-1 grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="ml-1 text-sm font-bold text-white">Start Time</label>
                                <input wire:model="start_time" type="time"
                                    class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="ml-1 text-sm font-bold text-white">End Time</label>
                                <input wire:model="end_time" type="time"
                                    class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Date -->
                    <div class="bg-primary border-primary flex items-center gap-6 rounded-2xl border p-5 shadow-sm">
                        <div class="flex flex-shrink-0 items-center justify-center border-r border-white/20 pr-6">
                            <i class="fa-regular fa-calendar text-[32px] font-light text-white"></i>
                        </div>
                        <div class="grid flex-1 grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label class="ml-1 text-sm font-bold text-white">Start Date</label>
                                <input wire:model="start_date" type="date"
                                    class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="ml-1 text-sm font-bold text-white">End Date</label>
                                <input wire:model="end_date" type="date"
                                    class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-accent relative mt-2 w-full rounded-xl py-4 text-lg font-bold text-white shadow-lg transition-all duration-200 hover:bg-[#0023cc] active:scale-[0.98]">
                        <span wire:loading.remove wire:target="saveWaktu">Simpan Pengaturan Waktu</span>
                        <span wire:loading wire:target="saveWaktu">Menyimpan...</span>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
