<!DOCTYPE html>
<html>
<head>
    <title>Quotation Disetujui</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $vendor->nama_perusahaan }}</h2>
    <p>Kami ingin menginformasikan bahwa quotation Anda untuk <strong>Batch {{ $batch_id }}</strong> telah <strong>DISETUJUI</strong> oleh Tim Procurement Equogreen.</p>
    
    <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 15px; margin: 15px 0; border-radius: 4px;">
        <p style="margin: 0; white-space: pre-wrap; font-size: 14px; color: #166534;">{{ $pesan }}</p>
    </div>
    
    <p>Silakan login ke portal vendor Equogreen untuk memeriksa Purchase Order (PO) Anda dan melengkapi berkas transaksi yang dibutuhkan.</p>
    <br>
    <p>Terima kasih,</p>
    <p>Tim Procurement Equogreen</p>
</body>
</html>
