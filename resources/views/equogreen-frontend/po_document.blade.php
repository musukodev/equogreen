<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order - {{ $vendor->nama_perusahaan }}</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="text-gray-800">

    <!-- Top Navbar (Optional, to mimic app layout) -->
    <div class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3">
            <img src="/gambar/logo.png" alt="Equogreen" class="h-8">
        </div>
        <div class="text-gray-500 font-medium">Equogreen - Purchase Order</div>
    </div>

    @if(session('success'))
        <div class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-4xl mx-auto mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="max-w-4xl mx-auto my-8 bg-white p-12 border-2 border-gray-800 shadow-xl relative">
        
        <!-- Header -->
        <div class="flex justify-between items-start mb-8 border-b border-gray-300 pb-8">
            <div class="flex flex-col">
                <!-- Use a generic logo if logo.png doesn't match the design perfectly -->
                <img src="/gambar/logo.png" alt="Logo" class="h-20 object-contain self-start mb-2">
                <h1 class="text-xl font-bold text-gray-800 mt-4">Purchase Order</h1>
            </div>
            <div class="text-right text-sm">
                <h2 class="font-bold text-gray-800 text-base mb-1">PT Ecogreen Oleochemicals</h2>
                <p>Jl. Raya Pelabuhan Kavling 1</p>
                <p>Kota Batam, Kepulauan Riau</p>
                <p>DIY 55882</p>
                <p>Telp: (0778) 711002</p>
                <p>Email: info@ecogreenoleo.com</p>
            </div>
        </div>

        <!-- Vendor Info -->
        <div class="mb-10 text-sm">
            <table class="w-full max-w-md">
                <tbody>
                    <tr>
                        <td class="font-bold py-1 w-40">Tanggal</td>
                        <td class="py-1">{{ date('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 w-40">Vendor</td>
                        <td class="py-1">{{ $vendor->nama_perusahaan }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 w-40">Alamat</td>
                        <td class="py-1">{{ $vendor->alamat }}, {{ $vendor->kecamatan }}, {{ $vendor->kota }}, {{ $vendor->provinsi }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 w-40">Telepon</td>
                        <td class="py-1">{{ $vendor->no_hp }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold py-1 w-40">Tanggal Proses</td>
                        <td class="py-1">{{ date('d/m/Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Items Table -->
        <table class="w-full mb-8 text-sm border-t border-b border-gray-300">
            <thead>
                <tr class="text-left font-bold text-gray-800 border-b border-gray-300">
                    <th class="py-3 px-2 w-1/12 uppercase text-xs tracking-wider">Kuantitas</th>
                    <th class="py-3 px-2 w-5/12 uppercase text-xs tracking-wider">Produk</th>
                    <th class="py-3 px-2 w-3/12 uppercase text-xs tracking-wider text-right">Harga</th>
                    <th class="py-3 px-2 w-3/12 uppercase text-xs tracking-wider text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $q)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2 text-gray-600">{{ $q->qty }}</td>
                    <td class="py-3 px-2 text-gray-800 font-medium">{{ $q->description }}</td>
                    <td class="py-3 px-2 text-gray-600 text-right">{{ number_format((float)$q->net_price, 0, ',', '.') }}</td>
                    <td class="py-3 px-2 text-gray-800 text-right">{{ number_format((float)($q->qty * $q->net_price), 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="w-full flex justify-end mb-8">
            <div class="w-1/2">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="bg-gray-200 font-bold">
                            <td class="py-2 px-3 text-gray-800">TOTAL</td>
                            <td class="py-2 px-3 text-right text-gray-800">{{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Actions -->
    <div class="max-w-4xl mx-auto flex justify-center gap-4 mb-16">
        <a href="{{ route('po.pdf', ['id_vendor' => $quotations->first()->id_vendor, 'id_penawaran' => $quotations->first()->id_penawaran]) }}" 
           class="px-6 py-2.5 bg-black text-white font-medium rounded hover:bg-gray-800 transition shadow-sm">
            Download as PDF
        </a>
        @if(auth()->check() && strtolower(auth()->user()->role) === 'procurement')
        <form action="{{ route('po.email', ['id_vendor' => $quotations->first()->id_vendor, 'id_penawaran' => $quotations->first()->id_penawaran]) }}" method="POST">
            @csrf
            <button type="submit" 
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition shadow-sm">
                Send to Email
            </button>
        </form>
        @endif
    </div>

</body>
</html>
