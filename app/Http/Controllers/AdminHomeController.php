<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $data['mobil'] = Mobil::count();
        $data['user'] = User::count();
        $data['transaksi'] = Transaksi::where('status_transaksi', 'SELESAI')->sum('total_pembayaran');
        
        return view('admin.home', $data);
    }
}
