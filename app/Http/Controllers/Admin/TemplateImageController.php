<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Template Image";
        $templates = TemplateImage::all();
        return view('admin.template-image.index', compact('title', 'templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Template Image";
        return view('admin.template-image.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'template' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            TemplateImage::create($validatedData);
            DB::commit();
            return redirect()->route('admin.template-image.index')->with('msg', 'Template Image berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.template-image.create')->with('msg', 'Terjadi kesalahan saat menambahkan Template Image.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TemplateImage $templateImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Edit Template Image";
        $templateImage = TemplateImage::findOrFail($id);
        return view('admin.template-image.edit', compact('title', 'templateImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'template' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $templateImage = TemplateImage::findOrFail($id);
            $templateImage->update($validatedData);
            DB::commit();
            return redirect()->route('admin.template-image.index')->with('msg', 'Template Image berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.template-image.edit', $id)->with('msg', 'Terjadi kesalahan saat mengupdate Template Image.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $templateImage = TemplateImage::findOrFail($id);
            $templateImage->delete();
            DB::commit();
            return redirect()->route('admin.template-image.index')->with('msg', 'Template Image berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.template-image.index')->with('msg', 'Terjadi kesalahan saat menghapus Template Image.' . $e->getMessage());
        }
    }
}
