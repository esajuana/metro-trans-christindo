@extends('layout.admin.template')

@section('title', 'Tambah Mobil')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h4 class="mb-2">Edit Mobil</h4>
    <form action="{{ route('mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nomor Polisi</label>
            <input type="text" name="nopolisi" class="form-control" value="{{ $mobil->nopolisi }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Merk</label>
            <input type="text" name="merk" class="form-control" value="{{ $mobil->merk }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="SELF_DRIVE" {{ $mobil->kategori == 'SELF_DRIVE' ? 'selected' : '' }}>SELF DRIVE</option>
                <option value="INCLUDE_DRIVER" {{ $mobil->kategori == 'INCLUDE_DRIVER' ? 'selected' : '' }}>INCLUDE DRIVER</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ $mobil->kapasitas }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $mobil->harga }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Mobil</label>
            <input type="file" name="foto" class="form-control">
            @if($mobil->foto)
                <img src="{{ asset('storage/' . $mobil->foto) }}" alt="Foto Mobil" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
