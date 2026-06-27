<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Vendor Berhasil</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $vendor->nama_perusahaan }}</h2>
    <p>Terima kasih telah mendaftar di platform Equogreen.</p>
    
    <div style="background: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px; margin: 15px 0; border-radius: 4px;">
        <p style="margin: 0; font-size: 14px; color: #b45309;"><strong>Status Pendaftaran:</strong> Menunggu Konfirmasi Admin</p>
    </div>
    
    <p>Data pendaftaran perusahaan Anda saat ini sedang dalam proses peninjauan oleh Tim Procurement kami. Kami akan mengirimkan email notifikasi lanjutan beserta password login sementara segera setelah akun Anda divalidasi dan diaktifkan.</p>
    <br>
    <p>Terima kasih,</p>
    <p>Tim Procurement Equogreen</p>
</body>
</html>
