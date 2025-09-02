<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Berita";
        $dataBerita = Berita::with(['kategori', 'user'])->orderBy('created_at', 'desc')->get();
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
        $dataKategori = Kategori::select('id', 'nama')->get();

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
        $dataKategori = Kategori::select('id', 'nama')->get();
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
        $dataBerita = Berita::where("id", $id)->first();
        $validatedData  = $request->validate([
            'title'     => 'required|max:255',
            "kategori_id" => 'required',
            "berita" => 'required',
            'foto' => 'image|file|2048',
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
        $berita = Berita::findOrFail($id);
        if ($berita->foto) {
            -Storage::delete('public/' . $berita->foto);
        }
        Berita::where("id", $berita->id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }


    public function berita_ai()
    {
        $title = "Buat Berita Dengan AI";
        $dataKategori = Kategori::all();
        return view('admin.berita.ai.create', compact('title', 'dataKategori'));
    }

    function berita_ai_generate(Request $request)
    {
        $validatedData = $request->validate([
            'prompt' => 'required',
        ]);

        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . env('GEMINI_API_KEY'), [
            "contents" => [
                "parts" => [
                    ["text" => $validatedData['prompt']]
                ]
            ]
        ]);

        if ($response->successful()) {
            $text = $response->json()['candidates'][0]['content']['parts'][0]['text'];
        } else {
            $text = "Something went wrong, Try again Later";
        }

       return response()->json([
            'status' => 'success',
            'data' => $text
        ]);
    }
}
