<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Vendor Baru</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo Tim Procurement,</h2>
    <p>Ada pendaftaran akun vendor baru yang memerlukan validasi dan persetujuan di platform Equogreen:</p>
    
    <table style="border-collapse: collapse; width: 100%; max-w: 600px; margin: 15px 0; font-size: 14px;">
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; width: 180px;">Nama Perusahaan</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $vendor->nama_perusahaan }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Kategori Vendor</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; text-transform: uppercase;">{{ $vendor->kategori_vendor }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Penanggung Jawab</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $vendor->penanggung_jawab }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Email Perusahaan</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $vendor->email_perusahaan }}</td>
        </tr>
    </table>
    
    <p>Silakan login ke panel admin Equogreen dan buka menu <strong>Validasi Vendor</strong> untuk memeriksa kelengkapan berkas portofolio dan mengambil tindakan persetujuan.</p>
    
    <div style="margin-top: 25px;">
        <a href="{{ route('procurement-validasi-vendor') }}" style="background-color: #002eff; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold; border-radius: 6px; display: inline-block;">Buka Validasi Vendor</a>
    </div>
    
    <br>
    <p>Salam,</p>
    <p>Sistem E-Procurement Equogreen</p>
</body>
</html>
