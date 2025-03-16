<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index() 
    {
        $cars = Mobil::paginate(9);
        return view('user.cars', compact('cars'));
    }

    public function show($id)
    {
        $car = Mobil::findOrFail($id);
        return view('user.cars-detail', compact('car'));
    }

    
}
