<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleAI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleAIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Role AI";
        $data =  RoleAI::all();

        return view('admin.role-ai.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Role AI";
        return view('admin.role-ai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            RoleAI::create($validatedData);
            DB::commit();
            return redirect()->route('admin.role-ai.index')->with('msg', 'Role AI berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.role-ai.create')->with('msg', 'Terjadi kesalahan saat menambahkan Role AI.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleAI $roleAI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Edit Role AI";
        $roleAI = RoleAI::findOrFail($id);
        return view('admin.role-ai.edit', compact('title', 'roleAI'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'context' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $roleAI = RoleAI::findOrFail($id);
            $roleAI->update($validatedData);
            DB::commit();
            return redirect()->route('admin.role-ai.index')->with('msg', 'Role AI berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.role-ai.edit', $id)->with('msg', 'Terjadi kesalahan saat mengupdate Role AI.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $roleAI = RoleAI::findOrFail($id);
            $roleAI->delete();
            DB::commit();
            return redirect()->route('admin.role-ai.index')->with('msg', 'Role AI berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.role-ai.index')->with('msg', 'Terjadi kesalahan saat menghapus Role AI.' . $e->getMessage());
        }
    }
}
