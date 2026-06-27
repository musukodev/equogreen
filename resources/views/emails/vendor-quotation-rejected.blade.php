<!DOCTYPE html>
<html>
<head>
    <title>Quotation Ditolak</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $vendor->nama_perusahaan }}</h2>
    <p>Kami ingin menginformasikan bahwa quotation Anda untuk <strong>Batch {{ $batch_id }}</strong> telah ditolak oleh Tim Procurement Equogreen.</p>
    
    <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 15px 0; border-radius: 4px;">
        <p style="margin: 0; white-space: pre-wrap; font-size: 14px; color: #991b1b;">{{ $pesan }}</p>
    </div>
    
    <p>Silakan login ke portal vendor Equogreen untuk memeriksa detail barang dan mengunggah ulang dokumen quotation yang baru.</p>
    <br>
    <p>Terima kasih,</p>
    <p>Tim Procurement Equogreen</p>
</body>
</html>
