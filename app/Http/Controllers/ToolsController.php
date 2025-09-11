<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tools;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        try{
            return response()->json([
                'status' => 'success',
                'data' => $qrcode
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membuat QR Code.' . $e->getMessage()
            ], 500);
        }
    }
}
