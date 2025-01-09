<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Berita;
use App\Models\Comment;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeritaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $title = "Home";
        $dataBerita = Berita::with(['kategori'])->orderBy('created_at', 'desc')->paginate(9);
        $beritaPopuler = Berita::with(['kategori','user'])->orderBy('views', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama','slug')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data Berita Ditemukan',
            'dataBerita' => $dataBerita,
            'beritaPopuler' => $beritaPopuler,
            'dataKategori' => $dataKategori,
        ], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $berita = Berita::with(['kategori', 'user', 'comment'])->where('slug', $slug)->first();

        if (!$berita) {
            return response()->json([
                'status' => false,
                'message' => 'Data Berita Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Berita Ditemukan',
            'data' => $berita,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }

    public function comment(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail(); 
        // Validasi input
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }
        $validatedData = $validator->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['berita_id'] = $berita->id;
        // Menyimpan data comment
        Comment::create($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Mengirim Komentar!!',
        ], 200);

    }

    public function listKategori()
    {
        $dataKategori = Kategori::select('nama','slug')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data Kategori Ditemukan',
            'dataKategori' => $dataKategori,
        ], 200);
    }

    public function beritaByKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->first();
        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data Kategori Tidak Ditemukan',
            ], 404);
        }
        $dataBerita = Berita::with(['kategori'])->where('kategori_id', $kategori->id)->orderBy('created_at', 'desc')->paginate(9);
        
        
        return response()->json([
            'status' => true,
            'message' => 'Data Berita Ditemukan',
            'dataBerita' => $dataBerita,
        ], 200);
    }
}
