<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KategoriController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('kategori-read');
        $title = "Data Kategori";
        $dataKategori = Kategori::all();

        return view('admin.kategori.index', compact(
            'title',
            'dataKategori'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('kategori-create');
        $title = "Tambah Kategori";
        return view('admin.kategori.create', compact(
            'title'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('kategori-create');
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'foto' => 'nullable|image|max:1024',
        ]);

        // Menyimpan file foto
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-kategori', 'public');
        }

        // Menyimpan data kategori
        Kategori::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori Berhasil Ditambah!!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('kategori-update');
        $title = "Edit Data Kategori";
        $kategori = Kategori::findOrFail($id);
        return  view('admin.kategori.edit', compact(
            'title',
            'kategori'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('kategori-update');
        $kategori = Kategori::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'foto' => 'nullable|image|max:1024',
        ]);

        // Menyimpan file foto jika ada
        if ($request->file('foto')) {
            if ($kategori->foto) {
                Storage::delete('public/' . $kategori->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-kategori', 'public');
            $kategori->foto = $validatedData['foto'];
        }

        // Menyimpan data kategori
        $kategori->nama = $validatedData['nama'];
        $kategori->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori Berhasil Diubah!!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('kategori-delete');
        $kategori = Kategori::findOrFail($id);
        if ($kategori->foto) {
            Storage::delete('public/' . $kategori->foto);
        }
        Kategori::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }
}
