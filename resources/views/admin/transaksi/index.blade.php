@extends('layout.admin.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h6 class="mb-4">Data Transaksi</h6>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary">
                            <a class="text-light" href="{{ route('transaksi.create') }}">Tambah Transaksi</a>
                        </button>

                        <!-- Dropdown Filter -->
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('transaksi.index') }}" class="d-flex gap-2">
                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                                <select name="status" class="form-select">
                                    <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="DIPROSES" {{ request('status') == 'DIPROSES' ? 'selected' : '' }}>Proses</option>
                                    <option value="SELESAI" {{ request('status') == 'SELESAI' ? 'selected' : '' }}>Selesai</option>
                                    <option value="DIBATALKAN" {{ request('status') == 'DIBATALKAN' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Mobil</th>
                                    <th>Kategori</th>
                                    <th style="min-width: 200px;">Waktu Mulai</th>
                                    <th style="min-width: 200px;">Waktu Selesai</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total Pembayaran</th>
                                    <th style="min-width: 100px;">DP</th>
                                    <th>Sisa Pembayaran</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->nama }}</td>
                                    <td>{{ $transaksi->mobil->merk }}</td>
                                    <td>{{ $transaksi->mobil->kategori }}</td>
                                    <td style="min-width: 200px;">{{ \Carbon\Carbon::parse($transaksi->waktu_mulai)->translatedFormat('l, d F Y H:i') }}</td>
                                    <td style="min-width: 200px;">{{ \Carbon\Carbon::parse($transaksi->waktu_selesai)->translatedFormat('l, d F Y H:i') }}</td>
                                    <td>{{ $transaksi->status_pembayaran }}</td>
                                    <td>Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                                    <td style="min-width: 100px;">Rp {{ number_format($transaksi->dp, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($transaksi->sisa_pembayaran, 0, ',', '.') }}</td>
                                    <td>
                                        @if (in_array($transaksi->status_transaksi, ['DIPROSES', 'SELESAI']))
                                            Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $transaksi->status_transaksi }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.invoice', $transaksi->id) }}" class="btn btn-success d-block w-100 mb-2">Invoice</a>
                                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-info d-block w-100 mb-2">Detail</a>
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning d-block w-100 mb-2 text-light">Edit</a>
                                        <button type="button" class="btn btn-danger d-block w-100 mb-2" onclick="confirmDelete('{{ route('transaksi.destroy', $transaksi->id) }}')">Hapus</button>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Data Transaksi Belum Ada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl) {
        document.getElementById('deleteForm').action = deleteUrl;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>

@endsection
