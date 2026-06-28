<div>
    <!-- Form Workspace -->
    <div class="flex flex-col gap-6 p-6 lg:p-8">
        <!-- Notifikasi Waktu Habis -->
        @if ($isExpired)
            <div
                class="flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                <i class="ph-fill ph-warning text-xl"></i>
                Batas waktu pengisian penawaran (deadline) telah berakhir. Anda tidak dapat melakukan perubahan atau
                pengiriman berkas quotation.
            </div>
        @endif

        @if ($isApproved)
            <div
                class="flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">
                <i class="ph-fill ph-check-circle text-xl"></i>
                Quotation Anda untuk pengadaan ini telah disetujui oleh Procurement. Berkas Purchase Order (PO) telah
                diterbitkan.
            </div>
        @endif

        @if (session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="w-full pb-10">

            @if ($batch)
                <!-- Topic Card -->
                <div
                    class="group mb-2 mt-6 flex cursor-pointer items-center gap-3 rounded-xl border border-gray-400 bg-white p-4 shadow-sm transition-all duration-300 hover:scale-[1.01] hover:shadow-md md:gap-4">
                    <div
                        class="flex h-[42px] w-[42px] flex-shrink-0 items-center justify-center rounded-full bg-[#4a40ce] md:h-[50px] md:w-[50px]">
                        <i class="fa-solid fa-box-open text-lg text-white md:text-xl"></i>
                    </div>
                    <div>
                        <h2 class="mb-0.5 text-base font-bold text-black md:text-lg">Pengadaan Barang Batch
                            {{ $batch->id_batch }}</h2>
                        <p class="text-xs text-gray-500 md:text-[15px]">ID Batch: {{ $batch->id_batch }}</p>
                    </div>
                </div>

                <!-- Form Card -->
                <form action="{{ route('fastexcel.import') }}" method="POST" enctype="multipart/form-data"
                    class="mb-8 mt-6 flex flex-col rounded-xl border border-gray-400 bg-white p-6 shadow-sm transition-all duration-300 hover:scale-[1.005] hover:shadow-md">
                    @csrf
                    <input type="hidden" name="id_vendor" value="{{ Auth::user()->vendor->id_vendor }}">
                    @if ($penawarans->isNotEmpty())
                        <input type="hidden" name="id_penawaran" value="{{ $penawarans->first()->id_penawaran }}">
                    @endif


                    <!-- Deadline Box -->
                    <div class="mb-6 rounded-md bg-[#ebeaef] px-4 pb-1 pt-3">
                        <p class="text-[13px] text-black md:text-[15px]"><span class="font-bold">Tenggat Waktu:</span>
                            {{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('l, d F Y, H:i') }}
                        </p>
                        <div class="mt-2.5 h-px w-full bg-gray-500"></div>
                    </div>

                    <!-- Description Area -->
                    <div class="mb-6 flex items-start gap-4 pt-1">
                        <!-- Icon outline box -->
                        <i class="fa-solid fa-box text-[24px] text-black md:text-[28px]"></i>
                        <div>
                            <h3 class="mb-0.5 text-[15px] font-bold text-black md:text-[16px]">Deskripsi Spesifikasi
                                Barang</h3>
                            <p class="text-[14px] text-gray-500">Perhatikan spesifikasi barang dengan baik</p>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="mb-8 w-full overflow-x-auto">
                        <table class="w-full min-w-[500px] border-collapse border border-gray-400">
                            <thead>
                                <tr class="bg-[#3a3fe0] text-[15px] text-white">
                                    <th class="w-1/3 border border-gray-400 py-2.5 text-center font-normal">Nama Barang
                                    </th>
                                    <th class="w-1/3 border border-gray-400 py-2.5 text-center font-normal">Spesifikasi
                                        detail</th>
                                    <th class="w-1/3 border border-gray-400 py-2.5 text-center font-normal">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penawarans as $item)
                                    <tr>
                                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-800">
                                            {{ $item->nama_barang }}</td>
                                        <td class="border border-gray-400 px-4 py-2 text-sm text-gray-800">
                                            {{ $item->spesifikasi }}</td>
                                        <td class="border border-gray-400 px-4 py-2 text-center text-sm text-gray-800">
                                            {{ $item->jumlah }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="border border-gray-400 p-4 text-center text-sm text-gray-500">Tidak
                                            ada barang dalam penawaran ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="w-full space-y-3">
                        <a href="{{ route('download-template') }}"
                            class="block w-full rounded-lg bg-black py-3.5 text-center text-[15px] text-white transition hover:bg-gray-800">
                            Unduh Templat
                        </a>

                        <!-- MODIFIKASI UPLOAD BOX DISINI -->
                        @if ($hasUploaded && !$isEditing)
                            <!-- Submission Status Box replacing Upload Box -->
                            <div
                                class="mt-2 rounded-xl border border-gray-300 bg-gray-50 p-5 transition-all duration-300">
                                <div class="mb-4 flex flex-col justify-between gap-4 md:flex-row md:items-center">
                                    <div>
                                        <h2 class="mb-0.5 text-[16px] font-bold text-gray-800">Status Pengiriman</h2>
                                        <p class="text-[13px] text-gray-500">File quotation telah berhasil diunggah.</p>
                                    </div>
                                    @if (!$isExpired && !$isApproved)
                                        <div class="flex flex-wrap gap-2">
                                            <button type="button" wire:click="$set('isEditing', true)"
                                                class="flex items-center gap-2 rounded-lg border border-blue-200 bg-white px-3 py-1.5 text-[13px] font-bold text-blue-700 shadow-sm transition hover:bg-blue-50">
                                                <i class="fa-solid fa-pen-to-square"></i> Ubah
                                            </button>
                                            <button type="button" wire:click="deleteQuotation"
                                                wire:confirm="Apakah Anda yakin ingin menghapus quotation ini?"
                                                class="flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-[13px] font-bold text-red-700 shadow-sm transition hover:bg-red-50">
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <!-- File Submission -->
                                <div
                                    class="flex items-center justify-between rounded-lg border border-gray-200 bg-white p-3 shadow-sm">
                                    <div class="flex w-full items-center gap-3 overflow-hidden">
                                        <div
                                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                            <i class="fa-solid fa-file-excel text-lg text-blue-600"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="mb-0.5 text-[12px] font-medium text-gray-500">Waktu Unggah:
                                                {{ $lastModified ?? '-' }}</p>
                                            <p class="w-full truncate text-[14px] font-bold text-[#1e40ff]">
                                                {{ $uploadedFileName ?? 'File tidak ditemukan' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if (!$isExpired && !$isApproved)
                                <!-- Area Upload File (Drag & Drop) -->
                                <div class="mb-4 mt-4">
                                    <label class="mb-1.5 block text-xs font-semibold text-gray-700">Dokumen Quotation
                                        (.xlsx, .xls, .csv)</label>
                                    <div class="rounded-xl border border-gray-200 bg-slate-50/50 p-1">
                                        <!-- Drop Zone -->
                                        <div id="dropZone"
                                            class="group relative flex h-[74px] cursor-pointer flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-blue-300 bg-blue-50/30 text-xs text-gray-500 transition-colors hover:border-blue-500">
                                            <!-- Input file yang menutupi area agar bisa didrag/diklik -->
                                            <input type="file" id="fileInput" name="file" accept=".xlsx,.xls,.csv"
                                                class="absolute z-10 h-full w-full cursor-pointer opacity-0"
                                                onchange="showFileName(this)" required />

                                            <div
                                                class="mb-1 rounded-full bg-blue-100 p-1.5 transition-transform group-hover:scale-110">
                                                <i class="ph-duotone ph-file-arrow-up text-lg text-blue-600"></i>
                                            </div>
                                            <p class="text-xs font-semibold text-gray-700">Pilih file atau seret ke sini
                                            </p>
                                            <span class="text-[10px] text-gray-500">Mendukung .xlsx, .xls, .csv (Maks.
                                                2MB)</span>
                                        </div>

                                        <!-- File Preview -->
                                        <div id="filePreview" class="mt-2 hidden px-2 pb-2">
                                            <div
                                                class="flex items-center justify-between rounded-xl border border-gray-200 bg-white px-3 py-2 shadow-sm">
                                                <div class="flex min-w-0 flex-1 items-center gap-2">
                                                    <div class="shrink-0 rounded-lg bg-blue-50 p-1">
                                                        <i class="ph-fill ph-file-text text-lg text-blue-600"></i>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pr-3">
                                                        <p id="fileNameDisplay"
                                                            class="w-full truncate text-xs font-semibold text-gray-800">
                                                        </p>
                                                        <p id="fileSizeDisplay" class="text-[10px] text-gray-500"></p>
                                                    </div>
                                                </div>
                                                <button type="button" id="removeFile"
                                                    class="shrink-0 rounded-lg p-1.5 text-red-500 transition-colors hover:bg-red-50 hover:text-red-700"
                                                    title="Hapus file">
                                                    <i class="ph-bold ph-trash text-base"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('file'))
                                        <span class="ml-1 mt-1 block text-xs font-semibold text-red-500">
                                            {{ $errors->first('file') }}
                                        </span>
                                    @endif
                                </div>
                                <!-- Tombol submit -->
                                <button type="submit"
                                    class="relative w-full rounded-lg bg-[#1e40ff] py-3.5 text-center text-[15px] font-bold text-white transition hover:bg-blue-700">
                                    {{ $hasUploaded ? 'Upload Ulang (Ubah)' : 'Kirim' }}
                                </button>
                            @elseif ($isApproved)
                                <!-- Tampilan quotation telah disetujui (read-only) -->
                                <div
                                    class="mt-2 rounded-xl border border-green-300 bg-green-50 p-6 text-center text-green-800">
                                    <i class="fa-solid fa-file-signature mb-3 block text-4xl text-green-500"></i>
                                    <p class="text-sm font-bold">Quotation Disetujui</p>
                                    <p class="mt-1 text-xs text-green-600">Status quotation Anda untuk batch ini sudah
                                        disetujui dan tidak dapat diubah lagi.</p>
                                </div>
                            @else
                                <!-- Tampilan Waktu Habis & Belum Mengajukan -->
                                <div
                                    class="mt-2 rounded-xl border border-gray-300 bg-gray-50 p-8 text-center text-gray-500">
                                    <i class="fa-regular fa-clock mb-3 block text-4xl text-gray-300"></i>
                                    <p class="text-sm font-semibold">Batas Waktu Habis</p>
                                    <p class="mt-1 text-xs text-gray-400">Anda tidak mengirimkan quotation sebelum
                                        waktu
                                        pengadaan berakhir.</p>
                                </div>
                            @endif

                            @if ($isEditing)
                                <button type="button" wire:click="$set('isEditing', false)"
                                    class="relative w-full rounded-lg bg-gray-200 py-3.5 text-center text-[15px] font-bold text-gray-800 transition hover:bg-gray-300">
                                    Batal Edit
                                </button>
                            @endif
                        @endif
                    </div>
                </form>
            @else
                <div
                    class="flex flex-col items-center justify-center rounded-xl border border-gray-400 bg-white p-10 text-center shadow-sm">
                    <i class="fa-regular fa-folder-open mb-4 text-[48px] text-gray-300"></i>
                    <h2 class="mb-2 text-xl font-bold text-gray-800">Belum Ada Pengadaan</h2>
                    <p class="text-gray-500">Saat ini belum ada penawaran pengadaan barang yang ditujukan untuk
                        perusahaan Anda.</p>
                </div>
            @endif

        </div>

        </main>
    </div>
    <script>
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const dropZone = document.getElementById('dropZone');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileSizeDisplay = document.getElementById('fileSizeDisplay');
        const removeFile = document.getElementById('removeFile');

        function showFileName(input) {
            if (input.files && input.files[0]) {
                let file = input.files[0];

                let sizeKB = (file.size / 1024).toFixed(1);
                let sizeMB = (file.size / (1024 * 1024)).toFixed(2);

                fileNameDisplay.textContent = file.name;
                fileSizeDisplay.textContent = file.size > 1024 * 1024 ? `${sizeMB} MB` : `${sizeKB} KB`;

                filePreview.classList.remove('hidden');
                dropZone.classList.add('hidden');
            }
        }

        if (removeFile) {
            removeFile.addEventListener('click', function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
                dropZone.classList.remove('hidden');
            });
        }
    </script>
</div>
</div>
