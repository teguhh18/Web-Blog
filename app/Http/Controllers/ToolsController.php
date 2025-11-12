<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tools;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mpdf\Mpdf;

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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // Maksimal 10MB per gambar
        ]);

        // dd($request->file('images'));

        try {
            // 2. Inisialisasi mPDF
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
            ]);

            // 3. Loop setiap gambar yang diupload
            foreach ($request->file('images') as $index => $image) {
                // Konversi gambar ke base64
                $imageData = base64_encode(file_get_contents($image->getRealPath()));
                $imageMime = $image->getMimeType();

                // Buat HTML untuk menampilkan gambar (full page, centered)
                $html = '
                    <div style="text-align: center; display: flex; align-items: center; justify-content: center; height: 100%; page-break-after: always;">
                        <img src="data:' . $imageMime . ';base64,' . $imageData . '" 
                             style="max-width: 100%; max-height: 100%; height: auto; object-fit: contain;" />
                    </div>
                ';

                // Tambahkan halaman baru jika bukan gambar pertama
                if ($index > 0) {
                    $mpdf->AddPage();
                }

                $mpdf->WriteHTML($html);
            }

            // 4. Simpan PDF ke folder storage/app/public/pdfs
            $fileName = 'converted_' . time() . '.pdf';
            $filePath = 'pdfs/' . $fileName;

            // Pastikan folder pdfs ada
            if (!file_exists(storage_path('app/public/pdfs'))) {
                mkdir(storage_path('app/public/pdfs'), 0755, true);
            }

            // Simpan file PDF
            $mpdf->Output(storage_path('app/public/' . $filePath), 'F');

            // 5. Return dengan session untuk menampilkan link download
            return back()->with('pdf_path', 'storage/' . $filePath);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengkonversi gambar: ' . $e->getMessage()]);
        }
    }
}
