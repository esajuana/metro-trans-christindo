@extends('layout.admin.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h4 class="mb-3">Edit Transaksi</h4>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" id="transaksi_id" value="{{ $transaksi->id }}">
        
        <!-- Pilih Kategori Sewa dari Tabel Mobil -->
        <div class="mb-3">
            <label class="form-label">Kategori Sewa</label>
            <select name="kategori_sewa" id="kategori_sewa" class="form-control" required>
                <option value="" disabled>-- Pilih Kategori --</option>
                @foreach($mobils->unique('kategori') as $mobil)
                    <option value="{{ $mobil->kategori }}" 
                        {{ $transaksi->mobil->kategori == $mobil->kategori ? 'selected' : '' }}>
                        {{ $mobil->kategori == 'DENGAN_KUNCI' ? 'Dengan Kunci (24 Jam)' : 'Tanpa Kunci (12 Jam)' }}
                    </option>
                @endforeach
            </select>
            @error('kategori_sewa')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Mobil -->
        <div class="mb-3">
            <label class="form-label">Pilih Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control" required>
                <option value="" disabled>-- Pilih Mobil --</option>
                @foreach($mobils as $mobil)
                    <option value="{{ $mobil->id }}" 
                        data-harga="{{ $mobil->harga }}" 
                        data-kategori="{{ $mobil->kategori }}"
                        {{ $transaksi->mobil_id == $mobil->id ? 'selected' : '' }}>
                        {{ $mobil->merk }} - Rp {{ number_format($mobil->harga, 0, ',', '.') }} / 
                        {{ $mobil->kategori == 'DENGAN_KUNCI' ? 'hari' : '12 jam' }}
                    </option>
                @endforeach
            </select>
            @error('mobil_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <!-- Nama Penyewa -->
        <div class="mb-3">
            <label class="form-label">Nama Penyewa</label>
            <input type="text" name="nama" class="form-control" value="{{ $transaksi->nama }}" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nomor Ponsel -->
        <div class="mb-3">
            <label class="form-label">Nomor Ponsel</label>
            <input type="text" name="ponsel" class="form-control" value="{{ $transaksi->ponsel }}" required>
            @error('ponsel')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{ $transaksi->instagram }}">
            @error('instagram')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Facebook</label>
            <input type="text" name="facebook" class="form-control" value="{{ $transaksi->facebook }}">
            @error('facebook')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Tempat Tinggal</label>
            <textarea name="alamat" class="form-control" required>{{ $transaksi->alamat }}</textarea>
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" class="form-control">{{ $transaksi->alamat_pengiriman }}</textarea>
            @error('alamat_pengiriman')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kantor</label>
            <input type="text" name="nama_kantor" class="form-control" value="{{ $transaksi->nama_kantor }}">
            @error('nama_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Kantor</label>
            <textarea name="alamat_kantor" class="form-control">{{ $transaksi->alamat_kantor }}</textarea>
            @error('alamat_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon Kantor</label>
            <input type="text" name="nomor_telp_kantor" class="form-control" value="{{ $transaksi->nomor_telp_kantor }}">
            @error('nomor_telp_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan Sewa</label>
            <input type="text" name="tujuan_sewa" class="form-control" value="{{ $transaksi->tujuan_sewa }}" required>
            @error('tujuan_sewa')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Lain Yang Bisa Dihubungi</label>
            <input type="text" name="nomor_lain" class="form-control" value="{{ $transaksi->nomor_lain }}" required>
            @error('nomor_lain')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Waktu Mulai -->
        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <input type="datetime-local" name="waktu_mulai" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($transaksi->waktu_mulai)) }}" required>
            @error('waktu_mulai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Waktu Selesai -->
        <div class="mb-3">
            <label class="form-label">Waktu Selesai</label>
            <input type="datetime-local" name="waktu_selesai" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($transaksi->waktu_selesai)) }}" required>
            @error('waktu_selesai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Waktu Pengembalian -->
        <div class="mb-3">
            <label class="form-label">Waktu Pengembalian</label>
            <input type="datetime-local" name="waktu_pengembalian" class="form-control" id="waktu_pengembalian"
            value="{{ $transaksi->waktu_pengembalian ? \Carbon\Carbon::parse($transaksi->waktu_pengembalian)->format('Y-m-d\TH:i') : '' }}">
            @error('waktu_pengembalian')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control">
                <option value="TRANSFER_BANK" {{ $transaksi->metode_pembayaran === 'TRANSFER_BANK' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="CASH" {{ $transaksi->metode_pembayaran === 'CASH' ? 'selected' : '' }}>Cash</option>
                <option value="E_WALLET" {{ $transaksi->metode_pembayaran === 'E_WALLET' ? 'selected' : '' }}>E Wallet</option>
            </select>
            @error('metode_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Denda</label>
            <p id="denda">Rp 0</p>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Total Pembayaran Baru</label>
            <p id="total_pembayaran">Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">DP</label>
            <input type="text" name="dp" class="form-control" 
            value="{{ number_format($transaksi->dp, 0, ',', '.') }}" required>
            @error('dp')
              <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sisa Pembayaran</label>
            <input type="text" name="sisa_pembayaran" class="form-control" value="{{ number_format($transaksi->sisa_pembayaran, 0, ',', '.') }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-control">
                <option value="BELUM_LUNAS" {{ $transaksi->status_pembayaran === 'BELUM_LUNAS' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="LUNAS" {{ $transaksi->status_pembayaran === 'LUNAS' ? 'selected' : '' }}>Lunas</option>
            </select>
            @error('status_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Transaksi -->
        <select name="status_transaksi" class="form-control mb-5">
            <option value="PENDING" {{ $transaksi->status_transaksi === 'PENDING' ? 'selected' : '' }}>Pending</option>
            <option value="DIPROSES" {{ $transaksi->status_transaksi === 'DIPROSES' ? 'selected' : '' }}>Proses</option>
            <option value="SELESAI" {{ $transaksi->status_transaksi === 'SELESAI' ? 'selected' : '' }}>Selesai</option>
            <option value="DIBATALKAN" {{ $transaksi->status_transaksi === 'DIBATALKAN' ? 'selected' : '' }}>Batal</option>
        </select>
        

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let dpInput = document.querySelector("input[name='dp']");
    let sisaPembayaranInput = document.querySelector("input[name='sisa_pembayaran']");
    let totalPembayaranElem = document.getElementById("total_pembayaran");
    let dendaElem = document.getElementById("denda");
    let transaksiId = document.getElementById("transaksi_id").value;

    function updateTotal() {
        let denda = parseInt(dendaElem.innerText.replace(/\D/g, '')) || 0;
        let totalBaru = {{ $transaksi->total_pembayaran }} + denda;
        totalPembayaranElem.innerText = `Rp ${totalBaru.toLocaleString('id-ID')}`;

        let dpValue = parseInt(dpInput.value.replace(/\D/g, '')) || 0;
        let sisaPembayaran = totalBaru - dpValue;
        sisaPembayaranInput.value = sisaPembayaran.toLocaleString('id-ID');
    }

    dpInput.addEventListener("input", updateTotal);

    document.getElementById("waktu_pengembalian").addEventListener("change", function () {
        fetch(`/admin/transaksi/${transaksiId}/hitung-denda`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ waktu_pengembalian: this.value })
        })
        .then(response => response.json())
        .then(data => {
            dendaElem.innerText = `Rp ${data.denda.toLocaleString('id-ID')}`;
            updateTotal();
        })
        .catch(error => console.error("Error fetching denda:", error));
    });
});
    document.addEventListener('DOMContentLoaded', function () {
    const kategoriSelect = document.getElementById('kategori_sewa');
    const mobilSelect = document.getElementById('mobil_id');

    function filterMobilByKategori() {
        const selectedKategori = kategoriSelect.value;
        mobilSelect.innerHTML = '<option value="" selected disabled>-- Pilih Mobil --</option>';

        @foreach($mobils as $mobil)
            if ('{{ $mobil->kategori }}' === selectedKategori) {
                let option = document.createElement('option');
                option.value = "{{ $mobil->id }}";
                option.text = "{{ $mobil->merk }} - Rp {{ number_format($mobil->harga, 0, ',', '.') }}";
                option.dataset.harga = "{{ $mobil->harga }}";
                mobilSelect.appendChild(option);
            }
        @endforeach
    }

    kategoriSelect.addEventListener('change', filterMobilByKategori);
});

//  document.addEventListener("DOMContentLoaded", function () {
//     let transaksiIdElement = document.getElementById("transaksi_id");
//     if (!transaksiIdElement) {
//         console.error("Element transaksi_id tidak ditemukan!");
//         return;
//     }
//     let transaksiId = transaksiIdElement.value;

//     let waktuPengembalian = document.getElementById("waktu_pengembalian");
//     if (waktuPengembalian) {
//         waktuPengembalian.addEventListener("change", function () {
//             let waktuPengembalianVal = this.value;

//             fetch(`/transaksi/${transaksiId}/hitung-denda`, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
//                 },
//                 body: JSON.stringify({ waktu_pengembalian: waktuPengembalianVal })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 document.getElementById("denda").innerText = `Rp ${data.denda.toLocaleString()}`;
//             })
//             .catch(error => console.error("Error fetching denda:", error));
//         });
//     }
// });

</script>

@endsection
