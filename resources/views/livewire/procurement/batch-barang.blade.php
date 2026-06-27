<div>
<div class="flex flex-col gap-6 p-6 lg:p-8">

    <!-- Form Workspace / Grid Card -->
    <div class="w-full">
        <div class="w-full rounded-xl border border-gray-400 bg-white p-6 shadow-sm md:p-8">
            <!-- Toolbar (Search and Add) -->
            <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <input type="text" placeholder="Search"
                    class="w-full rounded-md border border-gray-400 px-4 py-2 text-[15px] outline-none transition focus:border-black sm:w-[60%] lg:w-[40%] xl:w-[70%]">

                <button wire:click="$set('showModal', true)"
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
                                        class="flex items-center gap-1.5 rounded-md bg-blue-600 px-4 py-2 text-[13px] font-bold text-white shadow-sm transition hover:bg-blue-700"
                                        wire:navigate>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[12px]"></i>
                                        Buka
                                    </a>
                                    <!-- Delete Button -->
                                    <button type="button" wire:click="deleteBatch('{{ $batch->id_batch }}')"
                                        wire:confirm="Hapus batch ini secara permanen?"
                                        class="text-red-600 transition-transform hover:scale-110 hover:text-red-800">
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
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4 backdrop-blur-sm transition-all duration-300">
            <div
                class="animate-modal-slide-up bg-brand-bg w-full max-w-[600px] overflow-hidden rounded-lg border border-gray-400 shadow-xl">
                <!-- Modal Header -->
                <div class="flex items-start justify-between bg-white px-6 py-4">
                    <div>
                        <h2 class="text-[17px] font-bold leading-tight text-black">Batch Deadline</h2>
                        <p class="mt-1 text-[13px] text-gray-700">Atur tenggat waktu batch pada halaman ini</p>
                    </div>
                    <button wire:click="$set('showModal', false)"
                        class="mt-0.5 flex h-8 w-8 items-center justify-center rounded bg-[#ff4a4a] text-white shadow-sm transition hover:bg-red-600">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <form wire:submit="store" class="border-t border-gray-400 bg-white p-6 pb-8">
                    <!-- Badge -->
                    <div class="mb-5">
                        <span
                            class="inline-block rounded border border-black bg-white px-4 py-1.5 text-[15px] font-bold leading-none text-black">
                            Batch Baru
                        </span>
                    </div>

                    <!-- Time Input Card 2 (Dates) -->
                    <div
                        class="mb-4 flex w-full flex-col rounded border border-[#4142cf] bg-[#4142cf] shadow-sm md:flex-row">
                        <!-- Icon Side -->
                        <div
                            class="relative flex h-full min-h-[80px] w-[80px] flex-shrink-0 items-center justify-center border-r border-[#696ce6]">
                            <i class="fa-regular fa-calendar text-[32px] font-light text-white"></i>
                            <i
                                class="fa-solid fa-clock absolute bottom-[22px] right-[20px] rounded-full border border-[#4142cf] bg-[#4142cf] text-[12px] text-white"></i>
                        </div>
                        <!-- Input Side -->
                        <div class="flex-1 p-4 px-5">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1">
                                    <label class="mb-1.5 block text-[13px] text-white">Start Date</label>
                                    <input type="date" wire:model="start_date" required
                                        class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-[13px] text-black shadow-sm outline-none">
                                    @error('start_date')
                                        <span class="text-[10px] text-red-300">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="mb-1.5 block text-[13px] text-white">End Date</label>
                                    <input type="date" wire:model="end_date" required
                                        class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-[13px] text-black shadow-sm outline-none">
                                    @error('end_date')
                                        <span class="text-[10px] text-red-300">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Input Card 1 (Times) -->
                    <div
                        class="mb-6 flex w-full flex-col rounded border border-[#4142cf] bg-[#4142cf] shadow-sm md:flex-row">
                        <!-- Icon Side -->
                        <div
                            class="relative flex h-full min-h-[80px] w-[80px] flex-shrink-0 items-center justify-center border-r border-[#696ce6]">
                            <i class="fa-regular fa-clock text-[32px] font-light text-white"></i>
                            <i
                                class="fa-solid fa-clock absolute bottom-[22px] right-[20px] rounded-full border border-[#4142cf] bg-[#4142cf] text-[12px] text-white"></i>
                        </div>
                        <!-- Input Side -->
                        <div class="flex-1 p-4 px-5">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex-1">
                                    <label class="mb-1.5 block text-[13px] text-white">Start Time</label>
                                    <input type="time" wire:model="start_time" required
                                        class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-black shadow-sm outline-none">
                                    @error('start_time')
                                        <span class="text-[10px] text-red-300">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="mb-1.5 block text-[13px] text-white">End Time</label>
                                    <input type="time" wire:model="end_time" required
                                        class="h-[34px] w-full rounded-md bg-white px-3 py-1.5 text-black shadow-sm outline-none">
                                    @error('end_time')
                                        <span class="text-[10px] text-red-300">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="relative w-full rounded bg-[#1e40ff] py-2.5 text-[15px] font-normal text-white shadow transition hover:bg-blue-700">
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
