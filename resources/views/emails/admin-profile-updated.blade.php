<!DOCTYPE html>
<html>
<head>
    <title>Pembaruan Akun Procurement</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $procurement->nama_procurement }}</h2>
    <p>Kami ingin menginformasikan bahwa data akun admin Procurement Anda di platform Equogreen telah diperbarui oleh Superadmin.</p>
    
    <p>Berikut adalah rincian informasi terbaru akun Anda:</p>
    
    <table style="border-collapse: collapse; width: 100%; max-width: 600px; margin: 15px 0; font-size: 14px;">
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; width: 180px;">Nama Lengkap</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $procurement->nama_procurement }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Email</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $procurement->email }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">No. Handphone</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $procurement->no_hp }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Username</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-family: monospace;">{{ $username }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Kata Sandi</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                @if(!empty($password))
                    <span style="color: #d97706; font-weight: bold;">Telah Diubah Menjadi:</span> <code>{{ $password }}</code>
                @else
                    <span style="color: #6b7280; font-style: italic;">Tidak Ada Perubahan</span>
                @endif
            </td>
        </tr>
    </table>
    
    <p>Silakan gunakan informasi di atas untuk masuk ke portal Equogreen.</p>
    <br>
    <p>Terima kasih,</p>
    <p>Tim IT Equogreen</p>
</body>
</html>
