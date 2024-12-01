<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Berita";
        $dataBerita = Berita::with(['kategori','user'])->orderBy('created_at', 'desc')->get();
        // dd($dataBerita);

        return view('admin.berita.index', compact(
            'title',
            'dataBerita'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Berita";
        $dataKategori = Kategori::select('id','nama')->get();

        return view('admin.berita.create', compact(
            'title',
            'dataKategori'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'title' => 'required|max:255',
            'berita' => 'required',
            'foto' => 'required|image',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-berita', 'public');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Berita::create($validatedData);

        return redirect()->route('admin.berita.index')->with('success', 'Berita Berhasil Ditambah!!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Berita $berita, $id)
    {
        $title = "Edit Berita";
        $dataKategori = Kategori::all();
        $dataBerita = Berita::where('id', $id)->first();
        // dd($dataBerita);
        return  view('admin.berita.show', compact(
            'title',
            'dataBerita',
            'dataKategori'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita, $id)
    {
        $title = "Edit Berita";
        $dataKategori = Kategori::all();
        $berita = Berita::where('id', $id)->first();
        return  view('admin.berita.edit', compact(
            'title',
            'berita',
            'dataKategori'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $kategori = Kategori::findOrFail($id);
        $dataBerita = Berita::where("id", $id)->first();
        $validatedData  = $request->validate([
            'title'     => 'required|max:255',
            "kategori_id" => 'required',
            "berita" => 'required',
            'foto' => 'image',
        ]);

        if ($request->file('foto')) {

            if ($dataBerita->foto) {
                Storage::delete('public/' . $dataBerita->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-berita', 'public');
            $dataBerita->foto = $validatedData['foto'];
        }

        $dataBerita->slug = null;
        $dataBerita->title = $validatedData['title'];
        $dataBerita->kategori_id = $validatedData['kategori_id'];
        $dataBerita->berita = $validatedData['berita'];

        $dataBerita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::where("id", $id)->first();
        // dd($berita);
        if ($berita->foto) {
            Storage::delete('public/' . $berita->foto);
        }
        Berita::where("id", $berita->id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }


    public function generateTopik()
    {
        $title = "Buat Postingan Dengan AI";
        return  view('admin.berita.ai.create', compact(
            'title'
        ));
    }

    public function generateBerita(Request $request)
    {
        $dataKategori = Kategori::all();
        $validatedData  = $request->validate([
            'topik'     => 'required|max:255',
        ]);
        $topik = $validatedData['topik'];
        $process = new Process(['python', base_path('app/python/generate-post.py'), $topik]);
        $process->run();

        // Periksa apakah eksekusi berhasil
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Parsing output JSON dari Python
        $output = json_decode($process->getOutput(), true);

        if (isset($output['error'])) {
            return redirect()->back()->with('error', 'Gagal membuat artikel dengan AI: ' . $output['error']);
        }

        // Arahkan ke view form edit dengan artikel
        return view('admin.berita.ai.edit', [
            'topik' => $topik,
            'post' => $output['artikel'],
            'dataKategori' => $dataKategori,
        ]);
    }
}
