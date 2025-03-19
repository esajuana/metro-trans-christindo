<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $data['mobil'] = Mobil::count();
        $data['user'] = User::count();
        $data['transaksi'] = Transaksi::where('status_transaksi', 'SELESAI')->sum('total_pembayaran');
        $data['ulasan'] = Ulasan::count();
        $data['kontak'] = Contact::count();

        return view('admin.home', $data);
    }

    // public function getKalenderData()
    // {
    //     $events = Transaksi::where('status_transaksi', 'DIPROSES') // Filter transaksi aktif
    //         ->with('mobil') // Pastikan relasi mobil dimuat
    //         ->get()
    //         ->map(function ($transaksi) {
    //             return [
    //                 'title' => $transaksi->mobil ? $transaksi->mobil->merk : 'Mobil Tidak Diketahui',
    //                 'start' => date('c', strtotime($transaksi->waktu_mulai)), // Format ISO 8601
    //                 'end'   => date('c', strtotime($transaksi->waktu_selesai . ' +1 day')), 
    //                 'backgroundColor' => '#007bff',
    //                 'borderColor' => '#007bff',
    //             ];
    //         });

    //     return response()->json($events);
    // }

}
