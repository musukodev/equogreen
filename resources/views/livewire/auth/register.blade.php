<div class="w-full h-full">
<!-- Header -->
<header class="bg-black text-white h-[84px] relative absolute top-0 w-full z-10">
    <div class="absolute left-6 top-7">
        <a href="{{ route('login') }}" wire:navigate class="w-8 h-8 rounded-full border border-white flex items-center justify-center hover:bg-white/10 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col items-center justify-center h-full">
        <div class="flex items-center gap-2">
            <img src="/gambar/logo-putih.png" alt="Logo" class="w-12 h-12">
            <h1 class="text-[16px] font-bold leading-none">Equogreen</h1>
        </div>

        <nav class="flex gap-4 mt-3 text-[12px] text-white/90">
            <a href="#" class="hover:underline">Company Email</a>
            <span class="text-white/40 select-none" aria-hidden="true">|</span>
            <a href="#" class="hover:underline">Company number</a>
            <span class="text-white/40 select-none" aria-hidden="true">|</span>
            <a href="#" class="hover:underline">Company website</a>
        </nav>
    </div>
</header>

<!-- Content -->
<main class="px-[60px] pt-6 pb-10 w-full mt-[84px] overflow-y-auto">
    <!-- Title -->
    <div class="text-center">
        <h2 class="text-[18px] font-semibold text-black">Online Registration</h2>
        <p class="text-[12px] text-gray-700 mt-1">Please fill out this registration form.</p>
    </div>

    <!-- Form -->
    <form class="mt-10 max-w-4xl mx-auto" wire:submit="register">
        <div class="grid grid-cols-2 gap-x-10">

            <!-- Left -->
            <div class="space-y-3">
                <div>
                    <label class="block text-[12px] text-black mb-1">Nama Perusahaan</label>
                    <input type="text" wire:model="nama_perusahaan" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none focus:border-blue-600 transition-colors @error('nama_perusahaan') border-red-500 @enderror" required />
                    @error('nama_perusahaan') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[12px] text-black mb-1">Email Perusahaan</label>
                    <input type="email" wire:model="email_perusahaan" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none focus:border-blue-600 transition-colors @error('email_perusahaan') border-red-500 @enderror" required/>
                    @error('email_perusahaan') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[12px] text-black mb-1">No. Handphone Perusahaan</label>
                    <input type="text" wire:model="no_hp" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none focus:border-blue-600 transition-colors @error('no_hp') border-red-500 @enderror" required />
                    @error('no_hp') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[12px] text-black mb-1">Alamat Perusahaan</label>
                    <textarea wire:model="alamat" class="w-full h-[100px] border border-gray-400 rounded-[4px] px-2 py-2 text-[12px] resize-none focus:outline-none focus:border-blue-600 transition-colors @error('alamat') border-red-500 @enderror" required></textarea>
                    @error('alamat') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[12px] text-black mb-1">Kategori Vendor</label>
                    <select wire:model="kategori_vendor" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22/></svg>')] bg-no-repeat bg-[right_8px_center] @error('kategori_vendor') border-red-500 @enderror" required>
                        <option value="" disabled selected>Pilih Kategori Vendor</option>
                        <option value="supplier">Supplier</option>
                        <option value="kontraktor">Kontraktor</option>
                        <option value="distributor">Distributor</option>
                        <option value="jasa">Jasa</option>
                    </select>
                    @error('kategori_vendor') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Right -->
            <div class="space-y-3">
                <div>
                    <label class="block text-[12px] text-black mb-1">Nama Penanggung jawab</label>
                    <input type="text" wire:model="penanggung_jawab" class="w-full h-[24px] border border-gray-400 rounded-[4px] px-2 text-[12px] focus:outline-none focus:border-blue-600 transition-colors @error('penanggung_jawab') border-red-500 @enderror" required />
                    @error('penanggung_jawab') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[12px] text-black mb-1">Deskripsi Perusahaan</label>
                    <textarea wire:model="deskripsi" class="w-full h-[125px] border border-gray-400 rounded-[4px] px-2 py-2 text-[12px] resize-none focus:outline-none focus:border-blue-600 transition-colors @error('deskripsi') border-red-500 @enderror" required></textarea>
                    @error('deskripsi') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>

                <!-- PROVINSI -->
                <div wire:ignore.self>
                    <select wire:model.live="provinsi" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22/></svg>')] bg-no-repeat bg-[right_8px_center]" required>
                        <option value="">Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- KOTA -->
                <div wire:ignore.self>
                    <select wire:model.live="kota" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22/></svg>')] bg-no-repeat bg-[right_8px_center]" required>
                        <option value="">Kota</option>
                        @foreach($cities as $city)
                            <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- KECAMATAN -->
                <div wire:ignore.self>
                    <select wire:model="kecamatan" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22gray%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22/></svg>')] bg-no-repeat bg-[right_8px_center]" required>
                        <option value="">Kecamatan</option>
                        @foreach($districts as $district)
                            <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- KODE POS -->
                <div>
                    <input wire:model="kode_pos" type="text" placeholder="Kode Pos" class="w-full h-[28px] border border-gray-400 rounded-[4px] px-2 text-[12px] text-gray-600 bg-white focus:outline-none focus:border-blue-600 transition-colors @error('kode_pos') border-red-500 @enderror" required>
                    @error('kode_pos') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Upload -->
        <div class="mt-2">
            <label class="block text-[12px] text-black mb-1">Portofolio Perusahaan</label>
            <div class="border border-gray-400 rounded-[4px] p-1">
                <div class="relative border border-dashed border-gray-400 rounded-[4px] h-[68px] flex flex-col items-center justify-center text-[12px] text-gray-700 overflow-hidden">
                    <input type="file" wire:model="portofolio" accept=".pdf,.docx" class="absolute w-full h-full opacity-0 cursor-pointer" required />
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mb-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
                    </svg>
                    <p>You can drag and drop files here to add them.</p>
                </div>
            </div>
            @error('portofolio') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
            <p class="text-[12px] text-black mt-1">Accepted files type : .pdf, .docx</p>
        </div>

        <!-- Button -->
        <div class="mt-3">
            <button type="submit" class="w-full h-[32px] bg-blue-700 text-white text-[12px] rounded-[4px] hover:bg-blue-800 transition relative">
                <span wire:loading.remove wire:target="register">Registrasi</span>
                <span wire:loading wire:target="register">Memproses...</span>
            </button>
        </div>

        <!-- Login -->
        <div class="text-right mt-2 text-[12px]">
            <span class="text-black">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline" wire:navigate> Login.</a>
        </div>
        
        @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 text-[12px] rounded">
                {{ session('success') }}
            </div>
        @endif
    </form>
</main>
</div>
