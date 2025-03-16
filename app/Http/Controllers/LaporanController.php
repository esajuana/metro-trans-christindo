<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    // Ambil input tanggal dari request (jika ada)
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalSelesai = $request->input('tanggal_selesai');

    // Jika tanggal tidak dipilih, tampilkan semua transaksi SELESAI
    if ($tanggalMulai && $tanggalSelesai) {
        // Konversi ke format yang sesuai
        $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
        $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

        // Ambil data transaksi dalam rentang tanggal
        $transaksis = Transaksi::where('status_transaksi', 'SELESAI')
            ->whereBetween('waktu_mulai', [$tanggalMulai, $tanggalSelesai])
            ->orderBy('waktu_mulai', 'asc')
            ->get();
    } else {
        // Jika tidak ada filter, tampilkan semua transaksi selesai
        $transaksis = Transaksi::where('status_transaksi', 'SELESAI')
            ->orderBy('waktu_mulai', 'asc')
            ->get();
    }

    return view('admin.laporan.index', compact('transaksis', 'tanggalMulai', 'tanggalSelesai'));
}


    public function downloadPDF(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
        $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

        $transaksis = Transaksi::where('status_transaksi', 'SELESAI')
            ->whereBetween('waktu_mulai', [$tanggalMulai, $tanggalSelesai])
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('transaksis', 'tanggalMulai', 'tanggalSelesai'));

        return $pdf->stream("Laporan_Transaksi_{$tanggalMulai->format('d-m-Y')}_sampai_{$tanggalSelesai->format('d-m-Y')}.pdf");
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi = Transaksi::with('mobil')->find($transaksi->id);

        return view('admin.laporan.show', compact('transaksi'));
    }   


}

