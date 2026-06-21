<div>
    @if($showModal)
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 z-[60]" wire:click="closeModal"></div>

    <!-- Modal -->
    <div class="fixed inset-0 z-[70] flex items-center justify-center px-4 py-6 sm:py-10">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-[1200px] max-h-full flex flex-col overflow-hidden">

            <!-- Header Modal -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-6 sm:px-8 py-5 border-b border-gray-100 gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-[#f0e6ff] text-[#3833a6] font-bold flex items-center justify-center text-xl">
                        {{ strtoupper(substr($vendor->nama_perusahaan ?? 'N/A', 0, 2)) }}
                    </div>
                    <div>
                        <h2 class="text-[22px] font-bold text-black leading-tight">{{ $vendor->nama_perusahaan ?? '-' }}</h2>
                        <p class="text-[14px] text-gray-400 mt-1">{{ $vendor->email ?? '-' }}</p>
                    </div>
                </div>
                <button wire:click="closeModal"
                    class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                    <i class="ph ph-x text-lg"></i>
                </button>
            </div>

            <!-- Modal Content scrollable -->
            <div class="flex-1 overflow-y-auto px-6 sm:px-8 py-8">

                <!-- Info Vendor -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-7 gap-x-8 mb-8 pb-8 border-b border-gray-100">
                    <div>
                        <p class="text-[14px] text-gray-400 mb-1.5">Nama Perusahaan</p>
                        <p class="text-[16px] text-black font-medium">{{ $vendor->nama_perusahaan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[14px] text-gray-400 mb-1.5">Telepon</p>
                        <p class="text-[16px] text-black font-medium">{{ $vendor->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[14px] text-gray-400 mb-1.5">Email</p>
                        <p class="text-[16px] text-black font-medium">{{ $vendor->email_perusahaan ?? '-' }}</p>
                    </div>
                </div>

                <!-- Tabel Quotation -->
                <h3 class="text-[14px] font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Item</h3>

                <div class="overflow-x-auto w-full border-2 border-gray-250 rounded-lg">
                    <table class="w-full text-left whitespace-nowrap border-collapse">
                        <thead class="bg-[#423ec7] text-white">
                            <tr>
                                <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">No. Item</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">Coll No.</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">RFQ No.</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">Material No.</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">Description</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Qty</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">UoM</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Currency</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-right border-r-2 border-[#2825a8]">Net Price</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Incoterm</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Destination</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Remark 1</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Remark 2</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Payment Term</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">Lead Time (Weeks)</th>
                                <th class="py-3.5 px-4 font-semibold text-[13px]">Quotation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quotations as $quotation)
                            <tr class="border-b-2 border-gray-200 text-[13.5px] hover:bg-gray-50">
                                <td class="py-3.5 px-4 border-r-2 border-gray-200">{{ $quotation->no_item ?? '-' }}</td>
                                <td class="py-3.5 px-4 border-r-2 border-gray-200">{{ $quotation->coll_no ?? '-' }}</td>
                                <td class="py-3.5 px-4 border-r-2 border-gray-200">{{ $quotation->rfq_no ?? '-' }}</td>
                                <td class="py-3.5 px-4 border-r-2 border-gray-200">{{ $quotation->material_no ?? '-' }}</td>
                                <td class="py-3.5 px-4 border-r-2 border-gray-200">{{ $quotation->description ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->qty ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->uom ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->currency ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-right border-r-2 border-gray-200">{{ $quotation->net_price ?? '0.00' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->incoterm ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->destination ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->remark_1 ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->remark_2 ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->payment_term ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-center border-r-2 border-gray-200">{{ $quotation->lead_time_weeks ?? '-' }}</td>
                                <td class="py-3.5 px-4">{{ $quotation->quotation_date ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="16" class="py-6 text-center text-gray-400">Tidak ada data quotation</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endif
</div>
