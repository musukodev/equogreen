<main class="flex h-full min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-6 lg:p-8">

    <!-- Top Header -->
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- Mobile Hamburger -->
            <button onclick="toggleSidebar()"
                class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                <img src="/gambar/garis3.png" alt="Menu"
                    class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <div>
                <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Dashboard</h1>
                <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Halo, ATK Corner! Selamat
                    datang di website Equogreen</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center gap-3">
            <button
                class="hover:border-primary flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 bg-[#f0f5ff] shadow-sm transition-all duration-200">
                <img src="/gambar/bell-black.png" alt="Notifikasi" class="h-6 w-6 object-contain" />
            </button>

            <a href="{{ route('profile_procurement') }}"> <img src="/gambar/profileup.png" alt="Profil"
                    class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" /></a>
            <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
            <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
        </div>
    </header>

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

    <!-- Announcement Banner -->
    <section wire:click="$set('showPengumumanModal', true)"
        class="flex cursor-pointer flex-col items-start justify-between gap-4 rounded-2xl border border-black bg-[#4039c9] px-6 py-5 shadow-md transition-all duration-200 hover:scale-[1.01] hover:shadow-lg active:scale-[0.995] md:flex-row md:items-center md:px-8 md:py-6">
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
        <h2 class="text-xl font-bold text-gray-800">Pilih Kategori</h2>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 md:gap-4 lg:grid-cols-4">
            @foreach ($categories as $category)
                <button type="button" wire:click="toggleCategory('{{ $category }}')"
                    class="{{ in_array($category, $selectedCategories) ? 'bg-primary text-white border-primary selected' : 'bg-white text-gray-700 border-gray-300' }} hover:border-primary group flex items-center rounded-xl border px-5 py-3 text-left text-[15px] font-medium transition-all duration-200 hover:shadow-sm">
                    <span class="truncate">{{ $category }}</span>
                </button>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button wire:click="kirim"
                class="bg-accent relative rounded-xl px-8 py-3 text-sm font-bold text-white shadow transition-all duration-200 hover:bg-[#0023cc] hover:shadow-lg active:scale-95 md:text-base">
                <span wire:loading.remove wire:target="kirim">Kirim</span>
                <span wire:loading wire:target="kirim">Mengirim...</span>
            </button>
        </div>
    </section>

    <!-- ========== MODAL: Pengumuman ========== -->
    @if ($showPengumumanModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div
                class="animate-modal-slide-up mx-auto flex w-full max-w-lg flex-col gap-5 rounded-2xl bg-[#eef0f5] p-5 shadow-2xl md:p-7">
                <!-- Header -->
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-gray-900">Pengumuman</h2>
                    <div class="flex flex-shrink-0 items-center gap-2">
                        <button wire:click="deletePengumuman"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1f2937] text-white shadow-sm transition-all duration-200 hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        <button wire:click="$set('showPengumumanModal', false)"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#ef4444] text-xl font-bold text-white shadow-sm transition-all duration-200 hover:bg-red-600 active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form wire:submit="savePengumuman" class="flex flex-col gap-4">
                    <textarea wire:model="pengumuman" rows="10"
                        class="focus:border-primary focus:ring-primary/20 w-full resize-none rounded-xl border border-gray-200 bg-white p-5 text-sm text-gray-700 outline-none transition-all duration-200 placeholder:text-gray-400 focus:ring-2"
                        placeholder="Buatlah pengumuman untuk vendor" required></textarea>

                    <button type="submit"
                        class="bg-primary relative w-full rounded-xl py-3.5 text-sm font-bold text-white shadow-lg transition-all duration-200 hover:bg-blue-700 active:scale-95 md:text-base">
                        <span wire:loading.remove wire:target="savePengumuman">Simpan Pengumuman</span>
                        <span wire:loading wire:target="savePengumuman">Menyimpan...</span>
                    </button>
                </form>
            </div>
        </div>
    @endif

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
</main>
