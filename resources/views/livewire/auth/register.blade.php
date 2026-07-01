<div class="font-inter relative min-h-screen w-full"
    style="background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%);">

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animate-blob-delay {
            animation: blob 9s infinite 2s;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>

    <!-- Decorative background blobs -->
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden opacity-[0.8]">
        <div
            class="animate-blob absolute left-[-10%] top-[-10%] h-[40%] w-[40%] rounded-full bg-blue-200 opacity-70 mix-blend-multiply blur-[80px] filter">
        </div>
        <div
            class="animate-blob animation-delay-2000 absolute right-[-10%] top-[20%] h-[35%] w-[35%] rounded-full bg-slate-300 opacity-70 mix-blend-multiply blur-[80px] filter">
        </div>
        <div
            class="animate-blob animation-delay-4000 absolute bottom-[-20%] left-[20%] h-[45%] w-[45%] rounded-full bg-blue-100 opacity-70 mix-blend-multiply blur-[80px] filter">
        </div>
        <!-- Add subtle grid overlay -->
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: linear-gradient(#1d4ed8 1px, transparent 1px), linear-gradient(to right, #1d4ed8 1px, transparent 1px); background-size: 40px 40px;">
        </div>
    </div>

    <!-- Full-screen split layout -->
    <div class="relative z-10 flex min-h-screen w-full flex-col md:flex-row">

        <!-- Left panel (full on desktop, stacked on mobile) -->
        <div
            class="relative flex w-full flex-col overflow-hidden bg-blue-700 p-6 text-white md:min-h-screen md:w-[45%] md:p-8 lg:p-10 xl:p-12">

            <!-- Background decorations -->
            <div class="pointer-events-none absolute inset-0 opacity-10"
                style="background-image: radial-gradient(white 1.5px, transparent 1.5px); background-size: 24px 24px;">
            </div>
            <!-- Gradient overlay at bottom -->
            <div class="pointer-events-none absolute bottom-0 left-0 right-0 h-64"
                style="background: linear-gradient(to top, rgba(17,53,148,0.5), transparent);"></div>
            <!-- Decorative circles -->
            <div
                class="pointer-events-none absolute -bottom-24 -right-24 h-72 w-72 rounded-full border border-white/10">
            </div>
            <div
                class="pointer-events-none absolute -bottom-16 -right-16 h-52 w-52 rounded-full border border-white/10">
            </div>
            <div class="pointer-events-none absolute -right-32 top-1/2 h-64 w-64 rounded-full bg-blue-600/40"></div>

            <div class="relative z-10 flex h-full flex-col">
                <!-- Logo Header -->
                <div class="animate-fade-in-up mb-4 flex items-center gap-3 opacity-0 md:mb-5 md:gap-3 lg:mb-6"
                    style="animation-delay: 50ms;">
                    <img src="{{ asset('gambar/logo-putih.png') }}" alt="Equogreen Logo"
                        class="h-10 w-auto object-contain drop-shadow-sm md:h-12 lg:h-14">
                    <span
                        class="text-2xl font-bold leading-none tracking-wide text-white md:text-2xl lg:text-3xl">Equogreen</span>
                </div>

                <!-- Main Copy -->
                <div class="animate-fade-in-up mb-4 opacity-0 md:mb-5 lg:mb-6" style="animation-delay: 150ms;">
                    <span
                        class="mb-2.5 inline-block rounded-full border border-white/20 bg-white/15 px-3 py-1 text-[10px] font-semibold uppercase tracking-widest text-blue-100 md:mb-3 md:text-xs">E-Quotation
                        Platform</span>
                    <h1
                        class="mb-2 text-[1.8rem] font-bold leading-tight md:text-[2.2rem] lg:text-[2.5rem] xl:text-[2.8rem]">
                        Bergabung<br>Bersama Kami<br>Sebagai Mitra
                    </h1>
                    <p class="pr-2 text-sm leading-relaxed text-blue-100 opacity-95 md:pr-4 md:text-xs lg:text-sm">
                        Daftarkan perusahaan Anda dan mulai berpartisipasi dalam berbagai pengadaan proyek dan quotation
                        secara digital.
                    </p>
                </div>


                <!-- Steps List -->
                <div class="animate-fade-in-up space-y-2 opacity-0 md:space-y-3" style="animation-delay: 250ms;">
                    <!-- Step 1 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            1</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Daftar Akun</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Lengkapi profil
                                perusahaan Anda</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                    <!-- Step 2 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            2</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Verifikasi Profil</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Kami akan
                                meninjau pendaftaran Anda</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                    <!-- Step 3 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            3</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Mulai Berbisnis</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Terima RFQ dan
                                submit quotation online</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN — Registration Form -->
        <div
            class="relative flex w-full items-center justify-center bg-transparent p-4 sm:p-6 md:min-h-screen md:w-[55%] md:p-8 lg:p-10">
            <!-- Form Card -->
            <div class="animate-fade-in-up relative mx-auto my-auto w-full max-w-[760px] rounded-3xl border border-white/80 bg-white/95 p-5 opacity-0 shadow-[0_15px_50px_rgba(29,78,216,0.08)] backdrop-blur-md md:p-7"
                style="animation-delay: 350ms;">
                <!-- Heading -->
                <div class="mb-4 border-b border-gray-100 pb-3">
                    <h2 class="mb-1 text-xl font-bold leading-tight text-gray-900 md:text-2xl">Registrasi Vendor</h2>
                    <p class="text-xs text-gray-500 md:text-sm">Lengkapi formulir di bawah ini untuk mendaftarkan
                        perusahaan Anda.</p>
                </div>

                @if (session('success'))
                    <div
                        class="mb-4 flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 p-2.5 text-xs text-green-700">
                        <i class="ph-fill ph-check-circle text-lg"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-2.5">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0.5 flex items-center gap-1 text-[11px] text-red-600 last:mb-0">
                                <i class="ph-fill ph-warning-circle"></i> {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <!-- Form -->
                <form class="mx-auto mt-10 max-w-4xl" wire:submit="register">
                    @csrf
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-x-5">
                        <!-- Left Fields -->
                        <div class="space-y-3">
                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Nama Perusahaan</label>
                                <input type="text" wire:model="nama_perusahaan"
                                    class="@error('nama_perusahaan') border-red-500 @else border-gray-300 @enderror h-10 w-full rounded-xl border bg-white px-3.5 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required />
                                @error('nama_perusahaan')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Email Perusahaan</label>
                                <input type="email" wire:model="email_perusahaan"
                                    class="@error('email_perusahaan') border-red-500 @else border-gray-300 @enderror h-10 w-full rounded-xl border bg-white px-3.5 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required />
                                @error('email_perusahaan')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">No. Handphone
                                    Perusahaan</label>
                                <input type="text" wire:model="no_hp"
                                    class="@error('no_hp') border-red-500 @else border-gray-300 @enderror h-10 w-full rounded-xl border bg-white px-3.5 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required />
                                @error('no_hp')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Alamat Perusahaan</label>
                                <textarea wire:model="alamat"
                                    class="@error('alamat') border-red-500 @else border-gray-300 @enderror h-[82px] w-full resize-none rounded-xl border bg-white px-3.5 py-2 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required></textarea>
                                @error('alamat')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Kategori Vendor</label>
                                <div class="relative">
                                    <select wire:model="kategori_vendor"
                                        class="@error('kategori_vendor') border-red-500 @else border-gray-300 @enderror h-10 w-full appearance-none rounded-xl border bg-white px-3.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        required>
                                        <option value="" disabled selected>Pilih Kategori Vendor</option>
                                        <option value="atk">ATK</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="furniture">Furniture</option>
                                        <option value="cleaning">Cleaning Supply</option>
                                        <option value="supplier umum">Supplier Umum</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-gray-500">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </div>
                                </div>
                                @error('kategori_vendor')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Fields -->
                        <div class="space-y-3">
                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Nama Penanggung
                                    Jawab</label>
                                <input type="text" wire:model="penanggung_jawab"
                                    class="@error('penanggung_jawab') border-red-500 @else border-gray-300 @enderror h-10 w-full rounded-xl border bg-white px-3.5 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required />
                                @error('penanggung_jawab')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold text-gray-700">Deskripsi
                                    Perusahaan</label>
                                <textarea wire:model="deskripsi"
                                    class="@error('deskripsi') border-red-500 @else border-gray-300 @enderror h-[82px] w-full resize-none rounded-xl border bg-white px-3.5 py-2 text-sm transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    required></textarea>
                                @error('deskripsi')
                                    <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- PROVINSI & KOTA -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700">Provinsi</label>
                                    <div class="relative" wire:ignore.self>
                                        <select wire:model.live="provinsi"
                                            class="@error('provinsi') border-red-500 @else border-gray-300 @enderror h-10 w-full appearance-none rounded-xl border bg-white px-3 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                            required>
                                            <option value="">Provinsi</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province['id'] }}">{{ $province['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
                                            <i class="ph-bold ph-caret-down"></i>
                                        </div>
                                    </div>
                                    @error('provinsi')
                                        <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700">Kota</label>
                                    <div class="relative" wire:ignore.self>
                                        <select wire:model.live="kota"
                                            class="@error('kota') border-red-500 @else border-gray-300 @enderror h-10 w-full appearance-none rounded-xl border bg-white px-3 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                            required>
                                            <option value="">Kota</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
                                            <i class="ph-bold ph-caret-down"></i>
                                        </div>
                                    </div>
                                    @error('kota')
                                        <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- KECAMATAN & KODE POS -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700">Kecamatan</label>
                                    <div class="relative" wire:ignore.self>
                                        <select wire:model="kecamatan"
                                            class="@error('kecamatan') border-red-500 @else border-gray-300 @enderror h-10 w-full appearance-none rounded-xl border bg-white px-3 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                            required>
                                            <option value="">Kecamatan</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district['id'] }}">{{ $district['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
                                            <i class="ph-bold ph-caret-down"></i>
                                        </div>
                                    </div>
                                    @error('kecamatan')
                                        <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="mb-1 block text-xs font-semibold text-gray-700">Kode Pos</label>
                                    <input wire:model="kode_pos" type="text" placeholder="Kode Pos"
                                        class="@error('kode_pos') border-red-500 @else border-gray-300 @enderror h-10 w-full rounded-xl border bg-white px-3.5 text-sm text-gray-700 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        required />
                                    @error('kode_pos')
                                        <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload -->
                    <div class="mt-4">
                        <label class="mb-1 block text-xs font-semibold text-gray-700">Portofolio Perusahaan</label>
                        <div class="rounded-xl border border-gray-200 bg-slate-50/50 p-1" wire:ignore>
                            <div id="dropZone"
                                class="group relative flex h-[74px] cursor-pointer flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-blue-300 bg-blue-50/30 text-xs text-gray-500 transition-colors hover:border-blue-500">
                                <input type="file" id="fileInput" wire:model="portofolio"
                                    accept=".pdf,.doc,.docx"
                                    class="absolute z-10 h-full w-full cursor-pointer opacity-0" required />
                                <div
                                    class="mb-1 rounded-full bg-blue-100 p-1.5 transition-transform group-hover:scale-110">
                                    <i class="ph-duotone ph-file-arrow-up text-lg text-blue-600"></i>
                                </div>
                                <p class="text-xs font-semibold text-gray-700">Pilih file atau seret ke sini</p>
                                <span class="text-[10px] text-gray-500">Mendukung .pdf, .doc, .docx (Maks. 2MB)</span>
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
                                            <p id="fileName"
                                                class="w-full truncate text-xs font-semibold text-gray-800"></p>
                                            <p id="fileSize" class="text-[10px] text-gray-500"></p>
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
                        @error('portofolio')
                            <span class="mt-1 block text-[10px] text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="mt-5">
                        <button type="submit"
                            class="flex h-10 w-full items-center justify-center gap-2 rounded-xl bg-blue-600 text-sm font-bold text-white shadow-md transition-all hover:bg-blue-700 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-500/30">
                            <span wire:loading.remove wire:target="register" class="flex items-center gap-2">
                                Daftarkan Perusahaan <i class="ph-bold ph-arrow-right"></i>
                            </span>
                            <span wire:loading wire:target="register" class="flex items-center gap-2">
                                Memproses...
                            </span>
                        </button>
                    </div>

                    <!-- Login -->
                    <div class="mt-4 text-center">
                        <span class="text-xs text-gray-600">Sudah punya akun?</span>
                        <a href="{{ route('login') }}"
                            class="ml-1 text-xs font-semibold text-blue-600 transition-colors hover:text-blue-700 hover:underline"
                            wire:navigate>Masuk
                            di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script File Preview
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFile = document.getElementById('removeFile');
        const dropZone = document.getElementById('dropZone');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                showPreview(this.files[0]);
            }
        });

        removeFile.addEventListener('click', function() {
            fileInput.value = '';
            filePreview.classList.add('hidden');
            dropZone.classList.remove('hidden');
            fileInput.required = true;
        });

        function showPreview(file) {
            const sizeKB = (file.size / 1024).toFixed(1);
            const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
            fileName.textContent = file.name;
            fileSize.textContent = file.size > 1024 * 1024 ? `${sizeMB} MB` : `${sizeKB} KB`;
            filePreview.classList.remove('hidden');
            dropZone.classList.add('hidden');
        }
    </script>
</div>
