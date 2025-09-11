<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\LaravelPdf\Facades\Pdf;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Tools $tools, $slug)
    {
        $tool = Tools::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $title = $tool->name;
        $view = 'user.tools.' . $tool->slug;
        if (!view()->exists($view)) {
            abort(404, 'Halaman tidak ditemukan.');
        }
        $dataKategori = Kategori::select('nama', 'slug')->get();
        $tools = Tools::where('status', 'active')->get();
        return view($view, compact(
            'title',
            'tool',
            'dataKategori',
            'tools'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tools $tools)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tools $tools)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tools $tools)
    {
        //
    }

    public function qrcodeGenerator(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $text = $request->input('text');

        $qrcode_object = QrCode::size(300)->generate($text);
        $qrcode_string = (string) $qrcode_object;
        $qrcode = preg_replace('/<\?xml.*?\?>\n/', '', $qrcode_string, 1);
        // dd($qrcode);
        try {
            return response()->json([
                'status' => 'success',
                'data' => $qrcode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membuat QR Code.' . $e->getMessage()
            ], 500);
        }
    }

    public function imageToPdf(Request $request)
    {
        // 1. Validasi request
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Maksimal 2MB per gambar
        ]);

        $imagePaths = [];
        $tempFiles = [];

        // 2. Simpan gambar yang diunggah ke storage sementara
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Simpan file ke storage/app/public/temp
                $path = $image->store('public/temp');
                $imagePaths[] = Storage::url($path); // Dapatkan URL publik
                $tempFiles[] = $path; // Simpan path untuk dihapus nanti
            }
        }

        // 3. Render view Blade yang berisi gambar, lalu konversi ke PDF
        $pdf = Pdf::view('user.tools.pdf.template', ['imagePaths' => $imagePaths])
            ->format('a4')
            ->margins(0, 0, 0, 0); // Atur margin menjadi 0

        // dd($pdf);
        // 4. Hapus file sementara setelah PDF dibuat
        foreach ($tempFiles as $file) {
            Storage::delete($file);
        }

        // 5. Kirim PDF ke browser untuk diunduh
        return $pdf->download('gambar-konversi.pdf');
    }
}
