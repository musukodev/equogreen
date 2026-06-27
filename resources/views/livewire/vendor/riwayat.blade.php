<div>
    <!-- Search Bar -->
    <div class="flex flex-col gap-6 p-6 lg:p-8">
        <div class="relative">
            <input type="text" placeholder="Search"
                class="focus:border-primary w-full rounded-xl border border-gray-300 bg-white px-6 py-4 text-base font-medium text-gray-700 shadow-sm outline-none transition-all duration-200 placeholder:text-gray-400" />
        </div>

        <!-- Table Card -->
        <div class="overflow-hidden rounded-[32px] border border-gray-100 bg-white shadow-sm mt-0">
            <table class="w-full border-collapse text-left">
                <thead class="bg-primary">
                    <tr>
                        <th class="border-r border-white/10 px-8 py-5 text-center text-lg font-bold text-white">
                            Tanggal</th>
                        <th class="px-8 py-5 text-center text-lg font-bold text-white">Quotation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($history as $key => $data)
                        <tr class="transition-colors duration-150 hover:bg-gray-50">
                            <td class="border-r border-gray-100 px-8 py-6 text-center font-semibold text-gray-700">
                                {{ $data['waktu'] }} <br>
                                <span class="text-sm font-normal text-gray-400">Batch:
                                    {{ $data['batch_id'] }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <a href="javascript:void(0)" onclick="openModal('{{ $key }}')"
                                    class="font-bold text-blue-500 decoration-2 underline-offset-4 hover:underline">Lihat
                                    Rincian</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-8 py-6 text-center text-gray-500">Belum ada riwayat
                                quotation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openModal(key) {
            const modal = document.getElementById('modal-rincian-' + key);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal(key) {
            const modal = document.getElementById('modal-rincian-' + key);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-container')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>

    <!-- ========== MODAL: Rincian Item ========== -->
    @foreach ($history as $key => $data)
        <div id="modal-rincian-{{ $key }}"
            class="modal-container fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div
                class="mx-auto w-full max-w-7xl animate-[modalSlideUp_0.25s_ease-out] overflow-hidden rounded-2xl bg-white shadow-2xl">
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400">RINCIAN LENGKAP QUOTATION
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">Upload: {{ $data['waktu'] }} | Batch:
                            {{ $data['batch_id'] }}</p>
                    </div>
                    <button onclick="closeModal('{{ $key }}')"
                        class="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-gray-100">
                        <i class="ph-bold ph-x text-2xl text-gray-400"></i>
                    </button>
                </div>

                <!-- Table Body -->
                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full border-collapse text-left">
                            <thead class="bg-primary">
                                <tr class="whitespace-nowrap text-xs font-bold text-white md:text-sm">
                                    <th class="w-12 border-r border-white/10 px-4 py-4 text-center">#</th>
                                    <th class="border-r border-white/10 px-4 py-4">Coll No.</th>
                                    <th class="border-r border-white/10 px-4 py-4">RFQ No.</th>
                                    <th class="border-r border-white/10 px-4 py-4">Material No.</th>
                                    <th class="min-w-[200px] border-r border-white/10 px-4 py-4">Description</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Qty</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">UoM</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Currency</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-right">Net Price</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-right">Total Price</th>
                                    <th class="border-r border-white/10 px-4 py-4">Incoterm</th>
                                    <th class="border-r border-white/10 px-4 py-4">Destination</th>
                                    <th class="min-w-[150px] border-r border-white/10 px-4 py-4">Remark 1</th>
                                    <th class="min-w-[150px] border-r border-white/10 px-4 py-4">Remark 2</th>
                                    <th class="border-r border-white/10 px-4 py-4">Payment Term</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Lead Time (Wks)</th>
                                    <th class="px-4 py-4">Quotation Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">

                                @foreach ($data['items'] as $index => $item)
                                    <tr
                                        class="whitespace-nowrap text-xs text-gray-700 transition-colors hover:bg-gray-50 md:text-sm">
                                        <td
                                            class="border-r border-gray-50 px-4 py-4 text-center font-medium text-gray-300">
                                            {{ $index + 1 }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['coll_no'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['rfq_no'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 font-mono text-gray-600">
                                            {{ $item['material_no'] }}</td>
                                        <td class="max-w-xs truncate border-r border-gray-50 px-4 py-4 font-semibold"
                                            title="{{ $item['description'] }}">{{ $item['description'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center font-medium">
                                            {{ $item['qty'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['uom'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['currency'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-right text-gray-500">
                                            {{ number_format((float) $item['net_price'], 0, ',', '.') }}</td>
                                        <td
                                            class="border-r border-gray-50 px-4 py-4 text-right font-extrabold text-black">
                                            {{ number_format((float) ($item['qty'] * $item['net_price']), 0, ',', '.') }}
                                        </td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['incoterm'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['destination'] }}</td>
                                        <td class="max-w-[150px] truncate border-r border-gray-50 px-4 py-4 text-gray-500"
                                            title="{{ $item['remark_1'] }}">{{ $item['remark_1'] }}</td>
                                        <td class="max-w-[150px] truncate border-r border-gray-50 px-4 py-4 text-gray-500"
                                            title="{{ $item['remark_2'] }}">{{ $item['remark_2'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['payment_term'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['lead_time_weeks'] }}</td>
                                        <td class="px-4 py-4 text-gray-500">
                                            {{ $item['quotation_date'] ? date('d M Y', strtotime($item['quotation_date'])) : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
