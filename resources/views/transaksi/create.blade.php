@extends('layout.template')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h4 class="mb-3">Tambah Transaksi</h4>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <!-- Pilih Kategori Sewa dari Tabel Mobil -->
        <div class="mb-3">
            <label class="form-label">Kategori Sewa</label>
            <select name="kategori_sewa" id="kategori_sewa" class="form-control" required>
                <option value="" selected disabled>-- Pilih Kategori --</option>
                @foreach($mobils->unique('kategori') as $mobil)
                    <option value="{{ $mobil->kategori }}"
                        {{ old('kategori_sewa') == $mobil->kategori ? 'selected' : '' }}>
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
                <option value="mobil_id">-- Pilih Mobil --</option>
                @foreach($mobils as $mobil)
                <option value="{{ $mobil->id }}" 
                        {{ old('mobil_id') == $mobil->id ? 'selected' : '' }} 
                        data-harga="{{ $mobil->harga }}" 
                        data-kategori="{{ $mobil->kategori }}">
                        {{ $mobil->merk }} - 
                        Rp {{ number_format($mobil->harga, 0, ',', '.') }} 
                        / {{ $mobil->kategori == 'DENGAN_KUNCI' ? 'hari' : '12 jam' }}
                </option>
                @endforeach
            </select>
            @error('mobil_id')
              <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Lainnya -->
        <div class="mb-3">
            <label class="form-label">Nama Penyewa</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Ponsel</label>
            <input type="text" name="ponsel" class="form-control" value="{{ old('ponsel') }}" required>
            @error('ponsel')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}">
            @error('instagram')
                 <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Facebook</label>
            <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}">
            @error('facebook')
                 <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Tempat Tinggal</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
            @error('alamat')
                 <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" class="form-control">{{ old('alamat_pengiriman') }}</textarea>
            @error('alamat_pengiriman')
                 <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kantor</label>
            <input type="text" name="nama_kantor" class="form-control" value="{{ old('nama_kantor') }}">
            @error('nama_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Kantor</label>
            <textarea name="alamat_kantor" class="form-control">{{ old('alamat_kantor') }}</textarea>
            @error('alamat_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon Kantor</label>
            <input type="text" name="nomor_telp_kantor" class="form-control" value="{{ old('nomor_telp_kantor') }}">
            @error('nomor_telp_kantor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan Sewa</label>
            <input type="text" name="tujuan_sewa" class="form-control" value="{{ old('tujuan_sewa') }}" required>
            @error('tujuan_sewa')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Lain Yang Bisa Dihubungi</label>
            <input type="text" name="nomor_lain" class="form-control" value="{{ old('nomor_lain') }}" required>
            @error('nomor_lain')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" required>
            @error('waktu_mulai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Selesai</label>
            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}" required>
            @error('waktu_selesai')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="TRANSFER_BANK" {{ old('metode_pembayaran') == 'TRANSFER_BANK' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="CASH" {{ old('metode_pembayaran') == 'CASH' ? 'selected' : '' }}>Cash</option>
                <option value="E_WALLET" {{ old('metode_pembayaran') == 'E_WALLET' ? 'selected' : '' }}>E-Wallet</option>
            </select>
            @error('metode_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">DP</label>
            <input type="number" name="dp" id="dp" class="form-control" step="0.01" value="{{ old('dp') }}" required>
            @error('dp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Total Pembayaran</label>
            <input type="text" name="total_pembayaran" id="total_pembayaran" class="form-control" readonly>
        </div>
        

        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-control" required>
                <option value="BELUM_LUNAS" {{ old('status_pembayaran') == 'BELUM_LUNAS' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="LUNAS" {{ old('status_pembayaran') == 'LUNAS' ? 'selected' : '' }}>Lunas</option>
            </select>
            @error('status_pembayaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const kategoriSelect = document.getElementById('kategori_sewa');
    const mobilSelect = document.getElementById('mobil_id');
    const waktuMulai = document.getElementById('waktu_mulai');
    const waktuSelesai = document.getElementById('waktu_selesai');
    const totalPembayaran = document.getElementById('total_pembayaran');

    function hitungTotal() {
        const mobilId = mobilSelect.value;
        const mulai = waktuMulai.value;
        const selesai = waktuSelesai.value;

        if (mobilId && mulai && selesai) {
            fetch("{{ url('/transaksi/hitung-total') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ mobil_id: mobilId, waktu_mulai: mulai, waktu_selesai: selesai })
            })
            .then(response => response.json())
            .then(data => {
                // Pastikan nilai yang diterima adalah angka dan diformat dengan ribuan
                totalPembayaran.value = new Intl.NumberFormat('id-ID').format(data.total_pembayaran);
            })
            .catch(error => console.error('Error:', error));
        }
    }

    kategoriSelect.addEventListener('change', function () {
        const selectedKategori = this.value;
        mobilSelect.innerHTML = '<option value="" selected disabled>-- Pilih Mobil --</option>';
        @foreach($mobils as $mobil)
            if ('{{ $mobil->kategori }}' === selectedKategori) {
                let option = document.createElement('option');
                option.value = "{{ $mobil->id }}";
                option.text = "{{ $mobil->merk }} - Rp {{ number_format($mobil->harga, 0, ',', '.') }}";
                mobilSelect.appendChild(option);
            }
        @endforeach
    });

    mobilSelect.addEventListener('change', hitungTotal);
    waktuMulai.addEventListener('change', hitungTotal);
    waktuSelesai.addEventListener('change', hitungTotal);
});

</script>

@endsection
