<div>
    <div class="flex flex-col gap-6 p-6 lg:p-8">

        <!-- Form Workspace / Grid Card -->
        <div class="w-full">
            <div class="w-full rounded-xl border border-gray-400 bg-white p-6 shadow-sm md:p-8">
                <!-- Toolbar (Search and Add) -->
                <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                    <input type="text" placeholder="Cari..."
                        class="w-full rounded-md border border-gray-400 px-4 py-2 text-[15px] outline-none transition focus:border-black sm:w-[60%] lg:w-[40%] xl:w-[70%]">

                    <button wire:click="openAddModal"
                        class="flex w-full items-center justify-center gap-2 rounded-md bg-[#1e40ff] px-6 py-2 font-bold text-white transition hover:bg-blue-500 sm:w-auto">
                        <i class="fa-solid fa-plus text-sm"></i> Tambah Batch
                    </button>
                </div>

                <!-- Batch Grid -->
                <!-- Tabel Batch -->
                <!-- Title -->
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-black">Daftar Batch</h2>
                    @if (session('success'))
                        <div class="mt-2 rounded border border-green-400 bg-green-100 p-3 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full overflow-hidden rounded-lg border border-gray-300">
                        <thead class="bg-blue-600">
                            <tr>
                                <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">No</th>
                                <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Waktu Mulai</th>
                                <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Waktu Selesai</th>
                                <th class="border-b px-6 py-3 text-center text-sm font-bold text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($batches as $index => $batch)
                                <tr class="border-b hover:bg-gray-50" wire:key="batch-{{ $batch->id_batch }}">
                                    <td class="whitespace-nowrap px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="whitespace-nowrap px-4 py-3">
                                        {{ \Carbon\Carbon::parse($batch->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3">
                                        {{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('d F Y, H:i') }}
                                    </td>
                                    <td class="flex items-center justify-center gap-4 px-6 py-3 text-center">
                                        <a href="{{ route('procurement-tambah_barang', ['batch_id' => $batch->id_batch]) }}"
                                            class="text-gray-400 transition-all duration-150 hover:scale-110 hover:text-black"
                                            title="Buka Batch"
                                            wire:navigate>
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[18px]"></i>
                                        </a>
                                        <!-- Edit Button -->
                                        <button type="button" wire:click="editBatch('{{ $batch->id_batch }}')"
                                            class="text-blue-600 transition-transform hover:scale-110 hover:text-blue-800"
                                            title="Ubah Batch">
                                            <i class="ph-bold ph-pencil-simple-line text-[22px]"></i>
                                        </button>
                                        <!-- Delete Button -->
                                        <button type="button" wire:click="deleteBatch('{{ $batch->id_batch }}')"
                                            wire:confirm="Hapus batch ini secara permanen?"
                                            class="text-red-600 transition-transform hover:scale-110 hover:text-red-800"
                                            title="Hapus Batch">
                                            <i class="fa-regular fa-trash-can text-[22px]"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada batch.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Batch -->
        @if ($showModal)
            <div
                class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-black bg-opacity-50 px-4 py-6 backdrop-blur-sm transition-all duration-300 sm:items-center sm:py-4">
                <div
                    class="animate-modal-slide-up bg-brand-bg w-full max-w-[600px] rounded-lg border border-gray-400 shadow-xl">
                    <!-- Modal Header -->
                    <div class="flex items-start justify-between bg-white px-4 py-3 sm:px-6 sm:py-4">
                        <div>
                            <h2 class="text-[15px] font-bold leading-tight text-black sm:text-[17px]">Batch Deadline</h2>
                            <p class="mt-0.5 text-[12px] text-gray-700 sm:mt-1 sm:text-[13px]">Atur tenggat waktu batch pada halaman ini</p>
                        </div>
                        <button wire:click="$set('showModal', false)"
                            class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded bg-[#ff4a4a] text-white shadow-sm transition hover:bg-red-600">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit="store" class="border-t border-gray-400 bg-white p-4 pb-6 sm:p-6 sm:pb-8">
                        <!-- Badge -->
                        <div class="mb-4 flex items-center justify-between gap-4 sm:mb-5">
                            <span
                                class="inline-block rounded border border-black bg-white px-3 py-1 text-[13px] font-bold leading-none text-black sm:px-4 sm:py-1.5 sm:text-[15px]">
                                {{ $editMode ? 'Ubah Batch' : 'Batch Baru' }}
                            </span>
                        </div>

                        @if (auth()->user()->role === 'Superadmin')
                            <!-- Dropdown Pilihan Procurement (Superadmin Only) -->
                            <div class="mb-4 flex flex-col gap-1.5 sm:mb-5">
                                <label class="text-sm font-semibold text-gray-700">Tugaskan ke Procurement</label>
                                <div class="relative">
                                    <select wire:model="id_procurement_terpilih"
                                        class="focus:border-primary focus:ring-primary/20 h-11 w-full appearance-none rounded-xl border border-gray-300 bg-white px-4 text-sm text-gray-700 transition-colors focus:outline-none focus:ring-2 sm:h-10"
                                        required>
                                        <option value="">Pilih Admin Procurement</option>
                                        @foreach ($procurementList as $proc)
                                            <option value="{{ $proc->id_procurement }}">{{ $proc->nama_procurement }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <i class="ph-bold ph-caret-down"></i>
                                    </div>
                                </div>
                                @error('id_procurement_terpilih')
                                    <span class="mt-1 block text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Time Input Card 2 (Dates) -->
                        <div
                            class="mb-4 flex w-full flex-col overflow-hidden rounded border border-[#4142cf] bg-[#4142cf] shadow-sm md:flex-row">
                            <!-- Icon Side -->
                            <div
                                class="flex items-center justify-center border-b border-[#696ce6] px-4 py-3 md:min-h-[80px] md:w-[80px] md:border-b-0 md:border-r md:px-0 md:py-0">
                                <i class="fa-regular fa-calendar text-2xl text-white md:text-[32px]"></i>
                            </div>
                            <!-- Input Side -->
                            <div class="flex-1 p-4 sm:px-5">
                                <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                                    <div class="flex-1">
                                        <label class="mb-1.5 block text-[13px] text-white">Start Date</label>
                                        <input type="date" wire:model="start_date" required
                                            class="h-11 w-full rounded-md bg-white px-3 py-1.5 text-sm text-black shadow-sm outline-none sm:h-[34px] sm:text-[13px]">
                                        @error('start_date')
                                            <span class="text-[10px] text-red-300">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex-1">
                                        <label class="mb-1.5 block text-[13px] text-white">End Date</label>
                                        <input type="date" wire:model="end_date" required
                                            class="h-11 w-full rounded-md bg-white px-3 py-1.5 text-sm text-black shadow-sm outline-none sm:h-[34px] sm:text-[13px]">
                                        @error('end_date')
                                            <span class="text-[10px] text-red-300">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Time Input Card 1 (Times) -->
                        <div
                            class="mb-5 flex w-full flex-col overflow-hidden rounded border border-[#4142cf] bg-[#4142cf] shadow-sm sm:mb-6 md:flex-row">
                            <!-- Icon Side -->
                            <div
                                class="flex items-center justify-center border-b border-[#696ce6] px-4 py-3 md:min-h-[80px] md:w-[80px] md:border-b-0 md:border-r md:px-0 md:py-0">
                                <i class="fa-regular fa-clock text-2xl text-white md:text-[32px]"></i>
                            </div>
                            <!-- Input Side -->
                            <div class="flex-1 p-4 sm:px-5">
                                <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                                    <div class="flex-1">
                                        <label class="mb-1.5 block text-[13px] text-white">Start Time</label>
                                        <input type="time" wire:model="start_time" required
                                            class="h-11 w-full rounded-md bg-white px-3 py-1.5 text-sm text-black shadow-sm outline-none sm:h-[34px]">
                                        @error('start_time')
                                            <span class="text-[10px] text-red-300">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex-1">
                                        <label class="mb-1.5 block text-[13px] text-white">End Time</label>
                                        <input type="time" wire:model="end_time" required
                                            class="h-11 w-full rounded-md bg-white px-3 py-1.5 text-sm text-black shadow-sm outline-none sm:h-[34px]">
                                        @error('end_time')
                                            <span class="text-[10px] text-red-300">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="relative w-full rounded bg-[#1e40ff] py-3 text-sm font-semibold text-white shadow transition hover:bg-blue-700 sm:py-2.5 sm:text-[15px] sm:font-normal">
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store">Menyimpan...</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif
        <!-- Success Modal -->
        @if ($showSuccessModal)
            <div x-data="{
                init() {
                    setTimeout(() => {
                        $wire.set('showSuccessModal', false);
                    }, 2500);
                }
            }"
                class="fixed inset-0 z-[100] flex items-center justify-center bg-black bg-opacity-50 p-4 backdrop-blur-sm transition-all duration-300">
                <div
                    class="animate-modal-slide-up flex w-full max-w-sm flex-col items-center gap-5 rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-2xl">

                    <div class="flex items-center justify-center">
                        <div class="relative h-20 w-20">
                            <div class="absolute inset-0 animate-ping rounded-full bg-green-100 opacity-25"></div>
                            <div
                                class="animate-circle relative flex h-20 w-20 items-center justify-center rounded-full border-4 border-green-500 bg-green-50">
                                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor"
                                    stroke-width="4" viewBox="0 0 24 24">
                                    <path class="animate-check" stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"
                                        style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: checkmark 0.8s ease-in-out 0.3s forwards;">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Berhasil!</h3>
                        <p class="mt-2 text-sm font-medium text-gray-500">{{ $successMessage }}</p>
                    </div>

                    <!-- OK Button -->
                    <button wire:click="$set('showSuccessModal', false)"
                        class="w-full rounded-xl bg-[#1e40ff] py-2.5 font-bold text-white shadow-lg transition duration-200 hover:bg-blue-700 active:scale-95">
                        OK
                    </button>
                </div>
            </div>
            <style>
                @keyframes checkmark {
                    to {
                        stroke-dashoffset: 0;
                    }
                }

                @keyframes scaleCircle {
                    0% {
                        transform: scale(0);
                    }

                    100% {
                        transform: scale(1);
                    }
                }

                .animate-circle {
                    animation: scaleCircle 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
                }
            </style>
        @endif
    </div>
</div>
