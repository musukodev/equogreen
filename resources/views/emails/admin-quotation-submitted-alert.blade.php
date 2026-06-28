<!DOCTYPE html>
<html>
<head>
    <title>Quotation Baru Diterima</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo,</h2>
    <p>Vendor <strong>{{ $vendor->nama_perusahaan }}</strong> telah berhasil mengirimkan quotation penawaran harga untuk <strong>Batch {{ $batch->id_batch }}</strong>.</p>
    
    <p>Detail pengiriman:</p>
    <table style="border-collapse: collapse; width: 100%; max-w: 600px; margin: 15px 0; font-size: 14px;">
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; width: 180px;">Nama Vendor</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $vendor->nama_perusahaan }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Nomor Batch</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">Batch {{ $batch->id_batch }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Tenggat Waktu Batch</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('l, d F Y, H:i') }} WIB</td>
        </tr>
    </table>
    
    <p>Silakan tinjau penawaran harga yang diajukan oleh vendor tersebut melalui halaman periksa barang di panel admin Anda.</p>
    
    <br>
    <p>Salam,</p>
    <p>Sistem E-Procurement Equogreen</p>
</body>
</html>
