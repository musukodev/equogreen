<!DOCTYPE html>
<html>
<head>
    <title>Permintaan Penawaran Baru</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px;">
    <h2>Halo, {{ $vendor->nama_perusahaan }}</h2>
    <p>Ada permintaan penawaran harga baru (RFQ) untuk <strong>Batch {{ $batch_id }}</strong> dari Tim Procurement Equogreen.</p>
    
    <p>Berikut adalah rincian spesifikasi barang yang sedang kami butuhkan:</p>
    
    <table style="border-collapse: collapse; width: 100%; max-width: 600px; margin: 15px 0; font-size: 14px; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f3f4f6; border-bottom: 2px solid #ddd;">
                <th style="padding: 10px; text-align: left; border-right: 1px solid #ddd;">Nama Barang</th>
                <th style="padding: 10px; text-align: left; border-right: 1px solid #ddd;">Spesifikasi Detail</th>
                <th style="padding: 10px; text-align: center; width: 80px;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 10px; border-right: 1px solid #ddd;">{{ $item['nama_barang'] }}</td>
                <td style="padding: 10px; border-right: 1px solid #ddd;">{{ $item['spesifikasi'] }}</td>
                <td style="padding: 10px; text-align: center;">{{ $item['jumlah'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <p>Silakan login ke portal vendor Equogreen untuk mengunduh template penawaran dan mengunggah quotation harga terbaik Anda sebelum batas waktu batch berakhir.</p>
    
    <div style="margin-top: 25px;">
        <a href="{{ route('login') }}" style="background-color: #002eff; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold; border-radius: 6px; display: inline-block;">Kirim Quotation</a>
    </div>
    
    <br>
    <p>Terima kasih,</p>
    <p>Tim Procurement Equogreen</p>
</body>
</html>
