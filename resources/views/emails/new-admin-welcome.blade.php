<!DOCTYPE html>
<html>
<head>
    <title>Akun Procurement Baru Equogreen</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $procurement->nama_procurement }}</h2>
    <p>Selamat! Akun admin Procurement Anda di platform E-Procurement Equogreen telah berhasil dibuat oleh Superadmin.</p>
    
    <p>Silakan login ke platform menggunakan kredensial berikut:</p>
    
    <div style="background: #f1f5f9; padding: 15px; margin: 15px 0; border-radius: 6px; display: inline-block; font-size: 14px; border: 1px solid #cbd5e1;">
        <p style="margin: 0 0 8px 0;"><strong>Username:</strong> <code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px;">{{ $username }}</code></p>
        <p style="margin: 0;"><strong>Password:</strong> <code style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px;">{{ $password }}</code></p>
    </div>
    
    <p>Demi keamanan akun Anda, mohon segera ubah password Anda setelah berhasil login pertama kali melalui menu profil.</p>
    
    <div style="margin-top: 25px;">
        <a href="{{ route('login') }}" style="background-color: #002eff; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold; border-radius: 6px; display: inline-block;">Buka Portal Login</a>
    </div>
    
    <br>
    <p>Terima kasih,</p>
    <p>Tim IT Equogreen</p>
</body>
</html>
