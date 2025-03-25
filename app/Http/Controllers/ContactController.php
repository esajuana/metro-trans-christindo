<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:15',
            'pesan' => 'required|string',
        ]);

        // Simpan data ke database
        Contact::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->pesan,
            'status' => 'pending', // Default status pending
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('contact')->with('success', 'Pesan Anda telah dikirim!');
    }

    public function adminIndex(Request $request)
    {
        $query = Contact::query();

        // Filter berdasarkan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('pesan', 'like', "%$search%");
        }

        $contact = $query->latest()->get(); // Ambil data terbaru setelah difilter

        return view('admin.contact.index', compact('contact'));
    }


    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
