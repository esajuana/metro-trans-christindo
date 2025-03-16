<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; max-width: 700px; margin: auto; padding: 20px; border: 1px solid #ddd; }
        .text-center { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Invoice Rental Mobil</h2>
        <p><strong>No. Transaksi:</strong> INV-{{ $transaksi->id }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>

        
        <h3>Data Penyewa</h3>
        <p><strong>Nama:</strong> {{ $transaksi->nama }}</p>
        <p><strong>Telepon:</strong> {{ $transaksi->ponsel }}</p>
        <p><strong>Alamat:</strong> {{ $transaksi->alamat }}</p>

        <h3>Detail Mobil</h3>
        <p><strong>Mobil:</strong> {{ $transaksi->mobil->merk }}</p>
        <p><strong>Kategori:</strong> {{ $transaksi->mobil->kategori }}</p>
        <p><strong>Harga Sewa:</strong> Rp{{ number_format($transaksi->mobil->harga, 0, ',', '.') }}/jam</p>
        <p><strong>Durasi:</strong> {{ \Carbon\Carbon::parse($transaksi->waktu_mulai)->format('d M Y H:i') }} - 
            {{ \Carbon\Carbon::parse($transaksi->waktu_selesai)->format('d M Y H:i') }}</p>

        <h3>Detail Pembayaran</h3>
        <table>
            <tr>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Total Biaya</td>
                <td>Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>DP</td>
                <td>Rp{{ number_format($transaksi->dp, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sisa Pembayaran</td>
                <td>Rp{{ number_format($transaksi->sisa_pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>{{ ucfirst(strtolower($transaksi->status_pembayaran)) }}</td>
            </tr>
        </table>

        <p class="text-center">Terima kasih telah menggunakan layanan rental kami.</p>
    </div>
</body>
</html>
