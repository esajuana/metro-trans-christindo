<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        <style>
    body { 
        font-family: Arial, sans-serif; 
        font-size: 10px; /* Perkecil ukuran font */
        margin: 20px; /* Tambahkan margin agar tidak terlalu mepet */
    }
    
    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 10px; 
        table-layout: fixed; /* Paksa tabel agar menyesuaikan lebar halaman */
    }

    th, td { 
        border: 1px solid black; 
        padding: 4px; /* Kurangi padding agar tidak terlalu besar */
        text-align: center; 
        font-size: 9px; /* Perkecil font dalam tabel */
        word-wrap: break-word; /* Memastikan teks tidak keluar dari kotak */
        overflow: hidden; /* Mencegah teks keluar */
    }

    th { 
        background-color: #f2f2f2; 
    }

    h2 { 
        text-align: center; 
        font-size: 14px; /* Perkecil ukuran judul */
    }

    /* Atur lebar masing-masing kolom */
    th:nth-child(1), td:nth-child(1) { width: 10%; } /* Nama */
    th:nth-child(2), td:nth-child(2) { width: 12%; } /* Mobil */
    th:nth-child(3), td:nth-child(3) { width: 7%; } /* Kategori */
    th:nth-child(4), td:nth-child(4) { width: 12%; } /* Waktu Mulai */
    th:nth-child(5), td:nth-child(5) { width: 12%; } /* Waktu Selesai */
    th:nth-child(6), td:nth-child(6) { width: 12%; } /* Waktu Pengembalian */
    th:nth-child(7), td:nth-child(7) { width: 10%; } /* Total */
    th:nth-child(8), td:nth-child(8) { width: 8%; } /* DP */
    th:nth-child(9), td:nth-child(9) { width: 8%; } /* Denda */
    th:nth-child(10), td:nth-child(10) { width: 9%; } /* Status Pembayaran */
</style>

    </style>
</head>
<body>
    <h2>Laporan Transaksi Rental Mobil</h2>
    @if (isset($tanggalMulai) && isset($tanggalSelesai))
    <p><strong>Periode:</strong> {{ $tanggalMulai->format('d-m-Y') }} - {{ $tanggalSelesai->format('d-m-Y') }}</p>
    @endif
     <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Mobil</th>
                <th>Kategori</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Waktu Pengembalian</th>
                <th>Total Pembayaran</th>
                <th>DP</th>
                <th>Denda</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->nama }}</td>
                <td>{{ $transaksi->mobil->merk }}</td>
                <td>{{ $transaksi->mobil->kategori }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->waktu_mulai)->translatedFormat('l, d F Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->waktu_selesai)->translatedFormat('l, d F Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->waktu_pengembalian)->translatedFormat('l, d F Y H:i') }}</td>
                <td>Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transaksi->dp, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</td>
                <td>{{ $transaksi->status_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
