<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $reviews = Ulasan::where('status', 'publish')->latest()->get();
        return view('user.about', compact('reviews'));
    }

}
