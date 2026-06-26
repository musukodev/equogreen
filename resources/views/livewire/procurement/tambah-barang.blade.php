<div class="flex h-screen w-full flex-1 flex-col overflow-y-auto">

    <!-- Main Workspace Padding Wrapper -->
    <main class="relative flex min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-6 lg:p-8">

        <!-- Top Header -->
        <header class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button onclick="toggleSidebar()"
                    class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                    <img src="/gambar/garis3.png" alt="Menu"
                        class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <!-- Back Button -->
                <a href="{{ url()->previous() }}"
                    class="hover:bg-primary hover:border-primary flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white"
                    wire:navigate>
                    <img src="/gambar/back-arrow.png" alt="Back" class="h-6 w-6 object-contain brightness-0" />
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Tambah Barang</h1>
                </div>
            </div>

            <!-- Right: Profile Section -->
            <div class="flex items-center gap-3">
                <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>
                <img src="/gambar/profileup.png" alt="Profil"
                    class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
                <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
            </div>
        </header>

        <!-- Form Workspace -->
        <div class="w-full">
            @if (session('error'))
                <div class="mb-4 rounded-xl border border-red-400 bg-red-100 p-3 text-[14px] text-red-700 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Card -->
            <form wire:submit.prevent="store"
                class="relative flex w-full flex-col rounded-xl border border-gray-400 bg-white p-6 shadow-sm md:p-8">

                <!-- Top Dropdown Area -->
                <div class="mb-8">
                    <p class="mb-2 font-semibold">Pilih Kategori:</p>
                    <div class="relative w-72">
                        <select wire:model.live="kategori_terpilih"
                            class="focus:border-primary focus:ring-primary/20 w-full cursor-pointer appearance-none rounded-xl border border-gray-800 bg-white px-4 py-3 pr-10 text-base font-medium text-gray-800 outline-none transition-all duration-200 focus:ring-2">
                            <option value="atk">ATK</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="furniture">Furniture</option>
                            <option value="cleaning">Cleaning Supply</option>
                            <option value="supplier">Supplier Umum</option>
                        </select>
                        <!-- Dropdown arrow -->
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Vendor Dropdown Multi-Select -->
                <div class="mb-6">
                    <p class="mb-2 font-semibold">Pilih Vendor:</p>

                    <div x-data="{
                        open: false,
                        search: '',
                        selectedVendors: $wire.entangle('selected_vendors'),
                        vendors: $wire.entangle('vendors'),
                        // Helper to filter vendors based on search input
                        get filteredVendors() {
                            if (!this.search) return this.vendors;
                            return this.vendors.filter(v => v.nama_perusahaan.toLowerCase().includes(this.search.toLowerCase()));
                        }
                    }" @click.away="open = false" class="relative w-full md:w-96">

                        <!-- Dropdown Button -->
                        <button type="button" @click="open = !open"
                            class="focus:border-primary focus:ring-primary/20 flex w-full cursor-pointer items-center justify-between rounded-xl border border-gray-800 bg-white px-4 py-3 text-base font-medium text-gray-800 outline-none transition-all duration-200 focus:ring-2">
                            <span class="truncate">
                                <span x-show="selectedVendors.length > 0">
                                    <span x-text="selectedVendors.length"></span> Vendor Terpilih
                                </span>
                                <span x-show="selectedVendors.length === 0">
                                    Pilih Vendor
                                </span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200"
                                :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute left-0 right-0 z-50 mt-2 flex max-h-80 flex-col gap-2 overflow-hidden rounded-xl border border-gray-300 bg-white p-3 shadow-lg"
                            style="display: none;">

                            <!-- Search Input -->
                            <div class="relative">
                                <input type="text" x-model="search" placeholder="Cari vendor..."
                                    class="focus:border-primary focus:ring-primary w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1">
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                                </span>
                            </div>

                            <!-- Quick Actions: Select All & Clear All -->
                            <div class="flex items-center justify-between border-b border-gray-100 px-1 pb-2 text-xs">
                                <button type="button"
                                    @click="selectedVendors = vendors.map(v => v.id_vendor.toString())"
                                    class="font-medium text-blue-600 transition-colors hover:text-blue-800">
                                    Pilih Semua
                                </button>
                                <button type="button" @click="selectedVendors = []"
                                    class="font-medium text-red-500 transition-colors hover:text-red-700">
                                    Hapus Semua
                                </button>
                            </div>

                            <!-- Vendor List -->
                            <div class="flex max-h-48 flex-col gap-1 overflow-y-auto pr-1">
                                <template x-for="vendor in filteredVendors" :key="vendor.id_vendor">
                                    <label
                                        class="group flex cursor-pointer items-center gap-3 rounded-lg p-2 hover:bg-gray-50">
                                        <input type="checkbox" x-model="selectedVendors"
                                            :value="vendor.id_vendor.toString()"
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="group-hover:text-primary text-sm text-gray-800 transition-colors"
                                            x-text="vendor.nama_perusahaan"></span>
                                    </label>
                                </template>

                                <div x-show="filteredVendors.length === 0"
                                    class="py-4 text-center text-sm text-gray-500">
                                    Tidak ada vendor yang cocok.
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('selected_vendors')
                        <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description Topic -->
                <div class="mb-3 mt-6 flex items-center gap-4">
                    <i class="fa-solid fa-box text-[32px] text-black"></i>
                    <div>
                        <h3 class="text-[16px] font-bold leading-tight text-black">Spesifikasi Barang</h3>
                        <p class="mt-0.5 text-[14px] font-medium text-gray-400">Deskripsikan spesifikasi barang yang
                            dibutuhkan</p>
                    </div>
                </div>

                <!-- Table Wrapper with Add Button Container -->
                <div class="mb-4 mt-4 flex items-center gap-3">
                    <div class="flex items-center gap-2 rounded border border-gray-400 px-3 py-1">
                        <span class="text-sm text-gray-500">Nomor Penawaran</span>
                        <div class="w-8 text-center font-bold text-gray-800">
                            @if ($edit_id)
                                @php
                                    $editIndex = 1;
                                    foreach ($savedPenawaran as $index => $group) {
                                        if ($group['group_id'] === $edit_id) {
                                            $editIndex = $index + 1;
                                            break;
                                        }
                                    }
                                @endphp
                                {{ $editIndex }}
                            @else
                                {{ count($savedPenawaran) + 1 }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-8 flex w-full items-end gap-3">
                    <!-- Data Table -->
                    <div class="w-full flex-1 overflow-x-auto">
                        <table class="w-full min-w-[600px] border-collapse border border-gray-400">
                            <thead>
                                <tr class="bg-[#3a3fe0] text-white">
                                    <th class="w-1/4 border border-gray-400 py-3 text-center text-[14px] font-normal">
                                        Nama Barang</th>
                                    <th class="w-2/4 border border-gray-400 py-3 text-center text-[14px] font-normal">
                                        Spesifikasi detail</th>
                                    <th class="w-1/6 border border-gray-400 py-3 text-center text-[14px] font-normal">
                                        Jumlah</th>
                                    <th class="w-1/12 border border-gray-400 py-3 text-center text-[14px] font-normal">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td class="border border-gray-400 p-0">
                                            <input type="text" wire:model="items.{{ $index }}.nama_barang"
                                                placeholder="Nama Barang"
                                                class="h-[45px] w-full border-none px-2 outline-none">
                                            @error('items.' . $index . '.nama_barang')
                                                <div class="px-2 text-xs text-red-500">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="border border-gray-400 p-0">
                                            <input type="text" wire:model="items.{{ $index }}.spesifikasi"
                                                placeholder="Spesifikasi detail"
                                                class="h-[45px] w-full border-none px-2 outline-none">
                                            @error('items.' . $index . '.spesifikasi')
                                                <div class="px-2 text-xs text-red-500">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="border border-gray-400 p-0">
                                            <input type="number" wire:model="items.{{ $index }}.jumlah"
                                                placeholder="Jumlah" min="1"
                                                class="h-[45px] w-full border-none px-2 outline-none">
                                            @error('items.' . $index . '.jumlah')
                                                <div class="px-2 text-xs text-red-500">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="border border-gray-400 p-0 text-center">
                                            @if (!$edit_id)
                                                <button type="button" wire:click="hapusBaris({{ $index }})"
                                                    class="h-[45px] w-full text-red-500 hover:text-red-700">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Floating Plus Button -->
                    @if (!$edit_id)
                        <div class="mb-1 flex flex-shrink-0 items-center justify-center">
                            <button type="button" wire:click="addBaris"
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-black text-white transition hover:bg-gray-800">
                                <i class="fa-solid fa-plus text-[14px]"></i>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons Menu -->
                <div class="flex flex-col items-center justify-end gap-3 sm:flex-row">
                    @if ($edit_id)
                        <button type="button" wire:click="deletePenawaran('{{ $edit_id }}')"
                            class="w-full rounded-lg bg-black py-2.5 font-bold text-white transition hover:bg-gray-800 sm:w-[120px]">
                            Delete
                        </button>
                        <button type="button" wire:click="cancelEdit"
                            class="w-full rounded-lg border border-gray-400 bg-white py-2.5 font-bold text-black transition hover:bg-gray-50 sm:w-[120px]">
                            Batal
                        </button>
                    @endif
                    <button type="submit"
                        class="w-full rounded-lg bg-[#1e40ff] py-2.5 font-bold text-white transition hover:bg-blue-500 disabled:opacity-50 sm:w-[150px]"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">{{ $edit_id ? 'Update' : 'Kirim' }}</span>
                        <span wire:loading wire:target="store">Loading...</span>
                    </button>
                </div>

            </form>

            @if (count($savedPenawaran) > 0)
                <div class="mt-8 flex items-center gap-3">
                    <i class="fa-solid fa-list text-[28px] text-black"></i>
                    <h2 class="text-[18px] font-bold text-black">Periksa Penawaran</h2>
                </div>
                <div
                    class="relative mt-6 flex w-full flex-col overflow-hidden rounded-xl border border-gray-400 bg-white shadow-sm">

                    <div class="w-full overflow-x-auto">
                        <table class="w-full min-w-[600px] border-collapse">
                            <thead>
                                <tr class="bg-[#3a3fe0] text-white">
                                    <th
                                        class="w-[10%] border-b border-r border-gray-400 px-2 py-3 text-center text-[14px] font-normal">
                                        Nomor</th>
                                    <th
                                        class="w-[50%] border-b border-r border-gray-400 px-4 py-3 text-center text-[14px] font-normal">
                                        Vendor Tujuan</th>
                                    <th
                                        class="w-[20%] border-b border-r border-gray-400 px-4 py-3 text-center text-[14px] font-normal">
                                        Kategori</th>
                                    <th
                                        class="w-[20%] border-b border-gray-400 px-4 py-3 text-center text-[14px] font-normal">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($savedPenawaran as $index => $group)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border-b border-r border-gray-400 p-3 text-center text-sm">
                                            {{ $index + 1 }}</td>
                                        <td class="border-b border-r border-gray-400 p-3 text-center text-sm">
                                            <div class="flex flex-col items-center gap-1">
                                                @foreach ($group['vendors'] as $vendorName)
                                                    <span
                                                        class="w-fit whitespace-nowrap rounded-md bg-blue-100 px-2 py-1 text-xs text-blue-800">{{ $vendorName }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td
                                            class="border-b border-r border-gray-400 p-3 text-center text-sm font-semibold text-gray-700">
                                            <span
                                                class="rounded-md border border-gray-300 bg-gray-100 px-2.5 py-1 text-xs">
                                                {{ $group['kategori'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="border-b border-gray-400 p-3 text-center">
                                            <div class="flex items-center justify-center gap-3">
                                                <button wire:click="editPenawaran('{{ $group['group_id'] }}')"
                                                    class="text-gray-600 transition hover:text-black" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                                </button>
                                                <a href="{{ route('procurement-periksa_barang', ['batch_id' => $batch_id, 'group_id' => $group['group_id']]) }}"
                                                    class="inline-block rounded bg-blue-100 px-3 py-1.5 text-xs font-bold text-blue-700 transition hover:bg-blue-200"
                                                    wire:navigate>
                                                    Cek
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="mt-8 flex justify-end">
                <a href="{{ route('procurement-batch_barang') }}"
                    class="w-full rounded-lg bg-green-600 px-8 py-3 text-center font-bold text-white shadow-md transition hover:bg-green-500 sm:w-auto">
                    Selesai & Kembali
                </a>
            </div>

        </div>

    </main>
</div>
