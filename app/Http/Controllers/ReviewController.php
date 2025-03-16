<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('user.review');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|numeric',
            'pesan' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan data ulasan ke database
        Ulasan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->pesan,
            'rating' => $request->rating,
            'status' => 'pending', // Default pending, admin harus menyetujui dulu
        ]);

        return redirect()->route('review')->with('success', 'Ulasan Anda berhasil dikirim!');
    }

        public function adminIndex()
    {
        $reviews = Ulasan::latest()->get(); // Ambil semua ulasan terbaru

        return view('admin.review.index', compact('reviews'));
    }

    public function publish($id)
    {
        $review = Ulasan::findOrFail($id);
        $review->update(['status' => 'publish']); // Gunakan 'publish', bukan 'published'
    
        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dipublikasikan.');
    }
    

    public function destroy($id)
    {
        $review = Ulasan::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dihapus.');
    }

}
