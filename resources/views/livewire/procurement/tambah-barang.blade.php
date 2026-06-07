<div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">

    <!-- Main Workspace Padding Wrapper -->
    <main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto relative">

        <!-- Top Header -->
        <header class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                    <img src="/gambar/garis3.png" alt="Menu"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <!-- Back Button -->
                <a href="{{ url()->previous() }}"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm" wire:navigate>
                    <img src="/gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                </a>
                <div>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Tambah Barang</h1>
                </div>
            </div>

            <!-- Right: Profile Section -->
            <div class="flex items-center gap-3">
                <button
                    class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                    <img src="/gambar/bell-black.png" alt="Notifikasi"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <img src="/gambar/profileup.png" alt="Profil"
                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
            </div>
        </header>

        <!-- Form Workspace -->
        <div class="w-full">
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 text-[14px] rounded-xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Card -->
            <form wire:submit.prevent="store"
                class="bg-white rounded-xl border border-gray-400 p-6 md:p-8 shadow-sm flex flex-col relative w-full">

                <!-- Top Dropdown Area -->
                <div class="mb-8">
                    <div class="relative w-72">
                        <select wire:model.live="kategori_terpilih"
                            class="w-full appearance-none px-4 py-3 pr-10 rounded-xl border border-gray-800 bg-white text-gray-800 font-medium text-base outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 cursor-pointer">
                            <option value="atk">ATK</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="furniture">Furniture</option>
                            <option value="cleaning">Cleaning Supply</option>
                            <option value="supplier">Supplier Umum</option>
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

                <!-- Vendor Checkboxes -->
                <div class="mb-6">
                    <p class="font-semibold mb-2">Pilih Vendor:</p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-6 gap-y-4">
                        @forelse($vendors as $vendor)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" wire:model="selected_vendors" value="{{ $vendor->id_vendor }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-base text-gray-800 group-hover:text-primary transition-colors">{{ $vendor->nama_perusahaan }}</span>
                        </label>
                        @empty
                        <span class="text-gray-500 text-sm col-span-4">Tidak ada vendor (status approved) di kategori ini.</span>
                        @endforelse
                    </div>
                    @error('selected_vendors') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Description Topic -->
                <div class="flex items-center gap-4 mt-6 mb-3"> 
                    <i class="fa-solid fa-box text-[32px] text-black"></i>
                    <div>
                        <h3 class="text-[16px] font-bold text-black leading-tight">Spesifikasi Barang</h3>
                        <p class="text-[14px] text-gray-400 font-medium mt-0.5">Deskripsikan spesifikasi barang yang dibutuhkan</p>
                    </div>
                </div>

                <!-- Table Wrapper with Add Button Container -->
                <div class="flex items-end gap-3 mb-8 w-full">
                    <!-- Data Table -->
                    <div class="w-full overflow-x-auto flex-1">
                        <table class="w-full border-collapse border border-gray-400 min-w-[600px]">
                            <thead>
                                <tr class="bg-[#3a3fe0] text-white">
                                    <th class="border border-gray-400 py-3 text-[14px] font-normal w-1/4 text-center">Nama Barang</th>
                                    <th class="border border-gray-400 py-3 text-[14px] font-normal w-2/4 text-center">Spesifikasi detail</th>
                                    <th class="border border-gray-400 py-3 text-[14px] font-normal w-1/6 text-center">Jumlah</th>
                                    <th class="border border-gray-400 py-3 text-[14px] font-normal w-1/12 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $index => $item)
                                <tr>
                                    <td class="border border-gray-400 p-0">
                                        <input type="text" wire:model="items.{{ $index }}.nama_barang" placeholder="Nama Barang"
                                            class="w-full h-[45px] px-2 outline-none border-none">
                                        @error('items.'.$index.'.nama_barang') <div class="text-red-500 text-xs px-2">{{ $message }}</div> @enderror
                                    </td>
                                    <td class="border border-gray-400 p-0">
                                        <input type="text" wire:model="items.{{ $index }}.spesifikasi" placeholder="Spesifikasi detail"
                                            class="w-full h-[45px] px-2 outline-none border-none">
                                        @error('items.'.$index.'.spesifikasi') <div class="text-red-500 text-xs px-2">{{ $message }}</div> @enderror
                                    </td>
                                    <td class="border border-gray-400 p-0">
                                        <input type="number" wire:model="items.{{ $index }}.jumlah" placeholder="Jumlah" min="1"
                                            class="w-full h-[45px] px-2 outline-none border-none">
                                        @error('items.'.$index.'.jumlah') <div class="text-red-500 text-xs px-2">{{ $message }}</div> @enderror
                                    </td>
                                    <td class="border border-gray-400 p-0 text-center">
                                        @if(!$edit_id)
                                        <button type="button" wire:click="hapusBaris({{ $index }})" class="text-red-500 hover:text-red-700 w-full h-[45px]">
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
                    @if(!$edit_id)
                    <div class="flex-shrink-0 flex items-center justify-center mb-1">
                        <button type="button" wire:click="addBaris"
                            class="w-8 h-8 rounded-full bg-black text-white hover:bg-gray-800 transition flex items-center justify-center">
                            <i class="fa-solid fa-plus text-[14px]"></i>
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons Menu -->
                <div class="flex flex-col sm:flex-row justify-end items-center gap-3">
                    <button type="submit"
                        class="w-full sm:w-[150px] py-2.5 bg-[#1e40ff] text-white font-bold rounded-lg hover:bg-blue-500 transition disabled:opacity-50" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">{{ $edit_id ? 'Update Barang' : 'Tambah Barang' }}</span>
                        <span wire:loading wire:target="store">Loading...</span>
                    </button>
                    @if($edit_id)
                    <button type="button" wire:click="cancelEdit"
                        class="w-full sm:w-[150px] py-2.5 bg-gray-500 text-white font-bold rounded-lg hover:bg-gray-600 transition">
                        Batal Edit
                    </button>
                    @endif
                </div>

            </form>

            @if(count($savedPenawaran) > 0)
            <div class="bg-white rounded-xl border border-gray-400 p-6 md:p-8 shadow-sm flex flex-col relative w-full mt-6">
                <div class="flex items-center gap-4 mb-4">
                    <i class="fa-solid fa-list-check text-[24px] text-black"></i>
                    <div>
                        <h3 class="text-[16px] font-bold text-black leading-tight">Barang yang Sudah Ditambahkan</h3>
                        <p class="text-[14px] text-gray-400 font-medium mt-0.5">Daftar barang pada batch ini</p>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-400 min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800">
                                <th class="border border-gray-400 py-3 text-[14px] font-bold w-1/4 text-left px-4">Nama Barang</th>
                                <th class="border border-gray-400 py-3 text-[14px] font-bold w-1/3 text-left px-4">Spesifikasi detail</th>
                                <th class="border border-gray-400 py-3 text-[14px] font-bold w-1/6 text-center px-4">Vendor Tujuan</th>
                                <th class="border border-gray-400 py-3 text-[14px] font-bold w-1/12 text-center px-4">Jumlah</th>
                                <th class="border border-gray-400 py-3 text-[14px] font-bold w-1/6 text-center px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($savedPenawaran as $penawaran)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-400 p-3 text-sm">{{ $penawaran->nama_barang }}</td>
                                <td class="border border-gray-400 p-3 text-sm">{{ $penawaran->spesifikasi }}</td>
                                <td class="border border-gray-400 p-3 text-sm text-center">
                                    <div class="flex flex-col gap-1">
                                        @foreach($penawaran->penawaranVendors as $pv)
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md whitespace-nowrap">{{ $pv->vendor->nama_perusahaan ?? 'Unknown' }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border border-gray-400 p-3 text-sm text-center font-bold">{{ $penawaran->jumlah }}</td>
                                <td class="border border-gray-400 p-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button wire:click="editPenawaran({{ $penawaran->id_penawaran }})" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click="deletePenawaran({{ $penawaran->id_penawaran }})" onclick="confirm('Yakin ingin menghapus barang ini?') || event.stopImmediatePropagation()" class="text-red-500 hover:text-red-700 transition" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Tombol Selesai (Kembali ke batch list) -->
            <div class="mt-8 flex justify-end">
                <a href="{{ route('procurement-batch_barang_empty') }}" class="w-full sm:w-auto px-8 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-500 transition shadow-md text-center">
                    Selesai & Kembali
                </a>
            </div>

        </div>

    </main>
</div>
