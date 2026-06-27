<div x-data="{
    showApproveModal: false,
    showSuccessCheck: false,
    approveUrl: '',
    approveVendorId: null,
    showReminderModal: false,
    reminderVendorId: null,
    showReminderLoading: false,
    showReminderSuccess: false,
    reminderVendorName: '',
    showRejectModal: false,
    rejectVendorId: null,
    showRejectSuccess: false,
    rejectVendorName: ''
}"
    @reminder-sent.window="
    showReminderLoading = false; 
    reminderVendorName = $event.detail.nama_vendor;
    showReminderSuccess = true; 
    setTimeout(() => { showReminderSuccess = false; }, 2000);
"
    @quotation-rejected.window="
    showRejectSuccess = true;
    rejectVendorName = $event.detail.nama_vendor;
    setTimeout(() => { showRejectSuccess = false; }, 2000);
"
    class="flex flex-col gap-6 p-6 lg:p-8">

    @if (session()->has('message'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Card 1: Spesifikasi Barang -->
    <div class="mt-2 w-full">
        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow-sm md:p-8">
            <h2 class="mb-1 text-xl font-bold text-gray-900">Spesifikasi Barang</h2>
            <p class="mb-6 text-sm text-gray-500">Deskripsikan spesifikasi barang yang dibutuhkan</p>

            <div class="overflow-x-auto rounded-sm border border-black">
                <table class="w-full min-w-[600px] border-collapse text-center">
                    <thead>
                        <tr class="bg-[#423ec7] text-white">
                            <th
                                class="w-1/3 border-b border-r border-[#26245f] border-black px-4 py-4 text-[14px] font-normal">
                                Nama Barang</th>
                            <th
                                class="w-1/3 border-b border-r border-[#26245f] border-black px-4 py-4 text-[14px] font-normal">
                                Spesifikasi detail</th>
                            <th class="w-1/3 border-b border-black px-4 py-4 text-[14px] font-normal">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penawarans as $item)
                            <tr class="border-b border-black text-[14px] transition hover:bg-gray-50">
                                <td class="border-r border-black px-4 py-4 text-black">{{ $item->nama_barang }}</td>
                                <td class="border-r border-black px-4 py-4 text-black">{{ $item->spesifikasi }}</td>
                                <td class="px-4 py-4 text-black">{{ $item->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Card 2: Vendor List -->
    <div class="w-full">
        <div class="w-full rounded-lg border border-gray-200 bg-white p-6 shadow-sm md:p-8">

            <!-- Filters -->
            <div class="mb-6 flex flex-col items-center gap-4 md:flex-row">
                <div class="relative w-full md:w-[250px]">
                    <select wire:model.live="status_pengajuan"
                        class="w-full cursor-pointer appearance-none rounded-md border border-black bg-white px-4 py-2.5 pr-10 text-[14px] shadow-sm outline-none focus:border-black focus:ring-1 focus:ring-black">
                        <option value="">Status Pengajuan</option>
                        <option value="sudah">Sudah Mengajukan</option>
                        <option value="belum">Belum Mengajukan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-700">
                        <i class="ph ph-caret-down"></i>
                    </div>
                </div>

                <div class="relative w-full md:flex-1">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search"
                        class="w-full rounded-md border border-black px-4 py-2.5 text-[14px] outline-none transition focus:ring-1 focus:ring-black">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-sm border border-black">
                <table class="w-full min-w-[800px] border-collapse text-center">
                    <thead>
                        <tr class="bg-[#423ec7] text-white">
                            <th
                                class="w-1/4 border-b border-r border-[#26245f] border-black px-4 py-4 text-[14px] font-normal">
                                Nama Vendor</th>
                            <th
                                class="w-1/4 border-b border-r border-[#26245f] border-black px-4 py-4 text-[14px] font-normal">
                                Status Pengajuan</th>
                            <th
                                class="w-1/4 border-b border-r border-[#26245f] border-black px-4 py-4 text-[14px] font-normal">
                                Cek Quotation</th>
                            <th class="w-1/4 border-b border-black px-4 py-4 text-[14px] font-normal">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr class="border-b border-black text-[14px] transition hover:bg-gray-50">
                                <td class="border-r border-black px-4 py-4 text-black">{{ $vendor->nama_perusahaan }}
                                </td>

                                <!-- Status Pengajuan -->
                                <td class="border-r border-black px-4 py-4 text-black">
                                    @if ($vendor->sudah_mengajukan > 0)
                                        <span
                                            class="inline-flex items-center rounded-full bg-[#e6f7e8] px-3 py-1 text-xs font-medium text-[#2ebd3a]">
                                            Sudah Mengajukan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-[#fee6e6] px-3 py-1 text-xs font-medium text-[#e53e3e]">
                                            Belum Mengajukan
                                        </span>
                                    @endif
                                </td>

                                <!-- Cek Quotation -->
                                <td class="border-r border-black px-4 py-4">
                                    @if ($vendor->sudah_mengajukan > 0)
                                        <button
                                            wire:click.prevent="$dispatch('openQuotationModal', { idVendor: {{ $vendor->id_vendor }} })"
                                            class="rounded-md bg-[#e4e6fb] px-4 py-1.5 text-xs font-medium text-[#423ec7] transition hover:bg-[#d0d3f8]">
                                            Cek
                                        </button>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-4 text-center">
                                    <div class="flex items-center justify-center gap-4">
                                        @if ($vendor->sudah_mengajukan > 0)
                                            @if ($vendor->quotation_status === 'approved')
                                                <span class="inline-flex items-center rounded-md bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700 border border-green-300">
                                                    Approved
                                                </span>
                                            @elseif ($vendor->quotation_status === 'rejected')
                                                <span class="inline-flex items-center rounded-md bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700 border border-red-300">
                                                    Rejected
                                                </span>
                                            @else
                                                <!-- Jika belum ada vendor lain yang di-approve dalam grup ini, tampilkan tombol aksi -->
                                                @php
                                                    $anyApproved = $vendors->contains(fn($v) => $v->quotation_status === 'approved');
                                                @endphp
                                                @if (!$anyApproved)
                                                    <button
                                                        @click="approveUrl = '{{ route('po.show', ['id_vendor' => $vendor->id_vendor, 'id_penawaran' => $vendor->first_penawaran_id ?? 0]) }}'; approveVendorId = {{ $vendor->id_vendor }}; showApproveModal = true;"
                                                        class="transition-transform hover:scale-110">
                                                        <i class="ph ph-check text-xl font-bold text-[#4adb49]"></i>
                                                    </button>
                                                @else
                                                    <!-- Jika ada vendor lain yang sudah di-approve, nonaktifkan/beri tanda strip -->
                                                    <span class="text-gray-400 font-semibold">-</span>
                                                @endif
                                            @endif
                                        @else
                                            <button
                                                @click="reminderVendorId = {{ $vendor->id_vendor }}; showReminderModal = true;"
                                                title="Kirim Reminder"
                                                class="hover:text-primary text-gray-600 transition-transform hover:scale-110">
                                                <i class="ph ph-envelope-simple text-xl font-bold"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">Tidak ada vendor yang
                                    ditugaskan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal component rendering -->
    <livewire:procurement.quotation-detail />

    <!-- SweetAlert/Toast Notification Script (optional) -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (event) => {
                alert(event[0].message);
            });
        });
    </script>
    <!-- Approve Confirmation Modal -->
    <div x-show="showApproveModal && !showSuccessCheck" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;" x-cloak>
        <div x-show="showApproveModal && !showSuccessCheck"
            x-transition:enter="transition ease-out duration-300 delay-100"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-sm rounded-2xl border border-gray-100 bg-white p-8 shadow-2xl"
            @click.away="showApproveModal = false">

            <!-- Icon -->
            <div class="mb-5 flex justify-center">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-full border-2 border-amber-300 bg-amber-50">
                    <i class="ph ph-warning text-3xl text-amber-500"></i>
                </div>
            </div>

            <h3 class="mb-2 text-center text-lg font-bold text-gray-900">Konfirmasi Approve</h3>
            <p class="mb-8 text-center text-sm leading-relaxed text-gray-500">Apakah Anda yakin ingin menerima
                quotation dari vendor ini? Tindakan ini tidak dapat dibatalkan.</p>

            <div class="flex items-center gap-3">
                <button @click="showApproveModal = false"
                    class="flex-1 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700 transition-all duration-200 hover:bg-gray-200 active:scale-95">
                    Batal
                </button>
                <button
                    @click="showSuccessCheck = true; $wire.setujuiQuotation(approveVendorId);"
                    class="flex-1 rounded-xl bg-[#423ec7] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition-all duration-200 hover:bg-[#3633a8] active:scale-95">
                    Ya, Terima
                </button>
            </div>
        </div>
    </div>

    <!-- Success Checkmark Modal -->
    <div x-show="showSuccessCheck" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;" x-cloak>
        <div x-show="showSuccessCheck" x-transition:enter="transition ease-out duration-400 delay-100"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            class="flex w-full max-w-sm flex-col items-center gap-5 rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-2xl">

            <div class="flex items-center justify-center">
                <div class="relative h-20 w-20">
                    <div class="absolute inset-0 animate-ping rounded-full bg-green-100 opacity-25"></div>
                    <div
                        class="periksa-animate-circle relative flex h-20 w-20 items-center justify-center rounded-full border-4 border-green-500 bg-green-50">
                        <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" stroke-width="4"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"
                                style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: periksaCheckmark 0.8s ease-in-out 0.3s forwards;">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-900">Berhasil!</h3>
                <p class="mt-2 text-sm font-medium text-gray-500">Quotation berhasil diterima. Mengalihkan ke halaman
                    PO...</p>
            </div>
        </div>
    </div>

    <!-- Send Reminder Confirmation Modal -->
    <div x-show="showReminderModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;" x-cloak>
        <div x-show="showReminderModal" x-transition:enter="transition ease-out duration-300 delay-100"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-sm rounded-2xl border border-gray-100 bg-white p-8 shadow-2xl"
            @click.away="showReminderModal = false">

            <!-- Icon -->
            <div class="mb-5 flex justify-center">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-full border-2 border-blue-300 bg-blue-50">
                    <i class="ph ph-envelope-simple text-3xl font-bold text-blue-500"></i>
                </div>
            </div>

            <h3 class="mb-2 text-center text-lg font-bold text-gray-900">Kirim Pengingat</h3>
            <p class="mb-8 text-center text-sm leading-relaxed text-gray-500">Apakah Anda yakin ingin mengirim pesan
                pengingat (reminder) ke vendor ini agar segera mengajukan penawaran?</p>

            <div class="flex items-center gap-3">
                <button @click="showReminderModal = false"
                    class="flex-1 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700 transition-all duration-200 hover:bg-gray-200 active:scale-95">
                    Batal
                </button>
                <button
                    @click="showReminderModal = false; showReminderLoading = true; $wire.kirimReminder(reminderVendorId);"
                    class="flex-1 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-200 transition-all duration-200 hover:bg-blue-700 active:scale-95">
                    Kirim
                </button>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div x-show="showReminderLoading" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;" x-cloak>
        <div
            class="flex w-full max-w-sm flex-col items-center gap-5 rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-2xl">
            <div class="flex items-center justify-center">
                <div class="h-16 w-16 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600"></div>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Mengirim Pengingat...</h3>
                <p class="mt-2 text-sm font-medium text-gray-500">Mohon tunggu sebentar, email sedang dikirim ke
                    vendor.</p>
            </div>
        </div>
    </div>

    <!-- Success Reminder Modal (Centang) -->
    <div x-show="showReminderSuccess" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;" x-cloak>
        <div x-show="showReminderSuccess" x-transition:enter="transition ease-out duration-400 delay-100"
            x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="flex w-full max-w-sm flex-col items-center gap-5 rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-2xl">

            <div class="flex items-center justify-center">
                <div class="relative h-20 w-20">
                    <div class="absolute inset-0 animate-ping rounded-full bg-green-100 opacity-25"></div>
                    <div
                        class="periksa-animate-circle relative flex h-20 w-20 items-center justify-center rounded-full border-4 border-green-500 bg-green-50">
                        <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" stroke-width="4"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"
                                style="stroke-dasharray: 50; stroke-dashoffset: 50; animation: periksaCheckmark 0.8s ease-in-out 0.3s forwards;">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-900">Berhasil Dikirim!</h3>
                <p class="mt-2 text-sm font-medium text-gray-500">Reminder berhasil dikirim ke vendor <span
                        class="font-bold text-gray-800" x-text="reminderVendorName"></span>.</p>
            </div>
        </div>
    </div>

    <style>
        @keyframes periksaCheckmark {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes periksaScaleCircle {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        .periksa-animate-circle {
            animation: periksaScaleCircle 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</div>
