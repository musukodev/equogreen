<div x-data @profile-updated.window="$el.closest('.overflow-y-auto')?.scrollTo({ top: 0, behavior: 'smooth' })">
    <!-- ===== PROFILE FORM CARD ===== -->
    <div class="flex flex-col gap-6 p-6 lg:p-8">
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-green-400 bg-green-100 p-3 text-[14px] text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-xl border border-red-400 bg-red-100 p-3 text-[14px] text-red-700 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="updateProfile" class="flex flex-col gap-6">

                <!-- Form Container -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                  
                    <!-- Nama Perusahaan -->
                    <div class="flex flex-col gap-2">
                        <label for="nama_perusahaan" class="text-[15px] font-semibold text-gray-700">
                            Nama Perusahaan
                        </label>
                        <input
                            id="nama_perusahaan"
                            type="text"
                            wire:model="nama_perusahaan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            required
                        />
                        @error('nama_perusahaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Perusahaan -->
                    <div class="flex flex-col gap-2">
                        <label for="email_perusahaan" class="text-[15px] font-semibold text-gray-700">
                            Email Perusahaan
                        </label>
                        <input
                            id="email_perusahaan"
                            type="email"
                            wire:model="email_perusahaan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            required
                        />
                        @error('email_perusahaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- No. Handphone -->
                    <div class="flex flex-col gap-2">
                        <label for="no_hp" class="text-[15px] font-semibold text-gray-700">
                            No. Handphone
                        </label>
                        <input
                            id="no_hp"
                            type="tel"
                            wire:model="no_hp"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            required
                        />
                        @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Penanggung Jawab -->
                    <div class="flex flex-col gap-2">
                        <label for="penanggung_jawab" class="text-[15px] font-semibold text-gray-700">
                            Penanggung Jawab
                        </label>
                        <input
                            id="penanggung_jawab"
                            type="text"
                            wire:model="penanggung_jawab"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            required
                        />
                        @error('penanggung_jawab') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="flex flex-col gap-2 col-span-1 md:col-span-2">
                        <label for="alamat" class="text-[15px] font-semibold text-gray-700">
                            Alamat
                        </label>
                        <textarea
                            id="alamat"
                            wire:model="alamat"
                            rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400 resize-none"
                            required
                        ></textarea>
                        @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col gap-2 col-span-1 md:col-span-2">
                        <label for="deskripsi" class="text-[15px] font-semibold text-gray-700">
                            Deskripsi
                        </label>
                        <textarea
                            id="deskripsi"
                            wire:model="deskripsi"
                            rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400 resize-none"
                        ></textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                  
                </div>

                <!-- Ubah Kata Sandi Section -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ubah Kata Sandi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
                    <!-- Password Lama -->
                    <div class="flex flex-col gap-2">
                        <label for="current_password" class="text-[15px] font-semibold text-gray-700">Password Lama</label>
                        <input type="password" id="current_password" wire:model="current_password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan password lama" />
                        @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="flex flex-col gap-2">
                        <label for="new_password" class="text-[15px] font-semibold text-gray-700">Password Baru</label>
                        <input type="password" id="new_password" wire:model="new_password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan password baru" />
                        @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="flex flex-col gap-2">
                        <label for="new_password_confirmation" class="text-[15px] font-semibold text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Ulangi password baru" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
                        <span wire:loading.remove wire:target="updateProfile">Simpan Perubahan</span>
                        <span wire:loading wire:target="updateProfile">Menyimpan...</span>
                    </button>
                </div>

            </form>
        </section>
    </div>
</div>
