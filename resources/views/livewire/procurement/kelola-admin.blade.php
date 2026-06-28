<div>
    <div class="flex flex-col gap-6 p-6 lg:p-8">
        
        @if (session('success'))
            <div class="mb-4 rounded-xl border border-green-400 bg-green-100 p-4 text-sm font-semibold text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-xl border border-red-400 bg-red-100 p-4 text-sm font-semibold text-red-700 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Summary Metric Card & Action Bar -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Metric Card -->
            <div class="flex items-center gap-4 rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] w-full md:w-72">
                <div class="flex h-[52px] w-[52px] shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="ph ph-shield-check text-2xl font-bold"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-900 leading-none mb-1.5">{{ $admins->count() }}</h3>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Admin</p>
                </div>
            </div>

            <!-- Add Button -->
            <button wire:click="openAddModal"
                class="w-full md:w-auto bg-accent text-white font-bold text-sm md:text-base rounded-xl py-3 px-6 hover:bg-[#0023cc] active:scale-95 transition shadow-md flex items-center justify-center gap-2">
                <i class="ph-bold ph-plus text-base"></i>
                <span>Tambah Admin Baru</span>
            </button>
        </div>

        <!-- Admin Table Card -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm mt-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[#3a3fe0] text-white">
                        <th class="w-[25%] border-r border-white/20 px-5 py-3.5 text-left text-sm font-semibold">Nama Admin</th>
                        <th class="w-[20%] border-r border-white/20 px-5 py-3.5 text-left text-sm font-semibold">Username</th>
                        <th class="w-[20%] border-r border-white/20 px-5 py-3.5 text-left text-sm font-semibold">Email</th>
                        <th class="w-[20%] border-r border-white/20 px-5 py-3.5 text-center text-sm font-semibold">No. Handphone</th>
                        <th class="w-[15%] px-5 py-3.5 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr class="border-b border-gray-100 transition duration-150 hover:bg-[#f8f9ff]">
                            <td class="border-r border-gray-100 px-5 py-4 text-sm font-medium text-gray-800">
                                {{ $admin->procurement?->nama_procurement ?? '-' }}
                            </td>
                            <td class="border-r border-gray-100 px-5 py-4 text-sm text-gray-600 font-mono">
                                {{ $admin->username }}
                            </td>
                            <td class="border-r border-gray-100 px-5 py-4 text-sm text-gray-600">
                                {{ $admin->procurement?->email ?? '-' }}
                            </td>
                            <td class="border-r border-gray-100 px-5 py-4 text-center text-sm text-gray-600">
                                {{ $admin->procurement?->no_hp ?? '-' }}
                            </td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button type="button" 
                                        wire:click="editAdmin({{ $admin->id_procurement }})"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition hover:bg-blue-100 hover:text-blue-700"
                                        title="Edit Admin">
                                        <i class="ph-bold ph-pencil-simple-line"></i>
                                    </button>
                                    <button type="button" 
                                        wire:click="deleteAdmin({{ $admin->id_procurement }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus akun procurement ({{ $admin->procurement?->nama_procurement }}) ini?"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-lg font-bold text-red-500 transition hover:bg-red-100 hover:text-red-600"
                                        title="Hapus Admin">
                                        <i class="ph-bold ph-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">Belum ada akun procurement lain yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ========== MODAL: Tambah Admin ========== -->
        @if ($showModal)
        <div class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="animate-modal-slide-up bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-auto p-6 md:p-8 flex flex-col gap-5 border border-gray-150">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $editMode ? 'Edit Akun Admin' : 'Tambah Akun Admin' }}</h2>
                    <button wire:click="$set('showModal', false)"
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500 text-white hover:bg-red-600 transition text-lg font-bold">
                        ✕
                    </button>
                </div>
                <hr class="border-gray-100" />

                <!-- Form -->
                <form wire:submit.prevent="store" class="flex flex-col gap-4">
                    <!-- Nama Lengkap -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" wire:model="nama_procurement" placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" required />
                        @error('nama_procurement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" wire:model="email" placeholder="contoh@gmail.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" required />
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- No HP & Username -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">No. Handphone</label>
                            <input type="text" wire:model="no_hp" placeholder="08xxxx"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" required />
                            @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">Username</label>
                            <input type="text" wire:model="username" placeholder="username"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" required />
                            @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-gray-700">Password {{ $editMode ? '(Kosongkan jika tidak diubah)' : '' }}</label>
                        <input type="password" wire:model="password" placeholder="Password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" {{ $editMode ? '' : 'required' }} />
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-accent text-white font-bold text-base rounded-xl py-3.5 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow-lg mt-2 relative">
                        <span wire:loading.remove wire:target="store">{{ $editMode ? 'Perbarui Admin' : 'Simpan Admin' }}</span>
                        <span wire:loading wire:target="store">Menyimpan...</span>
                    </button>
                </form>
            </div>
        </div>
        @endif

    </div>
</div>
