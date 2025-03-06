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
                    <option value="{{ $mobil->kategori }}">{{ $mobil->kategori == 'DENGAN_KUNCI' ? 'Dengan Kunci (24 Jam)' : 'Tanpa Kunci (12 Jam)' }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Mobil -->
        <div class="mb-3">
            <label class="form-label">Pilih Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control" required>
                <option value="mobil_id">-- Pilih Mobil --</option>
                @foreach($mobils as $mobil)
                <option value="{{ $mobil->id }}" 
                        data-harga="{{ $mobil->harga }}" 
                        data-kategori="{{ $mobil->kategori }}">
                        {{ $mobil->merk }} - 
                        Rp {{ number_format($mobil->harga, 0, ',', '.') }} 
                        / {{ $mobil->kategori == 'DENGAN_KUNCI' ? 'hari' : '12 jam' }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Input Lainnya -->
        <div class="mb-3">
            <label class="form-label">Nama Penyewa</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Ponsel</label>
            <input type="text" name="ponsel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Instagram</label>
            <input type="text" name="instagram" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Facebook</label>
            <input type="text" name="facebook" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Tempat Tinggal</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat_pengiriman" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kantor</label>
            <input type="text" name="nama_kantor" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Kantor</label>
            <textarea name="alamat_kantor" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon Kantor</label>
            <input type="text" name="nomor_telp_kantor" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan Sewa</label>
            <input type="text" name="tujuan_sewa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Lain Yang Bisa Dihubungi</label>
            <input type="text" name="nomor_lain" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Selesai</label>
            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control" required>
                <option value="TRANSFER_BANK">Transfer Bank</option>
                <option value="CASH">Cash</option>
                <option value="E_WALLET">E-Wallet</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">DP</label>
            <input type="number" name="dp" id="dp" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Pembayaran</label>
            <input type="text" name="total_pembayaran" id="total_pembayaran" class="form-control" readonly>
        </div>
        

        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-control" required>
                <option value="BELUM_LUNAS">Belum Lunas</option>
                <option value="LUNAS">Lunas</option>
            </select>
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
