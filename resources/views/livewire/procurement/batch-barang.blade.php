<main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 pt-0 gap-6 h-full overflow-y-auto w-full">
    <!-- Header Layout -->
    <header class="flex flex-col md:flex-row md:items-end justify-between border-b border-gray-200 pb-2 mt-4 md:mt-8 gap-4 px-2 md:px-0">
        <!-- Left: Back Button, Title & Tabs -->
        <div class="flex flex-col gap-4 md:gap-6">
            <!-- Top Section (Mobile & Desktop) -->
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button onclick="toggleSidebar()"
                        class="md:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-all duration-200 shadow-sm flex-shrink-0 group">
                        <img src="/gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <!-- Back Button -->
                    <a href="{{ route('procurement-batch-list') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-all duration-200 shadow-sm" wire:navigate>
                        <img src="/gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                    </a>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827] leading-none">{{ $year }}</h1>
                </div>

                <!-- Tabs Section (Desktop) -->
                <div class="hidden md:flex items-center gap-8 ml-2">
                    <a href="{{ route('procurement-batch_barang_by_year', ['year' => $year]) }}"
                        class="text-[17px] font-bold text-black border-b-[3px] border-primary pb-1 whitespace-nowrap" wire:navigate>
                        Buat Batch
                    </a>
                    <a href="#"
                        class="text-[17px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap">
                        Periksa Barang
                    </a>
                </div>
            </div>

            <!-- Tabs Section (Mobile Only) -->
            <div class="flex md:hidden items-center gap-6 px-1">
                <a href="{{ route('procurement-batch_barang_by_year', ['year' => $year]) }}"
                    class="text-[15px] font-bold text-black border-b-2 border-primary pb-1 whitespace-nowrap" wire:navigate>
                    Buat Batch
                </a>
                <a href="#"
                    class="text-[15px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap">
                    Periksa Barang
                </a>
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

    <!-- Form Workspace / Grid Card -->
    <div class="w-full">
        <div class="bg-white rounded-xl border border-gray-400 p-6 md:p-8 shadow-sm w-full">
            <!-- Toolbar (Search and Add) -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <input type="text" placeholder="Search"
                    class="w-full sm:w-[60%] lg:w-[40%] xl:w-[70%] border border-gray-400 rounded-md px-4 py-2 text-[15px] outline-none focus:border-black transition">

                <button wire:click="$set('showModal', true)"
                    class="w-full sm:w-auto bg-[#1e40ff] text-white font-bold rounded-md px-6 py-2 flex items-center justify-center gap-2 hover:bg-blue-500 transition">
                    <i class="fa-solid fa-plus text-sm"></i> Tambah Batch
                </button>
            </div>

            <!-- Batch Grid -->
            <!-- Tabel Batch -->
            <!-- Title -->
            <div class="mb-4">
                <h2 class="text-xl font-bold text-black">Daftar Batch</h2>
                @if(session('success'))
                    <div class="mt-2 p-3 bg-green-100 border border-green-400 text-green-700 text-sm rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-blue-600 ">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold border-b text-white">No</th>
                            <th class="px-4 py-3 text-left text-sm font-bold border-b text-white">Waktu Mulai</th>
                            <th class="px-4 py-3 text-left text-sm font-bold border-b text-white">Waktu Selesai</th>
                            <th class="px-6 py-3 text-center text-sm font-bold border-b text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($batches as $index => $batch)
                        <tr class="border-b hover:bg-gray-50" wire:key="batch-{{ $batch->id_batch }}">
                            <td class="px-4 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($batch->waktu_mulai)->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-6 py-3 text-center flex justify-center items-center gap-4">
                                <a href="#"
                                    class="flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-[13px] font-bold rounded-md hover:bg-blue-700 transition shadow-sm">
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[12px]"></i>
                                    Buka
                                </a>
                                <!-- Delete Button -->
                                <button type="button" wire:click="deleteBatch('{{ $batch->id_batch }}')" wire:confirm="Hapus batch ini secara permanen?" class="text-red-600 hover:text-red-800 transition-transform hover:scale-110">
                                    <i class="fa-regular fa-trash-can text-[22px]"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                Belum ada batch pada tahun {{ $year }}.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Batch -->
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 transition-all duration-300 backdrop-blur-sm">
        <div class="animate-modal-slide-up bg-brand-bg rounded-lg shadow-xl w-full max-w-[600px] overflow-hidden border border-gray-400">
            <!-- Modal Header -->
            <div class="bg-white px-6 py-4 flex justify-between items-start">
                <div>
                    <h2 class="text-[17px] font-bold text-black leading-tight">Batch Deadline</h2>
                    <p class="text-[13px] text-gray-700 mt-1">Atur tenggat waktu batch pada halaman ini</p>
                </div>
                <button wire:click="$set('showModal', false)"
                    class="w-8 h-8 bg-[#ff4a4a] text-white rounded flex items-center justify-center hover:bg-red-600 transition shadow-sm mt-0.5">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form wire:submit="store" class="p-6 pb-8 border-t border-gray-400 bg-white">
                <!-- Badge -->
                <div class="mb-5">
                    <span class="inline-block px-4 py-1.5 bg-white border border-black rounded text-[15px] font-bold text-black leading-none">
                        Batch {{ $year }}
                    </span>
                </div>

                <!-- Time Input Card 2 (Dates) -->
                <div class="bg-[#4142cf] rounded flex flex-col md:flex-row mb-4 shadow-sm w-full border border-[#4142cf]">
                    <!-- Icon Side -->
                    <div class="w-[80px] h-full min-h-[80px] flex items-center justify-center border-r border-[#696ce6] flex-shrink-0 relative">
                        <i class="fa-regular fa-calendar text-white text-[32px] font-light"></i>
                        <i class="fa-solid fa-clock text-white text-[12px] bg-[#4142cf] rounded-full absolute bottom-[22px] right-[20px] border border-[#4142cf]"></i>
                    </div>
                    <!-- Input Side -->
                    <div class="flex-1 p-4 px-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label class="block text-white text-[13px] mb-1.5">Start Date</label>
                                <input type="date" wire:model="start_date" required class="w-full bg-white rounded-md px-3 py-1.5 text-black outline-none h-[34px] shadow-sm text-[13px]">
                                @error('start_date') <span class="text-red-300 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block text-white text-[13px] mb-1.5">End Date</label>
                                <input type="date" wire:model="end_date" required class="w-full bg-white rounded-md px-3 py-1.5 text-black outline-none h-[34px] shadow-sm text-[13px]">
                                @error('end_date') <span class="text-red-300 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Time Input Card 1 (Times) -->
                <div class="bg-[#4142cf] rounded flex flex-col md:flex-row mb-6 shadow-sm w-full border border-[#4142cf]">
                    <!-- Icon Side -->
                    <div class="w-[80px] h-full min-h-[80px] flex items-center justify-center border-r border-[#696ce6] flex-shrink-0 relative">
                        <i class="fa-regular fa-clock text-white text-[32px] font-light"></i>
                        <i class="fa-solid fa-clock text-white text-[12px] bg-[#4142cf] rounded-full absolute bottom-[22px] right-[20px] border border-[#4142cf]"></i>
                    </div>
                    <!-- Input Side -->
                    <div class="flex-1 p-4 px-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label class="block text-white text-[13px] mb-1.5">Start Time</label>
                                <input type="time" wire:model="start_time" required class="w-full bg-white rounded-md px-3 py-1.5 text-black outline-none h-[34px] shadow-sm">
                                @error('start_time') <span class="text-red-300 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block text-white text-[13px] mb-1.5">End Time</label>
                                <input type="time" wire:model="end_time" required class="w-full bg-white rounded-md px-3 py-1.5 text-black outline-none h-[34px] shadow-sm">
                                @error('end_time') <span class="text-red-300 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-[#1e40ff] hover:bg-blue-700 text-white font-normal text-[15px] py-2.5 rounded shadow transition relative">
                    <span wire:loading.remove wire:target="store">Simpan</span>
                    <span wire:loading wire:target="store">Menyimpan...</span>
                </button>
            </form>
        </div>
    </div>
    @endif
</main>
