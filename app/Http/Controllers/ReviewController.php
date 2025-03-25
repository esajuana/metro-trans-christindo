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

    public function adminIndex(Request $request)
    {
        $query = Ulasan::query();

        // Filter berdasarkan status (publish atau pending)
        if ($request->filled('status') && in_array($request->status, ['publish', 'pending'])) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian (nama, email, atau rating)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('rating', $search);
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->get();

        return view('admin.review.index', compact('reviews'));
    }



    public function publish($id)
    {
        $review = Ulasan::findOrFail($id);
        $review->update(['status' => 'publish']); // Gunakan 'publish', bukan 'published'
    
        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dipublikasikan.');
    }

    public function unpublish($id)
    {
        $review = Ulasan::findOrFail($id);
        $review->update(['status' => 'pending']); // Ubah status kembali ke pending

        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dikembalikan ke pending.');
    }
    

    public function destroy($id)
    {
        $review = Ulasan::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dihapus.');
    }

}
