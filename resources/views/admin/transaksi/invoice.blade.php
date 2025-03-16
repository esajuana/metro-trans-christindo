@extends('layout.admin.template')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h3>Invoice Rental Mobil</h3>
            <p><strong>No. Transaksi:</strong> INV-{{ $transaksi->id }}</p>
        </div>
        <div class="card-body">
            <h5>Data Penyewa</h5>
            <p><strong>Nama:</strong> {{ $transaksi->nama }}</p>
            <p><strong>Telepon:</strong> {{ $transaksi->ponsel }}</p>
            <p><strong>Alamat:</strong> {{ $transaksi->alamat }}</p>

            <hr>

            <h5>Detail Mobil</h5>
            <p><strong>Mobil:</strong> {{ $transaksi->mobil->merk }}</p>
            <p><strong>Kategori:</strong> {{ $transaksi->mobil->kategori }}</p>
            <p><strong>Harga Sewa:</strong> Rp{{ number_format($transaksi->mobil->harga, 0, ',', '.') }}/jam</p>
            <p><strong>Durasi:</strong> {{ \Carbon\Carbon::parse($transaksi->waktu_mulai)->format('d M Y H:i') }} - 
                {{ \Carbon\Carbon::parse($transaksi->waktu_selesai)->format('d M Y H:i') }}</p>

            <hr>

            <h5>Detail Pembayaran</h5>
            <p><strong>Total Biaya:</strong> Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</p>
            <p><strong>DP:</strong> Rp{{ number_format($transaksi->dp, 0, ',', '.') }}</p>
            <p><strong>Sisa Pembayaran:</strong> Rp{{ number_format($transaksi->sisa_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst(strtolower($transaksi->status_pembayaran)) }}</p>

            <hr>

            <p class="text-center">Terima kasih telah menggunakan layanan rental kami.</p>

            <div class="text-center">
                <a href="{{ route('transaksi.cetakInvoice', $transaksi->id) }}" class="btn btn-danger">
                    Download invoice
                </a>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </div>
    </div>
</div>
@endsection
