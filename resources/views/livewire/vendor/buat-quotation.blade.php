<div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">

    <!-- Main Workspace Padding Wrapper -->
    <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 gap-6 overflow-y-auto relative">

        <!-- Top Header -->
        <header class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                    <img src="/gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <!-- Back Button -->
                <a href="{{ route('vendor-dashboard') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm">
                    <img src="/gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                </a>
                <div>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Buat Quotation</h1>
                    <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Isi quotation sesuai ketentuan yang berlaku</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button
                    class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                    <img src="/gambar/bell-black.png" alt="Notifikasi"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>

                <!-- Profile -->
                <img src="/gambar/profileup.png" alt="Profil"
                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <span class="hidden md:block font-medium text-gray-700 text-[17px]">{{ Auth::user()->vendor->nama_perusahaan ?? 'Vendor' }}</span>
            </div>
        </header>

        <!-- Form Workspace -->
        <div class="w-full pb-10">

            @if($batch)
            <!-- Topic Card -->
            <div class="bg-white rounded-xl border border-gray-400 shadow-sm p-4 mb-2 flex items-center gap-3 md:gap-4 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group mt-6">
                <div class="w-[42px] h-[42px] md:w-[50px] md:h-[50px] rounded-full bg-[#4a40ce] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-box-open text-white text-lg md:text-xl"></i>
                </div>
                <div>
                    <h2 class="text-base md:text-lg font-bold text-black mb-0.5">Pengadaan Barang Batch {{ $batch->id_batch }}</h2>
                    <p class="text-gray-500 text-xs md:text-[15px]">ID Batch: {{ $batch->id_batch }}</p>
                </div>
            </div>

            <!-- Form Card -->
            <form action="{{ route('fastexcel.import') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-gray-400 p-6 shadow-sm flex flex-col transition-all duration-300 hover:scale-[1.005] hover:shadow-md mb-8">
                @csrf
                <input type="hidden" name="id_vendor" value="{{ Auth::user()->vendor->id_vendor }}">
                @if($batch->penawaran->isNotEmpty())
                <input type="hidden"
                    name="id_penawaran"
                    value="{{ $batch->penawaran->first()->id_penawaran }}">
                @endif
                <!-- Deadline Box -->
                <div class="bg-[#ebeaef] rounded-md px-4 pt-3 pb-1 mb-6">
                    <p class="text-black text-[13px] md:text-[15px]"><span class="font-bold">Tenggat Waktu:</span>
                        {{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('l, d F Y, H:i') }}
                    </p>
                    <div class="h-px bg-gray-500 w-full mt-2.5"></div>
                </div>

                <!-- Description Area -->
                <div class="flex items-start gap-4 mb-6 pt-1">
                    <!-- Icon outline box -->
                    <i class="fa-solid fa-box text-[24px] md:text-[28px] text-black"></i>
                    <div>
                        <h3 class="text-[15px] md:text-[16px] font-bold text-black mb-0.5">Deskripsi Spesifikasi Barang</h3>
                        <p class="text-[14px] text-gray-500">Perhatikan spesifikasi barang dengan baik</p>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="w-full mb-8 overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-400 min-w-[500px]">
                        <thead>
                            <tr class="bg-[#3a3fe0] text-white text-[15px]">
                                <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Nama Barang</th>
                                <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Spesifikasi detail</th>
                                <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($batch->penawaran as $item)
                            <tr>
                                <td class="border border-gray-400 px-4 py-2 text-sm text-gray-800">{{ $item->nama_barang }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-sm text-gray-800">{{ $item->spesifikasi }}</td>
                                <td class="border border-gray-400 px-4 py-2 text-sm text-gray-800 text-center">{{ $item->jumlah }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="border border-gray-400 p-4 text-center text-sm text-gray-500">Tidak ada barang dalam penawaran ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 w-full">
                    <a href="{{ route('download-template') }}"
                        class="block w-full bg-black text-white text-center text-[15px] py-3.5 rounded-lg hover:bg-gray-800 transition">
                        Download Template
                    </a>

                    <!-- MODIFIKASI UPLOAD BOX DISINI -->
                    <div class="w-full pt-1 pb-1">
                        <label for="file-upload-{{ $batch->id_batch }}"
                            class="border-[1.5px] border-gray-400 rounded-lg py-7 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition w-full">

                            <i class="fa-solid fa-arrow-up-from-bracket text-[#a0a0a0] mb-2 text-lg"></i>

                            <span id="upload-text-{{ $batch->id_batch }}"
                                class="text-[#a0a0a0] text-[15px]">
                                Upload File
                            </span>

                            <input
                                id="file-upload-{{ $batch->id_batch }}"
                                name="file"
                                type="file"
                                class="hidden"
                                onchange="showFileName(this, '{{ $batch->id_batch }}')" />
                        </label>

                        <p class="text-[#a0a0a0] text-[13px] mt-1.5 ml-1">
                            Accepted files: xlsx, xls, csv
                        </p>
                    </div>
                    <!-- Tombol submit -->
                    <button type="submit" class="w-full bg-[#1e40ff] text-white text-center text-[15px] py-3.5 rounded-lg hover:bg-blue-700 transition relative">
                        Kirim
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="mt-5 text-[14px] text-black">
                    Tata cara quotation <a href="#" class="text-[#1e40ff]">Unduh</a>
                </div>
            </form>
            @else
            <div class="bg-white rounded-xl border border-gray-400 p-10 shadow-sm flex flex-col items-center justify-center text-center">
                <i class="fa-regular fa-folder-open text-[48px] text-gray-300 mb-4"></i>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pengadaan</h2>
                <p class="text-gray-500">Saat ini belum ada penawaran pengadaan barang yang ditujukan untuk perusahaan Anda.</p>
            </div>
            @endif

        </div>

    </main>
</div>
<script>
    function showFileName(input, batchId) {
    if (input.files.length > 0) {
        let file = input.files[0];
        let size = (file.size / 1024).toFixed(2);

        document.getElementById('upload-text-' + batchId)
            .textContent = `${file.name} (${size} KB)`;
    }
}
</script>