<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\RoleAI;
use App\Models\TemplateImage;
use Gemini;
use Illuminate\Http\Request;
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

        // dd($request->all());
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'title' => 'required|max:255',
            'berita' => 'required',
            'foto' => 'image',
            'generated_image_base64' => 'required_without:foto',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-berita', 'public');
        }

        if ($request->input('generated_image_base64')) {
            $imageData = $request->input('generated_image_base64');
            $imageName = 'foto-berita/' . uniqid() . '.png';
            Storage::disk('public')->put($imageName, base64_decode($imageData));
            $validatedData['foto'] = $imageName;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Berita::create($validatedData);

        return redirect()->route('admin.berita.index')->with(['msg' => 'Berita Berhasil Ditambahkan', 'class' => 'success']);
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
        $roleAi = RoleAI::all();
        $dataKategori = Kategori::all();
        $templates = TemplateImage::all();
        return view('admin.berita.ai.create', compact('title', 'dataKategori', 'roleAi', 'templates'));
    }

    function berita_ai_generate(Request $request)
    {
        $validatedData = $request->validate([
            'prompt' => 'required',
            'role_ai' => 'required',
        ]);

        $role = RoleAI::select('context')->where('id', $validatedData['role_ai'])->first();
        $client = Gemini::client(env('GEMINI_API_KEY'));
        try {
            $response = $client->generativeModel('gemini-2.0-flash')
                ->generateContent($role->context . ' ' . $validatedData['prompt']);

            $text = $response->candidates[0]->content->parts[0]->text;
            return response()->json([
                'status' => 'success',
                'data' => $text
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => 'Gagal, ada error: ' . $e->getMessage()
            ]);
        }
    }

    private function generate_prompt_image(Request $request)
    {
        $template_id = $request->template_image;
        $template = TemplateImage::findOrFail($template_id);

        $client = Gemini::client(env('GEMINI_API_KEY'));
        $prompt_image = $client->generativeModel('gemini-2.0-flash')
            ->generateContent('Buatkan Prompt untuk generate image berdasarkan teks berikut: ' . $request->text . 'jangan berikan respon selain prompt, hanya berikan prompt nya saja. gunakan template ini untuk promptnya (' . $template->template . ')');

        return $prompt_image->candidates[0]->content->parts[0]->text;
    }

    public function generate_image(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'template_image' => 'required',
        ]);

        try {
            $client = Gemini::client(env('GEMINI_API_KEY'));

            $text = $this->generate_prompt_image($request);
            $result = $client->generativeModel('gemini-2.5-flash-image-preview')
                ->generateContent($text);
            $image = $result->candidates[0]->content->parts[1]->inlineData->data;
            if ($image) {
                return response()->json([
                    'status' => 'success',
                    'image' => $image
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal membuat gambar. Ada masalah. Coba lagi nanti.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kuota API Anda mungkin telah habis atau ada masalah lain. Coba lagi nanti.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
