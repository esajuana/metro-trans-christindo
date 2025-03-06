@extends('layout.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h4 class="mb-2">Tambah Mobil</h4>
    <form action="{{ route('mobils.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nomor Polisi</label>
            <input type="text" name="nopolisi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Merk</label>
            <input type="text" name="merk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="DENGAN_KUNCI">Dengan Kunci</option>
                <option value="TANPA_KUNCI">Tanpa Kunci</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Mobil</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
