<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Tools";
        $tools = Tools::all();
        return view('admin.tools.index', compact('title', 'tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Tools";
        return view('admin.tools.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
        $validatedData['slug'] = Str::slug($request->name);
        DB::beginTransaction();
        try {
            Tools::create($validatedData);
            DB::commit();
            return redirect()->route('admin.tools.index')->with('msg', 'Tools berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'Terjadi kesalahan saat menambahkan Tools.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tools $tools)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Edit Tools";
        $tool = Tools::findOrFail($id);
        return view('admin.tools.edit', compact('title', 'tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);
        $validatedData['slug'] = Str::slug($request->name);
        // dd($validatedData);
        DB::beginTransaction();
        try {
            $tool = Tools::findOrFail($id);
            $tool->update($validatedData);
            DB::commit();
            return redirect()->route('admin.tools.index')->with('msg', 'Tools berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'Terjadi kesalahan saat mengupdate Tools.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tools $tools)
    {
        //
    }
}
