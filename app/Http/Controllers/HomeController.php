<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        $reviews = Ulasan::where('status', 'publish')->latest()->get();
        return view('user.home', compact('mobils', 'reviews'));
    }

}
