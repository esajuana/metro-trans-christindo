<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Tampilkan daftar mobil.
     */
    public function index(Request $request)
    {
        $query = Mobil::query();

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $mobils = $query->get();

        return view('admin.mobils.index', compact('mobils'));
    }


    /**
     * Tampilkan form untuk menambah mobil baru.
     */
    public function create()
    {
        return view('admin.mobils.create');
    }

    /**
     * Simpan data mobil ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nopolisi' => 'required',
            'merk' => 'required',
            'kategori' => 'required',
            'kapasitas' => 'required|integer',
            'harga' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan data dengan user_id otomatis dari user yang login
        $mobil = new Mobil();
        $mobil->user_id = auth()->id(); // Otomatis mengambil user_id dari user yang sedang login
        $mobil->nopolisi = $request->nopolisi;
        $mobil->merk = $request->merk;
        $mobil->kategori = $request->kategori;
        $mobil->kapasitas = $request->kapasitas;
        $mobil->harga = $request->harga;

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $mobil->foto = $request->file('foto')->store('mobils', 'public');
        }
        
        $mobil->save(); // Simpan ke database

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil ditambahkan');
    }


    /**
     * Tampilkan form edit mobil.
     */
    public function edit(Mobil $mobil)
    {
        return view('admin.mobils.edit', compact('mobil'));
    }

    /**
     * Update data mobil.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nopolisi' => 'required|unique:mobils,nopolisi,' . $mobil->id,
            'merk' => 'required',
            'kategori' => 'required',
            'kapasitas' => 'required|integer',
            'harga' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('mobils', 'public');
        }

        $mobil->update($data);

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    /**
     * Hapus mobil dari database.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
