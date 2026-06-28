<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Purchase Order - {{ $vendor->nama_perusahaan }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; margin: 0; padding: 20px; }
        .header { width: 100%; border-bottom: 1px solid #ccc; padding-bottom: 20px; margin-bottom: 30px; }
        .header td { vertical-align: top; }
        .logo-container { width: 50%; }
        .company-info { width: 50%; text-align: right; font-size: 11px; line-height: 1.4; }
        .company-info h2 { margin: 0 0 5px 0; font-size: 14px; color: #000; }
        .company-info p { margin: 0; }
        .title { font-size: 18px; font-weight: bold; margin-top: 15px; color: #000; }
        
        .vendor-info { margin-bottom: 40px; }
        .vendor-info table { width: 60%; }
        .vendor-info td { padding: 4px 0; }
        .vendor-info td:first-child { font-weight: bold; width: 150px; }
        
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; }
        .items-table th { text-align: left; padding: 10px 5px; text-transform: uppercase; font-size: 10px; border-bottom: 1px solid #ccc; color: #000; }
        .items-table td { padding: 10px 5px; border-bottom: 1px solid #eee; }
        .items-table th.right, .items-table td.right { text-align: right; }
        
        .totals-container { width: 100%; }
        .totals { width: 40%; float: right; border-collapse: collapse; }
        .totals td { padding: 8px; }
        .totals .bg-gray { background-color: #e5e7eb; font-weight: bold; color: #000; }
        .clear { clear: both; }
        
        .signatures-table { width: 100%; margin-top: 50px; border-top: 1px solid #ccc; padding-top: 20px; }
        .signatures-table td { width: 50%; text-align: center; vertical-align: top; font-size: 11px; }
        .signature-space { height: 70px; }
        .signature-line { width: 180px; border-top: 1px solid #666; margin: 0 auto; padding-top: 5px; }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td class="logo-container">
                <!-- Fallback text since absolute local paths for images in dompdf can be tricky, 
                     but we'll try to load it using public_path if needed. For now, text is safer or absolute URL. -->
                <h1 style="margin:0; font-size: 24px;">Equogreen</h1>
                <div class="title">Purchase Order</div>
            </td>
            <td class="company-info">
                <h2>PT Ecogreen Oleochemicals</h2>
                <p>Jl. Raya Pelabuhan Kavling 1</p>
                <p>Kota Batam, Kepulauan Riau</p>
                <p>DIY 55882</p>
                <p>Telp: (0778) 711002</p>
                <p>Email: info@ecogreenoleo.com</p>
            </td>
        </tr>
    </table>

    <div class="vendor-info">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td>Tanggal</td>
                <td>{{ date('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Vendor</td>
                <td>{{ $vendor->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $vendor->alamat }}, {{ $vendor->kecamatan }}, {{ $vendor->kota }}, {{ $vendor->provinsi }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>{{ $vendor->no_hp }}</td>
            </tr>
            <tr>
                <td>Tanggal Proses</td>
                <td>{{ date('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">Kuantitas</th>
                <th style="width: 50%;">Produk</th>
                <th class="right" style="width: 20%;">Harga</th>
                <th class="right" style="width: 20%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotations as $q)
            <tr>
                <td>{{ $q->qty }}</td>
                <td>{{ $q->description }}</td>
                <td class="right">{{ number_format((float)$q->net_price, 0, ',', '.') }}</td>
                <td class="right">{{ number_format((float)($q->qty * $q->net_price), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-container">
        <table class="totals">
            <tr class="bg-gray">
                <td>TOTAL</td>
                <td style="text-align: right;">{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="clear"></div>
    </div>

    <!-- Signature Section -->
    <table class="signatures-table" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <p style="color: #666; margin: 0 0 5px 0;">Disetujui Oleh,</p>
                <p style="font-weight: bold; color: #000; margin: 0;">{{ $vendor->nama_perusahaan }}</p>
                <div class="signature-space"></div>
                <div class="signature-line" style="color: #666;">( Tanda Tangan & Stempel )</div>
            </td>
            <td>
                <p style="color: #666; margin: 0 0 5px 0;">Dibuat Oleh,</p>
                <p style="font-weight: bold; color: #000; margin: 0;">PT Ecogreen Oleochemicals</p>
                <div class="signature-space"></div>
                <div class="signature-line" style="font-weight: bold; color: #000;">{{ $procurementName }}</div>
            </td>
        </tr>
    </table>

</body>
</html>
