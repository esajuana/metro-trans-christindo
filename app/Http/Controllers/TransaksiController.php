<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Mobil;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query()->with('mobil');

        // Filter berdasarkan status transaksi (default 'PENDING' jika tidak dipilih)
        $status = $request->has('status') ? $request->status : 'PENDING';
        if ($status != '') {
            $query->where('status_transaksi', $status);
        }

        // Filter berdasarkan rentang tanggal jika dipilih
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('waktu_mulai', [
                Carbon::parse($request->tanggal_mulai)->startOfDay(),
                Carbon::parse($request->tanggal_selesai)->endOfDay(),
            ]);
        }

        $transaksis = $query->orderBy('id', 'desc')->get();

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $mobils = Mobil::all();
        return view('admin.transaksi.create', compact('mobils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'nama' => 'required|string|max:255',
            'ponsel' => 'required|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'alamat_pengiriman' => 'nullable|string',
            'nama_kantor' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'nomor_telp_kantor' => 'nullable|string|max:20',
            'nomor_lain' => 'nullable|string|max:20',
            'tujuan_sewa' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'metode_pembayaran' => 'required|in:TRANSFER_BANK,CASH,E_WALLET',
            'dp' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:BELUM_LUNAS,LUNAS',
        ]);

            $mobilBentrok = Transaksi::where('mobil_id', $request->mobil_id)
            ->where('status_transaksi', '!=', 'DIBATALKAN')
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                    ->where('waktu_selesai', '>=', $request->waktu_selesai);
                });
            })
            ->first(); // Ambil transaksi pertama yang menyebabkan bentrok
        
        if ($mobilBentrok) {
            return redirect()->back()
                ->withErrors(['mobil_id' => "Mobil ini sudah disewa dari {$mobilBentrok->waktu_mulai} hingga {$mobilBentrok->waktu_selesai}."])
                ->withInput();
        }
    

        // Hitung total pembayaran
        $total_pembayaran = $this->hitungTotal($request)->getData()->total_pembayaran;
        // Hitung DP (minimal 50% dari total pembayaran)
        $dp = min(max($request->dp, $total_pembayaran * 0.5), $total_pembayaran);
        // Hitung sisa pembayaran
        $sisa_pembayaran = $total_pembayaran - $dp;

        // Simpan transaksi ke database
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'mobil_id' => $request->mobil_id,
            'nama' => $request->nama,
            'ponsel' => $request->ponsel,
            'instagram' => $request->instagram ?? null,
            'facebook' => $request->facebook ?? null,
            'alamat' => $request->alamat,
            'alamat_pengiriman' => $request->alamat_pengiriman ?? null,
            'nama_kantor' => $request->nama_kantor ?? null,
            'alamat_kantor' => $request->alamat_kantor ?? null,
            'nomor_telp_kantor' => $request->nomor_telp_kantor ?? null,
            'nomor_lain' => $request->nomor_lain ?? null,
            'tujuan_sewa' => $request->tujuan_sewa ?? null,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'total_pembayaran' => $total_pembayaran,
            'dp' => $dp,
            'sisa_pembayaran' => $sisa_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_transaksi' => 'PENDING',
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function hitungTotal(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Ambil data mobil
        $mobil = Mobil::findOrFail($request->mobil_id);
        $harga_per_unit = $mobil->harga;
        $kategori = $mobil->kategori; // "DENGAN_KUNCI" atau "TANPA_KUNCI"

        // Hitung durasi dalam jam
        $waktu_mulai = strtotime($request->waktu_mulai);
        $waktu_selesai = strtotime($request->waktu_selesai);
        $durasi_jam = ceil(($waktu_selesai - $waktu_mulai) / 3600);

        // Hitung jumlah unit berdasarkan kategori sewa
        if ($kategori === 'SELF_DRIVE') {
            $jumlah_unit = ceil($durasi_jam / 24); // Dihitung per 24 jam
        } else {
            $jumlah_unit = ceil($durasi_jam / 12); // Dihitung per 12 jam
        }

        // Hitung total pembayaran
        $total_pembayaran = $jumlah_unit * $harga_per_unit;

        return response()->json([
            'total_pembayaran' => $total_pembayaran
        ]);
    }

    public function edit(Transaksi $transaksi)
    {
        $mobils = Mobil::all();
        return view('admin.transaksi.edit', compact('transaksi', 'mobils'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        
        $request->validate([
            // 'nama' => 'required|string|max:255',
            // 'ponsel' => 'required|string|max:20',
            // 'instagram' => 'nullable|string|max:255',
            // 'facebook' => 'nullable|string|max:255',
            // 'alamat' => 'required|string',
            // 'alamat_pengiriman' => 'nullable|string',
            // 'nama_kantor' => 'nullable|string|max:255',
            // 'alamat_kantor' => 'nullable|string',
            // 'nomor_telp_kantor' => 'nullable|string|max:20',
            // 'nomor_lain' => 'nullable|string|max:20',
            // 'tujuan_sewa' => 'nullable|string',
            // 'waktu_mulai' => 'required|date',
            // 'waktu_selesai' => 'required|date|after:waktu_mulai',
            // 'metode_pembayaran' => 'required|in:TRANSFER_BANK,CASH,E_WALLET',
            // 'status_pembayaran' => 'required|in:BELUM_LUNAS,LUNAS',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'status_transaksi' => 'required|in:PENDING,DIPROSES,SELESAI,DIBATALKAN',
            'waktu_pengembalian' => 'nullable|date|after_or_equal:waktu_selesai',
        ]);

             // Cek apakah ada bentrokan dengan transaksi lain (selain transaksi ini sendiri)
            $mobilBentrok = Transaksi::where('mobil_id', $request->mobil_id)
            ->where('status_transaksi', '!=', 'DIBATALKAN')
            ->where('id', '!=', $transaksi->id) // Hindari pengecekan terhadap transaksi ini sendiri
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                    ->where('waktu_selesai', '>=', $request->waktu_selesai);
                });
            })
            ->first(); // Ambil transaksi pertama yang menyebabkan bentrok

        if ($mobilBentrok) {
            return redirect()->back()
                ->withErrors(['mobil_id' => "Mobil ini sudah disewa dari {$mobilBentrok->waktu_mulai} hingga {$mobilBentrok->waktu_selesai}."])
                ->withInput();
        }


        $request->merge([
            'dp' => str_replace('.', '', $request->dp)
        ]);
        // Menghitung total pembayaran terbaru
        $denda_lama = $transaksi->denda;

        // Ambil nilai denda baru dari JSON response
        $denda_baru = $this->hitungDenda($request, $transaksi->id)->getData()->denda;

        // Hitung total pembayaran baru dengan mengurangi denda lama terlebih dahulu
        $total_pembayaran_baru = ($transaksi->total_pembayaran - $denda_lama) + $denda_baru;

        // $sisa_pembayaran = $transaksi->total_pembayaran - $request->dp;

        //  // Hitung denda menggunakan fungsi hitungDenda
        //  $denda = $this->hitungDenda($request, $transaksi->id)->getData()->denda;

        // Update transaksi dengan denda yang dihitung
        $transaksi->update([
            'nama' => $request->nama,
            'ponsel' => $request->ponsel,
            'instagram' => $request->instagram ?? null,
            'facebook' => $request->facebook ?? null,
            'alamat' => $request->alamat,
            'alamat_pengiriman' => $request->alamat_pengiriman ?? null,
            'nama_kantor' => $request->nama_kantor ?? null,
            'alamat_kantor' => $request->alamat_kantor ?? null,
            'nomor_telp_kantor' => $request->nomor_telp_kantor ?? null,
            'nomor_lain' => $request->nomor_lain ?? null,
            'tujuan_sewa' => $request->tujuan_sewa ?? null,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status_pembayaran' => $request->status_pembayaran,
            'total_pembayaran' => $total_pembayaran_baru,
            'denda' => $denda_baru, // Simpan denda baru
            'sisa_pembayaran' => $total_pembayaran_baru - $request->dp,
            // 'total_pembayaran' => $total_pembayaran_baru,
            'dp' => $request->dp,
            // 'sisa_pembayaran' => $sisa_pembayaran,
            // 'dp' => $request->dp,
            // 'sisa_pembayaran' => $sisa_pembayaran, // Tambahkan perhitungan ulang sisa pembayaran
            'waktu_pengembalian' => $request->waktu_pengembalian,
            // 'denda' => $denda,
            // 'total_pembayaran' => $transaksi->total_pembayaran + $denda, // Tambahkan denda ke total pembayaran
            'status_transaksi' => $request->status_transaksi,
        ]);
        
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function hitungDenda(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $waktuSelesai = Carbon::parse($transaksi->waktu_selesai);
        $waktuPengembalian = Carbon::parse($request->waktu_pengembalian);
        $hargaSewa = $transaksi->mobil->harga;

        // Hitung keterlambatan dalam jam
        $jamTerlambat = $waktuSelesai->diffInHours($waktuPengembalian, false);

        if ($jamTerlambat > 0) {
            if ($jamTerlambat > 10) {
                $denda = $hargaSewa; // Denda 1 hari penuh jika >10 jam
            } else {
                $denda = $hargaSewa * 0.1; // Denda 10% jika ≤ 10 jam
            }
        } else {
            $denda = 0;
        }

        return response()->json(['denda' => $denda]);
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi = Transaksi::with('mobil')->find($transaksi->id);

        return view('admin.transaksi.show', compact('transaksi'));
    }      

    public function invoice($id)
    {
        $transaksi = Transaksi::with('mobil')->findOrFail($id);
        return view('admin.transaksi.invoice', compact('transaksi'));
    }

    public function cetakInvoice($id)
    {
        $transaksi = Transaksi::with('mobil')->findOrFail($id);

        // Generate PDF
        $pdf = Pdf::loadView('admin.transaksi.invoice-pdf', compact('transaksi'))
                ->setPaper('A4', 'portrait'); // Atur ukuran kertas

        return $pdf->download('Invoice_' . $transaksi->id . '.pdf');
    }


    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
