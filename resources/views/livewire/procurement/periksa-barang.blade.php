<main x-data="{ showApproveModal: false, showSuccessCheck: false, approveUrl: '' }" class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto relative h-full">

    <!-- Top Header -->
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center justify-between md:justify-start w-full md:w-auto gap-4">
            <div class="flex items-center gap-3 md:gap-6">
                <div class="flex items-center gap-2 md:gap-4">
                    <!-- Mobile Hamburger -->
                    <button onclick="toggleSidebar()"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                        <img src="/gambar/garis3.png" alt="Menu"
                            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <!-- Back Button -->
                    <a href="{{ route('procurement-batch_barang') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-black text-black hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm" wire:navigate>
                        <i class="ph ph-arrow-left text-xl"></i>
                    </a>
                    <h1 class="text-2xl md:text-[32px] font-bold text-[#111827] leading-none">Batch {{ $batch->id_batch }}</h1>
                </div>
            </div>

            <!-- Right: Profile Section (Mobile Only) -->
            <div class="flex md:hidden items-center gap-3">
                <button
                    class="w-10 h-10 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200">
                    <img src="/gambar/bell-black.png" alt="Notifikasi" class="w-5 h-5 object-contain" />
                </button>
                <img src="/gambar/profileup.png" alt="Profil"
                    class="w-10 h-10 rounded-full object-cover border border-gray-200" />
            </div>
        </div>

        <!-- Right: Profile Section (Desktop Only) -->
        <div class="hidden md:flex items-center gap-3">
            <button
                class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <img src="/gambar/profileup.png" alt="Profil"
                class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
            <div class="w-px h-10 bg-gray-200"></div>
            <span class="font-medium text-gray-700 text-[17px]">Procurement</span>
        </div>
    </header>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Card 1: Spesifikasi Barang -->
    <div class="w-full mt-2">
        <div class="bg-white rounded-lg border border-gray-200 p-6 md:p-8 shadow-sm w-full">
            <h2 class="text-xl font-bold text-gray-900 mb-1">Spesifikasi Barang</h2>
            <p class="text-gray-500 mb-6 text-sm">Deskripsikan spesifikasi barang yang dibutuhkan</p>
            
            <div class="mb-4">
                <button class="px-4 py-1.5 border border-black rounded-md text-sm font-medium">1</button>
            </div>

            <div class="overflow-x-auto border border-black rounded-sm">
                <table class="w-full border-collapse min-w-[600px] text-center">
                    <thead>
                        <tr class="bg-[#423ec7] text-white">
                            <th class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">Nama Barang</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">Spesifikasi detail</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-b border-black w-1/3">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penawarans as $item)
                        <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                            <td class="py-4 px-4 text-black border-r border-black">{{ $item->nama_barang }}</td>
                            <td class="py-4 px-4 text-black border-r border-black">{{ $item->spesifikasi }}</td>
                            <td class="py-4 px-4 text-black">{{ $item->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Card 2: Vendor List -->
    <div class="w-full">
        <div class="bg-white rounded-lg border border-gray-200 p-6 md:p-8 shadow-sm w-full">
            
            <!-- Filters -->
            <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
                <div class="relative w-full md:w-[250px]">
                    <select wire:model.live="status_pengajuan"
                        class="w-full appearance-none px-4 py-2.5 pr-10 border border-black rounded-md outline-none focus:border-black focus:ring-1 focus:ring-black bg-white shadow-sm cursor-pointer text-[14px]">
                        <option value="">Status Pengajuan</option>
                        <option value="sudah">Sudah Mengajukan</option>
                        <option value="belum">Belum Mengajukan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-700">
                        <i class="ph ph-caret-down"></i>
                    </div>
                </div>
                            
                <div class="w-full md:flex-1 relative">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search"
                        class="w-full px-4 py-2.5 border border-black rounded-md outline-none focus:ring-1 focus:ring-black transition text-[14px]">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-black rounded-sm">
                <table class="w-full border-collapse min-w-[800px] text-center">
                    <thead>
                        <tr class="bg-[#423ec7] text-white">
                            <th class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/4">Nama Vendor</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/4">Status Pengajuan</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/4">Cek Quotation</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-b border-black w-1/4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                        <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                            <td class="py-4 px-4 text-black border-r border-black">{{ $vendor->nama_perusahaan }}</td>
                            
                            <!-- Status Pengajuan -->
                            <td class="py-4 px-4 text-black border-r border-black">
                                @if($vendor->sudah_mengajukan > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#e6f7e8] text-[#2ebd3a]">
                                        Sudah Mengajukan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#fee6e6] text-[#e53e3e]">
                                        Belum Mengajukan
                                    </span>
                                @endif
                            </td>

                            <!-- Cek Quotation -->
                            <td class="py-4 px-4 border-r border-black">
                                @if($vendor->sudah_mengajukan > 0)
                                    <button wire:click.prevent="$dispatch('openQuotationModal', { idVendor: {{ $vendor->id_vendor }} })" 
                                            class="bg-[#e4e6fb] text-[#423ec7] px-4 py-1.5 rounded-md text-xs font-medium hover:bg-[#d0d3f8] transition">
                                        Cek
                                    </button>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    @if($vendor->sudah_mengajukan > 0)
                                        <button @click="approveUrl = '{{ route('po.show', ['id_vendor' => $vendor->id_vendor, 'id_penawaran' => $vendor->first_penawaran_id ?? 0]) }}'; showApproveModal = true;" class="hover:scale-110 transition-transform">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                        </button>
                                        <button class="hover:scale-110 transition-transform">
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </button>
                                    @else
                                        <button wire:click="kirimReminder({{ $vendor->id_vendor }})" title="Kirim Reminder" class="hover:scale-110 transition-transform text-gray-600 hover:text-primary">
                                            <i class="ph ph-envelope-simple text-xl font-bold"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">Tidak ada vendor yang ditugaskan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal component rendering -->
    <livewire:procurement.quotation-detail />

    <!-- SweetAlert/Toast Notification Script (optional) -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (event) => {
                alert(event[0].message);
            });
        });
    </script>
    <!-- Approve Confirmation Modal -->
    <div x-show="showApproveModal && !showSuccessCheck"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
         style="display: none;" x-cloak>
        <div x-show="showApproveModal && !showSuccessCheck"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl p-8 max-w-sm w-full shadow-2xl border border-gray-100"
             @click.away="showApproveModal = false">

            <!-- Icon -->
            <div class="flex justify-center mb-5">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center border-2 border-amber-300">
                    <i class="ph ph-warning text-3xl text-amber-500"></i>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Konfirmasi Approve</h3>
            <p class="text-sm text-gray-500 text-center mb-8 leading-relaxed">Apakah Anda yakin ingin menerima quotation dari vendor ini? Tindakan ini tidak dapat dibatalkan.</p>

            <div class="flex items-center gap-3">
                <button @click="showApproveModal = false"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-200 active:scale-95">
                    Batal
                </button>
                <button @click="showSuccessCheck = true; setTimeout(() => { window.location.href = approveUrl; }, 2200);"
                    class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-[#423ec7] hover:bg-[#3633a8] rounded-xl transition-all duration-200 shadow-lg shadow-indigo-200 active:scale-95">
                    Ya, Terima
                </button>
            </div>
        </div>
    </div>

    <!-- Success Checkmark Modal -->
    <div x-show="showSuccessCheck"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
         style="display: none;" x-cloak>
        <div x-show="showSuccessCheck"
             x-transition:enter="transition ease-out duration-400 delay-100"
             x-transition:enter-start="opacity-0 scale-75"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full text-center border border-gray-200 flex flex-col items-center gap-5">

            <div class="flex items-center justify-center">
                <div class="relative w-20 h-20">
                    <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-25"></div>
                    <div class="relative w-20 h-20 bg-green-50 rounded-full flex items-center justify-center border-4 border-green-500 periksa-animate-circle">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: periksaCheckmark 0.8s ease-in-out 0.3s forwards;"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-900">Berhasil!</h3>
                <p class="text-gray-500 text-sm mt-2 font-medium">Quotation berhasil diterima. Mengalihkan ke halaman PO...</p>
            </div>
        </div>
    </div>

    <style>
        @keyframes periksaCheckmark {
            to { stroke-dashoffset: 0; }
        }
        @keyframes periksaScaleCircle {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }
        .periksa-animate-circle {
            animation: periksaScaleCircle 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</main>

