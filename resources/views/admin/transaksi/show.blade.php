@extends('layout.admin.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Detail Transaksi</h6>

                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $transaksi->nama }}</td>
                    </tr>
                    <tr>
                        <th>Ponsel</th>
                        <td>{{ $transaksi->ponsel }}</td>
                    </tr>
                    <tr>
                        <th>Mobil</th>
                        <td>{{ $transaksi->mobil->merk }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp{{ number_format($transaksi->mobil->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $transaksi->mobil->kategori }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td>{{ $transaksi->alamat_pengiriman }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Mulai</th>
                        <td>{{ \Carbon\Carbon::parse($transaksi->waktu_mulai)->translatedFormat('l, d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Selesai</th>
                        <td>{{ \Carbon\Carbon::parse($transaksi->waktu_selesai)->translatedFormat('l, d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Pengembalian</th>
                        <td>{{ \Carbon\Carbon::parse($transaksi->waktu_mulai  ?? 'Belum dikembalikan')->translatedFormat('l, d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ $transaksi->metode_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>DP</th>
                        <td>Rp{{ number_format($transaksi->dp, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Denda</th>
                        <td>Rp{{ number_format($transaksi->denda, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Sisa Pembayaran</th>
                        <td>Rp{{ number_format($transaksi->sisa_pembayaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td>Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Status Transaksi</th>
                        <td>{{ $transaksi->status_transaksi }}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>{{ $transaksi->status_pembayaran }}</td>
                    </tr>
                    
                </table>

                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
