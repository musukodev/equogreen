<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order - {{ $vendor->nama_perusahaan }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="text-gray-800">

    <!-- Top Navbar -->
    <div class="flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 shadow-sm sm:px-6 md:px-8 md:py-4">
        <div class="flex items-center gap-3">
            <img src="/gambar/logo.png" alt="Equogreen" class="h-7 sm:h-8">
        </div>
        <div class="text-xs font-medium text-gray-500 sm:text-sm md:text-base">Equogreen - Purchase Order</div>
    </div>

    @if(session('success'))
        <div class="mx-auto mt-4 max-w-4xl rounded border border-green-400 bg-green-100 px-4 py-3 text-sm text-green-700 sm:mt-6">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="mx-auto mt-4 max-w-4xl rounded border border-red-400 bg-red-100 px-4 py-3 text-sm text-red-700 sm:mt-6">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- PO Document Card -->
    <div class="mx-auto my-6 max-w-4xl border-2 border-gray-800 bg-white p-5 shadow-xl sm:my-8 sm:p-8 md:p-10 lg:p-12">
        
        <!-- Header -->
        <div class="mb-6 border-b border-gray-300 pb-6 sm:mb-8 sm:pb-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex flex-col">
                    <img src="/gambar/logo.png" alt="Logo" class="mb-2 h-14 self-start object-contain sm:h-16 md:h-20">
                    <h1 class="mt-2 text-lg font-bold text-gray-800 sm:mt-4 sm:text-xl">Purchase Order</h1>
                </div>
                <div class="text-sm sm:text-right">
                    <h2 class="mb-1 text-sm font-bold text-gray-800 sm:text-base">PT Ecogreen Oleochemicals</h2>
                    <p>Jl. Raya Pelabuhan Kavling 1</p>
                    <p>Kota Batam, Kepulauan Riau</p>
                    <p>DIY 55882</p>
                    <p>Telp: (0778) 711002</p>
                    <p>Email: info@ecogreenoleo.com</p>
                </div>
            </div>
        </div>

        <!-- Vendor Info -->
        <div class="mb-8 text-sm sm:mb-10">
            <div class="grid grid-cols-1 gap-y-2 sm:max-w-md">
                <div class="flex">
                    <span class="w-28 flex-shrink-0 font-bold sm:w-36 md:w-40">Tanggal</span>
                    <span>{{ date('d/m/Y') }}</span>
                </div>
                <div class="flex">
                    <span class="w-28 flex-shrink-0 font-bold sm:w-36 md:w-40">Vendor</span>
                    <span>{{ $vendor->nama_perusahaan }}</span>
                </div>
                <div class="flex">
                    <span class="w-28 flex-shrink-0 font-bold sm:w-36 md:w-40">Alamat</span>
                    <span>{{ $vendor->alamat }}, {{ $vendor->kecamatan }}, {{ $vendor->kota }}, {{ $vendor->provinsi }}</span>
                </div>
                <div class="flex">
                    <span class="w-28 flex-shrink-0 font-bold sm:w-36 md:w-40">Telepon</span>
                    <span>{{ $vendor->no_hp }}</span>
                </div>
                <div class="flex">
                    <span class="w-28 flex-shrink-0 font-bold sm:w-36 md:w-40">Tanggal Proses</span>
                    <span>{{ date('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="mb-8 -mx-5 sm:-mx-8 md:-mx-10 lg:-mx-12">
            <div class="overflow-x-auto px-5 sm:px-8 md:px-10 lg:px-12">
                <table class="w-full min-w-[480px] border-b border-t border-gray-300 text-sm">
                    <thead>
                        <tr class="border-b border-gray-300 text-left font-bold text-gray-800">
                            <th class="w-1/12 px-2 py-3 text-xs uppercase tracking-wider">Kuantitas</th>
                            <th class="w-5/12 px-2 py-3 text-xs uppercase tracking-wider">Produk</th>
                            <th class="w-3/12 px-2 py-3 text-right text-xs uppercase tracking-wider">Harga</th>
                            <th class="w-3/12 px-2 py-3 text-right text-xs uppercase tracking-wider">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotations as $q)
                        <tr class="border-b border-gray-100 last:border-0">
                            <td class="px-2 py-3 text-gray-600">{{ $q->qty }}</td>
                            <td class="px-2 py-3 font-medium text-gray-800">{{ $q->description }}</td>
                            <td class="px-2 py-3 text-right text-gray-600">{{ number_format((float)$q->net_price, 0, ',', '.') }}</td>
                            <td class="px-2 py-3 text-right text-gray-800">{{ number_format((float)($q->qty * $q->net_price), 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totals -->
        <div class="mb-8 flex w-full justify-end">
            <div class="w-full sm:w-2/3 md:w-1/2">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="bg-gray-200 font-bold">
                            <td class="px-3 py-2 text-gray-800">TOTAL</td>
                            <td class="px-3 py-2 text-right text-gray-800">{{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="mt-8 grid grid-cols-1 gap-8 border-t border-gray-200 pt-8 text-sm sm:mt-12 sm:grid-cols-2">
            <!-- Vendor Signature (Kiri) -->
            <div class="flex flex-col items-center">
                <p class="mb-1 text-gray-500">Disetujui Oleh,</p>
                <p class="font-bold text-gray-800">{{ $vendor->nama_perusahaan }}</p>
                <div class="h-20"></div>
                <p class="w-48 border-t border-gray-400 pt-1 text-center text-gray-600">( Tanda Tangan & Stempel )</p>
            </div>

            <!-- Procurement Signature (Kanan) -->
            <div class="flex flex-col items-center">
                <p class="mb-1 text-gray-500">Dibuat Oleh,</p>
                <p class="font-bold text-gray-800">PT Ecogreen Oleochemicals</p>
                <div class="h-20"></div>
                <p class="w-48 border-t border-gray-400 pt-1 text-center font-semibold text-gray-800">{{ $procurementName }}</p>
            </div>
        </div>

    </div>

    <!-- Actions -->
    @php
        $backRoute = 'login';
        if (auth()->check()) {
            $role = strtolower(auth()->user()->role);
            if ($role === 'procurement' || $role === 'superadmin') {
                $backRoute = 'procurement-dashboard';
            } elseif ($role === 'vendor') {
                $backRoute = 'vendor-dashboard';
            }
        }
    @endphp
    <div class="mx-auto mb-12 flex max-w-4xl flex-col items-stretch gap-3 px-4 sm:mb-16 sm:flex-row sm:flex-wrap sm:items-center sm:justify-center sm:gap-4 sm:px-0">
        <a href="{{ route($backRoute) }}" 
           class="rounded bg-gray-200 px-6 py-2.5 text-center text-sm font-medium text-gray-800 shadow-sm transition hover:bg-gray-300 sm:text-base">
            Kembali ke Dashboard
        </a>
        <a href="{{ route('po.pdf', ['id_vendor' => $quotations->first()->id_vendor, 'id_penawaran' => $quotations->first()->id_penawaran]) }}" 
           class="rounded bg-black px-6 py-2.5 text-center text-sm font-medium text-white shadow-sm transition hover:bg-gray-800 sm:text-base">
            Unduh sebagai PDF
        </a>
        @if(auth()->check() && in_array(strtolower(auth()->user()->role), ['procurement', 'superadmin']))
        <form action="{{ route('po.email', ['id_vendor' => $quotations->first()->id_vendor, 'id_penawaran' => $quotations->first()->id_penawaran]) }}" method="POST" class="flex">
            @csrf
            <button type="submit" 
                    class="w-full rounded bg-blue-600 px-6 py-2.5 text-center text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 sm:w-auto sm:text-base">
                Kirim ke Email
            </button>
        </form>
        @endif
    </div>

</body>
</html>
