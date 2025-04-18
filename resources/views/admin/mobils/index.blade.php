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

                    <h6 class="mb-4">Data Mobil</h6>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary">
                            <a class="text-light text-decoration-none" href="{{ route('mobils.create') }}">Tambah Mobil</a>
                        </button>
                    
                        <div class="d-flex">
                            <form action="{{ route('mobils.index') }}" method="GET" class="d-flex">
                                <!-- Input Pencarian -->
                                <input type="text" class="form-control me-2" name="search" placeholder="Cari Nama, Merk, atau No Polisi" value="{{ request('search') }}">
                    
                                <!-- Dropdown Kategori -->
                                <select class="form-select me-2" name="kategori">
                                    <option value="">-- Semua Kategori --</option>
                                    <option value="SELF_DRIVE" {{ request('kategori') == 'SELF_DRIVE' ? 'selected' : '' }}>SELF DRIVE</option>
                                    <option value="INCLUDE_DRIVER" {{ request('kategori') == 'INCLUDE_DRIVER' ? 'selected' : '' }}>INCLUDE DRIVER</option>
                                </select>
                    
                                <!-- Tombol Cari -->
                                <button type="submit" class="btn btn-primary me-2">Cari</button>
                    
                                <!-- Tombol Reset -->
                                <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Reset</a>
                            </form>
                        </div>
                    </div>
                    
                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Polisi</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Kapasitas</th>
                                <th scope="col">Kategori</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mobils as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->nopolisi }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->kapasitas }} Seat</td>
                                    <td>{{ $data->kategori }}</td>
                                    <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $data->foto) }}" style="width: 150px">
                                    </td>
                                    <td>
                                        <a class="btn btn-warning text-light d-block w-100 mb-2" href="{{ route('mobils.edit', $data->id) }}">
                                            Edit
                                        </a>
                                        <button class="btn btn-danger d-block w-100" onclick="confirmDelete('{{ route('mobils.destroy', $data->id) }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data Mobil Belum Ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
