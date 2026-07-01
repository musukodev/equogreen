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
                  
                    <!-- Nama Procurement -->
                    <div class="flex flex-col gap-2">
                        <label for="nama_procurement" class="text-[15px] font-semibold text-gray-700">
                            Nama Procurement
                        </label>
                        <input
                            id="nama_procurement"
                            type="text"
                            wire:model="nama_procurement"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            required
                        />
                        @error('nama_procurement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Username -->
                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-[15px] font-semibold text-gray-700">
                            Username
                        </label>
                        <input
                            id="username"
                            type="text"
                            wire:model="username"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                            placeholder="Username"
                            required
                        />
                        @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email Procurement -->
                    <div class="flex flex-col gap-2">
                        <label for="email_procurement" class="text-[15px] font-semibold text-gray-700">
                            Email Procurement
                        </label>
                        <input
                            id="email_procurement"
                            type="email"
                            wire:model="email"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan email"
                            required
                        />
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- No. Handphone -->
                    <div class="flex flex-col gap-2">
                        <label for="no_handphone" class="text-[15px] font-semibold text-gray-700">
                            No. Handphone Procurement
                        </label>
                        <input
                            id="no_handphone"
                            type="tel"
                            wire:model="no_hp"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Masukkan no. handphone"
                            required
                        />
                        @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
