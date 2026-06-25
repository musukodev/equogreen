<main class="flex h-full w-full min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-4 pt-0 md:p-6 lg:p-8">
    <!-- Top Header -->
    <header class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- Mobile Hamburger -->
            <button onclick="toggleSidebar()"
                class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                <img src="/gambar/garis3.png" alt="Menu"
                    class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <div>
                <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Riwayat PO</h1>
                <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">
                    Daftar Purchase Order (PO) yang telah dibuat untuk masing-masing vendor
                </p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center gap-3">
            <button
                class="hover:bg-primary hover:border-primary group flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 bg-[#f0f5ff] transition-all duration-200">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
            </button>
            <a href="{{ route('profile_procurement') }}">
                <img src="/gambar/profileup.png" alt="Profil"
                    class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
            </a>
            <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
            <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
        </div>
    </header>

    <!-- Table Card -->
    <div class="w-full">
        <div class="w-full rounded-xl border border-gray-400 bg-white p-6 shadow-sm md:p-8">
            <!-- Toolbar (Search) -->
            <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <input type="text" placeholder="Search" wire:model.live="search"
                    class="w-full rounded-md border border-gray-400 px-4 py-2 text-[15px] outline-none transition focus:border-black sm:w-[60%] lg:w-[40%] xl:w-[70%]">
            </div>

            <!-- Title -->
            <div class="mb-4">
                <h2 class="text-xl font-bold text-black">Daftar PO</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full overflow-hidden rounded-lg border border-gray-300">
                    <thead class="bg-blue-600">
                        <tr>
                            <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">No</th>
                            <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Nama Vendor</th>
                            <th class="border-b px-4 py-3 text-left text-sm font-bold text-white">Tanggal</th>
                            <th class="border-b px-4 py-3 text-center text-sm font-bold text-white">PO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pos as $index => $po)
                            <tr class="border-b hover:bg-gray-50"
                                wire:key="po-{{ $po->id_vendor }}-{{ $po->id_penawaran }}">
                                <td class="whitespace-nowrap px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium">
                                    {{ $po->vendor->nama_perusahaan ?? 'Vendor Tidak Ditemukan' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600">
                                    {{ $po->tanggal ? \Carbon\Carbon::parse($po->tanggal)->translatedFormat('d F Y, H:i') : '-' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-center">
                                    <a href="{{ route('po.show', ['id_vendor' => $po->id_vendor, 'id_penawaran' => $po->id_penawaran]) }}"
                                        target="_blank"
                                        class="font-bold text-blue-500 decoration-2 underline-offset-4 hover:underline">
                                        Lihat PO
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada riwayat PO.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
