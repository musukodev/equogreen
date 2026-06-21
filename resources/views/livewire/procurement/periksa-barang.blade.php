<main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto relative h-full">

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
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary transition-all duration-200 shadow-sm" wire:navigate>
                        <img src="/gambar/back-arrow.png" alt="Back"
                            class="w-6 h-6 object-contain brightness-0" />
                    </a>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827] leading-none">2026</h1>
                </div>

                <!-- Tabs Section (Desktop) -->
                <div class="hidden md:flex items-center gap-8 ml-2">
                    <a href="{{ route('procurement-batch_barang') }}"
                        class="text-[17px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap" wire:navigate>
                        Buat Batch
                    </a>
                    <a href="{{ route('procurement-periksa_barang') }}"
                        class="text-[17px] font-bold text-black border-b-[3px] border-primary pb-1 whitespace-nowrap" wire:navigate>
                        Periksa Barang
                    </a>
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

        <!-- Tabs Section (Mobile Only) -->
        <div class="flex md:hidden items-center gap-6 px-1">
            <a href="{{ route('procurement-batch_barang') }}"
                class="text-[15px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap" wire:navigate>
                Buat Batch
            </a>
            <a href="{{ route('procurement-periksa_barang') }}"
                class="text-[15px] font-bold text-black border-b-2 border-primary pb-1 whitespace-nowrap" wire:navigate>
                Periksa Barang
            </a>
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

    <!-- Content Card -->
    <div class="w-full">
        <div class="bg-white rounded-lg border border-gray-400 p-6 shadow-sm w-full">

            <!-- Search Input -->
            <div class="mb-4">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search Vendor Name"
                    class="w-full px-4 py-2 border border-black rounded-md outline-none focus:ring-1 focus:ring-black transition text-[15px]">
            </div>

            <!-- Dropdowns -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <div class="relative min-w-[150px]">
                    <select wire:model.live="selectedBatch"
                        class="w-full appearance-none px-3 py-2 pr-10 border border-black rounded-md outline-none focus:border-black focus:ring-1 focus:ring-black bg-white shadow-sm cursor-pointer text-[15px]">
                        <option value="">Semua Batch</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id_batch }}">Batch {{ $batch->id_batch }}</option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-gray-700 font-bold">
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                </div>
                <div class="relative min-w-[150px]">
                    <select wire:model.live="selectedCategory"
                        class="w-full appearance-none px-3 py-2 pr-10 border border-black rounded-md outline-none focus:border-black focus:ring-1 focus:ring-black bg-white shadow-sm cursor-pointer text-[15px]">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-gray-700 font-bold">
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-black rounded-sm">
                <table class="w-full border-collapse min-w-[600px] text-center">
                    <thead>
                        <tr class="bg-[#423ec7] text-white">
                            <th
                                class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">
                                Nama Vendor</th>
                            <th
                                class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">
                                Quotation</th>
                            <th class="py-4 px-4 font-normal text-[14px] border-b border-black w-1/3">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotations as $quotation)
                        <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                            <td class="py-4 px-4 text-black border-r border-black">{{ $quotation->vendor->nama_perusahaan ?? 'N/A' }}</td>
                            <td class="py-4 px-4 border-r border-black">
                                <a href="#"
                                    wire:click.prevent="$dispatch('openQuotationModal', { idVendor: {{ $quotation->id_vendor }} })"
                                    class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">
                                    Cek
                                </a>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-5">
                                    <a href="{{ route('po.show', ['id_vendor' => $quotation->id_vendor, 'id_penawaran' => $quotation->id_penawaran]) }}" wire:navigate class="hover:scale-110 transition-transform">
                                        <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                    </a>
                                    <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal component rendering -->
    <livewire:procurement.quotation-detail />

</main>
